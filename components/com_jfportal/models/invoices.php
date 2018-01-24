<?php
/**
 * @package     site.com_jfportal
 * @subpackage  models.invoices
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Invoices model
 */
class JfportalModelInvoices extends JModelList{
    protected $_context = 'com_jfportal.invoices';

    protected $totalUserInvoices = 0;

    /**
     * Constructor.
     */
    public function __construct($config = array()){
        if (empty($config['filter_fields']))
        {
            $config['filter_fields'] = array(
                'Description','invoices.Description',
            	'Payment Status', 'invoices.PayStatus',
                'Credit Status','invoices.CreditStatus',    
                'Date Created', 'invoices.DateCreated',
                'Invoice Total', 'invoices.InvoiceTotal',
                'Invoice Type', 'invoices.InvoiceType',
                'Product Sold', 'invoices.ProductSold',
                'Promo Code', 'invoices.PromoCode',
                'Refund Status', 'invoices.RefundStatus',
                'Total Due', 'invoices.TotalDue',
				'Total Paid', 'invoices.TotalPaid'
				);
        }

        parent::__construct($config);
    }

    protected function populateState($ordering = null, $direction = null){
        // List state information.
        parent::populateState('invoices.Id', 'desc');
        $params = JFactory::getApplication()->getParams();

        //Set the filters
        $status = $this->getUserStateFromRequest($this->context . '.filter.status', 'filter_status','0');
        $this->setState('filter.status', $status);

        //Credit status appears/applies only when the relevant column is visible
        $creditStatus = $params->get('show_CreditStatus',false) ? $this->getUserStateFromRequest($this->context . '.filter.creditstatus', 'filter_creditstatus','0') : 0;
        $this->setState('filter.creditstatus', $creditStatus);

        //Refund status appears/applies only when the relevant column is visible
        $refundStatus = $params->get('show_RefundStatus',true) ? $this->getUserStateFromRequest($this->context . '.filter.refundstatus', 'filter_refundstatus','0') : 0;
        $this->setState('filter.refundstatus', $refundStatus);

        //When moving from pagination page 2 (?limitstart=X) to the first (no ?limitstart request param), we end up stuck with the previous limitstart
        //This is an attempt at a fix, but probably not the proper one
        JFactory::getApplication()->setUserState($this->context . '.limitstart', JFactory::getApplication()->input->getUInt('start', 0));
        $this->setState('list.start', JFactory::getApplication()->input->getUInt('start', 0));
    }

    public function getItems(){
        $params = JFactory::getApplication()->getParams();
        
        //Fetch the invoice maps
        $invoice_maps = JFactory::getApplication()->getParams()->get('subscription_maps',array());

        //Visitors will never have any invoices
        $user = JFactory::getUser();
        if(!$user->get('id')){
            return array();
        }
         
        //Load the contact
        if(!$contact = IFSFactory::getUserContact()){
            JFactory::getApplication()->enqueueMessage('JoomFuse Portal Model Invoices could not load contact');
            return array();
        }
         
        //Fetch the user invoices list
        $user_invoices =  $contact->getInvoices(true);

        //Filter the invoices
        $user_invoices = $this->filterInvoices($user_invoices);
        $this->totalUserInvoices =  count($user_invoices);
        
        //Fetch the product list so we can append the product names in the invoices
        $productList = IFSApi::getProducts();
         
        //Inject other data within the invoices objects
        foreach($user_invoices AS &$invoice){
            //Check, just in case
            if(!isset($invoice->Id)){
                unset($invoice);
                continue;
            }

            //Verify the existence of PayStatus
            if(!isset($invoice->PayStatus) || !in_array($invoice->PayStatus, array(0,1))){
                $invoice->PayStatus = JoomfuseTableInvoice::INVOICE_PAY_STATUS_UNKNOWN;
            }

            //Verify the existence of Description
            if(!isset($invoice->Description) || !$invoice->Description){
                $invoice->Description = '';
            }

            //Verify the existence of Credit Status
            if(!isset($invoice->CreditStatus) || !$invoice->CreditStatus){
                $invoice->CreditStatus = JoomfuseTableInvoice::INVOICE_CREDIT_STATUS_NONE;
            }

            //Verify the existence of Invoice Total
            if(!isset($invoice->InvoiceTotal)){
                $invoice->InvoiceTotal = false;    //We test against is_numeric in the template
            }

            //Verify the existence of Invoice Type
            if(!isset($invoice->InvoiceType)){
                $invoice->InvoiceType = false;
            }

            //Verify the existence of Product Sold
            if(!isset($invoice->ProductSold)){
                $invoice->ProductSold = '';
            }
            
            //Append the name of the Product Sold, if found
            $invoice->ProductSoldEntries = array();
            $invoice->ProductSoldNames = array();
            if($invoice->ProductSold){
                //Seriously? comma-seperated values? Infusionsoft please...
                $products_sold = explode(',', $invoice->ProductSold);
                $productnames = array();
                
                foreach($productList AS $product){
                    if(in_array($product->Id, $products_sold)){
                        $invoice->ProductSoldEntries[] = $product;
                        $invoice->ProductSoldNames[] = $product->ProductName;
                    }
                }                
            }

            //Verify the existence of PromoCode
            if(!isset($invoice->PromoCode)){
                $invoice->PromoCode = '';
            }

            //Verify the existence of RefundStatus
            if(!isset($invoice->RefundStatus) || !in_array($invoice->RefundStatus, array(0,1))){
                $invoice->RefundStatus = JoomfuseTableInvoice::INVOICE_REFUND_STATUS_UNKNOWN;
            }

            //Verify the existence of TotalDue
            if(!isset($invoice->TotalDue)){
                $invoice->TotalDue = false;
            }

            //Verify the existence of TotalPaid
            if(!isset($invoice->TotalPaid)){
                $invoice->TotalPaid = false;
            }

            //Format the DateCreated
            if(isset($invoice->DateCreated) && $invoice->DateCreated){
                $jdate = JFactory::getDate(JoomfuseFieldMapElement::castInfusionsoftValueToJoomla($invoice->DateCreated, JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE));
                $invoice->DateCreated = $jdate;
            } else {
                $invoice->DateCreated = false;
            }
            $invoice->DateCreated_format = $params->get('DateCreated_format','') ? $this->params->get('DateCreated_format','') : null;
        }

        $ordered_invoices =  $this->order_invoices($user_invoices);
        return $this->getState('list.limit') ? array_slice($ordered_invoices, $this->getStart(), $this->getState('list.limit')) : $ordered_invoices;
    }

    protected function filterInvoices($invoices){
        //Apply the filter.status
        $status_filter = $this->getState('filter.status');
        $credit_status_filter = $this->getState('filter.creditstatus');
        $refund_status_filter = $this->getState('filter.refundstatus');

        $resultArray = $invoices;

        //Payment status filter
        foreach($resultArray AS $key => $invoice){
            switch($status_filter){
                case 1:
                    if(!isset($invoice->PayStatus) || $invoice->PayStatus != JoomfuseTableInvoice::INVOICE_PAY_STATUS_PAID){
                        //$status_filter_array[] = $invoice;
                        unset($resultArray[$key]);
                    }
                    break;
                case -1:
                    if(!isset($invoice->PayStatus) || $invoice->PayStatus != JoomfuseTableInvoice::INVOICE_PAY_STATUS_UNPAID){
                        //$status_filter_array[] = $invoice;
                        //unset($invoice);
                        unset($resultArray[$key]);
                    }
                    break;
                default:
                    //$status_filter_array[] = $invoice;
                    break;
            }
        }

        //Credit status filter
        foreach($resultArray AS $key => $invoice){
            switch($credit_status_filter){
                case 1:
                    if(!isset($invoice->CreditStatus) || $invoice->CreditStatus != JoomfuseTableInvoice::INVOICE_CREDIT_STATUS_PARTIAL){
                        //$credit_status_filter_array[] = $invoice;
                        //unset($invoice);
                        unset($resultArray[$key]);
                    }
                    break;
                case -1:
                    if(!isset($invoice->CreditStatus) || $invoice->CreditStatus != JoomfuseTableInvoice::INVOICE_CREDIT_STATUS_NONE){
                        //$credit_status_filter_array[] = $invoice;
                        //unset($invoice);
                        unset($resultArray[$key]);
                    }
                    break;
                default:
                    //$credit_status_filter_array[] = $invoice;
                    break;
            }
        }

        //Refund status filter
        foreach($resultArray AS $key => $invoice){
            switch($refund_status_filter){
                case 1:
                    if(!isset($invoice->RefundStatus) || $invoice->RefundStatus != JoomfuseTableInvoice::INVOICE_REFUND_STATUS_REFUNDED){
                        //$credit_status_filter_array[] = $invoice;
                        //unset($invoice);
                        unset($resultArray[$key]);
                    }
                    break;
                case -1:
                    if(!isset($invoice->RefundStatus) || $invoice->RefundStatus != JoomfuseTableInvoice::INVOICE_REFUND_STATUS_NONE){
                        //$credit_status_filter_array[] = $invoice;
                        //unset($invoice);
                        unset($resultArray[$key]);
                    }
                    break;
                default:
                    //$credit_status_filter_array[] = $invoice;
                    break;
            }
        }

        return $resultArray;
    }

    /**
     * Orders the invoices list according to the ordering criteria
     * @param Array $invoices		The array of invoice objects as returned from getItems()
     * @return Array					The sorted array
     */
    protected function order_invoices($invoices){
        $returnArray = array();

        //Essentially we place the entries in an associative array, with the index of the positions being the selected ordering field
        //Notice that we also add the invoice id to avoid duplicate keys (e.g: someone having the same product-sub twice, one active, one cancelled)
        $ordering = $this->getState('list.ordering', 'subscriptions.Id');
        $direction = $this->getState('list.direction', 'DESC');
        $keysort_function = 'strcasecmp';    //Default sorting is case-insensitive text-ranking
        foreach($invoices AS $invoice){
            switch($ordering){
                case 'invoices.Description':
                    $returnArray[$invoice->Description.'.'.$invoice->Id] = $invoice;
                    break;
                case 'invoices.PayStatus':
                    $returnArray[$invoice->PayStatus.'.'.$invoice->Id] = $invoice;
                    $keysort_function = array($this,'sortInvoiceNumeric');
                    break;
                case 'invoices.CreditStatus':
                    $returnArray[$invoice->CreditStatus.'.'.$invoice->Id] = $invoice;
                    break;
                case 'invoices.DateCreated':
                    //Just use the timestamp, but make sure we're using a JDate or we'll error-out
                    if(isset($invoice->DateCreated) && is_a($invoice->DateCreated, 'JDate')){
                        $returnArray[$invoice->DateCreated->toUnix().'.'.$invoice->Id] = $invoice;
                    } else {
                        $returnArray[$invoice->Id] = $invoice;
                    }
                    $keysort_function = array($this,'sortInvoiceNumeric');
                    break;
                case 'invoices.InvoiceTotal':
                    $returnArray[$invoice->InvoiceTotal.'.'.$invoice->Id] = $invoice;
                    $keysort_function = array($this,'sortInvoiceNumeric');
                    break;
                case 'invoices.InvoiceType':
                    //Invoice type is String.
                    $returnArray[$invoice->CreditStatus.'.'.$invoice->Id] = $invoice;
                    break;
                case 'invoices.ProductSold':
                    $returnArray[$invoice->ProductSold.'.'.$invoice->Id] = $invoice;
                    break;
                case 'invoices.PromoCode':
                    $returnArray[$invoice->PromoCode.'.'.$invoice->Id] = $invoice;
                    break;
                case 'invoices.RefundStatus':
                    $returnArray[$invoice->RefundStatus.'.'.$invoice->Id] = $invoice;
                    $keysort_function = array($this,'sortInvoiceNumeric');
                    break;
                case 'invoices.TotalDue':
                    $returnArray[intval($invoice->TotalDue).'.'.$invoice->Id] = $invoice;
                    $keysort_function = array($this,'sortInvoiceNumeric');
                    break;
                case 'invoices.TotalPaid':
                    $returnArray[intval($invoice->TotalPaid).'.'.$invoice->Id] = $invoice;
                    $keysort_function = array($this,'sortInvoiceNumeric');
                    break;
                default :
                    //Something is off, order just by Id
                    $returnArray[$invoice->Id] = $invoice;
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
     */

    /**
     * Simple numeric sorting function for the subscription prices.
     * We need to use this function as we utilize uksort, and we don't want to use inline functions (due to possible PHP version restrictions)
     * Notice that the values may end up coming in as 199.99.36 (36 being the RecurringOrder.Id), but PHP apparently has no issue with this value
     * @param Numeric $var1		The first comparison term
     * @param Numeric $var2		The second comparison term
     * @return number			1,0,-1 depending on if $var 1 is greater-than,equal-to,less-than $var2
     */

    public static function sortInvoiceNumeric($var1, $var2){
        if($var1 == $var2){return 0;}
        return ($var1-$var2) > 0 ? 1 : -1;    //I doubt we will ever run into a PHP integer overflow
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
        return $this->totalUserInvoices;
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
            //Verify that we have the minimum required data
            if(!isset($creditcard->Status) || !isset($creditcard->Last4) ||
            !isset($creditcard->CardType) || !isset($creditcard->ExpirationMonth) ||
            !isset($creditcard->ExpirationYear)){
                continue;
            }

            //Verify the Status type
            if(!isset($creditcard->Status) || $creditcard->Status != JoomfuseTableCreditcard::CARD_STATUS_OK){
                continue;
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


}
