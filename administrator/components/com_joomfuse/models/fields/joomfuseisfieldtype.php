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
//Load the javascript used for the interception and value changes
JFactory::getDocument()->addScript(JURI::root().'/administrator/components/com_joomfuse/models/fields/joomfuseisfieldtype.js');

//Load the field element that we extend upon
JFormHelper::loadFieldClass('hidden');


/**
 * Joomfuse field for intercepting changes to joomfuseprofilefield fields and
 * storing their ifs field types (which are stored in the select option classnames)
 * @author Georgios Ntampitzias and the JoomFuse team (nonickch@gmail.com)
 *
 */
class JFormFieldJoomfuseisfieldtype extends JFormFieldHidden {
    protected $type = 'Joomfuseisfieldtype';
    
    protected function getInput(){
        $this->class = '" data-fieldtypecontainer="true';
        /*
        // Initialize some field attributes.
        $class = !empty($this->class) ? ' class="' . $this->class . '"' : '';
        $disabled = $this->disabled ? ' disabled' : '';

        // Initialize JavaScript field attributes.
        $onchange = $this->onchange ? ' onchange="' . $this->onchange . '"' : '';

        return '<input type="hidden" name="' . $this->name . '" id="' . $this->id . '" value="'
        . htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '"' . $class . $disabled . $onchange . ' />';
        */
        return parent::getInput();
    }

}