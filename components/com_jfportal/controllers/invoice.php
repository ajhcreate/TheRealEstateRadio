<?php
/**
 * Joomfuse Portal views
 * @package     site.com_jfportal
 * @subpackage	controllers.invoice
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JfportalControllerInvoice extends JControllerForm{
    protected $view_item = 'invoice';
    protected $view_list = 'invoices';
    protected $urlVar = 'Id';


    /**
     * Get the return URL.
     * @return	The URL to redirect the page to. Either the value stored in the return param or the JURI::base()
     */
    protected function getReturnURL(){
        $return = $this->input->get('return', null, 'base64');

        if (empty($return) || !JUri::isInternal(base64_decode($return)))
        {
            return JRoute::_('index.php?option=com_jfportal&view=invoices');
        }
        else
        {
            return base64_decode($return);
        }
    }


    public function pay(){
        //CSRF check
        JSession::checkToken() or die( 'Invalid Token' );

        //Get some basic variables
        $jinput = JFactory::getApplication()->input;
        $returnURL = $this->getReturnURL();
        $params = JFactory::getApplication()->getParams();

        //Verify that this is a registered user
        $user = JFactory::getUser();
        if($user->guest){
            $this->setRedirect($returnURL,JText::_('COM_JFPORTAL_CONTROLLER_INVOICE_PLEASE_LOG_IN_FIRST'),'error');
            return;
        }

        //Extract and verify the invoice id
        $id = $jinput->getUInt('id',0);
        if(!$id){
            $this->setRedirect($returnURL,JText::_('COM_JFPORTAL_CONTROLLER_INVOICE_NO_INVOICE_ID_DEFINED'),'error');
            return;
        }

        //Extract and verify the creditcard id
        $cc_id = $jinput->getUInt('cc_id',0);
        if(!$id){
            $this->setRedirect($returnURL,JText::_('COM_JFPORTAL_CONTROLLER_INVOICE_NO_CREDITCARD_ID_DEFINED'),'error');
            return;
        }

        //Extract and verify the merchant Id
        $merchantId = $params->get('merchant_id');
        if(!$merchantId){
            $this->setRedirect($returnURL,JText::_('COM_JFPORTAL_CONTROLLER_INVOICE_NO_MERCHANT_ID_DEFINED'),'error');
            return;
        }

        //Get the invoice model and make sure the invoice is owned by this user
        $model = $this->getModel();
        $item = $model->getItem();
        if(!$item || $model->getError()){
            $this->setRedirect($returnURL,JText::_('COM_JFPORTAL_CONTROLLER_INVOICE_COULD_NOT_LOCATE_INVOICE'),'error');
            return;
        }

        //Verify that the credit card is owned by this user
        $creditCards = $model->getCreditCards();
        $found = false;
        foreach($creditCards AS $creditCard){
            if($creditCard->Id == $cc_id){
                $found = true;
                break;
            }
        }
        if(!$found){
            $this->setRedirect($returnURL,JText::_('COM_JFPORTAL_CONTROLLER_INVOICE_DEFINED_CREDITCARD_NOT_OWNED'),'error');
            return;
        }

        //Charge the invoice
        try{
            //@TODO: Set notes ands bypassComissions via a config?
            IFSApi::chargeInvoice($id, 'via JoomFuse', $cc_id, $merchantId, false);
            JFactory::getApplication()->enqueueMessage(JText::_('COM_JFPORTAL_CONTROLLER_INVOICE_INVOICE_PAID'),'success');
        }catch(Exception $e){
            $this->setRedirect($returnURL, JText::sprintf('COM_JFPORTAL_CONTROLLER_INVOICE_ERROR_WHILE_PAYING',$e->getMessage()),'error');
            return;
        }
        
        //See if this invoice has a subscription and the actionsets/goals, if any
        $subscriptionsModel = $this->getModel('Subscriptions');
        $subscriptions = $subscriptionsModel->getItems();
        if($subscriptions && ($subscription = $this->getSubscriptionFromJobId($item->JobId, $subscriptions))){
        	$contact = IFSFactory::getUserContact();
        	if($subscription->invoice_paid_actionset && !$contact->runActionSet($subscription->invoice_paid_actionset, true)){
        		$this->setRedirect($returnURL);
        		return;
        	}
        	if($subscription->invoice_paid_goal && !$contact->achieveGoal($subscription->invoice_paid_goal, '', true)){
        		$this->setRedirect($returnURL);
        		return;
        	}
        
        	//See if this invoices' subscription has any other unpaid invoices
        	$hasUnpaidRelatedInvoices = $this->hasUnpaidRelatedInvoices($item);
        	if(!$hasUnpaidRelatedInvoices && $subscription->all_invoices_paid_actionset && !$contact->runActionSet($subscription->all_invoices_paid_actionset, true)){
        		$this->setRedirect($returnURL);
        		return;
        	}
        	if(!$hasUnpaidRelatedInvoices && $subscription->all_invoices_paid_goal && !$contact->achieveGoal($subscription->all_invoices_paid_goal, '', true)){
        		$this->setRedirect($returnURL);
        		return;
        	}
        
        }

        //Done. Use the default redirect. The success message is already added by the respective code
        $this->setRedirect($returnURL);
    }

    /**
     * See if the given invoice of a subscription has any other unpaid invoices
     * @param stdClass $invoice				The invoice object as returned from the model invoice->getItem()
     * @return boolean|Number				False if no unpaid invoices found or the invoice id of the first unpaid invoice
     */
    protected function hasUnpaidRelatedInvoices($invoice){   
        //Fetch the list of invoices and subscriptions for this user
        $model = $this->getModel();
        $invoices = $model->getItems();
        $subscriptionsModel = $this->getModel('Subscriptions');
        $subscriptions = $subscriptionsModel->getItems();
        
        //Retrieve the subscription we need to check for
        if(!($subscription = $this->getSubscriptionFromJobId($invoice->JobId, $subscriptions))){
            return false;
        }
        
        if(!($subId = $subscription->Id)){
            return false;
        }
        
        //Go through each invoice this user has and see if it's unpaid and matches the currenct subscription we're looking for
        foreach($invoices AS $item){
            if($item->Id == $invoice->Id){continue;}    //Do not consider the invoice we're about to pay
            if(isset($item->PayStatus) && $item->PayStatus == JoomfuseTableInvoice::INVOICE_PAY_STATUS_UNPAID){
                $sub = $this->getSubscriptionFromJobId($item->JobId, $subscriptions);
                if($sub && $sub->Id == $subId){
                    return $item->Id;
                }
            }
        }
        
        //Nothing found
        return false;
    }

    protected function getSubscriptionFromJobId($jobId, $subscriptions){
        //Make sure we have a real job Id and a subscripton list
        if(!$jobId || !$subscriptions){
            return false;
        }

        //Check the subscription list for an OriginatingOrderId that matches the JobId we're looking for
        foreach($subscriptions AS $subscription){
            if(isset($subscription->Id) && isset($subscription->OriginatingOrderId) && $subscription->OriginatingOrderId == $jobId){
                return $subscription->Id;
            }
        }

        //Even if we didn't find an OriginatingOrderId, that doesn't mean there isn't such a job that points to us (RecurringOrder.Id) with Job.JobRecurringId
        //Fetch all the jobs for this contact and look through each one
        $contact = IFSFactory::getUserContact();

        //See if we can find an Id match with a Job.RecurringId value
        $job=$contact->getJob($jobId, true);
        if($job && isset($job->JobRecurringId) && $job->JobRecurringId){
            //Found a Job.JobRecurringId, now locate the entry in the given subscription list
            foreach($subscriptions AS $subscription){
                if($subscription->Id == $job->JobRecurringId){
                    return $subscription;
                }
            }
        }

        //Nothing found
        return false;
    }

    protected function getSubscriptionMaps($params){
        $subscription_maps = $params->get('subscription_maps',array());


    }

}
