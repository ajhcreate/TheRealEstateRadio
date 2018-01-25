<?php
/**
 * Joomfuse fields
 * @package     admin.com_joomfuse
 * @subpackage	models.fields.joomfuseactionsetlist
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

//Import/register the IFSFactory that takes care of all the required files
class_exists('IFSFactory') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/ifsfactory.php';
JLoader::register('IFSApi', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/ifsapi.php');

//Load the field element that we extend upon
JFormHelper::loadFieldClass('List');

/**
 * Joomfuse field for listing all Infusionsoft actionsets in a select list
 * @author Georgios Ntampitzias (nonickch@gmail.com)
 *
 */
class JFormFieldJoomfuseactionsetlist extends JFormFieldList {
    //The field class must know its own type through the variable $type.
    protected $type = 'joomfuseactionsetlist';

    protected function getOptions(){
        $groups = parent::getOptions();
        
        //Fetch the list of action sets
        $actionset_list = IFSApi::getActionsetList();
        
        foreach($actionset_list AS $actionset){
            if(!isset($actionset->TemplateName)){continue;} //Ignore un-named entries
            $tmp = JHtml::_(
				'select.option', $actionset->Id,
				$actionset->TemplateName, 'value', 'text',
				false
			);
			
			$groups[] = $tmp;
        }
        reset($groups);
        
        //@TODO-GN: Remove this and the method
        //$this->temp();

        return $groups;
    }
    
    /*
    protected function temp(){
        //Get The ActionSequence Table
        $table = new JoomfuseTableCProgram();
        $searchField = new JoomfuseAPIField('Active', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 1);

        var_dump(IFSApi::dsQuery('CProgram', $searchField));

    }
    */

}