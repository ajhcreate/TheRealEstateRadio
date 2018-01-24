<?php
/**
 * Joomfuse plugin for the Joomla plugingroup
 * @package     site.com_joofuse.plugins
 * @subpackage	joomfuse.joomla
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

//No direct access
defined( '_JEXEC' ) or die( '' );

// Import library dependencies
jimport( 'joomla.plugin.plugin' );

//Import/register the IFSFactory that takes care of all the required files
JLoader::register('IFSFactory', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/ifsfactory.php');
JLoader::register('PlgUserJoomfuse', JPATH_SITE.'/plugins/user/joomfuse/joomfuse.php');
JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR.'/components/com_fields/helpers');
JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_fields/models');

/**
 * Joomfuse Joomla plugin
 * Handles all the joomfuse events related to vanilla Joomla
 *
 * WARNING developers: Pay attention that we implement the IFSPlugin interface. This will help you build your own extensions
 *
 * @package		joomla.joomfuse
 * @subpackage	JoomFuse.plugins
 * @copyright	Copyright Zacaw Enterprises Inc. All rights reserved.
 * @since 		3.0
 */
class plgJoomfuseJoomla extends JPlugin{
    //Plugin configuration options
    private $allowNewUserEmails = 1;
    private $tagGroupAssociation = array();
    protected  $field_associations = array();  //Vanilla joomla and profile field associations


    /**
     * Custom constructor so we can load the Joomfuse component parameters.
     * Some of those parameters are specific to this plugin
     */
    public function __construct(&$subject, $config = array()){
        parent::__construct($subject, $config);

        //Extrapolate plugin configuration
        $this->allowNewUserEmails = $this->params->get('allowNewUserEmails', '1');

        //Retrieve the parameters
        $params = JComponentHelper::getParams('com_joomfuse');
        if(!$params){
            //JErrorPage::render('plgJoomfuseJoomla::__construct could not retrieve the com_joomfuse configuration options');
            JFactory::getApplication()->enqueueMessage('plgJoomfuseJoomla::__construct could not retrieve the com_joomfuse configuration options');
        }
        /* @var $params JRegistry */

        //Retrieve the component parameters, and default the values to what config.xml sets as the params may not have been saved yet
        $this->tagGroupAssociation = $params->get('tag_group_associations',array());

        //Retrieve the field associations
        $associations = $params->get('field_associations',array());
        foreach($associations AS $key=>$association){
            //Ignore incorrectly set or empty values
            if(!$association->ifsField || !$association->joomlaField){
                continue;
            }
            $this->field_associations[] = $association;
        }

    }

    /*
     * HTTP POST PARSING EVENTS
     */

    /**
     * Event that triggers at the near-beggining of an HTTP POST from Infusionsoft
     */
    public function onIFSHTTPPostStart(){
        //Nothing to do here
        return;

    }

    /**
     * Handle the event that signals the succesful parsing of an HTTP POST
     * @param array $userProperties		The IFSUser object properties that was handled in this HTTP POST
     * @param bool $isNew				Whether this IFSUser was just created or not (just updated)
     */
    public function onIFSHTTPPostComplete(array $userProperties, $isNew){
        //Nothing to do here.
        return;
    }

    /**
     * Event that requests which Contact fields we would like to fetch for a contact.
     * If it wasn't for custom fields, there would be no need (we would fetch all known contact fields), but since we do have
     * support for custom fields, we need to define all of them here.
     * This event is fired at the beggining of the HTTP POST parser so we can fetch all standard contact fields plus the custom ones (defined here)
     * @return	JoomfuseFieldMapping	The JoomfuseFieldMapping containing the appropriate JoomfuseFieldMapElements
     */
    public function getCustomFieldMappings(){
        //Initialize the result
        $fieldMaps = new JoomfuseFieldMapping(get_class($this));

        //Find which fields we are supposed to save
        foreach($this->field_associations AS $association){
            //Custom fields start with an underscore, so search for those in the configured mappings
            if(strpos($association->ifsField,'_')===0){
                $ifsFieldType = isset($association->ifsFieldType) && $association->ifsFieldType ? JoomfuseTableDataFormField::translateDataTypeToFieldType($association->ifsFieldType) : JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING;
                //@TODO-GN: We are always casting to string. This is bound to explode in our face sooner or later
                $fieldMaps->addField(new JoomfuseFieldMapElement('joms'.$association->ifsField, 'joms_id_'.$association->joomlaField, $association->ifsField, $ifsFieldType));
            }
        }

        //Return the result
        return $fieldMaps;
    }


    /**
     * Decide which user groups to remove from the user based on the Infusionsoft tags and the Groups that are about to be added
     * @param IFSContact $ifs_contact	The IFSContact object
     * @param array $addedGroups		The array of groups that the component is about to add to this user
     * @param bool $isNew				Whether this user is new or not
     * @return array					The array of user group id's to be removed from this user
     */
    public function onPrepareACLDrop(IFSContact $ifs_contact, array $addedGroups, $isNew){
        $returnArray = array();    //The array holding the user group id's we want to drop

        //This plugin removes the usergroup if the tag is not present in the contact. So we do the inverse of onPrepareACLGrant

        //Check for tag/usergroup associations
        foreach($this->tagGroupAssociation AS $association){
            //Extrapolate the entries from the association row as defined in the joomfuse config.xml
            $usergroup = (int)$association->usergroup;
            $tag = (int)$association->tag;
            $suspend_tag = (int)$association->suspend_tag;

            //If this is a valid association and the contact does not have the association tag, then remove the association usergroup
            if($usergroup && $tag){
                //If the ususer does NOT have the tag associated with the current usergroup we're looking at OR has the 'suspend' tag, we remove his usergroup
                if(!$ifs_contact->hasIFSTagById($tag, true) || ( $suspend_tag && $ifs_contact->hasIFSTagById($suspend_tag, true) )){
                    $returnArray[] = $usergroup;
                }
            }
        }

        return $returnArray;
    }

    /**
     * Decide which user groups to add to the user based on the Infusionsoft tags and the Groups that are about to be added
     * @param IFSContact $ifs_contact	The IFSContact object
     * @param bool $isNew				Whether this user is new or not
     */
    public function onPrepareACLGrant(IFSContact $ifs_contact, $isNew){
        $returnArray = array();

        //Check for tag/usergroup associations
        foreach($this->tagGroupAssociation AS $association){
            //Extrapolate the entries from the association row as defined in the joomfuse config.xml
            $usergroup = (int)$association->usergroup;
            $tag = (int)$association->tag;
            $suspend_tag = (int)$association->suspend_tag;

            if($usergroup && $tag){
                //If the user has the mapped tag, append the usergroup only if the suspend tag is not defined or he doesn't have the suspend tag
                if($ifs_contact->hasIFSTagById($tag, true) && (!$suspend_tag || !$ifs_contact->hasIFSTagById($suspend_tag, true)) ){
                    $returnArray[] = $usergroup;
                }
            }
        }

        return $returnArray;
    }

    public function onCustomUserRegistration($ifs_contact){
        return;
        /*
         * There are two uses for this event:
         * 1) See what fields are about to be assigned to a newly created user and possibly abort the process
         * 2) Override Joomfuses' registration process and implement your own.
         *
         * CHECKING THE JOOMLA FIELDS:
         * if(isset($joomlaFields['name']) && $joomlaFields['name']=='monkey'){
         * 		//You can only abort the process by throwing a generic Exception that contains a message
         * 		//That message will be returned as the failure reason to the HTTP POST
         * 		throw new Exception('monkeys are not allowed',1);
         * }
         *
         * CUSTOM REGISTRATION PROCESS:
         * Sample implementation of a custom user registration process.
         * Use this function ONLY when you cannot properly sync the component-created vanilla-joomla user
         * with your extensions' tables via the onJoomlaFieldSave and it's $isNew=true parameter.
         * I'm not aware of any such cases (i.e. CB/JomSocial have some simple steps), but this is supported anyways.
         * Be aware that if more than one plugins do their own custom registration process, only the first one in
         * the execution order will have it's opportunity to create the user, so never assume that you will always get your call.
         *
         * 		$userTable = JTable::getInstance('user');
         *
         *      //Save the new user and check for errors. Let JTableUser do all the checking for us.
         *      //NOTICE: We actually save directly to the User table which means no events are being thrown.
         *      //If you want to throw events, instantiate a JUser and save him instead.
         *      if(!$userTable->save($joomla_fields)){
         *          return; //Returning nothing will give the opportunity to another plugin or the component to create the user
         *          //If you wanted to abort this process too, you could throw a generic Exception with the $userTable->getError() message
         *          //which could be 'Please enter a name' or something similar
         *      } else {
         *      	//Be SURE to throw an JoomfuseRegistrationSuccess exception (parameters are this class and the IFSUser object that has been SAVED)
         *      	//when you actually register the user. This way the component knows to stop calling for other plugins to register the
         *      	//user and avoid doing the registration on it's own.
         *      	throw new JoomfuseRegistrationSuccess($this, $user->get('id'));
         *      }
         *
         */
    }

    /**
     * Event fired when we need to set the Joomla fields according to contact field values.
     * This event is fired exclusively from the HTTP POST parser
     * WARNING: the $ifs_contact may be missing fields that have no value in IFS (API behavior)
     * @param Numeric $user_id			The id of the user we need to update
     * @param stdClass $ifs_contact		An stdClass with members all the Contact fields and mapped custom fields
     * @param boolean $isNew			Whether the user was just created or this is an update
     */
    public function onSetJoomlaFieldsFromContact($user_id, $ifs_contact, $isNew){
        //@TODO-GN: WARNING: There is duplicate code of this in ifsfactory. We have to fix this somehow
        //When the user is first created, we share the exact same fields with the post parser code, therefore we do nothing
        if($isNew){
            return;
        }

        /* We don't need to do anything, the post parser should've taken care of everything*/
        $user = IFSFactory::getUser($user_id);
        $bindArray = array();

        //This should never happen, but check anyways
        if($user->guest){
            throw new Exception('onSetJoomlaFieldsFromContact was called for a visitor.', 1);
        }

        //We should always honor the $this->getFieldMappings() replies.
        //But since most of the fields we set there are registration-only, we will just do things manually instead
        $fname = isset($ifs_contact->FirstName) ? (string)$ifs_contact->FirstName : '';
        $lname = isset($ifs_contact->LastName) ? (string)$ifs_contact->LastName : '';
        $name = IFSFactory::getNameByFLName($fname, $lname);
        if($name && $name != $user->get('name')){
            $bindArray['name'] = $name;
        }

        //See if there's an email set.
        //There is a special situation where the IFS email can be empty (now allowed in IFS), but we don't allow empty emails in Joomla
        if(isset($ifs_contact->Email) && !empty($ifs_contact->Email) && strtolower($ifs_contact->Email) != strtolower($user->get('email'))){
            $bindArray['email'] = (string)$ifs_contact->Email;
        }

        //Fetch the current plg_user_profile fields array. We have to use the current values as plg_user_profile deletes all rows
        //before inserting any new data. And we may have just mapped one out of the entire list of profile fields...
        $original_profileFields = $this->getProfileFields($user_id);

        //Extract the groups of fields from the original profile fields
        $original_custom_fieldgroups = array();
        foreach($original_profileFields AS $original_profileField=>$value){
            $original_array = explode('.', $original_profileField);
            if(count($original_array) != 2){
                JFactory::getApplication()->enqueueMessage('plg_joomfuse_joomla/onSetJoomlaFieldsFromContact encountered an unexpected original_profilefile: '.$original_profileField);
                continue;
            }

            $grpName = $original_array[0];
            $fldName = $original_array[1];

            if(!isset($original_custom_fieldgroups[$grpName])){
                $original_custom_fieldgroups[$grpName] = array();
            }
            $original_custom_fieldgroups[$grpName][$fldName] = $value;
        }

        //Assign values according to the field maps
        foreach($this->field_associations AS $association){
            $contact_field_name = $association->ifsField;
            $ifsFieldType = isset($association->ifsFieldType) && $association->ifsFieldType ? JoomfuseTableDataFormField::translateDataTypeToFieldType($association->ifsFieldType) : JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING;
            $contact_value = isset($ifs_contact->$contact_field_name) ? JoomfuseFieldMapElement::castInfusionsoftValueToJoomla($ifs_contact->$contact_field_name, $ifsFieldType) : '';

            //Check if this is a profile field. JFormFieldJoomfuseprofilefield stores the selected profile field as <fieldgroupname>.<fieldname>
            if(strpos($association->joomlaField, '.')){
                //JFactory::getApplication()->enqueueMessage('non-profile field map field-get');
                $fieldname_arr = explode('.', $association->joomlaField);

                //We expect to have exactly 2 array elements (one . separator)
                if(count($fieldname_arr) != 2){
                    JFactory::getApplication()->enqueueMessage('plg_joomfuse_joomla/onSetJoomlaFieldsFromContact encountered an unsupported joomla field name: '.$association->joomlaField);
                    continue;
                }

                $groupName = $fieldname_arr[0];
                $fieldName = $fieldname_arr[1];

                //See if the groupname array is set in the bind array.
                //If not, we need to fetch the current (i.e. what the user had before the update) values or we'll end up
                //deleting values that were not mapped (the custom profile field plugins work on a mass-delete&insert basis)
                if(!isset($bindArray[$groupName])){
                    $bindArray[$groupName] = (isset($original_custom_fieldgroups[$groupName])? $original_custom_fieldgroups[$groupName] : array());
                }

                $bindArray[$groupName][$fieldName] = $contact_value;

            } else {
                //No empty usernames or passwords
                if(in_array($association->joomlaField, array('username','password')) && empty($contact_value)){
                    JFactory::getApplication()->enqueueMessage('plg_joomfuse_joomla received an empty username or password. Ignoring the value','warning');
                    continue;
                }

                //Plain Joomla field.
                $bindArray[$association->joomlaField] = $contact_value;

                //If this is the password, we need to mirror it in password2
                if($association->joomlaField == 'password'){
                    $bindArray['password2'] = $contact_value;
                }
            }

        }

        //If nothing has changed in the profile fields (i.e. a POST arrived with the same plg_user_profile fields as we had before), don't do anything
        foreach($original_custom_fieldgroups AS $grpName=>$grpFields){
            if(isset($bindArray[$grpName]) && $bindArray[$grpName] == $grpFields){
                unset($bindArray[$grpName]);
            }
        }

        if(!empty($bindArray)){
            try{
                //bind and save can either return false and setErrorMessage or throw an exception. Do both by throwing on false
                if(!$user->bind($bindArray) || !$user->save()){
                    throw new Exception($user->getError(), 1);
                }
            } catch(Exception $e){
                $message = 'plg_joomfuse_joomla encountered an error while updating the user: '.$e->getMessage();
                IFSFactory::logError($message);
                JFactory::getApplication()->enqueueMessage('JoomFuse encountered an error while updating the user. Please contact the administrator','error');
            }
        }

        return;
    }

    /**
     * Retrieve the plg_user_profile profile field values for the given user
     * @param int $user_id		The user id
     */
    protected function getProfileFields($user_id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query->select('profile_key, profile_value');
        $query->from('#__user_profiles');
        $query->where('user_id = '.intval($user_id));
        $query->order('ordering ASC');
        $db->setQuery($query);

        //Uncaught excepion! Let it propagate all the way up
        $results = $db->loadObjectList();

        $returnArray = array();
        foreach($results AS $result){
            $returnArray[$result->profile_key] = json_decode($result->profile_value);
        }
        
        //Fetch the J3.7 custom fields, if any
        if(class_exists('FieldsHelper')){
        	//@TODO: Add the JLoader for this.
        	//Fetch the com_fields/field model so we can use getFieldValue. FieldsHelper::getFields(X,Y,true) fetches old 
        	//	data when dealing with user udpates (post-update we get pre-update data due to caching)
        	if(!($model = JModelLegacy::getInstance('Field', 'FieldsModel', array('ignore_request' => true)))){
        		IFSFactory::logError('plgJoomfuseJoomla failed to fetch the FieldsModelField', JLog::ERROR);
        		return $returnArray;
        	}
        	
        	//Fetch the fields data from the Fields Helper
        	$item_obj = new stdClass();
        	$item_obj->id = $user_id;
        	$com_fields_array = FieldsHelper::getFields('com_users.user', $item_obj);
        	foreach($com_fields_array AS $field){
        		
        		$returnArray['com_fields.'.$field->name] = $model->getFieldValue($field->id, $user_id);
        	}
        }

        return $returnArray;

    }


    /*
     * EVENTS RELATED TO PUSHING DATA TO INFUSIONSOFT
     */

    /**
     * Event fired right before the saving of a contact.
     * This event is fired for the plugins to get a final say right before the a contact save.
     * The $fieldMappings may contain some associations from other plugins that we do not like, so we get a chance to abort the process
     * by returning false
     * @param Integer $user_id										The user id associated with this contact
     * @param Array[JoomFuseAPIField] $initialContactFieldState		The array of initial contact fields state/values (see getJoomFuseContactFields)
     * @param Array[JoomFuseAPIField] $finalFieldsState				The array of final contact fields state/values (see getJoomFuseContactFields)
     * @throws Exception											In case we want to abort the contact save process
     */
    public function onJoomFuseBeforeContactSave($userid, array $initialContactFields, array $finalContactFields){
        //throw new Exception('This would forbid all contact updates', 1);
        //Nothing to do here
        return;
    }

    /**
     * A simple notice that the contact has been saved to IFS
     * @param Integer $userid									The userid associated with the contact that is being updated
     * @param Array[JoomfuseAPIField] $initialContactFields		The initial (before any updates) contact field state
     * @param Array[JoomfuseAPIField] $finalContactFields		The final (the one we save) contact field state
     */
    public function onJoomFuseAfterContactSave($userid, array $initialContactFields, array $finalContactFields){
        //Nothing to do here
        return;
    }


    /**
     * Returns the contact field values given the current user state.
     * There is a peculiar usage of this event from JoomFuse. It is called two or three times for each loaded contact:
     * Once when the IFSContact object is loaded to get the initial (unmodified) state of the user
     * Once when the application is shutting down to get the final state of the user.
     * Lastly, if the contact was autocreated from IFSContact::load, then this event will be thrown to decide upon the contact field values
     * IF the two states differ, the final-state contact fields are all pushed to IFS.
     * So care must be taken to always load the IFSContact in your plugins before any modifications to the relevant user is made
     * (for example, plg_joomla_joomfuse loads the contact onBeforeUserSave)
     * NOTICE: If more than one plugins try to send data for the same contact field, the one last in the plugin execution order will take precedence
     * @param Numeric $user_id				The user id for which we should return contact fields
     * @param boolean $isContactCreation	Whether this is a contact creation or not
     * @return Array[JoomfuseAPIField]		The array with the JoomfuseAPIField elements, ready for pushing through the API
     */
    public function getJoomFuseContactFields($user_id, $isContactCreation = false){
        //$user = JFactory::getUser($user_id);
        //$user = JUser::getInstance($user_id);

        //Load the JTableUser object for this user.
        //We HAVE to load the table because JFactory::getUser will return us the current state of the object,
        //and if this is the event triggered from IFScontact->load ('get initial state'), which was triggered
        //by the onBeforeUser() user event, then we will end up with the updated user object (bind precedes the OnBeforeUserUpdate event)
        $user = JTable::getInstance('User');
        if(!$user->load($user_id)){
            //This is probably a deletion, so do nothing
            return;
            //throw new Exception('plg_joomfuse_joommla could not load user table row with id: '.$user_id, 1);
        }

        //Prepare the return array
        $returnArray = array();

        //Extract the email
        if($email = $user->get('email','')){
            $returnArray[] = new JoomfuseAPIField('Email', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $email);
        }

        //Extract the first and last name
        if($name = $user->get('name','')){
            if($fname = IFSFactory::getFirstNameFromName($name)){
                $returnArray[] = new JoomfuseAPIField('FirstName', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $fname);
            }

            if($lname = IFSFactory::getLastNameFromName($name)){
                $returnArray[] = new JoomfuseAPIField('LastName', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $lname);
            }
        }

        //See if any joomla/profile field mappings are set
        $profile_fields = $this->getProfileFields($user_id);
        foreach($this->field_associations AS $association){
            $joomlafield = $association->joomlaField;
            $ifsFieldType = isset($association->ifsFieldType) && $association->ifsFieldType ? JoomfuseTableDataFormField::translateDataTypeToFieldType($association->ifsFieldType) : JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING;
            //Profile field
            if(strpos($joomlafield, '.')!== false){
                $value = isset($profile_fields[$joomlafield]) ? JoomfuseFieldMapElement::castJoomlaValueToInfusionsoft($profile_fields[$joomlafield], $ifsFieldType) : '';
                $returnArray[] = new JoomfuseAPIField($association->ifsField, $ifsFieldType, $value);
            } else if($joomlafield == 'password'){
                //See if we can find the plaintext password of this user.
                //If we can't, it means that he didn't change it, so we don't push any value to IFS
                if($plaintext_password = PlgUserJoomfuse::getUserPassword($user_id)){
                    $returnArray[] = new JoomfuseAPIField($association->ifsField, $ifsFieldType, $plaintext_password);
                }
            } else {
                //Plain field. Most likely 'username'.
                $returnArray[] = new JoomfuseAPIField($association->ifsField, $ifsFieldType, (String) $user->get($joomlafield,''));
            }
        }

        //Done, return the array of JoomfuseAPIFields that we created
        return $returnArray;
    }

    /**
     * Called from the HTTP-POST based creation of new user accounts.
     * We need to decide on whether we want to send an email or not not and it's contents.
     * WARNING: This event is not thrown if the com_joomfuse config gags all new user emails
     * @param array $userProperties
     */
    public function onNewUserRegistrationEmail(array $userProperties, $password){
        //See if the plugin configuration does not allow sending new-user emails
        if($this->allowNewUserEmails !=1 ){
            return false;
        }
         
        //Retrieve the com_users and global configuration
        $params = JComponentHelper::getParams('com_users');
        if(!$params){
            return false;
        }
        $config = JFactory::getConfig();

        //Load com_users language files
        JFactory::getLanguage()->load('com_users',JPATH_SITE);
         
        //Retrieve new-user email-related configuration options
        $useractivation = $params->get('useractivation');
        $sendpassword = $params->get('sendpassword', 1);
        $sitename = $config->get('sitename');
         
        //See if new-user-emails are allowed.
        //Config values 1 and 2 are admin-activated and user-activated, hence ignored
        if($useractivation == 1 || $useractivation == 2){
            return false;
        }
         
        //Compose the email contents/title
        //Taken straight from the com_users model registration (front-end)
        $returnArray = array();
        $returnArray['topic'] = JText::sprintf('COM_USERS_EMAIL_ACCOUNT_DETAILS', $userProperties['name'], $sitename);
        if ($sendpassword){
            $returnArray['content'] = JText::sprintf('COM_USERS_EMAIL_REGISTERED_BODY', $userProperties['name'], $sitename, JUri::root(), $userProperties['username'], $password);
        } else {
            $returnArray['content'] = JText::sprintf('COM_USERS_EMAIL_REGISTERED_BODY_NOPW', $userProperties['name'], $sitename, JUri::root());
        }
         
        //Done
        return $returnArray;
    }

    /**
     * Event fired after a user has been sucesfully deleted (thrown from plg_user_joomfuse)
     * We need to delete all the tags that we're aware of (tags configured in the component back-end)
     * @param Array $userProperties	The associative array of user properties that the user had
     */
    public function onContactUserDelete($userProperties){
        //We have access to the IFSContact object as it's been already cached
        $ifsContact = IFSFactory::getUserContact($userProperties['id']);
        if(!$ifsContact){
            JFactory::getApplication()->enqueueMessage('plgJoomfuseJoomla::onContactUserDelete could not load the contact object','warning');
            return;
        }

        //Retrieve the parameters
        $params = JComponentHelper::getParams('com_joomfuse');
        if(!$params){
            //JErrorPage::render('plgJoomfuseJoomla::__construct could not retrieve the com_joomfuse configuration options');
            JFactory::getApplication()->enqueueMessage('plgJoomfuseJoomla::onContactUserDelete could not retrieve the com_joomfuse configuration options','warning');
            return;
        }
        /* @var $params JRegistry */

        //Retrieve the component parameters, and default the values to what config.xml sets as the params may not have been saved yet
        //WARNING: we do NOT delete the allowNewUsersOnTag
        $newUserTag = $params->get('newUserTag',false);
        $newPostUserTag = $params->get('newPostUserTag',false);
        $successHttppostContactTag = $params->get('successHttppostContactTag', false);
        $failHttppostContactTag = $params->get('failHttppostContactTag', false);

        //We already know the associations, so remove all tags and suspended tags
        foreach($this->tagGroupAssociation AS $association){
            //Extrapolate the entries from the association row as defined in the joomfuse config.xml
            $ifsContact->removeIFSTag((int)$association->tag);
            $ifsContact->removeIFSTag((int)$association->suspend_tag);
        }

        //Remove the new user tag
        if($newUserTag){
            $ifsContact->removeIFSTag((int)$newUserTag);
        }

        //Remove the new POST user tag
        if($newPostUserTag){
            $ifsContact->removeIFSTag((int)$newPostUserTag);
        }

        //Remove the post success tag
        if($successHttppostContactTag){
            $ifsContact->removeIFSTag((int)$successHttppostContactTag);
        }

        //Remove the post fail tag
        if($failHttppostContactTag){
            $ifsContact->removeIFSTag((int)$failHttppostContactTag);
        }

        //All done
        return;
    }

}