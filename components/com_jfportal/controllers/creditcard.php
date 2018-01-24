<?php
/**
 * Joomfuse Portal views
 * @package     site.com_jfportal
 * @subpackage	controllers.creditcard
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JfportalControllerCreditcard extends JControllerForm{
    protected $view_item = 'creditcard';
    protected $view_list = 'creditcards';
    protected $urlVar = 'Id';


    /**
     * Get the return URL.
     * @return	The URL to redirect the page to. Either the value stored in the return param or the JURI::base()
     */
    protected function getReturnURL(){
        $return = $this->input->get('return', null, 'base64');

        if (empty($return) || !JUri::isInternal(base64_decode($return)))
        {
            return JUri::base();
        }
        else
        {
            return base64_decode($return);
        }
    }


    public function deactivate(){
        //CSRF check
        JSession::checkToken() or die( 'Invalid Token' );

        //Get some basic variables
        $jinput = JFactory::getApplication()->input;
        $returnURL = $this->getReturnURL();
        $params = JFactory::getApplication()->getParams();

        //Verify that this is a registered user
        $user = JFactory::getUser();
        if($user->guest){
            $this->setRedirect($returnURL,JText::_('COM_JFPORTAL_CONTROLLER_CREDITCARD_PLEASE_LOG_IN_FIRST'),'error');
            return;
        }
        
        //Verify that creditcard deactivations are allowed
        if(!($params->get('cc_alow_deactivation',true))){
            $this->setRedirect($returnURL,JText::_('COM_JFPORTAL_CONTROLLER_CREDITCARD_DEACTIVATION_NOT_ALLOWED'),'error');
            return;
        }

        //Extract and verify the creditcard id
        $id = $jinput->getUInt('Id',0);
        if(!$id){
            $this->setRedirect($returnURL,JText::_('COM_JFPORTAL_CONTROLLER_CREDITCARD_NO_CREDITCARD_ID_DEFINED'),'error');
            return;
        }

        //Get the subscription model
        $model = $this->getModel();
        $item = $model->getItem();
        if(!$item || $model->getError()){
            $this->setRedirect($returnURL,JText::_('COM_JFPORTAL_CONTROLLER_CREDITCARD_COULD_NOT_LOCATE_THIS_CREDITCARD'),'error');
            return;
        }

        //Verify that there are no subscriptions using this Credit Card
        $contact = IFSFactory::getUserContact();
        /* @var $contact IFSContact */
        $subscriptions = $contact->getSubscriptionList(true);
        $found = false;
        foreach($subscriptions AS $subscription){
            if(isset($subscription->CC1) && $subscription->CC1 == $item->Id){
                $found = true;
                break;
            }
        }
        if($found){
            $this->setRedirect($returnURL,JText::_('COM_JFPORTAL_CONTROLLER_CREDITCARD_CREDITCARD_ASSIGNED_FOR_SUBSCRIPTION'),'error');
            return;
        }

        //Deactivate the credit card
        try{
            IFSApi::deactivateCreditCard($item->Id);
        }catch(Exception $e){
            $this->setRedirect($returnURL, JText::sprintf('COM_JFPORTAL_CONTROLLER_CREDITCARD_ERROR_WHILE_DEACTIVATING_CREDITCARD',$e->getMessage()),'error');
            return;
        }
        
        //Set the redirect and return
        $this->setRedirect($returnURL,JText::_('COM_JFPORTAL_CONTROLLER_CREDITCARD_CREDITCARDCARD_DEACTIVATED'),'success');
    }
    
    public function save($key = null, $urlVar = null){
        $model = $this->getModel();
        $redirect = JRoute::_('index.php?option=com_jfportal&view=creditcards');
        $params = JFactory::getApplication()->getParams();
        
        //Make sure that if a card is being edited, the current user is allowed to edit it
        if(JFactory::getApplication()->input->getUint('Id',0) && !$model->getItem()){
            $this->setRedirect($redirect,JText::_('COM_JFPORTAL_CONTROLLER_CREDITCARD_ACCESS_DENIED'),'error');
            return false;
        }
        
        //Make sure that adding new cards is allowed
        if(!(JFactory::getApplication()->input->getUint('Id',0)) && !($params->get('cc_alow_addition',true)) ){
            $this->setRedirect($redirect,JText::_('COM_JFPORTAL_CONTROLLER_CREDITCARD_CARD_ADDITION_NOT_ALLOWED'),'error');
            return false;
        }
        
        //Save and redirect
        try{
            $model->save();
            $this->setRedirect($redirect,JText::_('COM_JFPORTAL_CONTROLLER_CREDITCARD_CREDITCARDCARD_SUCCESSFULLY_UPDATED'),'success');
        } catch(Exception $e){
            $this->setRedirect($redirect, JText::sprintf('COM_JFPORTAL_CONTROLLER_CREDITCARD_CREDITCARDCARD_UPDATE_FAILED', $e->getMessage()),'error');
        }

    }
    

}
