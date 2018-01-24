<?php
/**
 * @package     site.com_jfportal
 * @subpackage  models.creditcard
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('JfportalModelCreditcards', JPATH_SITE.'/components/com_jfportal/models/creditcards.php');

/**
 * Creditcard model
 * Overrides the models creditcards and simply fetches the data of the exact subscription that we need
 * We don't really care about overfetching data: We still need exactly 3 API calls to fetch all the data.
 */
class JfportalModelCreditcard extends JfportalModelCreditcards{
    protected $_context = 'com_jfportal.creditcard';

    public function getItem(){
        $params = JFactory::getApplication()->getParams();
        if(!($pk = JFactory::getApplication()->input->getUint('Id',0))){
            //JErrorPage::render('No creditcard id defined');
        }

        //Fetch all the items. It's the same amount of API calls anyway.
        //This seems like a joomla bug. If we don't getState, the setState doesn't work for some reason
        $this->getState('list.limit');
        $this->setState('list.limit',0);
        $items = $this->getItems();

        //Return the relevant item
        foreach($items AS $item){
            if(!isset($item->Id)){continue;}    //Should never happen, but check anyways
            if($item->Id == $pk){
                return $item;
            }
        }

        //$this->setError('No such creditcard found');
        return false;
    }

    public function getCreditCardTypes(){
        $returnArray = array();

        $accepted_cards = IFSApi::getAppSetting('Order', 'optioncctypes');
        $accepted_cardArray =explode(',',$accepted_cards);

        foreach($accepted_cardArray AS $cardName){
            if(!empty($cardName)){
                $returnArray[] = $cardName;
            }
        }

        return $returnArray;
    }

    public function save(){
        // Check for request forgeries.
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
        
        $app = JFactory::getApplication();
        $input = $app->input;
        $updateFields = array();

        if(!($ifs_id = IFSFactory::getUserContact()->ifs_id)){
            throw new Exception(JText::_('COM_JFPORTAL_MODEL_CREDITCARD_CONTACT_ID_NOT_FOUND'), 1);
        }
        
        $Id = $input->getUint('Id',0);
        $isNew = ($Id == 0);
        
        //Make sure that this card exists AND it belongs to the current user (getItem() takes care of that)
        if(!$isNew && !$this->getItem()){
            throw new Exception(JText::_('COM_JFPORTAL_MODEL_CREDITCARD_CARD_NOT_FOUND'), 1);
        }

        //Fetch the required data. Remember: Field presense is optional/configurable, so don't delete things just because they aren't there
        
        if($isNew){
            $updateFields[] = new JoomfuseAPIField('ContactId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, $ifs_id);
        } else {
            $updateFields[] = new JoomfuseAPIField('Id', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, $Id);
        }

        //Fetch and verify the card type
        $CardType = $input->getString('CardType',null);
        if(!in_array($CardType, $this->getCreditCardTypes())){
            throw new Exception(JText::_('COM_JFPORTAL_MODEL_CREDITCARD_UNSUPPORTED_CREDIT_CARD_TYPE'), 1);
        }
        if($isNew && empty($CardType)){
            throw new Exception(JText::_('COM_JFPORTAL_MODEL_CREDITCARD_CREDIT_CARD_TYPE_REQUIRED'), 2);
        }
        if($CardType != null){
            $updateFields[] = new JoomfuseAPIField('CardType', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $CardType);
        }

        //Fetch and validate the card number and CVV. CardNumber only exists for new cards while CVV2 is write-only (and optional)
        $CardNumber = $isNew ? $input->getString('CardNumber',null) : null;
        $cvv_temp = $input->getString('CVV2',null);
        $CVV2 = !empty($cvv_temp) ? $cvv_temp : null;
        if($isNew && empty($CardNumber)){
            throw new Exception(JText::_('COM_JFPORTAL_MODEL_CREDITCARD_CREDIT_CARD_NUMBER_REQUIRED'), 3);
        }
        if($CardNumber != null && $isNew){
            $updateFields[] = new JoomfuseAPIField('CardNumber', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $CardNumber);
        }
        if($isNew && empty($CVV2)){
            throw new Exception(JText::_('COM_JFPORTAL_MODEL_CREDITCARD_CVV2_REQUIRED'), 3);
        }
        if(!empty($CVV2)){
            $updateFields[] = new JoomfuseAPIField('CVV2', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $CVV2);
        }

        //Fetch and validate the Credit Card expiration month/year
        $ExpirationMonth = $input->getString('ExpirationMonth',null);
        $ExpirationYear = $input->getString('ExpirationYear',null);
        if($isNew && empty($ExpirationMonth)){
            throw new Exception(JText::_('COM_JFPORTAL_MODEL_CREDITCARD_EXPIRATION_MONTH_REQUIRED'), 4);
        }
        if($isNew && empty($ExpirationYear)){
            throw new Exception(JText::_('COM_JFPORTAL_MODEL_CREDITCARD_EXPIRATION_YEAR_REQUIRED'), 5);
        }
        if($ExpirationMonth != null){
            $updateFields[] = new JoomfuseAPIField('ExpirationMonth', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $ExpirationMonth);
        }
        if($ExpirationYear != null){
            $updateFields[] = new JoomfuseAPIField('ExpirationYear', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $ExpirationYear);
        }

        //FirstName/LastName are optional
        $FirstName = $input->getString('FirstName',null);
        $LastName = $input->getString('LastName',null);
        if($FirstName != null){
            $updateFields[] = new JoomfuseAPIField('FirstName', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $FirstName);
        }
        if($LastName != null){
            $updateFields[] = new JoomfuseAPIField('LastName', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $LastName);
        }

        //NameOnCard is required for new cards
        $NameOnCard = $input->getString('NameOnCard',null);
        if($isNew && empty($NameOnCard)){
            throw new Exception(JText::_('COM_JFPORTAL_MODEL_CREDITCARD_NAME_ON_CARD_REQUIRED'), 6);
        }
        if($NameOnCard != null){
            $updateFields[] = new JoomfuseAPIField('NameOnCard', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $NameOnCard);
        }

        //Bill Addr1,zip,City,Country are required as per the IFS UI for creating CC's
        $BillAddress1 = $input->getString('BillAddress1',null);
        if($BillAddress1 != null){
            $updateFields[] = new JoomfuseAPIField('BillAddress1', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $BillAddress1);
        }
        if($isNew && empty($BillAddress1)){
            throw new Exception(JText::_('COM_JFPORTAL_MODEL_CREDITCARD_BILL_ADDRESS1_REQUIRED'), 4);
        }
        $BillZip = $input->getString('BillZip',null);
        if($BillZip != null){
            $updateFields[] = new JoomfuseAPIField('BillZip', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $BillZip);
        }
        if($isNew && empty($BillZip)){
            throw new Exception(JText::_('COM_JFPORTAL_MODEL_CREDITCARD_BILL_ZIP_REQUIRED'), 4);
        }
        $BillCity = $input->getString('BillCity',null);
        if($BillCity != null){
            $updateFields[] = new JoomfuseAPIField('BillCity', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $BillCity);
        }
        if($isNew && empty($BillCity)){
            throw new Exception(JText::_('COM_JFPORTAL_MODEL_CREDITCARD_BILL_CITY_REQUIRED'), 4);
        }
        $BillCountry = $input->getString('BillCountry',null);
        if($BillCountry != null){
            $updateFields[] = new JoomfuseAPIField('BillCountry', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $BillCountry);
        }
        if($isNew && empty($BillCountry)){
            throw new Exception(JText::_('COM_JFPORTAL_MODEL_CREDITCARD_BILL_COUNTRY_REQUIRED'), 4);
        }

        //The rest of the fields are optional
        $BillName = $input->getString('BillName',null);
        if($BillName != null){
            $updateFields[] = new JoomfuseAPIField('BillName', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $BillName);
        }
        $BillAddress2 = $input->getString('BillAddress2',null);
        if($BillAddress2 != null){
            $updateFields[] = new JoomfuseAPIField('BillAddress2', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $BillAddress2);
        }
        $BillState = $input->getString('BillState',null);
        if($BillState != null){
            $updateFields[] = new JoomfuseAPIField('BillState', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $BillState);
        }

        $PhoneNumber = $input->getString('PhoneNumber',null);
        if($PhoneNumber != null){
            $updateFields[] = new JoomfuseAPIField('PhoneNumber', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $PhoneNumber);
        }
        $MaestroIssueNumber = $input->getString('MaestroIssueNumber',null);
        if($MaestroIssueNumber != null){
            $updateFields[] = new JoomfuseAPIField('MaestroIssueNumber', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $MaestroIssueNumber);
        }
        $StartDateMonth = $input->getString('StartDateMonth',null);
        if($StartDateMonth != null){
            $updateFields[] = new JoomfuseAPIField('StartDateMonth', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $StartDateMonth);
        }
        $StartDateYear = $input->getString('StartDateYear',null);
        if($StartDateYear != null){
            $updateFields[] = new JoomfuseAPIField('StartDateYear', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $StartDateYear);
        }

        if(empty($updateFields)){
            throw new Exception(JText::_('COM_JFPORTAL_MODEL_NO_FIELDS_TO_UPDATE'), 7);
        }

        //See if we need to update or create.
        //We propagate the exception if an error occurs
        if($isNew){
            //@TODO-GN: validate first
            IFSApi::dsAdd('CreditCard', $updateFields);
        } else {
            IFSApi::dsUpdate('CreditCard', $Id, $updateFields);
        }

        //Done
        return true;
    }

}
