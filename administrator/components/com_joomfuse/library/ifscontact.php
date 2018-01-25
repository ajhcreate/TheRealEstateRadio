<?php
/**
 * Joomfuse IFS Contact
 * @package     admin.com_joomfuse
 * @subpackage	lib.ifscontact
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class IFSContact {
    public static $ifs_instances = array();    //Holds the cached IFSContacts for usage from getInstanceByUserId()

    /*
     * #__joomfuse_users columns
     */
    public $ifs_id = null;
    public $user_id = null;
    protected $beingDeleted = false;    //Flag that gets set to true when the JUser is being deleted. This is used from save() so we don't update the contact fields

    //The initial contact field state (before editing the user) so we can find out if something changed at save() time
    protected $initialContactFieldState = array();

    //@TODO-GN: clean up the hook vars when decided upon the shutdown thing
    protected static $hookOnShutdown = null;           //Whether we've we make the API calls on PHP shutdown or on __deconstruct
    protected static $checkedHookOnShutdown = false;    //Whether we've already checked on whether we make the API calls on PHP shutdown or on __deconstruct

    /*
     * Variables related to tags (ContactGroup)
     */
    private $ifs_tags = null;                  //The current tags of this contact BEFORE doing any update actions. Stays thesame throughout the execution
    private $add_ifs_tags = array();           //The set of tags plugins have requested to be added to this contact
    private $remove_ifs_tags = array();        //The set of tags plugins have requested to be removed from this contact
    protected static $numTagsCutOff = 1;       //The max amount of tags to be added+removed that will not trigger an extra getIFSTags() call from saveIFSTags()

    /*
     * Variables related to email Opt-ins
     */
    private $needsOptIn = false;               //When enable via OptIn(), the email of the contact AFTER saving will be opted-in
    private $optinMessage = 'By JoomFuse';     //The API message for the contact optIn (if requested)

    /*
     * Variables related to subscriptions
     */
    private $subscriptionList = null;
    private $recurringInvoicesList = null;
    private $jobsList = null;


    /*
     * Variables related to Credit Cards
     */
    private $creditcard_list = null;


    /**
     * Protected constructor. Only use getInstanceByUserId
     * @param Integer $user_id			The user id that is associated (or will be, since we autocreate contacts) with this contact
     * @throws Exception				Propagated up in case of an API error
     */
    protected function __construct($user_id = null){
        //if no(or 0) user id is given, don't initialize anything
        if (empty($user_id)){
            return;
        }

        //Load the user data from the DB or create the contact in IFS
        $this->load($user_id);
    }

    /**
     * Sets the beingDleted property to true
     * Called from the plg_user_joomfuse plugin so we know not to update contact fields (issues with blank field values coming from CB)
     * Checked from save() so we avoid the contact field updates
     */
    public function setUserBeingDeleted(){$this->beingDeleted = true;}

    /*
     * SAVE-RELATED FUNCTIONS
     */

    /**
     * Saves all information to Infusionsoft.
     * This function is called at the end of the page load by the JoomFuse system plugin.
     * We do this in order to have one point in the execution (as late as possible) where we have
     * to decide what data to push to IFS. After repeated JUser::save() calls (i.e. JomSocial), we can extrapolate
     * what has actually changed and what exactly we need to push to Infusionsoft.
     * This is also a good place to attempt to fork() the process so we can immediatelly disconnect the client while
     * the API calls keep executing in the back-end.
     */
    public static function saveAllData(){
        foreach (self::$ifs_instances AS $instance){
            /* @var $instance IFSContact */
            $instance->save();
        }
        self::$ifs_instances = array();    //Make sure we never make more than one save per contact;
    }

    /**
     * Saves all the contact information to Infusionsoft.
     * This includes contact fields and all related data (tags, optins etc).
     * It will also try to prune any unnecessary API calls by checking against the current state of the contact/user.
     * Notice that this function is protected, and only callable via the self::saveAllData() which is triggered upon script execution end
     */
    protected function save(){
        //Retrieve our custom plugin group, fire the getContactFields event and store them as the initial contact state
        JPluginHelper::importPlugin('joomfuse');
        $dispatcher = JEventDispatcher::getInstance();

        /*
         * STEP 1: See if the contact data changed during execution and only save the contact if something changed.
         * 		Also fire the onBeforeContactSave event and abort the entire process if any plugin objects
         */
        //Fetch the current (final) contact field values for this contact
        $finalFieldsState = array();
        $finalFieldsArray = $dispatcher->trigger('getJoomFuseContactFields',array($this->user_id, false));
        foreach($finalFieldsArray AS $fieldSet){
            foreach($fieldSet AS $field){
                if(!is_a($field, 'JoomfuseAPIField')){
                    JFactory::getApplication()->enqueueMessage('IFSContact received a non-JoomfuseAPIField reply from event getJoomFuseContactFields. Ignoring','warning');
                    continue;
                }
                //Save to associative array with key the API field name so we can resolve field conflicts between plugins (plugin execution sequence matters)z
                $finalFieldsState[$field->getFieldName()] = $field;
            }
        }

        //See if any of the plugins object to this contact save
        try{
            $dispatcher->trigger('onJoomFuseBeforeContactSave', array($this->user_id, $this->initialContactFieldState, $finalFieldsState));
        } catch(Exception $e){
            IFSFactory::logError('Contact '.$this->ifs_id.' save aborted due to plugin request at onBeforeContactSave: '.$e->getMessage());
            return;
        }

        //If contact field data has changed, push all the fields to IFS
        if(!$this->beingDeleted && $finalFieldsState != $this->initialContactFieldState){
            //We could argue here that we should only send over fields that have changed, but we push everything to take care of the odd field desyncs
            $api_results = IFSApi::updateContactById($finalFieldsState, $this->ifs_id);
            if(!$api_results->wasSuccess()){
                //Api error code 4 means no contact found, so attempt to re-associate the user to another contact with load()
                if($api_results->getAPIErrorCode()==5){
                    $this->recreateIFSUsersTableRow();
                    $api_results = IFSApi::updateContactById($finalFieldsState, $this->ifs_id);
                    if(!$api_results->wasSuccess()){
                        $message = 'Tried to re-associated user to contact but still cannot not update IFS contact (id: '.$this->ifs_id.'). Code:'.$api_results->getAPIErrorCode().' Message: '.$api_results->getAPIErrorMessage();
                        JFactory::getApplication()->enqueueMessage($message,'error');
                        IFSFactory::logError($message);
                        return;
                    }
                } else {
                    $message = 'Could not update IFS contact (id: '.$this->ifs_id.'). Code:'.$api_results->getAPIErrorCode().' Message: '.$api_results->getAPIErrorMessage();
                    JFactory::getApplication()->enqueueMessage($message,'error');
                    IFSFactory::logError($message);
                    return;
                }
            }
        }

        /*
         * STEP 2: SAVE TAGS
         */

        //Save tag additions/removals. saveIFSTags() checks on it's own on whether we need to change something or not.
        $this->saveIFSTags();

        /*
         * STEP 3: OPT-IN (it uses the final email)
         */
        if($this->needsOptIn){
            //Make sure there's an email to opt-in
            //$user = JFactory::getUser($this->user_id);
            $userTable = JTable::getInstance('User');
            $userTable->load($this->user_id);
            $email = $userTable->get('email','');
            if(!$email){
                $message = 'JoomFuse: Opt-in requested for user id: '.$this->user_id.' yet no email was set/found. Aborting optin';
                JFactory::getApplication()->enqueueMessage($message,'warning');
                IFSFactory::logError($message,JLog::NOTICE);
            } else {
                //Opt-in and ignore any failures. This is because opted-out emails cannot be opted in and the API returns an error
                IFSApi::optIn($email, $this->optinMessage);
            }
        }

        //Inform the plugins of the contact update
        $dispatcher->trigger('onJoomFuseAfterContactSave', array($this->user_id, $this->initialContactFieldState, $finalFieldsState));
    }

    /**
     * Re-creates the #__joomfuse_users row for the current user_id.
     * We need such functionality since even though we've stored the user_id/contact_id pairs, the IFS contact may end up getting deleted (or merged).
     * So when save() detects a non-existent contact_id, we need to re-associated (in case of merge) or re-create the IFS contact
     * @throws Exception		In the odd case that the #__joomfuse_users row does not exist (should never happen, but we check anyways)
     */
    protected function recreateIFSUsersTableRow(){
        $joomfuse_users_table = JTable::getInstance('IFSUser');
        if($joomfuse_users_table->load($this->user_id)){
            $joomfuse_users_table->delete();
        } else {
            throw new Exception('IFScontact::recreateIFSUsersTableRow could not loade table row with user_id: '.$this->user_id, 1);
        }

        $this->load($this->user_id);
    }

    /**
     * Loads the essentialy user data into the object (user_id and ifs_id).
     * Please notice that this function will also create a contact, if no association is found
     * It does the constructors main work, with the exception we can re-use it when re-assigning contact id's (i.e. the contact id we had stored is no longer there)
     * @param Numeric $user_id		The user id that is associated with this contact
     * @throws Exception			In case of a malformed user_id parameter
     */
    protected function load($user_id){
        //@TODO-GN: When a stored association has it's contact deleted from IFS, we may have to re-associate using this function.
        //@TODO-GN: The same probably applies for all API-using methods like OptIn() and getIFSTags()
        /*
        if(!($user = JFactory::getUser($user_id))){
            throw new Exception('IFSContact::__construct could not locate a user with id: '.$user_id, 1);
        }
        */
        
        //Alternative to using a JUser object as it creates problems with the static:: JUser cache and front-end updates.
        $userTable = JTable::getInstance('user');
        if(!$userTable->load($user_id)){
            throw new Exception('IFSContact::__construct could not locate a user with id: '.$user_id, 1);
        }

        //No matter what happens, this is the user id we'll end up with, so save it now
        $this->user_id = (int)$user_id;

        //Attempt to locate an entry in the #__joomfuse_users table
        $joomfuse_users_table = JTable::getInstance('IFSUser');
        if($joomfuse_users_table->load($user_id)){
            $this->ifs_id = (int)$joomfuse_users_table->ifs_id;
        } else {
            //If we did not find the respective ifs_contact, try to locate/autocreate one in IFS
            $this->ifs_id = $this->locateIFSContact($userTable->get('email'), $userTable->get('name'));
            $this->createUserContactAssociation();
        }

        //Retrieve our custom plugin group, fire the getContactFields event and store them as the initial contact state
        JPluginHelper::importPlugin('joomfuse');
        $dispatcher = JEventDispatcher::getInstance();
        $initialFieldsArray = $dispatcher->trigger('getJoomFuseContactFields',array($this->user_id, false));
        foreach($initialFieldsArray AS $fieldset){
            foreach($fieldset AS $field){
                if(!is_a($field, 'JoomfuseAPIField')){
                    JFactory::getApplication()->enqueueMessage('IFSContact received a non-JoomfuseAPIField reply from event getJoomFuseContactFields. Ignoring','warning');
                    continue;
                }
                //Save to associative array with key the API field name so we can resolve field conflicts between plugins (plugin execution sequence matters)
                if(isset($this->initialContactFieldState[$field->getFieldName()]) && !empty($this->initialContactFieldState[$field->getFieldName()])){
                    JFactory::getApplication()->enqueueMessage('IFSContact::save encountered the same IFS field mapped to two or more Joomla fields: '.$field->getFieldName().'. Only one of these mappings will take effect','warning');
                }
                $this->initialContactFieldState[$field->getFieldName()] = $field;
            }
        }
    }

    protected function createUserContactAssociation(){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->insert('#__joomfuse_users')
        ->columns($db->quoteName(array('id','ifs_id')))
        ->values((int)$this->user_id. ', '. (int)$this->ifs_id);

        try{
            $db->setQuery($query);
            $db->query();
        }catch(Exception $e){
            IFSFactory::logError('IFSContact::__construct could not save into the #__joomfuse_users table: '.$e->getMessage());
            throw $e;
        }

        //@TODO-GN: We need to properly save() here so all the data is properly pushed to IFS.
        //I don't think so, we call this from load() and there's no concrete reason to save right now. we're making possibly 2x API calls to what end?
        //Don't forget that we no longer refresh the tags after saving them, which implies that we don't support premature saving functionality at all
    }


    /**
     * Locates a pre-existing contact by the given email and name and creates it if it does not exist.
     * This method should always return a valid and existing IFS contact
     * @param String $email		The email to look for
     * @param String $name		The JUser name that we look for (we will contatenate fname and lname and compare the result to it)
     * @throws Exception		In case of an API error
     * @return Itenger			The contact Id of the found or created contact
     */
    private function locateIFSContact($email, $name){
        //See if we can find the contact by email and name
        $contacts = IFSApi::getContactsByEmail($email);
        foreach($contacts AS $contact){
            //Append the first name to the compare string, if the fname is set
            $concatenated_name = isset($contact->FirstName)? $contact->FirstName : '';
            if(isset($contact->LastName)){
                //Append a space if the first name was non-empty
                $concatenated_name .= (isset($contact->FirstName) && !empty($contact->FirstName))? ' ': '';
                //Append the last name
                $concatenated_name .= $contact->LastName;
            }

            //If the concatenated name and email match, then this is the contact we're looking for
            if(strtolower($concatenated_name) == strtolower($name) && isset($contact->Email) && strtolower($contact->Email) == strtolower($email)){
                return (int)$contact->Id;
            }
        }

        //We will now create the Contact according to the plugin contact fields state
        JPluginHelper::importPlugin('joomfuse');
        $dispatcher = JEventDispatcher::getInstance();

        $contactFields = array();
        $callResultsArray = $dispatcher->trigger('getJoomFuseContactFields',array($this->user_id, true));
        foreach($callResultsArray AS $fieldSet){
            foreach($fieldSet AS $field){
                if(!is_a($field, 'JoomfuseAPIField')){
                    JFactory::getApplication()->enqueueMessage('IFSContact::locateIFSContact received a non-JoomfuseAPIField reply from event getJoomFuseContactFields. Ignoring','warning');
                    continue;
                }
                //Save to associative array with key the API field name so we can resolve field conflicts between plugins (plugin execution sequence matters)
                $contactFields[$field->getFieldName()] = $field;
            }
        }

        $result = IFSApi::createContact($contactFields);
        if(!$result->wasSuccess()){
            $message = 'IFSUser::locateIFSContact failed to IFSApi::createContact: '.$result->getAPIErrorCode() . ': ' . $result->getAPIErrorMessage();
            IFSFactory::logError($message, JLog::ALERT);
            throw new Exception($message, 1);
        }

        return (int)$result->getResult();
    }

    /*
     * TAG-RELATED METHODS
     */

    /**
     * Gets the list of Infusionsoft tags assigned to the respective contact (of this user) in Infusionsoft
     * @param boolean $causesAPICall	Non-functional param, it's only there to remind developers via phpdoc
     * @return array					The array of infusionsoft tags as returned by IFSApi::getTagsByIFSId()
     * 										(an array of stdClass with the ContactGroupAssign table fields assigned to it)
     */
    public function getIFSTags($causesAPICall){
        //See if we have the tags cached and no force-refresh is requested
        if($this->ifs_tags !== null){
            return $this->ifs_tags;
        }

        //If this is a blank object (no ifs id set), then return just an empty array (new contacts have no tags set)
        if(!$this->ifs_id){
            $this->ifs_tags = array();
            return $this->ifs_tags;
        }

        //Fetch the tags and check for API errors
        $tags = IFSApi::getTagsByIFSId($this->ifs_id);
        if($tags === false){
            JFactory::getApplication()->enqueueMessage('IFSContact::getIFSTags failed the API Call','error');
            IFSFactory::logError('IFSContact::getIFSTags failed the API Call');
            $tags = array();
        }
        $this->ifs_tags = $tags;

        return $this->ifs_tags;
    }

    /**
     * Requests the assignement of a tag to this contact.
     * Warning: The tag will not be pushed to IFS until the contact object is saved
     * @param Numeric $tagId		The IFS tag ID to assign
     * @throws Exception			In case of incorrect tag id's
     */
    public function assignIFSTag($tagId){
        //Sanitize the parameters
        if(!is_numeric($tagId)){
            throw new Exception('IFContact::assignIFSTag received a non-numeric $tagid: '.$tagId, 1);
        }
        $tagId = (int)$tagId;

        //Assign this tag to be added upon save() as long as it doesn't exist in the $this->add_ifs_tags array
        if(!in_array($tagId, $this->add_ifs_tags)){
            $this->add_ifs_tags[] = $tagId;
        }

        //Check if we already requested to remove this tag
        if(in_array($tagId, $this->remove_ifs_tags)){
            $message = 'JoomFuse: The following tag was requested to be both added and removed from contact id '.$this->ifs_id.': '.$tagId."\nPlease make sure that this tag is only used once within all the JoomFuse configuration options (plugins included)";
            JFactory::getApplication()->enqueueMessage($message,'warning');
            IFSFactory::logError($message);
        }

        return;
    }

    /**
     * Requests the disassociation of a tag to this contact.
     * @param Numeric $tagId		The IFS tag ID to un-assign
     * @throws Exception			In case of an incorrect tag id
     */
    public function removeIFSTag($tagId){
        //Sanitize the parameters
        if(!is_numeric($tagId)){
            throw new Exception('IFContact::removeIFSTag received a non-numeric $tagid: '.$tagId, 1);
        }
        $tagId = (int)$tagId;

        //Assign this tag to be removed upon save() as long as it doesn't exist in the $this->add_ifs_tags array
        if(!in_array($tagId, $this->remove_ifs_tags)){
            $this->remove_ifs_tags[] = $tagId;
        }

        //Check if we already requested to remove this tag
        if(in_array($tagId, $this->add_ifs_tags)){
            $message = 'JoomFuse: The following tag was requested to be both added and removed from contact id '.$this->ifs_id.': '.$tagId."\nPlease make sure that this tag is only used once within all the JoomFuse configuration options (plugins included)";
            JFactory::getApplication()->enqueueMessage($message,'warning');
            IFSFactory::logError($message);
        }
    }

    /**
     * Checks to see on whether this user has the specified Infusionsoft tag (by tag name)
     * @param String $tagName			The Infusionsoft tag name
     * @param boolean $causesAPICall	Non-functional param, it's only there to remind developers via phpdoc
     * @return boolean					True if it exists, false if otherwise
     */
    public function hasIFSTagByName($tagName, $causesAPICall){
        $tags = $this->getIFSTags(true);

        foreach($tags AS $tag){
            if($tag->ContactGroup == $tagName){
                return true;
            }
        }

        return false;
    }

    /**
     * Checks to see on whether this user has the specified Infusionsoft tag (by tag id)
     * @param Numeric $tagName	The Infusionsoft tag id
     * @param boolean $causesAPICall	Non-functional param, it's only there to remind developers via phpdoc
     * @return boolean			True if it exists, false if otherwise
     */
    public function hasIFSTagById($tagId, $causesAPICall){
        $tags = $this->getIFSTags(true);

        foreach($tags AS $tag){
            if($tag->GroupId == $tagId){
                return true;
            }
        }

        return false;
    }

    /**
     * Saves the IFS Tags for this contact to infusionsoft according to the add/remove-tag lists
     *  created by assignIFSTag() and removeIFSTag() calls
     * Sensible pruning of the add/remove tag lists is performed against each other (removal takes precedence)
     *  and the current tags of the user (to avoid unnecessary APIcalls).
     * This method will attempt to display messages to the UI in case an API call fails
     * @throws Exception	In case the ifs_id of this object is not set
     */
    protected function saveIFSTags(){
        //@TODO-GN: If we have to add/delete X or less (x=[1-3]?) tags, then do it directly without fetching the current tags (need to calculate which is more efficient)
        //Make sure the ifs_id is set
        if(!$this->ifs_id){
            throw new Exception('IFSContact::saveIFSTags received a call when no ifs_id is set', 1);
        }

        //Abort if nothing needs to be changed
        if(empty($this->add_ifs_tags) && empty($this->remove_ifs_tags)){
            return;
        }

        //Subtract the tags to be removed from the tags to be added and vice versa
        $addTags = array_diff($this->add_ifs_tags, $this->remove_ifs_tags);
        $this->add_ifs_tags = $addTags;

        //See if it's worth the possible API call to fetch the current tags to prune needless adds/removes or just do the add/remove straight away
        if($this->ifs_tags !== null || (count($this->add_ifs_tags)+count($this->remove_ifs_tags)) > self::$numTagsCutOff){
            //Flatten the array of the tags this contact has so we can search more easily
            $tags = $this->getIFSTags(true);
            $flat_tags = array();
            foreach($tags AS $tag){
                $flat_tags[''.$tag->GroupId] = $tag->GroupId;
            }

            //Remove tags that are to be added if they are already present in the tags
            foreach($this->add_ifs_tags AS $key=>$value){
                if(isset($flat_tags[''.$value])){
                    unset($this->add_ifs_tags[$key]);
                }
            }

            //Remove tags that are to be removed if they are not already present in the tags
            foreach($this->remove_ifs_tags AS $key=>$value){
                if(!isset($flat_tags[''.$value])){
                    unset($this->remove_ifs_tags[$key]);
                }
            }
        }

        //Perform the group additions and removals. We also reset the add/remove-tags list, but this should not be moved (we now push data once per pageload)
        try{
            foreach($this->add_ifs_tags AS $addTag){
                IFSApi::assignTagToContact($addTag, $this->ifs_id);
            }
            $this->add_ifs_tags = array();

            //Perform the removals and clear the remove-list
            foreach($this->remove_ifs_tags AS $removeTag){
                IFSApi::removeTagFromContact($removeTag, $this->ifs_id);
            }
            $this->remove_ifs_tags = array();
        } catch(Exception $e){
            JFactory::getApplication()->enqueueMessage($e->getMessage(),'error');
            IFSFactory::logError($e->getMessage());
        }

        //Instead of forcing a refresh of the tags with $this->getIFSTags(true), we just null-out the local copy of the tags
        //This way, only if a new tag assignmenet/removal/fetch is requested will trigger the API call to fetch the tags (we may save 1 API call)
        $this->ifs_tags = null;

        //All done
        return;
    }

    public static function getInstanceByUserId($userid = 0){
        // Sanitize the input
        if (!is_numeric($userid)){
            throw new Exception('IFSContact::getInstanceByUserId was given an invalid userid: '.$userid, 1);
        }
        $id = (int)$userid;

        // If the $id is zero, just return an empty object.
        // Note: don't cache this user because it'll have a new ID on save!
        if ($id === 0){
            return new IFSContact();
        }

        // Check if the user ID is already cached.
        if (empty(self::$ifs_instances[$id]))
        {
            $contact = new IFSContact($id);
            self::$ifs_instances[$id] = $contact;
        }

        return self::$ifs_instances[$id];
    }

    /*
     *
     * SUBSCRIPTION-RELATED METHODS
     *
     */


    public function getSubscriptionList($causesAPICall){
        //Check the cache first
        if($this->subscriptionList !== null){
            return $this->subscriptionList;
        }

        if(($subscriptionList = IFSApi::getSubscriptionListByIFSId($this->ifs_id)) === false){
            $message = 'IFSContact::getSubscriptionLists could not fetch the contact subscriptions';
            JFactory::getApplication()->enqueueMessage($message,'error');
            IFSFactory::logError($message);
            $subscriptionList = array();
        }

        //Cache the result and return
        $this->subscriptionList = $subscriptionList;
        return $this->subscriptionList;
    }

    public function getInvoices($causesAPICall){
        //Check the cache first
        if($this->recurringInvoicesList !== null){
            return $this->recurringInvoicesList;
        }

        if(($invoicesList = IFSApi::getInvoicesByIFSId($this->ifs_id)) === false){
            $message = 'IFSContact::getInvoicesByIFSId could not fetch the contact recurring invoices';
            JFactory::getApplication()->enqueueMessage($message,'error');
            IFSFactory::logError($message);
            $invoicesList = array();
        }

        //Cache the result and return
        $this->recurringInvoicesList = $invoicesList;
        return $this->recurringInvoicesList;
    }

    public function getJobs($causesAPICall){
        //Check the cache first
        if($this->jobsList !== null){
            return $this->jobsList;
        }


        if(($jobsList = IFSApi::getJobsByIFSId($this->ifs_id)) === false){
            $message = 'IFSContact::getJobs could not fetch the contact jobs';
            JFactory::getApplication()->enqueueMessage($message,'error');
            IFSFactory::logError($message);
            $jobsList = array();
        }
        
        //Cache the result and return
        $this->jobsList = $jobsList;
        return $this->jobsList;

    }
    
    public function getJob($jobId, $causesAPICall){
        //Make sure the cache is populated
        if($this->jobsList == null){
            $this->getJobs(true);
        }
        
        //Search through the cache for the requested job entry
        foreach($this->jobsList AS $job){
            if(isset($job->Id) && $job->Id == $jobId){
                return $job;
            }
        }
        
        //Nothing found
        return false;
    }


    /*
     *
     * MISC METHODS
     *
     */

    /**
     * Runs the specified actionset on this contact
     * @param Numeric $actionsetId				The actionset Id to execute on this contact
     * @param Boolean $causesAPICall			(Ignored) A warning param to remind developers that this method triggers a synchronous API call
     * @throws Exception						Propagated up from IFSApi::runActionSet in case of an API error
     * @return boolean
     */
    public function runActionSet($actionsetId, $causesAPICall){
        try{
            IFSApi::runActionSet($this->ifs_id, $actionsetId);
        } catch (Exception $e){
            JFactory::getApplication()->enqueueMessage($e->getMessage(),'error');
            return false;
        }

        //All checks out
        return true;
    }

    /**
     * Runs the specified actionset on this contact
     * @param Numeric $actionsetId				The actionset Id to execute on this contact
     * @param Boolean $causesAPICall			(Ignored) A warning param to remind developers that this method triggers a synchronous API call
     * @throws Exception						Propagated up from IFSApi::runActionSet in case of an API error
     * @return boolean
     */
    public function achieveGoal($callName, $integration, $causesAPICall){
        //Extrapolate a callname/integration from a composite callName.Integration naming scheme
        if(strpos($callName, '.') !== false){
            $callNameArray = explode('.', $callName);
            if(isset($callNameArray[0])){
                $integration = $callNameArray[0];
            }
            if(isset($callNameArray[1])){
                $callName = $callNameArray[1];
            }
        }

        try{
            IFSApi::achieveGoal($this->ifs_id, $callName, $integration);
        } catch (Exception $e){
            JFactory::getApplication()->enqueueMessage($e->getMessage(),'error');
            return false;
        }
         

        //All checks out
        return true;
    }

    /**
     * Gets all the credit card information assigned to this contact
     * @param boolean $causesAPICall		(Ignored) A warning param to remind developers that this method triggers a synchronous API call
     * @return Array						The array containing the credit card DB rows
     */
    public function getCreditCards($causesAPICall){
        //Check the cache first
        if($this->creditcard_list !== null){
            return $this->creditcard_list;
        }

        if(($creditcards = IFSApi::getCreditCardsByIFSId($this->ifs_id)) === false){
            $message = 'IFSContact::getCreditCards could not fetch the contact credit card list';
            JFactory::getApplication()->enqueueMessage($message,'error');
            IFSFactory::logError($message);
            $creditcards = array();
        }

        //Cache the result and return
        $this->creditcard_list = $creditcards;
        return $this->creditcard_list;
    }


    /**
     * Requests that the contact will be opted in
     * WARNING: the opted-in email will be the one at the end of the script execution.
     * This means that if we're dealing with a pageload that changes the user email (i.e. joomla profile edit),
     * then the opted-in email is the changed-to one (not the changed-from, which we no longer care)
     * @param String $message		(Optional) The opt-in message for the API
     */
    public function OptIn($message = null){
        $this->needsOptIn = true;
        if($message){
            $this->optinMessage = (String)$message;
        }
    }

}