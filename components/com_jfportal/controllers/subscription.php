<?php
/**
 * Joomfuse Portal views
 * @package     site.com_jfportal
 * @subpackage	controllers.subscription
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JfportalControllerSubscription extends JControllerForm{
    protected $view_item = 'subscription';
    protected $view_list = 'subscriptions';
    protected $urlVar = 'id';


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

    public function changeCC(){
        //CSRF check
        JSession::checkToken() or die( 'Invalid Token' );

        //Get some basic variables
        $jinput = JFactory::getApplication()->input;
        $returnURL = $this->getReturnURL();

        //Verify that this is a registered user
        $user = JFactory::getUser();
        if($user->guest){
            $this->setRedirect($returnURL,JText::_('COM_JFPORTAL_CONTROLLER_SUBSCRIPTION_PLEASE_LOG_IN_FIRST'),'error');
            return;
        }

        //Extract and verify the CC/subscription id's
        $id = $jinput->getUInt('id',0);
        $cc_id = $jinput->getUint('cc_id',0);
        if(!$id){
            $this->setRedirect($returnURL,JText::_('COM_JFPORTAL_CONTROLLER_SUBSCRIPTION_NO_SUBSCRIPTION_ID_DEFINED'),'error');
            return;
        }
        if(!$cc_id){
            $this->setRedirect($returnURL,JText::_('COM_JFPORTAL_CONTROLLER_SUBSCRIPTION_NO_CC_ID_DEFINED'),'error');
            return;
        }

        //Get the subscription model
        $model = $this->getModel();
        $item = $model->getItem();
        if(!$item || $model->getError()){
            $this->setRedirect($returnURL,JText::_('COM_JFPORTAL_CONTROLLER_SUBSCRIPTION_COULD_NOT_LOCATE_THIS_SUBSCRIPTION'),'error');
            return;
        }

        //Attempt to update the row
        try{
            $updateField = new JoomfuseAPIField('CC1', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $cc_id);
            IFSApi::dsUpdate('RecurringOrder', $id, array($updateField));
        } catch(Exception $e){
            $this->setRedirect($returnURL,JText::_($e->getMessage()),'error');
            return;
        }

        //Set the redirect and return
        $this->setRedirect($returnURL,JText::_('COM_JFPORTAL_CONTROLLER_SUBSCRIPTION_CC_CHANGED'),'success');
    }


    public function cancel(){
        //CSRF check
        JSession::checkToken() or die( 'Invalid Token' );

        //Get some basic variables
        $jinput = JFactory::getApplication()->input;
        $returnURL = $this->getReturnURL();

        //Verify that this is a registered user
        $user = JFactory::getUser();
        if($user->guest){
            $this->setRedirect($returnURL,JText::_('COM_JFPORTAL_CONTROLLER_SUBSCRIPTION_PLEASE_LOG_IN_FIRST'),'error');
            return false;
        }

        //Extract and verify the subscription id
        $id = $jinput->getUInt('id',0);

        if(!$id){
            $this->setRedirect($returnURL,JText::_('COM_JFPORTAL_CONTROLLER_SUBSCRIPTION_NO_SUBSCRIPTION_ID_DEFINED'),'error');
            return false;
        }

        //Get the subscription model
        $model = $this->getModel();
        $model->getState();
        $item = $model->getItem();
        if(!$item || $model->getError()){
            $this->setRedirect($returnURL,JText::_('COM_JFPORTAL_CONTROLLER_SUBSCRIPTION_COULD_NOT_LOCATE_THIS_SUBSCRIPTION'),'error');
            return false;
        }

        //Verify that this subscription is cancel-able
        if(!$item->is_editable){
            $this->setRedirect($returnURL,JText::_('COM_JFPORTAL_CONTROLLER_SUBSCRIPTION_CANNOT_CANCEL_THIS_SUBSCRIPTION'),'error');
            return false;
        }

        //Trigger the actionset/goals, if any
        $contact = IFSFactory::getUserContact();
        if($item->subscription_cancel_actionset && !$contact->runActionSet($item->subscription_cancel_actionset, true)){
            $this->setRedirect($returnURL);
            return true;
        }
        if($item->subscription_cancel_goal && !$contact->achieveGoal($item->subscription_cancel_goal, '', true)){
            $this->setRedirect($returnURL);
            return true;
        }

        //Schedule the actionset/goals of subscription end via the jfportal plugin
        $now = JFactory::getDate();
        $endDate = JFactory::getDate();
        if(!$this->subscriptionHasUnpaidInvoices($item->Id)){
            //If the subscription has NO unpaid invoices, then we schedule any 'subscription complete' actionsets/goals at the NextBillDate
            $endDate = $item->NextBillDate ? $item->NextBillDate : JFactory::getDate();
        }
        
        if($item->subscription_cancel_complete_actionset){
            //If the endDate is in the past, execute now
            if($endDate->toUnix() <= $now->toUnix()){
                if(!$contact->runActionSet($item->subscription_cancel_complete_actionset, true)){
                    $this->setRedirect($returnURL);
                    return true;
                }
            } else {
                $params = new JRegistry;
                $params->set('actionsetId', $item->subscription_cancel_complete_actionset);
                $params->set('contactId', $contact->ifs_id );
                IFSFactory::scheduleCron($endDate, 'plgJoomfuseJfportal', $params);
            }
        }
        if($item->subscription_cancel_complete_goal){
            //If the endDate is in the past, execute now
            if($endDate->toUnix() <= $now->toUnix()){
                if(!$contact->achieveGoal($item->subscription_cancel_complete_goal, '', true)){
                    $this->setRedirect($returnURL);
                    return true;
                }
            } else {
                $params = new JRegistry;
                //@TODO-GN: Duplicate code for generating the integration name. Maybe we should move things into contact->
                //Extrapolate a callname/integration from a composite callName.Integration naming scheme
                $callName = $item->subscription_cancel_complete_goal;
                $integration = 'JoomFuse';
                if(strpos($callName, '.') !== false){
                    $callNameArray = explode('.', $callName);
                    if(isset($callNameArray[0])){
                        $integration = $callNameArray[0];
                    }
                    if(isset($callNameArray[1])){
                        $callName = $callNameArray[1];
                    }
                }

                $params->set('goalIntegration', $integration);
                $params->set('goalName', $callName);
                $params->set('contactId', $contact->ifs_id );
                IFSFactory::scheduleCron($endDate, 'plgJoomfuseJfportal', $params);
            }
        }


        //Cancel the subscription. Note that we set the table EndDate to now() in EST (IFS timezone)
        try{
            IFSApi::cancelSubscription($item->Id, JFactory::getDate('now', new DateTimeZone('America/New_York')), 'User request via JoomFuse Portal');
        } catch(Exception $e){
            JFactory::getApplication()->enqueueMessage($e->getMessage(),'error');
            $this->setRedirect($returnURL);
            return true;
        }

        //Set the redirect and return
        $this->setRedirect($returnURL,JText::_('COM_JFPORTAL_CONTROLLER_SUBSCRIPTION_SUBSCRIPTION_IS_BEING_CANCELLED'),'success');
        return true;
    }

    /**
     * Checks whether the given recurringOrder has any unpaid invoices
     * @param Numeric $recurringOrderId		The RecurringOrder.Id
     * @return boolean						True if there's an unpaid invoice, false if otherwise
     */
    protected function subscriptionHasUnpaidInvoices($recurringOrderId){
        //Check for empty recurringOrderId. Just in case...
        if(!$recurringOrderId){
            return false;
        }

        $contact = IFSFactory::getUserContact();


        //Find the job for this RecurringOrder
        if(!($jobList = $contact->getJobs(true))){
            return false;
        }

        $jobId = false;
        foreach($jobList AS $job){
            if(!isset($job->JobRecurringId) || !$job->JobRecurringId){
                continue;
            }

            if($job->JobRecurringId == $recurringOrderId){
                $jobId = $job->Id;
                break;
            }
        }

        if(!$jobId){
            return false;
        }

        //Find the invoices for this jobId and see whether we can find an unpaid one
        if(!($invoicesList = $contact->getInvoices(true))){
            return false;
        }
        
        foreach($invoicesList AS $invoice){
            if(isset($invoice->JobId) && ($invoice->JobId == $jobId) && isset($invoice->PayStatus) && $invoice->PayStatus == JoomfuseTableInvoice::INVOICE_PAY_STATUS_UNPAID ){
                return true;
            }
        }
        
        //Nothing found
        return false;
    }

}
