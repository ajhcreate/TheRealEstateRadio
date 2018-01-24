<?php
/**
 * @package     site.com_jfportal
 * @subpackage  models.subscription
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('JfportalModelSubscriptions', JPATH_SITE.'/components/com_jfportal/models/subscriptions.php');

/**
 * Subscription model
 * Overrides the models subscription and simply fetches the data of the exact subscription that we need
 * We don't really care about overfetching data: We still need exactly 3 API calls to fetch all the data.
 */
class JfportalModelSubscription extends JfportalModelSubscriptions{
    protected $_context = 'com_jfportal.subscription';

    public function getItem(){
        $params = JFactory::getApplication()->getParams();
        if(!($pk = JFactory::getApplication()->input->getUint('id',0))){
            JErrorPage::render('No Subscription id defined');
        }

        //Fetch all the items. It's the same amount of API calls anyway.
        //@TODO-GN: See if refreshing the subs page keeps the list.limit=all
        //This seems like a joomla bug. If we don't getState, the setState doesn't work for some reason
        $this->getState('list.limit');
        $this->setState('list.limit',0);
        $items = $this->getItems();

        //Return the relevant item
        foreach($items AS $item){
            if(!isset($item->Id)){continue;}    //Should never happen, but check anyways
            if($item->Id == $pk){
                //Only keep object properties we were configured to display
                if(!$params->get('show_details_ProgramName',true)){
                    if(isset($item->CProgram) && isset($item->CProgram->ProgramName)){$item->CProgram->ProgramName = null;}
                }
                if(!$params->get('show_details_AutoCharge',true)){
                    if(isset($item->AutoCharge)){$item->AutoCharge = null;}
                }
                if(!$params->get('show_details_BillingAmt',true)){
                    if(isset($item->BillingAmt)){$item->BillingAmt = null;}
                }
                if(!$params->get('show_details_BillingCycle',true)){
                    if(isset($item->BillingCycle)){$item->BillingCycle = null;}
                }
                if(!$params->get('show_details_CC1',true)){
                    if(isset($item->CC1)){$item->CC1 = null;}
                }
                if(!$params->get('show_details_LastBillDate',true)){
                    if(isset($item->LastBillDate)){$item->LastBillDate = null;}
                }
                if(!$params->get('show_details_MaxRetry',false)){
                    if(isset($item->MaxRetry)){$item->MaxRetry = null;}
                }
                if(!$params->get('show_details_NextBillDate',true) && isset($item->Status) && $item->Status == JoomfuseTableRecurringOrder::STATUS_ACTIVE){
                    if(isset($item->NextBillDate)){$item->NextBillDate = null;}
                }
                if(!$params->get('show_details_NumDaysBetweenRetry',false)){
                    if(isset($item->NumDaysBetweenRetry)){$item->NumDaysBetweenRetry = null;}
                }
                /*
                if(!$params->get('show_details_PaidThruDate',false)){
                    if(isset($item->PaidThruDate)){$item->PaidThruDate = null;}
                }
                */
                if(!$params->get('show_details_StartDate',true)){
                    if(isset($item->StartDate)){$item->StartDate = null;}
                }
                if(!$params->get('show_details_Status',true)){
                    if(isset($item->Status)){$item->Status = null;}
                }
                
                //If we do not want to show the cancel-subscription button, we just set the editable flag to false
                if(!$params->get('show_details_Cancel',true)){
                   $item->is_editable = false;
                }
                
                //Set the optional modal classname
                $item->classname = $params->get('modal_classname','');

                return $item;
            }
        }

        $this->setError('No such subscription found');
        return false;
    }

}
