<?php
/**
 * Joomfuse profile field
 * @package     admin.com_joomfuse
 * @subpackage	models.fields.joomfuseprofilefield
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

//We utilize jQuery for throwing the events upon selecting a value
JHtml::_('jquery.framework');

//Load the field element that we extend upon
JFormHelper::loadFieldClass('GroupedList');

//Register the J3.7 com_fields helper (IF it exists)
JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR.'/components/com_fields/helpers');

//Load the front-end plg_user_profile language file
JFactory::getLanguage()->load('plg_user_profile', JPATH_ADMINISTRATOR);

/**
 * Joomfuse field for listing vanilla and plg_user_profile fields
 * @author Georgios Ntampitzias and the JoomFuse team (nonickch@gmail.com)
 *
 */
class JFormFieldJoomfuseprofilefield extends JFormFieldGroupedList {
    //The field class must know its own type through the variable $type.
    protected $type = 'joomfuseprofilefield';


    protected function getGroups(){
        //Fetch the groups/elements in the xml manifest
        $groups = parent::getGroups();

        //Go through each tab and extract the groups and custom fields assign to it
        if(JPluginHelper::isEnabled('user','profile')){
            //Load the XML definition of the profile fields. They may have been edited after all (i.e. don't harcode. Forward compatibility too)
            if(!$fieldset = simplexml_load_file(JPATH_ROOT.'/plugins/user/profile/profiles/profile.xml')){
                JFactory::getApplication()->enqueueMessage('JoomFuse could not load your joomla profile fields. Please contact support','error');
                return;
            }

            if(!isset($fieldset->fields) || !isset($fieldset->fields->fieldset) || !isset($fieldset->fields->fieldset->field)){
                JFactory::getApplication()->enqueueMessage('JoomFuse could not properly parse your joomla profile fields. Have you modified the profile manifest? If not, Please contact support','error');
                return;
            }

            //Try to extrapolate the group name
            $group_attribs = $fieldset->fields->fieldset->attributes();
            $groupLabel = 'Profile';    //It seems that the PLG_USER_PROFILE_SLIDER_LABEL translation string defined in the XML is missing in J3.3
            $groups[$groupLabel] = array();
            foreach($fieldset->fields->fieldset->field AS $profile_field){
                $attribs = $profile_field->attributes();
                //Make sure there's a valid entry with a name
                if(!isset($attribs['name'])){
                    continue;
                }

                //Do not parse hidden or spacer fields
                if(isset($attribs['type'])){
                    $type_arr = (array)$attribs['type'];
                    if(in_array($type_arr[0], array('hidden','space'))){
                        continue;;
                    }
                }

                //Extrapolate name/label
                $name_arr = (array)$attribs['name'];
                $name = $name_arr[0];

                $label = 'Unknown';
                if(isset($attribs['label'])){
                    $label_arr = (array)$attribs['label'];
                    $label = $label_arr[0];
                }

                $tmp = JHtml::_(
				'select.option', 
                'profile.'.$name,
                JText::_($label),
				'value',
				'text',
                false
                );
                 
                $tmp->class = 'joomfuseprofilefield';

                // Add the option object to the result set.
                $groups[$groupLabel][] = $tmp;
            }
        }

        //Look for other plugins using the profiles table
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('DISTINCT profile_key')->from('#__user_profiles')->where('profile_key NOT LIKE("profile.%")');
        $db->setQuery($query);

        $results = array();
        try{
            $results = $db->loadObjectList();
        } catch(Exception $e){
            JFactory::getApplication()->enqueueMessage('joomfuseprofilefield: Error while fetching list of custom profile fields: '.$e->getMessage(),'warning');
        }

        //Go through the results and find the groupnames/group entries
        $groupsList = array();
        foreach($results AS $result){
            $key_arr = explode('.', $result->profile_key);
            if(count($key_arr) != 2){continue;}    //Ignore unexpected cases where there's more than one period in the key name

            //See if we've met this plugin/key name (i.e. improved.[fieldname])
            if(!isset($groupsList[$key_arr[0]])){
                $groupsList[$key_arr[0]] = array();
            }

            //Append the field name (without the key) to the list on field names for this group/plugin
            $groupsList[$key_arr[0]][] = $key_arr[1];
        }

        //Append the found groups/fieldnames to the results
        foreach($groupsList AS $groupName=>$groupEntries){
            $groups[$groupName] = array();
            foreach($groupEntries AS $entry){
                $tmp = JHtml::_('select.option', $groupName.'.'.$entry, JText::_($entry), 'value', 'text', false);
                $tmp->class = 'joomfuseprofilefield';

                // Add the option object to the result set.
                $groups[$groupName][] = $tmp;
            }
        }
        reset($groups);
        
        
        //Look for any possible J3.7 com_fields entries
        if(class_exists('FieldsHelper')){
        	$com_fields_array = FieldsHelper::getFields('com_users.user');
        	foreach($com_fields_array AS $com_fields_entry){
        		if(!isset($groups['fields'])){$groups['Fields'] = array();}	//Initialize the group if not set
        		
        		$tmp = JHtml::_('select.option', 'com_fields'.'.'.$com_fields_entry->name, JText::_($com_fields_entry->label), 'value', 'text', false);
        		$tmp->class = 'joomfuseprofilefield';
        		
        		$groups['fields'][] = $tmp;
        	}
        }
        
         
        //Done
        return $groups;
    }

}