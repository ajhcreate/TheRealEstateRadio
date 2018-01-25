<?php
/**
 * Joomfuse fields
 * @package     admin.com_joomfuse
 * @subpackage	models.fields.joomfuseifsfield
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

//Import/register the IFSFactory that takes care of all the required files
class_exists('IFSFactory') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/ifsfactory.php';

//We utilize jQuery for throwing the events upon selecting a value
JHtml::_('jquery.framework');

//Load the field element that we extend upon
JFormHelper::loadFieldClass('GroupedList');

/**
 * Joomfuse field for listing all Infusionsoft field types that we support
 * @author Georgios Ntampitzias and the JoomFuse team (nonickch@gmail.com)
 *
 */
class JFormFieldJoomfuseifsfield extends JFormFieldGroupedList {
    //The field class must know its own type through the variable $type.
    protected $type = 'joomfuseifsfield';

    protected static $availableFieldTypes =
    array(
        'Currency' => JoomfuseTableDataFormField::DataFormFieldValue_DataType_Currency,
        'Date' => JoomfuseTableDataFormField::DataFormFieldValue_DataType_Date,
        'Date/Time' => JoomfuseTableDataFormField::DataFormFieldValue_DataType_DateTime
    );

    protected function getGroups(){
        //@TODO-GN: add onClick (throw event?) functionality to the custom fields and the options
        // in the xml so we can catch that event from the CB/JomSocial etc map-to fiels so we can gray-out the irrelevant ones
        //We can't use the onClick since it's not printed by JFormFieldGroupedList::getInput(). So custom JS it is...
        //Fetch the groups/elements in the xml manifest
        $groups = parent::getGroups();
         
        //Fetch the custom fields and their tabs/groups.
        //Notice: Don't worry about caching/multiple API calls, this is taken care of from the IFSApi
        $customIFSFields = IFSApi::getCustomFields();
        $ifsFormGroups = IFSApi::getDataFormGroups();
        $ifsFormTabs = IFSApi::getDataFormTabs();

        //Go through each tab and extract the groups and custom fields assign to it
        foreach($ifsFormTabs AS $tab){
            //Check, just in case...
            if(!isset($tab->Id) || !isset($tab->TabName)){continue;}

            //Find out which formGroups belong to this tab
            $formGroups = array();
            foreach ($ifsFormGroups AS $group){
                //Check, just in case...
                if(!isset($group->Id) || !isset($group->TabId) || !isset($group->Name)){continue;}

                if($group->TabId == $tab->Id){
                    $formGroups[] = $group->Id;
                }
            }

            //No point continuing if no form groups were found as fields are bound to tabs via groups
            if(empty($formGroups)){continue;}
            
            //Find which fields belong to this tab and add them
            $groups[$tab->TabName] = array();
            foreach($customIFSFields AS $custom_field){
                //Check, just in case...
                if(!isset($custom_field->Name) || !isset($custom_field->Label) || !isset($custom_field->GroupId)){continue;}
                
                //Ignore custom fields that do not belong to this tab
                if(!in_array($custom_field->GroupId, $formGroups)){continue;}

                // Create a new option object based on the <option /> element.
                $tmp = JHtml::_(
				'select.option', 
                '_'.$custom_field->Name,
                $custom_field->Label,
				'value',
				'text',
                false
                );
                
                //Encode the DataType and add it to the class
                $tmp->class = 'ifsfield" data-ifsfieldtype="'.$custom_field->DataType.'';

                // Add the option object to the result set.
                $groups[$tab->TabName][] = $tmp;
            }
        }
        //Tabs do not need sorting. First come first display basis
         
        //Reset the counter and return
        reset($groups);
        return $groups;
    }


    /* (non-PHPdoc)
     * @see JFormFieldList::getOptions()
    
    protected function getOptions(){
        $options = array();
        //JFactory::getDocument()->addStyleDeclaration('.ifs_fieldtype_15 {background-color: red;}');

        //Append the custom fields to the selection
        foreach (self::$customIFSFields AS $option)
        {
             
            // Create a new option object based on the <option /> element.
            $tmp = JHtml::_(
				'select.option', 
            $option->Name,
            $option->Label,
				'value',
				'text',
            false
            );
             
            $tmp->class = 'ifs_fieldtype_'.$option->DataType;

            // Add the option object to the result set.
            $options[] = $tmp;
        }

        reset($options);

        return $options;
    }
     */
}