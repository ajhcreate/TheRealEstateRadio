<?php
/**
 * Joomfuse libs
 * @package     site.com_joofuse.plugins
 * @subpackage	user.joomfuse
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

//Include the Joomfuse Factory
JLoader::register('IFSFactory', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/ifsfactory.php');
JLoader::register('JUserHelper', JPATH_BASE.'/libraries/joomla/user/helper.php');

/**
 * Joomfuse User plugin
 *
 * @package     Joomfuse
 * @copyright	Copyright Zacaw Enterprises Inc. All rights reserved.
 */
class PlgUserJoomfuse extends JPlugin
{
    private $defaultNewUserUsergroup = 2;
    private $newUserOptIn = 1;
    private $newUserTag = '';
    private $tagGroupAssociation = array();
    protected static $plaintext_passwords = array();    //We store the plaintext passwords when they change so we can feed them (if needed) to plg_joomfuse_joomla (it can map password fields to IFS fields)

    private $emailHasChanged = false;

    //In order to avoid making unnecessary calls to add/remove tags, we save the usergroups before the user update so we can compare
    protected static $beforeSaveUserGroups = array();

    /**
     * Custom constructor so we can load the Joomfuse component parameters.
     * Some of those parameters are specific to this plugin
     * @param unknown_type $properties
     */
    public function __construct(&$subject, $config = array()){
        parent::__construct($subject, $config);

        //Retrieve the parameters
        $params = JComponentHelper::getParams('com_joomfuse');
        if(!$params){
            //JErrorPage::render('plgJoomfuseJoomla::__construct could not retrieve the com_joomfuse configuration options');
            JFactory::getApplication()->enqueueMessage('PlgUserJoomfuse::__construct could not retrieve the com_joomfuse configuration options');
            return;
        }
        /* @var $params JRegistry */

        //Retrieve the component parameters, and default the values to what config.xml sets as the params may not have been saved yet
        $this->defaultNewUserUsergroup = $params->get('default_usergroup',2);
        $this->tagGroupAssociation = $params->get('tag_group_associations',array());
        $this->newUserTag = $params->get('newUserTag','');
        $this->newUserOptIn = $params->get('newUserOptIn',1);
    }
    
    /**
     * Fetch a plaintext password for a user.
     * This only works if this user has changed his password in this render and we have caught it in the onUserAfterSave event
     * @param numeric $userid			The user id
     * @return String|false				The plaintext password or false if otherwise
     */
    public static function getUserPassword($userid){
        return isset(self::$plaintext_passwords[''.$userid]) ? self::$plaintext_passwords[''.$userid] : false;
    }

    /**
     * Check for email changes so we can opt-in in the onUserAfterSave()
     * IMPORTANT: We load the contact before the user save so JoomFuse
     *  can grab the initial contact field state as soon as possible
     *
     * @param   array    $user   Holds the old user data.
     * @param   boolean  $isnew  True if a new user is stored.
     * @param   array    $data   Holds the new user data.
     *
     * @return    boolean
     *
     * @since   3.1
     * @throws    InvalidArgumentException on invalid date.
     */
    public function onUserBeforeSave($user, $isnew, $data){
        //Don't do anything on HTTP POSTs
        if(IFSFactory::isParsingHttpPost()){return;}

        //Just load the contact so JoomFuse grabs the contact fields before any joomla (or 3rd party extensions) fields change
        $ifs_contact = IFSFactory::getUserContact($user['id']);

        //Cache the user groups so we can see if something changed on the onAfterUserSave (and avoid redundant add/removeTag calls)
        //Notice the usage of array_merge so we can get rid of the numerical indexes in $user that are not the same in $data (same applies for onUserAfterSave and messes up the group comparison)
        self::$beforeSaveUserGroups[$user['id']] = array_merge(array(),$user['groups']);

        //We only handle pre-existing users.
        if($isnew){
            return;
        }
         
        //If the email is changing, mark it down so we can later perform the opt-in (in onUserAfterSave)
        if($user['email'] != $data['email']){
            $this->emailHasChanged = true;
        }
    }

    /**
     * Utility method to act on a user after it has been saved.
     *
     * This method sends a registration email to new users created in the backend.
     *
     * @param   array          $user         Holds the new user data.
     * @param   boolean        $isnew        True if a new user is stored.
     * @param   boolean        $success      True if user was succesfully stored in the database.
     * @param   string         $msg          Message.
     *
     * @return  void
     * @since   1.6
     */
    public function onUserAfterSave($user, $isnew, $success, $msg){
        //Bear in mind that this bit of code runs upon user deletions as well
        //Don't do anything on HTTP POSTs
        if(IFSFactory::isParsingHttpPost()){return;}

        //Don't do anything on failed saves
        if(!$success){
            return;
        }
        
        //See if we can retrieve the plaintext password. This only works when this event refers to a user
        //modification that includes the changing of his password
        if(isset($user['password_clear']) && !empty($user['password_clear'])){
            self::$plaintext_passwords[''.$user['id']] = $user['password_clear'];
        }
        
        /*
         * JomSocial-based HACK:
         * 		The JomSocial front-end profile edit (on at least on May 2017) hashes/stores the password
         * 		with a JUser->set(). This leads to no plaintext password being sent to us here. We need to check
         * 		the JInput for the specific field name they use on their form.
         */
        $jinput = JFactory::getApplication()->input;
        if(($jspassword = $jinput->get('jspassword','','RAW')) == ($jspassword2 = $jinput->get('jspassword2','','RAW')) && !empty($jspassword)){
        	self::$plaintext_passwords[''.$user['id']] = $jspassword;
        }

        //Load the IFSUser
        $ifs_contact = IFSFactory::getUserContact($user['id']);

        //Actions for new users
        if($isnew){
            //See if this is a new user and we assign tags to new users
            if(!empty($this->newUserTag)){
                $ifs_contact->assignIFSTag($this->newUserTag);
            }
        }

        //Check for email changes and auto opt-in and also automatically opt-in new users
        if($this->newUserOptIn && ($isnew || $this->emailHasChanged)){
            $ifs_contact->optIn();
        }


        //$groups =  JUserHelper::getUserGroups($user['id']);;
        $groups = $user['groups'];

        //Check for tag/usergroup associations only if the user groups have changed
        //Check for the NULL $groups jomsocial bug. If $groups==null, don't change any mapped tags.
        if( !isset(self::$beforeSaveUserGroups[$user['id']]) ||
            (self::$beforeSaveUserGroups[$user['id']] != $groups && !empty($groups)) ){
            foreach($this->tagGroupAssociation AS $association){
                //Extrapolate the entries from the association row as defined in the joomfuse config.xml
                $usergroup = (int)$association->usergroup;
                $tag = (int)$association->tag;
                $suspend_tag = (int)$association->suspend_tag;

                if($usergroup && $tag){
                    if(in_array($usergroup, $groups)){
                        //If there is a 'suspend' tag associated with this usergroup and the user has it, Remove the suspend tag and emit a JError::notice
                        if($suspend_tag && $ifs_contact->hasIFSTagById($suspend_tag, true)){
                            $ifs_contact->removeIFSTag($suspend_tag);
                            JFactory::getApplication()->enqueueMessage("JoomFuse: This user had the associated suspend that did not allow him to be a member of the requested group\nIn order to allow him to belong to this group, we had to remove the associated suspend tag in Infusionsoft. Please review this user and the contact if you believe this should not be the case",'warning');
                        }
                        //If the user being created is in a group associated with a tag, add it to the contact
                        $ifs_contact->assignIFSTag($tag);
                    } else if(!$ifs_contact->hasIFSTagById($suspend_tag, true)){
                        //Not a member of the usergroup of the association. Remove the tag as long as the suspend tag is not there
                        $ifs_contact->removeIFSTag($tag);
                    }
                }
            }
        }

    }

    /**
     * Load the user so we can have access to it post-user deletion
     * If we get to onAfterDelete, then the plugins will not be able to load the contact (foreign key will kill the #__joomfuse_users row)
     * @param Array $user	An associative array of the columns in the user table.
     */
    public function onUserBeforeDelete($user){
        $ifsContact = IFSFactory::getUserContact($user['id']);
    }

    /**
     * Trigger the JoomFuse user deletion event so we can delete the tags
     *
     * @param   array    $user     Holds the user data
     * @param   boolean  $success  True if user was succesfully stored in the database
     * @param   string   $msg      Message
     * @return  boolean
     */
    public function onUserAfterDelete($user, $success, $msg){
        //Check for a succesful deletion
        if (!$success){	return false; }

        //Mark the user as being deleted
        $ifsContact = IFSFactory::getUserContact($user['id']);
        $ifsContact->setUserBeingDeleted();

        //Retrieve our custom plugin group and trigger the onBeforeContactUserDelete
        JPluginHelper::importPlugin('joomfuse');
        $dispatcher = JEventDispatcher::getInstance();
        $dispatcher->trigger('onContactUserDelete', array($user));

        return true;
    }
}

