<?php
/**
 * @package     site.com_jfportal
 * @subpackage  models.creditcards
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Creditcards model
 */
class JfportalModelCreditcards extends JModelList{
    protected $_context = 'com_jfportal.creditcards';
    protected $total_user_creditcards = 0;

    /**
     * Constructor.
     */
    public function __construct($config = array()){
        if (empty($config['filter_fields']))
        {
            $config['filter_fields'] = array(
			    'Card Type', 'creditcards.cardType',
                'Billing Address 1', 'creditcards.billaddress1',
                'Billing Address 2', 'creditcards.billaddress2',
            	'Billing Zip', 'creditcards.billzip',
                'Billing City', 'creditcards.billcity',
                'Billing State', 'creditcards.billstate',
                'Billing Country', 'creditcards.billcountry',
                'Billing Name', 'creditcards.billname',
                'Expiration Date','creditcards.expiration',
                'First Name', 'creditcards.firstname',
            	'Last Name', 'creditcards.lastname',
                'Full Name', 'creditcards.nameoncard',
                'Maestro Issue Number', 'creditcards.maestroissuenumber',
                'Phone Number', 'creditcards.phonenumber',
                'Last 4', 'creditcards.last4',
                'Shipping First Name', 'creditcards.shipfirstname',
                'Shipping Last Name', 'creditcards.shiplastname',
                'Shipping Full Name', 'creditcards.shipname',
                'Start Date', 'creditcards.startdate',
                'Status', 'creditcards.status'
                );
        }

        parent::__construct($config);
    }

    protected function populateState($ordering = null, $direction = null){
        // List state information.
        parent::populateState('creditcards.Id', 'asc');


        //Set the filters
        $status = $this->getUserStateFromRequest($this->context . '.filter.status', 'filter_status','-1');
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

        //Fetch the Credit card list
        //Load the contact
        if(!$contact = IFSFactory::getUserContact()){
            JFactory::getApplication()->enqueueMessage('JoomFuse Portal Model creditcards could not load contact');
            return array();
        }

        //Fetch the list of creditcards and apply any filters
        $creditcard_list = $contact->getCreditCards(true);
        $creditcard_list = $this->filterCreditcards($creditcard_list);

        $user_creditcards = array();
        foreach($creditcard_list AS $creditcard){
            $creditcard->expirationDate = new JDate();
            $creditcard->StartDate = null;
            $creditcard->ExpirationDate_format = '';
            $creditcard->StartDate_format = '';
            
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

            //Make sure all the card fields exist
            if(!isset($creditcard->BillAddress1)){
                $creditcard->BillAddress1 = null;
            }
            if(!isset($creditcard->BillAddress2)){
                $creditcard->BillAddress2 = null;
            }
            if(!isset($creditcard->BillZip)){
                $creditcard->BillZip = null;
            }
            if(!isset($creditcard->BillCity)){
                $creditcard->BillCity = null;
            }
            if(!isset($creditcard->BillState)){
                $creditcard->BillState = null;
            }
            if(!isset($creditcard->BillCountry)){
                $creditcard->BillCountry = null;
            }
            if(!isset($creditcard->BillName)){
                $creditcard->BillName = null;
            }
            if(!isset($creditcard->FirstName)){
                $creditcard->FirstName = null;
            }
            if(!isset($creditcard->LastName)){
                $creditcard->LastName = null;
            }
            if(!isset($creditcard->NameOnCard)){
                $creditcard->NameOnCard = null;
            }
            if(!isset($creditcard->MaestroIssueNumber)){
                $creditcard->MaestroIssueNumber = null;
            }
            if(!isset($creditcard->PhoneNumber)){
                $creditcard->PhoneNumber = null;
            }
            if(!isset($creditcard->Last4)){
                $creditcard->Last4 = null;
            }
            if(!isset($creditcard->ShipFirstName)){
                $creditcard->ShipFirstName = null;
            }
            if(!isset($creditcard->ShipLastName)){
                $creditcard->ShipLastName = null;
            }
            if(!isset($creditcard->ShipName)){
                $creditcard->ShipName = null;
            }

            //Add the expiration-date composite field
            $date = DateTime::createFromFormat('Y m',$creditcard->ExpirationYear.' '.$creditcard->ExpirationMonth);
            $creditcard->expirationDate = new JDate($date->getTimestamp());
            $creditcard->ExpirationDate_format = $params->get('ExpirationDate_format','') ? $this->params->get('ExpirationDate_format','') : 'm/Y';

            //Add the StartDate composite field
            $creditcard->StartDate_format = $params->get('StartDate_format','') ? $this->params->get('StartDate_format','') : 'm/Y';
            if(isset($creditcard->StartDateYear) && isset($creditcard->StartDateMonth)){
                $date = DateTime::createFromFormat('Y m',$creditcard->StartDateYear.' '.$creditcard->StartDateMonth);
                $creditcard->StartDate = new JDate($date->getTimestamp());
            }

            $user_creditcards[] = $creditcard;
        }

        $this->total_user_creditcards = count($user_creditcards);

        $ordered_creditcards =  $this->order_creditcards($user_creditcards);
        return $this->getState('list.limit') ? array_slice($ordered_creditcards, $this->getStart(), $this->getState('list.limit')) : $ordered_creditcards;
    }

    protected function filterCreditcards($creditcards){
        //Apply the filter.status
        $status_filter = $this->getState('filter.status', -1);
        $returnArray = array();

        foreach($creditcards AS $creditcard){
            //If a filter is set, skip entries that do not match the filter
            if($status_filter != -1 && $creditcard->Status != $status_filter){
                continue;
            }

            $returnArray[] = $creditcard;
        }


        return $returnArray;
    }

    /**
     * Orders the creditcards list according to the ordering criteria
     * Defaults to creditcards.Id ASC
     * @param Array $creditcards		The array of creditcard objects as returned from getItems()
     * @return Array					The sorted array
     */
    protected function order_creditcards($creditcards){
        $returnArray = array();

        //Essentially we place the entries in an associative array, with the index of the positions being the selected ordering field
        //Notice that we also add the creditcard id to avoid duplicate keys (e.g: someone having the same product-sub twice, one active, one cancelled)
        $ordering = $this->getState('list.ordering', 'creditcards.name');
        $direction = $this->getState('list.direction', 'ASC');
        $keysort_function = 'strcasecmp';    //Default sorting is case-insensitive text-ranking
        foreach($creditcards AS $creditcard){
            switch($ordering){
                case 'creditcards.cardType':
                    $returnArray[$creditcard->CardType.'.'.$creditcard->Id] = $creditcard;
                    break;
                case 'creditcards.billaddress1':
                    $returnArray[$creditcard->BillAddress1.'.'.$creditcard->Id] = $creditcard;
                    break;
                case 'creditcards.billaddress2':
                    $returnArray[$creditcard->BillAddress1.'.'.$creditcard->Id] = $creditcard;
                    break;
                case 'creditcards.billzip':
                    $returnArray[$creditcard->BillZip.'.'.$creditcard->Id] = $creditcard;
                    break;
                case 'creditcards.billcity':
                    $returnArray[$creditcard->BillCity.'.'.$creditcard->Id] = $creditcard;
                    break;
                case 'creditcards.billstate':
                    $returnArray[$creditcard->BillState.'.'.$creditcard->Id] = $creditcard;
                    break;
                case 'creditcards.billcountry':
                    $returnArray[$creditcard->BillCountry.'.'.$creditcard->Id] = $creditcard;
                    break;
                case 'creditcards.billname':
                    $returnArray[$creditcard->BillName.'.'.$creditcard->Id] = $creditcard;
                    break;
                case 'creditcards.expiration':
                    //Just use the timestamp, but make sure we're using a JDate or we'll error-out
                    if(isset($creditcard->expirationDate) && is_a($creditcard->expirationDate, 'JDate')){
                        $returnArray[$creditcard->expirationDate->toUnix().'.'.$creditcard->Id] = $creditcard;
                    } else {
                        $returnArray[$creditcard->Id] = $creditcard;
                    }
                    $keysort_function = array('JfportalModelCreditcards','sortCreditcardNumeric');
                    break;
                case 'creditcards.firstname':
                    $returnArray[$creditcard->FirstName.'.'.$creditcard->Id] = $creditcard;
                    break;
                case 'creditcards.lastname':
                    $returnArray[$creditcard->LastName.'.'.$creditcard->Id] = $creditcard;
                    break;
                case 'creditcards.nameoncard':
                    $returnArray[$creditcard->NameOnCard.'.'.$creditcard->Id] = $creditcard;
                    break;
                case 'creditcards.maestroissuenumber':
                    $returnArray[$creditcard->MaestroIssueNumber.'.'.$creditcard->Id] = $creditcard;
                    break;
                case 'creditcards.phonenumber':
                    $returnArray[$creditcard->PhoneNumber.'.'.$creditcard->Id] = $creditcard;
                    break;
                case 'creditcards.last4':
                    $returnArray[$creditcard->Last4.'.'.$creditcard->Id] = $creditcard;
                    break;
                case 'creditcards.shipfirstname':
                    $returnArray[$creditcard->ShipFirstName.'.'.$creditcard->Id] = $creditcard;
                    break;
                case 'creditcards.shiplastname':
                    $returnArray[$creditcard->ShipLastName.'.'.$creditcard->Id] = $creditcard;
                    break;
                case 'creditcards.shipname':
                    $returnArray[$creditcard->ShipName.'.'.$creditcard->Id] = $creditcard;
                    break;
                case 'creditcards.status':
                    //Use the translation strings for ordering here. Worst case scenario is that we order by the untranslated strings
                    $returnArray[JText::_('COM_JFPORTAL_VIEW_CREDITCARDS_STATUS_'.$creditcard->Status).'.'.$creditcard->Id] = $creditcard;
                    break;
                default :
                    //Something is off, order just by Id
                    $returnArray[$creditcard->Id] = $creditcard;
                    break;
            }

        }

        uksort($returnArray, $keysort_function);
        return $direction == 'asc' ? $returnArray : array_reverse($returnArray);
    }

    /**
     * Simple numeric sorting function for the creditcard prices.
     * We need to use this function as we utilize uksort, and we don't want to use inline functions (due to possible PHP version restrictions)
     * Notice that the values may end up coming in as 199.99.36 (36 being the RecurringOrder.Id), but PHP apparently has no issue with this value
     * @param Numeric $var1		The first comparison term
     * @param Numeric $var2		The second comparison term
     * @return number			1,0,-1 depending on if $var 1 is greater-than,equal-to,less-than $var2
     */
    public static function sortCreditcardNumeric($var1, $var2){
        return $var1-$var2;    //I doubt we will ever run into a PHP integer overflow
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
        return $this->total_user_creditcards;
    }


}
