<?php
/**
 * Joomfuse fields
 * @package     admin.com_joomfuse
 * @subpackage	models.fields.joomfusesubscriptionproductlist
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
class JFormFieldJoomfusesubscriptionproductlist extends JFormFieldList {
    //The field class must know its own type through the variable $type.
    protected $type = 'joomfusesubscriptionproductlist';

    protected function getOptions(){
        $groups = parent::getOptions();
        
        //Fetch the list of action sets
        /*
        $table = new JoomfuseTableCProgram();
        $searchField = new JoomfuseAPIField('Active', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 1);
        $subscription_list = IFSApi::dsQuery('CProgram', $searchField);
        */
        $subscription_list = IFSApi::getSubscriptionList();
        
        foreach($subscription_list AS $subscription){
            if(!isset($subscription->ProgramName) || !$subscription->Active){continue;} //Ignore un-named and inactive entries
            
            //We need a composite of the ProgramName (the product name), billig cycle and frequency
            //That is because there can be multiple entries with the same Program Name but are simply for different cycles/frequencies.
            //For example: Sub1 Monthly, Sub1 Yearly
            $programName = $subscription->ProgramName;
            if(isset($subscription->DefaultCycle) && isset($subscription->DefaultFrequency)){
                //We only know about daily, weekly, monthly, yearly BillingCycles
                $cycle = $subscription->DefaultCycle;
                if(!in_array($cycle, array(1,2,3,6))){
                    $cycle = 0;
                }
                
                //See whether we need to do 'Monthly' or 'Every X months'
                if($subscription->DefaultFrequency > 1){
                    $programName .= ' - '. JText::sprintf('FIELD_JOOMFUSESUBSCRIPTIONPRODUTLIST_BILLING_CYCLE_VALUE_'.$cycle.'_MULTIPLE',$subscription->DefaultFrequency);
                } else {
                    $programName .= ' - '. JText::_('FIELD_JOOMFUSESUBSCRIPTIONPRODUTLIST_BILLING_CYCLE_VALUE_'.$cycle);
                }
                
            }
                        
            $tmp = JHtml::_(
				'select.option', $subscription->Id,
				$programName, 'value', 'text',
				false
			);
			
			$groups[] = $tmp;
        }
        reset($groups);

        return $groups;
    }
    
}