<?php
/**
 * @package     site.com_jfportal
 * @subpackage  models.subscriptions
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Subscriptions model
 */
class JfportalModelSubscriptions extends JModelList{
    protected $_context = 'com_jfportal.subscriptions';

    protected $totalUserSubscriptions = 0;

    /**
     * Constructor.
     */
    public function __construct($config = array()){
        if (empty($config['filter_fields']))
        {
            $config['filter_fields'] = array(
			    'Subscription', 'subscriptions.name',
                'Status','subscriptions.status',
			    'Cycle', 'subscriptions.cycle',
				'Subscription Start', 'subscriptions.substart',
            	'Subscription End', 'subscriptions.subend',
            	'Last Charge', 'subscriptions.lastcharge',
                'Next Charge', 'subscriptions.nextcharge',
            //'Paid Through', 'subscriptions.paidthru',
            	'Price', 'subscriptions.price',
            	'Credit Card', 'subscriptions.cc'
            	);
        }

        parent::__construct($config);
    }

    protected function populateState($ordering = null, $direction = null){
        // List state information.
        parent::populateState('subscriptions.name', 'asc');


        //Set the filters
        $status = $this->getUserStateFromRequest($this->context . '.filter.status', 'filter_status','0');
        $this->setState('filter.status', $status);

        //When moving from pagination page 2 (?limitstart=X) to the first (no ?limitstart request param), we end up stuck with the previous limitstart
        //This is an attempt at a fix, but probably not the proper one
        //$cur_state = $this->getUserState($key, $default);
        JFactory::getApplication()->setUserState($this->context . '.limitstart', JFactory::getApplication()->input->getUInt('start', 0));
        $this->setState('list.start', JFactory::getApplication()->input->getUInt('start', 0));
        //$this->getState('limit.start',0);
        //$new_state = $this->input->get($request, null, $type);
    }

    public function getItems(){
        $params = JFactory::getApplication()->getParams();

        //Fetch the subscription maps
        $subscription_maps = JComponentHelper::getParams('com_jfportal')->get('subscription_maps',array());
        //$subscription_maps = JFactory::getApplication()->getParams()->get('subscription_maps',array());

        //Visitors will never have any subscriptions
        $user = JFactory::getUser();
        if(!$user->get('id')){
            return array();
        }
         
        //Load the contact
        if(!$contact = IFSFactory::getUserContact()){
            JFactory::getApplication()->enqueueMessage('JoomFuse Portal Model Subscriptions could not load contact');
            return array();
        }
         
        //Fetch the entire list of subscription products
        $subscriptions = IFSApi::getSubscriptionList();
        //var_dump($subscriptions);
         
        //Fetch the user subscriptions list
        $user_subscriptions =  $contact->getSubscriptionList(true);
        //$this->totalUserSubscriptions =  count($user_subscriptions);
        //var_dump($user_subscriptions);

        //Filter the subscriptions
        $user_subscriptions = $this->filterSubscriptions($user_subscriptions);
        $this->totalUserSubscriptions =  count($user_subscriptions);

        //Fetch the Credit card list
        $user_creditcards = $contact->getCreditCards(true);
         
        //Inject other data within the subscriptions object
        foreach($user_subscriptions AS &$user_sub){
            $user_sub->CProgram = null;
            $user_sub->is_editable = false;
            $user_sub->subscription_cancel_actionset = 0;
            $user_sub->subscription_cancel_goal = '';
            $user_sub->subscription_cancel_complete_actionset = 0;
            $user_sub->subscription_cancel_complete_goal = '';
            $user_sub->invoice_paid_actionset = 0;
            $user_sub->invoice_paid_goal = '';
            $user_sub->all_invoices_paid_actionset = 0;
            $user_sub->all_invoices_paid_goal = '';

            //Check, just in case
            if(!isset($user_sub->Id)){continue;}

            //Make sure the BillingCycle makes sense to us
            if(!isset($user_sub->BillingCycle) || !in_array($user_sub->BillingCycle, array(3,2,1,6))){
                JFactory::getApplication()->enqueueMessage('JoomFuse Portal encountered an unknown BillingCycle for RecurringOrder '.$user_sub->Id.': '.$user_sub->BillingCycle);
                $user_sub->BillingCycle = 0;
            }

            //Make sure the frequency is set
            if(!isset($user_sub->Frequency)){
                $user_sub->Frequency = 1;
            }

            //Format the Start Date
            if(isset($user_sub->StartDate) && $user_sub->StartDate){
                $jdate = JFactory::getDate(JoomfuseFieldMapElement::castInfusionsoftValueToJoomla($user_sub->StartDate, JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE));
                $user_sub->StartDate = $jdate;
            } else {
                $user_sub->StartDate = false;
            }
            $user_sub->StartDate_format = $params->get('StartDate_format','') ? $this->params->get('StartDate_format','') : null;

            //Format the End Date
            if(isset($user_sub->EndDate) && $user_sub->EndDate){
                $jdate = JFactory::getDate(JoomfuseFieldMapElement::castInfusionsoftValueToJoomla($user_sub->EndDate, JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE));
                $user_sub->EndDate = $jdate;
            } else {
                $user_sub->EndDate = false;
            }
            $user_sub->EndDate_format = $params->get('EndDate_format','') ? $this->params->get('EndDate_format','') : null;

            //Format the Next Bill Date
            if(isset($user_sub->NextBillDate) && $user_sub->NextBillDate && isset($user_sub->Status) && $user_sub->Status == JoomfuseTableRecurringOrder::STATUS_ACTIVE){
                $jdate = JFactory::getDate(JoomfuseFieldMapElement::castInfusionsoftValueToJoomla($user_sub->NextBillDate, JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE));
                $user_sub->NextBillDate = $jdate;
            } else {
                $user_sub->NextBillDate = null;
            }
            $user_sub->NextBillDate_format = $params->get('nextBillDate_format','') ? $this->params->get('nextBillDate_format','') : null;

            //Format the Last Bill Date
            if(isset($user_sub->LastBillDate) && $user_sub->LastBillDate){
                $jdate = JFactory::getDate(JoomfuseFieldMapElement::castInfusionsoftValueToJoomla($user_sub->LastBillDate, JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE));
                $user_sub->LastBillDate = $jdate;
            } else {
                $user_sub->LastBillDate = false;
            }
            $user_sub->LastBillDate_format = $params->get('LastBillDate_format','') ? $this->params->get('LastBillDate_format','') : null;

            //Format the Paid Through Date
            /*
            if(isset($user_sub->PaidThruDate) && $user_sub->PaidThruDate){
            $jdate = JFactory::getDate(JoomfuseFieldMapElement::castInfusionsoftValueToJoomla($user_sub->PaidThruDate, JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE));
            $user_sub->PaidThruDate = $jdate;
            } else {
            $user_sub->PaidThruDate = false;
            }
            $user_sub->PaidThruDate_format =  $params->get('PaidThruDate_format','') ? $this->params->get('PaidThruDate_format','') : null;
            */
             
            //Inject the CProgram data we have in the $subscriptions within $user_subscriptions
            foreach($subscriptions AS $subscription){
                //Check, just in case
                if(!isset($subscription->Id)){continue;}
                if($subscription->Id == $user_sub->ProgramId){
                    $user_sub->CProgram = $subscription;
                }
            }

            //Inject the credit card data
            foreach($user_creditcards AS $creditcard){
                if(!isset($creditcard->Status)){continue;}    //Should never happen, but check anyways
                if(isset($user_sub->CC1) && $user_sub->CC1 == $creditcard->Id ){
                    $user_sub->CC1 = $creditcard;
                    break;
                }
            }

            //Make sure we found the CC we were looking for
            if(is_numeric($user_sub->CC1) && $user_sub->CC1){
                $message = 'JoomFuse Portal could not locate a user CC with id: '.$user_sub->CC1;
                IFSFactory::logError($message);
                JFactory::getApplication()->enqueueMessage($message,'error');

                $user_sub->CC1 = false;
            }

            //See whether this subscription is editable or not
            foreach($subscription_maps AS $subscription_map){
                //Check, just in case
                if(!isset($subscription_map->subscription_id) || !$subscription_map->subscription_id ){continue;}

                //Extract the actionsets/goals configured for the various actions upon this subscription
                if($subscription_map->subscription_id == $user_sub->ProgramId){
                    $user_sub->is_editable = true;
                    if (isset($subscription_map->subscription_cancel_actionset) &&  $subscription_map->subscription_cancel_actionset){
                        $user_sub->subscription_cancel_actionset = $subscription_map->subscription_cancel_actionset;
                    }
                    if (isset($subscription_map->subscription_cancel_goal) &&  $subscription_map->subscription_cancel_goal){
                        $user_sub->subscription_cancel_goal = $subscription_map->subscription_cancel_goal;
                    }
                    if (isset($subscription_map->subscription_cancel_complete_actionset) &&  $subscription_map->subscription_cancel_complete_actionset){
                        $user_sub->subscription_cancel_complete_actionset = $subscription_map->subscription_cancel_complete_actionset;
                    }
                    if (isset($subscription_map->subscription_cancel_complete_goal) &&  $subscription_map->subscription_cancel_complete_goal){
                        $user_sub->subscription_cancel_complete_goal = $subscription_map->subscription_cancel_complete_goal;
                    }
                    if (isset($subscription_map->invoice_paid_actionset) &&  $subscription_map->invoice_paid_actionset){
                        $user_sub->invoice_paid_actionset = $subscription_map->invoice_paid_actionset;
                    }
                    if (isset($subscription_map->invoice_paid_goal) &&  $subscription_map->invoice_paid_goal){
                        $user_sub->invoice_paid_goal = $subscription_map->invoice_paid_goal;
                    }
                    if (isset($subscription_map->all_invoices_paid_actionset) &&  $subscription_map->all_invoices_paid_actionset){
                        $user_sub->all_invoices_paid_actionset = $subscription_map->all_invoices_paid_actionset;
                    }
                    if (isset($subscription_map->all_invoices_paid_goal) &&  $subscription_map->all_invoices_paid_goal){
                        $user_sub->all_invoices_paid_goal = $subscription_map->all_invoices_paid_goal;
                    }

                }
            }
        }

        $ordered_subscriptions =  $this->order_subscriptions($user_subscriptions);
        return $this->getState('list.limit') ? array_slice($ordered_subscriptions, $this->getStart(), $this->getState('list.limit')) : $ordered_subscriptions;
    }

    protected function filterSubscriptions($subscriptions){
        //Apply the filter.status
        $status_filter = $this->getState('filter.status');
        $returnArray = array();

        foreach($subscriptions AS $subscription){
            switch($status_filter){
                case 1:
                    if(!isset($subscription->Status) || $subscription->Status == JoomfuseTableRecurringOrder::STATUS_ACTIVE){
                        $returnArray[] = $subscription;
                    }
                    break;
                case -1:
                    if(!isset($subscription->Status) || $subscription->Status == JoomfuseTableRecurringOrder::STATUS_INACTIVE){
                        $returnArray[] = $subscription;
                    }
                    break;
                default:
                    $returnArray[] = $subscription;
                    break;
            }
        }

        return $returnArray;
    }

    /**
     * Orders the subscriptions list according to the ordering criteria
     * Defaults to subscriptions.name ASC
     * @param Array $subscriptions		The array of subscription objects as returned from getItems()
     * @return Array					The sorted array
     */
    protected function order_subscriptions($subscriptions){
        $returnArray = array();

        //Essentially we place the entries in an associative array, with the index of the positions being the selected ordering field
        //Notice that we also add the subscription id to avoid duplicate keys (e.g: someone having the same product-sub twice, one active, one cancelled)
        $ordering = $this->getState('list.ordering', 'subscriptions.name');
        $direction = $this->getState('list.direction', 'ASC');
        $keysort_function = 'strcasecmp';    //Default sorting is case-insensitive text-ranking
        foreach($subscriptions AS $subscription){
            switch($ordering){
                case 'subscriptions.name':
                    $returnArray[$subscription->CProgram->ProgramName.'.'.$subscription->Id] = $subscription;
                    break;
                case 'subscriptions.status':
                    //RecurringOrder.Status is a string, so we can sort by it
                    $returnArray[$subscription->Status.'.'.$subscription->Id] = $subscription;
                    break;
                case 'subscriptions.cycle':
                    // ASC order is: 0,6,3,2,1. Just use the translation string for the ordering and get it over with (helps with other languages too)
                    $keysort_function = array('JfportalModelSubscriptions','sortSubscriptionBillingCycle');
                    $returnArray[$subscription->BillingCycle.'.'.$subscription->Id] = $subscription;
                    break;
                case 'subscriptions.substart':
                    //Just use the timestamp, but make sure we're using a JDate or we'll error-out
                    if(isset($subscription->StartDate) && is_a($subscription->StartDate, 'JDate')){
                        $returnArray[$subscription->StartDate->toUnix().'.'.$subscription->Id] = $subscription;
                    } else {
                        $returnArray[$subscription->Id] = $subscription;
                    }
                    $keysort_function = array('JfportalModelSubscriptions','sortSubscriptionNumeric');
                    break;
                case 'subscriptions.subend':
                    //Just use the timestamp, but make sure we're using a JDate or we'll error-out
                    if(isset($subscription->EndDate) && is_a($subscription->EndDate, 'JDate')){
                        $returnArray[$subscription->EndDate->toUnix().'.'.$subscription->Id] = $subscription;
                    } else {
                        $returnArray[$subscription->Id] = $subscription;
                    }
                    $keysort_function = array('JfportalModelSubscriptions','sortSubscriptionNumeric');
                    break;
                case 'subscriptions.lastcharge':
                    //Just use the timestamp, but make sure we're using a JDate or we'll error-out
                    if(isset($subscription->LastBillDate) && is_a($subscription->LastBillDate, 'JDate')){
                        $returnArray[$subscription->LastBillDate->toUnix().'.'.$subscription->Id] = $subscription;
                    } else {
                        $returnArray[$subscription->Id] = $subscription;
                    }
                    $keysort_function = array('JfportalModelSubscriptions','sortSubscriptionNumeric');
                    break;
                case 'subscriptions.nextcharge':
                    //Just use the timestamp, but make sure we're using a JDate or we'll error-out
                    if(isset($subscription->NextBillDate) && is_a($subscription->NextBillDate, 'JDate')){
                        $returnArray[$subscription->NextBillDate->toUnix().'.'.$subscription->Id] = $subscription;
                    } else {
                        $returnArray[$subscription->Id] = $subscription;
                    }
                    $keysort_function = array('JfportalModelSubscriptions','sortSubscriptionNumeric');
                    break;
                    /*
                     case 'subscriptions.paidthru':
                     //Just use the timestamp, but make sure we're using a JDate or we'll error-out
                     if(isset($subscription->PaidThruDate) && is_a($subscription->PaidThruDate, 'JDate')){
                     $returnArray[$subscription->PaidThruDate->toUnix().'.'.$subscription->Id] = $subscription;
                     } else {
                     $returnArray[$subscription->Id] = $subscription;
                     }
                     $keysort_function = array('JfportalModelSubscriptions','sortSubscriptionNumeric');
                     break;
                     */
                case 'subscriptions.price':
                    $returnArray[$subscription->BillingAmt.'.'.$subscription->Id] = $subscription;
                    $keysort_function = array('JfportalModelSubscriptions','sortSubscriptionNumeric');
                    break;
                case 'subscriptions.cc':
                    if($subscription->CC1 && isset($subscription->CC1->ExpirationYear)){
                        $returnArray[$subscription->CC1->ExpirationYear.'.'.$subscription->Id] = $subscription;
                    } else {
                        $returnArray['0.'.$subscription->Id] = $subscription;
                    }
                    $keysort_function = array('JfportalModelSubscriptions','sortSubscriptionNumeric');
                    break;
                default :
                    //Something is off, order just by Id
                    $returnArray[$subscription->Id] = $subscription;
                    break;
            }

        }

        uksort($returnArray, $keysort_function);
        return $direction == 'asc' ? $returnArray : array_reverse($returnArray);
    }

    /**
     * Used to sort the arbitrary int values of the RecurringOrder.BillingCycle column with uksort
     * Notice that we can never really have true equality, as the values come in as cycle_int.unique_recurring_order_id, so the decimal bit will always differ
     * @param Numeric $var1			The first comparison term
     * @param Numeric $var2			The second comparison term
     * @return number				1,0,-1 depending on if $var 1 is greater-than,equal-to,less-than $var2
     */
    public static function sortSubscriptionBillingCycle($var1, $var2){
        // ASC order is: 0,6,3,2,1. Just use the translation string for the ordering and get it over with (helps with other languages too)
        $sequence_array = array(JoomfuseTableRecurringOrder::CYCLE_UNKNOWN, JoomfuseTableRecurringOrder::CYCLE_DAILY, JoomfuseTableRecurringOrder::CYCLE_WEEKLY, JoomfuseTableRecurringOrder::CYCLE_MONTHLY, JoomfuseTableRecurringOrder::CYCLE_YEARLY);

        //The values show up as int.int, so they look like decimals. So treat them as such

        //Check for integer equality, if so, return with a simple numeric comparison
        if((int)$var1 == (int)$var2){
            return $var1 > $var2 ? 1 : -1;
        }

        //So now we just compare the numerical indexes in the sequence array. Just cast them to int to get rid of the id bit at the end of the
        return array_search((int)$var1, $sequence_array) > array_search((int)$var2, $sequence_array) ? 1 : -1;
    }

    /**
     * Simple numeric sorting function for the subscription prices.
     * We need to use this function as we utilize uksort, and we don't want to use inline functions (due to possible PHP version restrictions)
     * Notice that the values may end up coming in as 199.99.36 (36 being the RecurringOrder.Id), but PHP apparently has no issue with this value
     * @param Numeric $var1		The first comparison term
     * @param Numeric $var2		The second comparison term
     * @return number			1,0,-1 depending on if $var 1 is greater-than,equal-to,less-than $var2
     */
    public static function sortSubscriptionNumeric($var1, $var2){
        return $var1-$var2;    //I doubt we will ever run into a PHP integer overflow
    }



    /**
     * Fetches the list of active creditcards for the current user
     * @return Array
     */
    public function getCreditcards(){
        //Load the contact
        if(!$contact = IFSFactory::getUserContact()){
            JFactory::getApplication()->enqueueMessage('JoomFuse Portal Model Subscriptions could not load contact');
            return array();
        }

        //Guests do not have credit card lists
        if(JFactory::getUser()->guest){
            return array();
        }

        //Fetch the list of creditcards and extract the active ones
        $creditcard_list = $contact->getCreditCards(true);
        $returnArray = array();
        foreach($creditcard_list AS $creditcard){
            //Skip deleted creditcards
            if(isset($creditcard->Status) && $creditcard->Status == JoomfuseTableCreditcard::CARD_STATUS_DELETED){
                continue;
            }

            //Verify that we have the minimum required data
            if(!isset($creditcard->Status) || !isset($creditcard->Last4) ||
            !isset($creditcard->CardType) || !isset($creditcard->ExpirationMonth) ||
            !isset($creditcard->ExpirationYear)){
                $message = 'JoomFuse Portal encountered missing data for CC: '.$creditcard->Id;
                IFSFactory::logError($message);
                //JFactory::getApplication()->enqueueMessage($message,'error');
                continue;
            }

            //Verify the Status type
            if(!isset($creditcard->Status) || !in_array($creditcard->Status, array(1,2,3,4))){
                $message = 'JoomFuse Portal encountered an unknown CC status: '.$creditcard->Status .' for CC '.$creditcard->Id;
                IFSFactory::logError($message);
                JFactory::getApplication()->enqueueMessage($message,'error');
                $creditcard->Status = 0;
            }

            /*
             if($creditcard->Status == 3){
             $returnArray[] = $creditcard;
             }
             */
            $returnArray[] = $creditcard;
        }

        return $returnArray;
    }

    public function getPagination(){
        // Get a storage key.
        $store = $this->getStoreId('getPagination');

        // Try to load the data from internal storage.
        if (isset($this->cache[$store]))
        {
            return $this->cache[$store];
        }

        // Create the pagination object.
        $limit = (int) $this->getState('list.limit') - (int) $this->getState('list.links');
        $page = new JPagination($this->getTotal(), $this->getStart(), $limit);

        // Add the object to the internal cache.
        $this->cache[$store] = $page;

        return $this->cache[$store];
    }

    public function getTotal(){
        return $this->totalUserSubscriptions;
    }


}
