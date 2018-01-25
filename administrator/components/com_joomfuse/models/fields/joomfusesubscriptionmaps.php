<?php
/**
 * Joomfuse fields
 * @package     admin.com_joomfuse
 * @subpackage	models.fields.joomfusesubscriptionmaps
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

//@TODO-GN: DELETE THIS FILE. We did it with repeatable

//We utilize jQuery for replicating the fields and jQuery UI for sortable
JHtml::_('jquery.ui', array('core','sortable'));

// The class name must always be the same as the filename (in camel case)
class JFormFieldJoomfusesubscriptionmaps extends JFormField {
    protected $type = 'joomfusesubscriptionmaps';
    
    protected static $cprograms = null;

    protected $childElements = array();

    public function setup($element, $value, $group = null){
        //Setup normally
        if(!$parent_setup = parent::setup($element, $value, $group)){
            return $parent_setup;
        }

        //If no values are set, give at least one row so we can get started
        if(!is_array($value)){
            //$value = array(array());
            $value = array();
        }

        //For each row of fields, setup all the defined child fields the same way that JForm::loadField() does
        foreach($value AS $row_counter => $row_values){
            foreach($element->field AS $child_element){
                $this->childElements[$row_counter][(string)$child_element['name']] = $this->setupChildelement($child_element, $row_values, $group, $element, $row_counter);
            }
        }

        return $parent_setup;
    }

    /**
     * Setup()'s the child element given the SimpleXMLElement for it and returns it's JFormField.
     * Mirrors the appropriate JForm functionality, essentially transforming this JFormFields to a fieldgroup
     * @param SimpleXML $child_element		The child element we're setting up
     * @param Array $row_values				The row of values for the current row of child elements
     * @param String $group					The groupname of the parent joomfuserepeatable element
     * @param SimpleXML $element			The joomfuserepeatable element
     * @param Numeric $row_counter			The index (0-based) of the current row of values we're displaying (so we get the composite groupnames right)
     * @return JFormField					The setup()'d JFormField
     */
    protected function setupChildelement($child_element, $row_values, $group, $element, $row_counter){
        $type = $child_element['type'] ? (string) $child_element['type'] : 'text';
        $field = JFormHelper::loadFieldType($type);
        if ($field === false)
        {
            $field = JFormHelper::loadFieldType('text');
        }

        //extrapolate the child value. J3.2 has $row_values as an stdClass and J3.3 as an array, so check.
        if(is_array($row_values)){
            $child_value = isset($row_values[(string) $child_element['name']])? $row_values[(string) $child_element['name']] : null;
        } else {
            $fieldName = (string) $child_element['name'];
            $child_value = isset($row_values->$fieldName)? $row_values->$fieldName : null;
        }


        if ($child_value === null){
            $default = (string) $child_element['default'];

            if (($translate = $child_element['translate_default']) && ((string) $translate == 'true' || (string) $translate == '1')){
                $lang = JFactory::getLanguage();

                if ($lang->hasKey($default)){
                    $debug = $lang->setDebug(false);
                    $default = JText::_($default);
                    $lang->setDebug($debug);
                } else {
                    $default = JText::_($default);
                }
            }

            $child_value = $this->form->getValue((string) $child_element['name'], $group, $default);
        }

        $field->setForm($this->form);

        //Notice the new group name. We compose a new group name based on the container name and the fact that it is $this->multiple=true
        $composite_group = empty($group) ? (string)$element['name'].'.'.$row_counter : $group.'.'.(string)$element['name'].'.'.$row_counter;
        $field->setup($child_element, $child_value, $composite_group);

        return $field;
    }

    /* (non-PHPdoc)
     * @see JFormField::getInput()
     */
    protected function getInput(){
        //Append a hidden input so when there are no fields left to be saved, there will be a value to overwrite the old one
        $returnString = '<div class="joomfuserepeatable_container '.$this->type.'" id="'.$this->name.'">';
        $returnString .= '<input type="hidden" name="'.$this->name.'" value="" />';
        //Insert the 'add row' button
        $returnString .= '<button class="btn btn-small btn-success joomfuserepeatable_addrow" type="button" data-forrepeatable="'.$this->name.'">
        	<span class="icon-new icon-white"></span>Add Row
        	</button>';

        //Start the table holding all the child elements
        $returnString .= '<table>';   

        //Table body: the child elements
        $returnString .= '<tbody>';
        foreach($this->childElements AS $child_row){
            $returnString .= '<tr>';
            //Append the move icon
            $returnString .= '<td>'.$this->getMoveIconHTML().'</td>';
            foreach($child_row AS $child_element){
                $returnString .= '<td>';
                $returnString .= $child_element->getInput();
                $returnString .= '</td>';
            }
            //Append the remove button
            $returnString .= '<td>'.$this->getRemoveIconHTML().'</td>';
            $returnString .= '</tr>';
        }
        $returnString .= '</tbody>';
        
        //Insert the header row. We do this AFTER the tbody so we can use the tbody:empty+thead selector
        $returnString .= '<thead><tr>';
        $returnString .= '<th></th>'; //Space for the move icon
        foreach($this->templateChildElements AS $childElement){
            $returnString .= '<th>'.$childElement->getLabel().'</th>';
        }
        $returnString .= '<th></th>'; //Space for the remove icon
        $returnString .= '</tr></thead>';

        //End of table and container div
        $returnString .= '</table>';
        $returnString .= '</div>';


        return $returnString;
    }
    
    /**
     * Returns the 'move' icon used for the jQuery.sortable.
     * More of a normalizations function than a helper one
     * @return string	The HTML for the move icon
     */
    protected function getMoveIconHTML(){
        return '<span class="sortable-handler" style="cursor: move;"><i class="icon-menu"></i></span></a>';
    }


    /**
     * Returns the child form elements. Use this for custom layouts as the default one is quite bad.
     * @return Array[JFormField]	The child form elements
     */
    public function getFields(){return $this->childElements;}
}