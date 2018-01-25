<?php
/**
 * Joomfuse Factory
 * @package     admin.com_joomfuse
 * @subpackage	lib.ifsfactory
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('IFSContact', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/ifscontact.php');
JLoader::register('JTableIFSUser', JPATH_ADMINISTRATOR.'/components/com_joomfuse/tables/ifsuser.php');
JLoader::register('JTableJoomfusecron', JPATH_ADMINISTRATOR.'/components/com_joomfuse/tables/joomfusecron.php');
JLoader::register('JoomfuseFieldMapping', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/fieldMapping.php');
JLoader::register('JoomfuseFieldMapElement', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/fieldMapElement.php');
JLoader::register('JoomfuseAPIField', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiField.php');
JLoader::register('IFSApi', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/ifsapi.php');
//JLoader::register('JoomFuseCron', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/joomfusecron.php');


class_exists('JoomfuseApiCall') OR require(JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCall.php');
class_exists('JoomfuseIFSTable') OR require(JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/ifsTable.php');

//Include the xmlrpc library
function_exists('xmlrpc_encode_entitites') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/xmlrpc-3.0/lib/xmlrpc.inc';

//Import the Joomla JLog
jimport('joomla.log.log');


/**
 * Object factory and go-to class for all things JoomFuse.
 * Requiring this class should get you up and running for all your JoomFuse usage
 * @author Georgios Ntampitzias and the JoomFuse team
 *
 */
class IFSFactory extends JFactory{
    private static $fieldMappings = null;
    private static $loggingEnabled = null;

    protected static $parsingHttpPost = false;

    //The cache lifetime (mins) for the cache entries used to avoid POST colissions (two parallel posts for the same contact id)
    protected static $postCollisionDetectionCacheLifetime = 1;

    /**
     * Get the IFSContact for the optionally provided user id (defaults to current user)
     * @param   Numeric 	$id		(Optional, defaults to the currently rendering user) The user id for contact to load
     * @return  IFSContact object	The IFSContact object
     */
    public static function getUserContact($id = null){
        /*
         * When id=null, the reliable way to fetch the current user id is JFactory::getUser
         * The problem is that this creates issues wtih front-end profile editing and the onAfter/BeforeUserSave
         * events in joomfuse because those trigger this method, which calls JFactory::getUser(), which ends up caching the
         * user object. This leads to incorrect assumptions that nothing changed in the user, which leads to no updates
         * in IFS.
         * On the other hand, JTableUser cannot retrieve the current user id.
         * 
         *  So we try to do the best of both worlds: If the user is known, we verify/load from JUserTable
         */
        $user_id = 0;
        if($id){
            //Retrieve the user JTable entry
            $userTable = JTable::getInstance('User');
            if($userTable->load($id)){
                $user_id = $userTable->get('id',0);
            }
        }else {
            $user = JFactory::getUser($id);
            $user_id = $user->get('id',0);
        }
        
        return IFSContact::getInstanceByUserId($user_id);
    }

    /**
     * Checks if we're currently parsing an HTTP POST.
     * We need this so plg_user_joomfuse will not activate (or we enter a loop: create/update user from post -> repost data back to IFS)
     * @return boolean		Whther we're currently parsing an http post or not
     */
    public static function isParsingHttpPost(){return self::$parsingHttpPost;}

    /**/
    public static function getFieldMappings(){
        //See if we have the field mappings cached.
        if(self::$fieldMappings !== null){
            return self::$fieldMappings;
        }

        //Retrieve our custom plugin group
        JPluginHelper::importPlugin('joomfuse');
        $dispatcher = JEventDispatcher::getInstance();

        //Retrieve the field mappings from the event call. Cache and return the values
        $mappings = $dispatcher->trigger('getCustomFieldMappings');

        //If there are no plugins observing, then $mappings is null. If so, set it to an empty array so the event doesn't fire again
        //Notice that we use ArrayObject so we can clone it later on (cant clone arrays)
        self::$fieldMappings = array();
        if($mappings){
            foreach($mappings AS $map){
                /* @var $map JoomfuseFieldMapping */
                if(!is_a($map, 'JoomfuseFieldMapping')){
                    JFactory::getApplication()->enqueueMessage('IFSFactory::getFieldMappings() received a non-JoomfuseFieldMapping response. Ignoring','warning');
                    continue;
                }
                foreach($map->getFields() AS $field){
                    /* @var $field JoomfuseFieldMapElement */
                    if(!is_a($field, 'JoomfuseFieldMapElement')){
                        JFactory::getApplication()->enqueueMessage('IFSFactory::getFieldMappings() received a non-JoomfuseFieldMapElement element. Ignoring','warning');
                        continue;
                    }
                    //Notice that if two plugins have conflicing usages for the same API field, the last one to execute will have it's way
                    self::$fieldMappings[$field->getJoomlaField()] = $field->getAPIField('');
                }
            }
        }

        //Return the field mappings. Plugins cannot edit these values since arrays are passed as copies, not references
        return self::$fieldMappings;
    }

    /**
     * Signals the beginning of the HTTP Post parsing of the given IFS id
     * IF there's another process doing the same, this method will return false
     * This is used so we can avoid having race conditions between two parallel HTTP Posts for the same contact
     * @param Numeric $is_id		The IFS Contact Id
     * @return boolean				True upon no conflict, false if otherwise
     */
    protected static function contactIdBeingProcessed($is_id){
        $cache_id = 'joomfuse_post_parsing_'.$is_id;
        $cache = JFactory::getCache('joomfuse');
        $cache->setCaching(1);
        $cache->setLifeTime(self::$postCollisionDetectionCacheLifetime);

        //See if the contact id is already being parsed
        if(unserialize($cache->cache->get($cache_id))){
            return false;
        }
        $cache->store(true, $cache_id);
        return true;
    }

    /**
     * Signals the end of the HTTP POST process so other posts can work on the same contact id
     * Please notice that even if this method is not called (in case of a post parser crash),
     * a cache timeout still kicks in after self::$postCollisionDetectionCacheLifetime secs
     * @param Numeric $is_id		The contact id
     */
    protected static function contactIdEndsProcess($is_id){
        $cache_id = 'joomfuse_post_parsing_'.$is_id;
        $cache = JFactory::getCache('joomfuse');
        $cache->setCaching(1);
        $cache->setLifeTime(self::$postCollisionDetectionCacheLifetime);

        $cache->store(false, $cache_id);
        return;
    }

    /**
     * Parses Infusionsoft HTTP POSTs
     * @return void|string		void on success, the error string in case of error
     */
    public static function parseHttpPost(){
        //Attempted fix for the randomly failing HTTP POSTS
        ignore_user_abort(true);

        //Mark this execution as an HTTP POST so the plugins can opt to not process some of the events
        self::$parsingHttpPost = true;
        
        //Give us full permissions to do anything. This is needed at least from com_fields as it checks access before
        //		allowing a field value change
        JFactory::getUser()->set('isRoot',true);

        //Load the front-end language settings
        JFactory::getLanguage()->load('com_joomfuse',JPATH_SITE);

        //Retrieve our custom plugin group for event firing
        JPluginHelper::importPlugin('joomfuse');
        $dispatcher = JEventDispatcher::getInstance();

        //Retrieve our required component configuration options
        $params = JComponentHelper::getParams('com_joomfuse');
        if(!$params){
            $message = 'IFSFactory::parseHttpPost could not retrieve the com_joomfuse configuration options';
            self::logError($message);
            return $message;
        }

        //Default to the config.xml values in case the component config has never been saved
        $configAllowNewUsers = $params->get('allowNewUsers',true);
        $configAllowNewUsersOnTag = $params->get('allowNewUsersOnTag','');
        $defaultUsergroup = $params->get('default_usergroup',2);
        $successHttppostContactTag = $params->get('successHttppostContactTag','');
        $successHttppostGoal = $params->get('successHttppostGoal', '');
        $newPostUserTag = $params->get('newPostUserTag','');

        //Retrieve and sanitise the HTTP POST contact id that may show up as 'Id' or 'ContactId'
        $jinput = JFactory::getApplication()->input;
        $is_id = $jinput->get('Id', 0, 'INT')?$jinput->get('Id', 0, 'INT'):$jinput->get('contactId', 0, 'INT');
        self::logError('Received HTTP Post with Id: '.$is_id ,JLog::NOTICE);

        if(!$is_id){
            $error = 'No Id specified';
            self::logError($error);
            return $error;
        }

        //Log the beggining of the HTTP Post and check for any other HTTP Posts doing the same
        if(!self::contactIdBeingProcessed($is_id)){
            $error = 'ContactId '.$is_id.' is already being processed';
            self::logError($error);
            return $error;
        }

        //Inform all the plugins that a new HTTP post has arrived.
        $plugin_results = $dispatcher->trigger('onIFSHTTPPostStart');

        //Retrieve the contact fields through the API. We do not rely on the POST'ed fields since it might be a fake one
        $ifs_contact = IFSApi::getContactByIFSId($is_id);

        //This means that the fetch failed. Probably an incorrect Id given or a malicious page hit (API error aswell)
        if(!$ifs_contact){
            $error = 'Could not retrieve contact information with id: '.$is_id;
            self::logError($error);
            return $error;
        }

        //This should never happen (get more than one result, we searched for a primary key), but check anyways
        if(count($ifs_contact) > 1){
            $error = 'IFSFactory::parseHttpPost received more than one results';
            self::logError($error);
            return $error;
        }

        $ifs_contact = $ifs_contact[0];

        //See if a user associated with this ifs_id exists.
        $ifs_user = self::getUserByIFSId($is_id);
        //If no user is found, try to see if there is a user with the same email and f/l-name
        if(!$ifs_user){
            $search_email = isset($ifs_contact->Email)?$ifs_contact->Email:'';
            $fname = isset($ifs_contact->FirstName) ? $ifs_contact->FirstName : '';
            $lname = isset($ifs_contact->LastName) ? $ifs_contact->LastName : '';
            $search_name = self::getNameByFLName($fname, $lname);

            $ifs_user = self::getUserByEmailAndName($search_email, $search_name);
        }

        $isNew = $ifs_user ? false : true;
        //$userProperties = $ifs_user?$ifs_user->getProperties():array();

        //Check to see if this is a new user and this is a new user registration when one is not allowed (check on tags performed later on)
        if($isNew && !$configAllowNewUsers && empty($configAllowNewUsersOnTag)){
            return self::httpPostFail('New user registration from HTTP Posts has been disabled', $ifs_contact->Id);
        }

        //If new user registration is allowed on the condition of the existence of a tag, make the check
        if($isNew && !$configAllowNewUsers && !empty($configAllowNewUsersOnTag)){
            $contactTags = IFSApi::getTagsByIFSId($is_id);
            $found = false;
            foreach($contactTags AS $tag){
                if($tag->GroupId == $configAllowNewUsersOnTag){
                    $found = true;
                    break;
                }
            }

            //See if we found our tag. If not, abort
            if(!$found){
                return self::httpPostFail('New user registration from HTTP Posts is only allowed for contacts with a specific tag', $ifs_contact->Id);
            }
        }

        //Request the field mappings from the plugins
        //$joomla_fields = self::getFieldMappings();

        //User exists
        if($isNew){
            //See if a plugin wants to perform the registration on it's own
            $needsRegistration = true;
            try{
                $dispatcher->trigger('onCustomUserRegistration', $ifs_contact);
            } catch(JoomfuseRegistrationSuccess $e){
                $needsRegistration = false;
                $ifs_user = $e->getJUser();
            } catch(Exception $e){
                return self::httpPostFail($e->getMessage(), $ifs_contact->Id);
            }

            //If no plugins made their own registration, perform it ourselves
            if($needsRegistration){
                try{
                    $ifs_user = self::registerUser($ifs_contact);
                } catch(Exception $e){
                    return self::httpPostFail($e->getMessage(), $ifs_contact->Id);
                }
            }

        }    //End of if($isNew){

        //Instruct the plugins to save the fields they need
        $dispatcher->trigger('onSetJoomlaFieldsFromContact',array($ifs_user->get('id'), $ifs_contact, $isNew));

        /*
         * USER GROUP MANAGEMENT
         */
        $groups = $ifs_user->get('groups');
        $addGroups = self::getPluginUserGroups($ifs_user, $isNew, false);
        $removeGroups = self::getPluginUserGroups($ifs_user, $isNew, true, $addGroups);

        //Append the groups that are to be added, then remove the ones that should be removed
        $groups = array_merge($groups, $addGroups);
        $groups = array_diff($groups, $removeGroups);

        //Make sure that the user is a member of at least one group. If not, assign him the default usergroup
        if(!count($groups)){
            $groups[] = $defaultUsergroup;
        }

        //Assign the user groups to the user.
        $ifs_user->set('groups', $groups);


        //Save the user
        //At this point Infusionsoft is also updated according to plugin requirements
        if(!$ifs_user->save()){
            return self::httpPostFail('Error while updating User with groups: '.$ifs_user->getError(), $ifs_contact->Id);
        }

        /*
         * Final steps in the HTTP POSTS
         */
        //Fetch the IFSContact object
        $contactObject = IFSFactory::getUserContact($ifs_user->get('id'));

        //Assign the success-http-post tag and/or goal (if required)
        if(!empty($successHttppostContactTag) && $successHttppostContactTag){
            $contactObject->assignIFSTag(intval($successHttppostContactTag));
        }
        if(!empty($successHttppostGoal)){
            $contactObject->achieveGoal($successHttppostGoal, '', true);
        }

        //If the new user creation tag is configured and this is a new Joomla user, add the tag
        if($isNew && !empty($newPostUserTag) && $newPostUserTag){
            $contactObject->assignIFSTag(intval($newPostUserTag));
        }

        //Notify the plugins that a successful HTTP POST took place
        $dispatcher->trigger('onIFSHTTPPostComplete', array($ifs_user->getProperties(), $isNew));

        //Free the contact id from the post parsing collision detection
        self::contactIdEndsProcess($is_id);

        //Success.
        self::logError('HTTP POST registration complete',JLog::NOTICE);
        return;
    }


    /**
     * Registers a new user according to the given contact object
     * @param stdClass $ifs_contact		The contact object that contains all the known contact fields as properties
     * @return JUser					The JUser object for the new user
     * @throws Exception				In case of a registration failure
     */
    protected static function registerUser($ifs_contact){
        //Retrieve our required component configuration options
        $params = JComponentHelper::getParams('com_joomfuse');
        if(!$params){
            $message =  'IFSFactory::registerUser could not retrieve the com_joomfuse configuration options';
            throw new Exception($message, 1);
        }

        $writebackChangedCredentials = $params->get('writebackChangedCredentials',0);
        $overridePostParamsEmailsAllowed = $params->get('overridePostParamsEmailsAllowed',1);
        $newUserEmailsAllowed = $params->get('newUserEmailsAllowed',1);
        $param_associations = $params->get('field_associations',array());
        $field_associations = array();
        foreach($param_associations AS $association){
            //Ignore incorrectly set or empty values
            if(!$association->ifsField || !$association->joomlaField){
                continue;
            }
            $field_associations[] = $association;
        }

        $dispatcher = JEventDispatcher::getInstance();

        //Try to retrieve the email from the contact
        $needsEmail = false;
        $email = '';
        if(isset($ifs_contact->Email) && !empty($ifs_contact->Email)){
            $email = $ifs_contact->Email;
        } else {
            //It seems there is no email set in the contact. Emit an email to the admin as we cannot send a warning email to the user
            $error = 'IFSFactory::registerUser() could not locate an email value';
            self::mailAdmin('HTTP Post error', 'An HTTP POST from IFS did not contain an email and no relevant user was found');
            throw new Exception($error, 2);
        }

        //Try to retrieve the username
        $username = '';
        if(isset($ifs_contact->Username) && !empty($ifs_contact->Username)){
            $username = $ifs_contact->Username;
        } else {
            //Our fallback is the email of the user
            $needsEmail = true; //We chanced something. Notify the user
            $username = $email;
        }

        //Try to retrieve the password or generate a new one if none is set
        if(isset($ifs_contact->Password) && !empty($ifs_contact->Password)){
            $password = $ifs_contact->Password;
        } else {
            //When we generate a random passowrd, we need to communicate that (either email or writeback to IFS)
            $password = JUserHelper::genRandomPassword();
            $needsEmail = true;
        }

        //Try to retrieve the name
        $fname = isset($ifs_contact->FirstName) ? $ifs_contact->FirstName : '';
        $lname = isset($ifs_contact->LastName) ? $ifs_contact->LastName : '';
        //If we can't compose a full name, fall back to the email.
        if(!($name = self::getNameByFLName($fname, $lname))){
            //Notice that we don't email people and we silently change the name if we have to
            $name = $email;
        }

        //Attempt to create the new user
        $user = new JUser();
        $bindArray = array('name'=>$name, 'username'=>$username, 'password'=>$password, 'email'=>$email);
        //Extract any profile fields. Notice that we disregard any username/password fields as we handle them seperately
        //@TODO-GN: This is DUPLICATE CODE (plg_joomfuse_joomla). We have to fix this somehow
        foreach($field_associations AS $association){
            $contact_field = $association->ifsField;
            if(isset($ifs_contact->$contact_field) && !empty($ifs_contact->$contact_field)){
                //Ignore username, password, name, as we set them manually
                if(in_array($association->joomlaField, array('username','password','name'))){continue;}
                //Profile/#__user_profile based fields
                if(strpos($association->joomlaField, '.')!==false){
                    //Extract the field group and field names
                    $fieldname_arr = explode('.', $association->joomlaField);
                    if(count($fieldname_arr) != 2){continue;}
                    $groupName = $fieldname_arr[0];
                    $fieldName = $fieldname_arr[1];
                    //Make sure the field group exists
                    if(!isset($bindArray[$groupName])){
                        $bindArray[$groupName] = array();
                    }
                    //Assign the custom field value
                    $bindArray[$groupName][$fieldName] = $ifs_contact->$contact_field;
                } else {
                    //Normal joomla field
                    $bindArray[$association->joomlaField] = (String) $ifs_contact->$contact_field;
                }
            }
        }

        if(!$user->bind($bindArray)){
            $error = $user->getError();
            self::mailUser(JText::sprintf('COM_JOOMFUSE_EMAIL_TOPIC_FAILED_REGISTRATION',JFactory::getConfig()->get('sitename')), JText::sprintf('COM_JOOMFUSE_EMAIL_CONTENT_FAILED_REGISTRATION',$error), $email);
            self::mailAdmin(JText::_('COM_JOOMFUSE_EMAIL_ADMIN_CONTENT_NEW_USER_MODIFIED_REGISTRATION_DETAILS'), JText::sprintf('COM_JOOMFUSE_EMAIL_ADMIN_TOPIC_FAILED_REGISTRATION', $email, $username, $password, $name, $email, $error));

            throw new Exception($message, 3);
        }

        //JUser:: save throws both exceptions AND returns false. So throw when false and catch everything
        try{
            if(!$user->save()){
                //See if we fail because of a username-in-use
                if($user->getError()==JText::_('JLIB_DATABASE_ERROR_USERNAME_INUSE')){
                    $needsEmail = true;
                    //Change the username and re-set the password. For some reason $bindArray['password'] is encrypted
                    $username = $bindArray['username'].rand(0, 9999);
                    $bindArray['password'] = $password;
                    $bindArray['username'] = $username;
                    if(!$user->bind($bindArray) || !$user->save()){
                        throw  new Exception($user->getError(), 1);
                    }
                } else {
                    //Save failed for non-username reasons. Fail the hwole process
                    throw new Exception($user->getError(),1);
                }
            }
        } catch(Exception $e){
            $error = $user->getError();
            self::mailUser(JText::sprintf('COM_JOOMFUSE_EMAIL_TOPIC_FAILED_REGISTRATION',JFactory::getConfig()->get('sitename')), JText::sprintf('COM_JOOMFUSE_EMAIL_CONTENT_FAILED_REGISTRATION',$error), $email);
            self::mailAdmin(JText::_('COM_JOOMFUSE_EMAIL_ADMIN_CONTENT_NEW_USER_MODIFIED_REGISTRATION_DETAILS'), JText::sprintf('COM_JOOMFUSE_EMAIL_ADMIN_TOPIC_FAILED_REGISTRATION', $email, $username, $password, $name, $email, $error));

            throw $e;
        }

        //Since we now know the contactId and userId, we can save straight to the Joomfuse DB
        try{
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->insert('#__joomfuse_users')->columns(array('id','ifs_id'))->values(intval($user->get('id')).','.intval($ifs_contact->Id));
            $db->setQuery($query);
            $db->query();
        } catch (Exception $e){
            $error = $db->getErrorMsg();
            self::mailAdmin('HTTP POST failed in binding contact to the user', 'Could not bind user id '.$user->get('id').' to cotnact Id '.$ifs_contact->Id."\nReason: ".$error."\nPlease contact support");
            //self::logError($error);
            throw $e;
        }


        //$user = JFactory::getUser($userTable->get('id'));

        //Email the user if it is required (we changed some of his preferred account fields)
        if($needsEmail){
            //If the username or passwords fields have been changed and the write-back is enabled, inform the joomfuse.joomla plugin of this
            if($writebackChangedCredentials){
                //@TODO-GN: What about these? We should manually fire them. Check and see if the plg_joomfuse_joomla can see those from JFactory::getUser in getContactFields
                IFSApi::updateContactById(
                array(
                new JoomfuseAPIField('Username', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $username),
                new JoomfuseAPIField('Password', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $password)
                ), $ifs_contact->Id
                );
                $user->usernameWriteback =  $username;
                $user->passwordWriteback = $password;
            }
            if(!$overridePostParamsEmailsAllowed){
                self::logError('Even though the login information for this user was altered, the configuration suppressed the user email', JLog::DEBUG);
            }else if(!self::mailUser(JText::_('COM_JOOMFUSE_EMAIL_TOPIC_NEW_USER_MODIFIED_REGISTRATION_DETAILS'), JText::sprintf('COM_JOOMFUSE_EMAIL_CONTENT_NEW_USER_MODIFIED_REGISTRATION_DETAILS',$username, $password, $name, $email), $user->email)){
                self::logError('Failed to notify new user of altered login credentials at: '.$user->email, JLog::WARNING);
            }
        }

        //See if we need to send any new-user-registration emails
        if($newUserEmailsAllowed){
            $results = $dispatcher->trigger('onNewUserRegistrationEmail', array($user->getProperties(), $password));
            $sendNewUserMail = false;
            $newUserMailTopic = false;
            $newUserMailContent = false;
             
            //Check all the plugin replies for any emails
            foreach($results AS $key=>$value){
                if(!is_array($value)){continue;}
                if(isset($value['topic']) && !empty($value['topic']) && isset($value['content']) && !empty($value['content'])){
                    $newUserMailTopic = $value['topic'];
                    $newUserMailContent = $value['content'];
                    $sendNewUserMail = true;
                }
            }
             
            //Send the email
            if($sendNewUserMail){
                self::mailUser($newUserMailTopic, $newUserMailContent, $user->email);
            }
        }

        return $user;
    }

    /**
     * Performs the necessary steps (logging and error tag setting) when the http post is considered as failed.
     * WARNING: this function does not interrupt execution. You should use it as return self::httpPostFail() from within the post parser
     * @param String $message				The message to log and also return back to the caller
     * @param Numeric $contactId			The contact Id that should receive the fail tag (if configured to be used)
     * @return string						The given $message, whith the possibility of it being overridden if we can't load com_joomfuse parameters
     */
    protected function httpPostFail($message, $contactId){
        //Retrieve our required component configuration options
        $params = JComponentHelper::getParams('com_joomfuse');
        if(!$params){
            $message = 'IFSFactory::logHttpPostFail could not retrieve the com_joomfuse configuration options';
        }
        $failHttppostContactTag = $params->get('failHttppostContactTag','');
        $failHttppostGoal = $params->get('failHttppostGoal','');

        //Assign the fail tag and/or goal to the contact
        if(!empty($failHttppostContactTag) && $failHttppostContactTag){
            IFSApi::assignTagToContact(intval($failHttppostContactTag), (int)$contactId);
        }
        if(!empty($failHttppostGoal) && $failHttppostGoal){
            try{
                IFSApi::achieveGoal((int)$contactId, $failHttppostGoal, '');
            } catch(Exception $e){
                $message.= " Also, failed to assign the fail goal to contact id ".$contactId.': '.$e->getMessage();
            }
        }
        

        //Log the error message
        self::logError($message);

        //Return the $message so we can easily call return self::logHttpPostFail($message);
        return $message;
    }

    /**
     * Generic function to email users messages generated from the HTTP POST
     * @param String $topic				The mail topic
     * @param String $subject			The email subject
     * @param String $email				The email address of the user
     * @return boolean					True upon success, false if otherwise
     */
    private function mailUser($topic, $subject, $email){
        $config = JFactory::getConfig();
         
        // Send the mail and check for errors
        if (!JFactory::getMailer()->sendMail($config->get( 'mailfrom' ),  $config->get( 'fromname' ), $email, $topic, $subject)){
            self::mailAdmin('Error while mailing the user of a JoomFuse registration problem', 'Could not deliver email at '.$email);
            self::logError('Error while mailing the user of a JoomFuse registration problem');
            return false;
        }

        return true;
    }

    /**
     * Email admin users for any registration errors.
     * Taken straight from the com_users model registration function register()
     * @param String $topic			The email topic
     * @param String $subject		The email subject
     * @return boolean				True upon success, false if otherwise
     */
    private function mailAdmin($topic,$body){
        $config = JFactory::getConfig();
        $db = JFactory::getDbo();

        // Get all admin users
        $query = $db->getQuery(true);
        $query->select($db->quoteName(array('name', 'email', 'sendEmail')));
        $query->from($db->quoteName('#__users'));
        $query->where($db->quoteName('sendEmail') . ' = ' . 1);

        $db->setQuery($query);

        try
        {
            $rows = $db->loadObjectList();
        }
        catch (RuntimeException $e)
        {
            $this->setError(JText::sprintf('COM_USERS_DATABASE_ERROR', $e->getMessage()), 500);
            return false;
        }

        // Send mail to all superadministrators id
        foreach ($rows as $row)
        {
            $return = JFactory::getMailer()->sendMail($config->get( 'mailfrom' ),  $config->get( 'fromname' ), $row->email, $topic, $body);

            // Check for an error.
            if ($return !== true)
            {
                self::logError('Error while mailing the administrators of a JoomFuse registration problem');
                return false;
            }
        }

        return true;
    }

    /**
     * Performs logging for the component.
     * Will only create log entries in the /log/com_joomfuse.txt file if the debug option LOG is enabled
     * @param String $message	The message to log
     * @param numeric $level	(optional, defaults to JLog::INFO)The JLog loglevel, like JLog::INFO
     * @throws Exception
     */
    public static function logError($message, $level=JLog::ERROR){
        //Abort if no logging is enabled
        if(self::$loggingEnabled === false){
            return;
        }
         
        //See if the loggingEnabled configuration parameter is not already cached
        if(self::$loggingEnabled === null){
            //Retrieve our required component configuration options
            $params = JComponentHelper::getParams('com_joomfuse');
            if(!$params){
                throw new Exception('IFSFactory::logError could not retrieve the com_joomfuse configuration options',1);
            }

            //Default to the config.xml values in case the component config has never been saved
            self::$loggingEnabled = $params->get('loggingEnabled',false)?true:false;

            //See if we're allowed to log in a file
            if(!self::$loggingEnabled){
                return;
            }

            //Define the logging file and category

            JLog::addLogger(array('text_file' => 'com_joomfuse.txt'), JLog::ALL, 'com_joomfuse');
        }
         
        //Log the error/message
        JLog::add($message, $level, 'com_joomfuse');
    }


    /**
     * Requests the joomfuse plugin to decide on which user groups they want to assign (or drop) to the given user
     * If $remove is set to true, then the $addGroups MUST be given, or the plugins will not know what usergroups are
     * about to be added
     * @param IFSUser $ifs_user			The user that is having his usergroups modified
     * @param bool $isNew				Whether or not the user is a new one
     * @param bool $remove				(Optional, defaults to false) Set to true when we want to find out the groups that the plugins want to be removed (instead of added)
     * @param array $addGroups			(Optional, defaults to array(), MUST be given if $remove is set to true) The user groups that the plugins have already decided on adding to the user
     * @return array					The array of groups that are to be added or removed (depending on $remove) to this user
     */
    private static function getPluginUserGroups(JUser $ifs_user, $isNew , $remove = false, array $addGroups = array()){
        //Retrieve our custom plugin group for event firing
        JPluginHelper::importPlugin('joomfuse');
        $dispatcher = JEventDispatcher::getInstance();

        $ifs_contact = IFSFactory::getUserContact($ifs_user->get('id'));

        //Instruct the plugins to assign usergroups based on tags. Call the appropriate event of grant/drop
        if($remove){
            $groups = $dispatcher->trigger('onPrepareACLDrop', array($ifs_contact, $addGroups, $isNew));
        } else {
            $groups = $dispatcher->trigger('onPrepareACLGrant', array($ifs_contact, $isNew));
        }

        //Flatten the $groups since it's an array of arrays
        $returnGroups = array();
        foreach($groups AS $groupArray){
            $returnGroups = array_merge($groupArray,$returnGroups);
        }

        //Cast the $returnGroups elements to strings and unique the values
        foreach($returnGroups AS &$value){
            $value = ''.$value;
        }
        $returnGroups = array_unique($returnGroups);

        return $returnGroups;
    }

    /**
     * Retrieves a user by the given ifs_id, if the relation exists in the #__joomfuse_users table
     * @param Numeric $ifs_id								The infusionsoft contactId
     * @return Ambigous <boolean, IFSUser, multitype:>		The JUser object if the relation is found, false if otherwise
     */
    public static function getUserByIFSId($ifs_id){
        $joomfuse_table = JTable::getInstance('IFSUser');
        return $joomfuse_table->load(array('ifs_id'=>(int)$ifs_id))? JFactory::getUser($joomfuse_table->id) : false;
    }

    private static function getUserByEmailAndName($search_email, $search_name){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        //Setup the query searching for the ifs id
        $query->from('#__users','users');
        $query->select('id');
        $query->where("email = ".$db->quote($search_email)." AND name = ".$db->quote($search_name));
        $db->setQuery($query);

        //Execute the query and check for errors
        $result = $db->execute();
        if(!$result){
            JErrorPage::render('IFSFactory::getUserByEmailAndName encountered a DB error');
        }

        $id = $db->loadResult();
        return $id?self::getUser($id):false;
    }

    public static function getNameByFLName($fname, $lname){
        $returnString = !empty($fname) ? $fname : '' ;
        if(empty($returnString)){
            $returnString .= isset($lname)? $lname : '' ;
        } else {
            $returnString .= isset($lname)? ' '.$lname : '';
        }

        return $returnString;
    }

    /*
     * NAME-PARSING FUNCTIONS
     */


    /**
     * Returns the First Name part from a full name
     * @param string $name		The full name
     * @return string			The first name
     */
    public static function getFirstNameFromName($name){return self::getNamePart($name);}

    /**
     * Returns the Last Name part from a full name
     * @param string $name		The full name
     * @return string			The last name
     */
    public static function getLastNameFromName($name){return self::getNamePart($name, true);}

    /**
     * Helper function for implementing getFirstNameFromName and getLastNameFromName
     * Returns either the first or the last name given a name
     * @param string $name			The full name.
     * @param boolean $lastName		Whether to return the last name or the first name
     * @return string				The reuqested f/l name
     */
    protected static function getNamePart($name, $lastName=false){
        //Break down the full name by exploding on the space character
        $nameArray = explode(' ', $name);

        //If there's nothing there, just return false
        if(!count($nameArray)){
            return '';
        }

        //If we want a last name and we only have an array size of 1 or less, then there's no last name
        if(count($nameArray) <= 1 && $lastName){
            return '';
        }

        //First name is the first entry of the array
        if(!$lastName){
            return $nameArray[0];
        } else {
            //Last name is everything except the first array element, concatenated back with the space character
            array_shift($nameArray);
            return (string)implode(' ',$nameArray);
        }
    }



    /**
     * Schedule the execution of a cronjob
     * @param JDate $date				The (minimum) date/time for the execution of the cron
     * @param String $handler			The handler of this cronjob
     * @param JRegistry $params			The parameters of the cronjob call
     */
    public static function scheduleCron(JDate $date, $handler, JRegistry $params){
        $table = JTable::getInstance('Joomfusecron');
        try{
            $table->save(array('date'=>$date->toSql(), 'handler'=>$handler, 'params'=>(String)$params));
        }catch(Exception $e){
            self::logError('IFSFactory error while storing a cronjob: '.$e->getMessage());
        }
    }
        
    /**
     * Checks the cron table for any pending cronjobs and triggers events for their execution
     * Currently, the X (x= numCronChecks config) oldest and applicable entries will be executed.
     * @return number	The amount of cron jobs executed
     */
    public static function cronCheck(){
        //See how may cronjobs we need to check
        $params = JComponentHelper::getParams('com_joomfuse');
        $num_crons = (int) ($params->get('numCronChecks', 3));
        if($num_crons <= 0){
            return 0;
        }
        
        $now = JFactory::getDate()->toSql();
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*')->from('#__joomfuse_cron')->where('date < '.$db->quote($now))->order('date ASC');
        $db->setQuery($query, 0, $num_crons);
        
        //Execute and test for errors
        try{
            $results = $db->loadObjectList();
        }catch(Exception $e){
            JFactory::getApplication()->enqueueMessage('IFSApi::cronCheck failed to fetch any pending cronhjobs: '.$e->getMessage());
            return 0;
        }
        if(!count($results)){return 0;}
        
        //Retrieve our custom plugin group
        JPluginHelper::importPlugin('joomfuse');
        $dispatcher = JEventDispatcher::getInstance();
        
        $deleteIds = array();
        foreach($results AS $result){
            $deleteIds[] = (int)$result->id;
            $params = new JRegistry($result->params);
            //var_dump($params);
            
            $call_array = array($result->handler, $params);
            $plugin_results = $dispatcher->trigger('onJoomfuseCron', $call_array);
        }
        
        //Delete the executed crons. They should all be ints, but just in case...
        foreach($deleteIds AS &$id){$id = (int)$id;}
        
        $delete = $db->getQuery(true);
        $delete->delete('#__joomfuse_cron')->where('id IN('.implode(',', $deleteIds).')');
        $db->setQuery($delete);
        
        //Execute and test for errors
        try{
            $db->execute();
        }catch(Exception $e){
            JFactory::getApplication()->enqueueMessage('IFSApi::cronCheck failed to delete the executed cronjobs: '.$e->getMessage());
            return 0;
        }
        
        return count($results);
    }

}