<?php
/**
 * Joomfuse Portal views
 * @package     site.com_jfportal
 * @subpackage	controllers.json.creditcard
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JfportalControllerCreditcard extends JControllerForm{
    protected $view_item = 'creditcard';

    public function verifyCreditCard(){
        //@TODO-GN: RE-ENABLE FOR PROPER CHECKS
        // Check for request forgeries.
        //JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
        
        //Setup variables
        $response = new JfportalControllerCreditcardVerifyResponse();
        $app = JFactory::getApplication();
        $input = $app->input;
        $user = JFactory::getUser();
        $ifs_id = IFSFactory::getUserContact()->ifs_id;

        //Verify this is a logged in user
        if($user->guest){
            //$response->Invalidate(JText::_('COM_JFPORTAL_CONTROLLER_CREDITCARD_PLEASE_LOG_IN_FIRST'));
            //echo json_encode($response);
            echo JText::_('COM_JFPORTAL_CONTROLLER_CREDITCARD_PLEASE_LOG_IN_FIRST');
            return;
        }

        if(!$ifs_id){
            //$response->Invalidate(JText::_('COM_JFPORTAL_CONTROLLER_CREDITCARD_CONTACT_ID_NOT_FOUND'));
            //echo json_encode($response);
            echo JText::_('COM_JFPORTAL_CONTROLLER_CREDITCARD_CONTACT_ID_NOT_FOUND');
            return;
        }

        //Get/verify the credit card info
        $CardType = $input->getString('CardType',null);
        if(empty($CardType)){
            //$response->Invalidate(JText::_('COM_JFPORTAL_MODEL_CREDITCARD_CREDIT_CARD_TYPE_REQUIRED'));
            //echo json_encode($response);
            echo JText::_('COM_JFPORTAL_MODEL_CREDITCARD_CREDIT_CARD_TYPE_REQUIRED');
            return;
        }

        $CardNumber = $input->getString('CardNumber',null);
        if(empty($CardNumber)){
            //$response->Invalidate(JText::_('COM_JFPORTAL_MODEL_CREDITCARD_CREDIT_CARD_NUMBER_REQUIRED'));
            //echo json_encode($response);
            JText::_('COM_JFPORTAL_MODEL_CREDITCARD_CREDIT_CARD_NUMBER_REQUIRED');
            return;
        }

        $ExpirationMonth = $input->getString('ExpirationMonth',null);
        if(empty($ExpirationMonth)){
            //$response->Invalidate(JText::_('COM_JFPORTAL_MODEL_CREDITCARD_EXPIRATION_MONTH_REQUIRED'));
            //echo json_encode($response);
            echo JText::_('COM_JFPORTAL_MODEL_CREDITCARD_EXPIRATION_MONTH_REQUIRED');
            return;
        }

        $ExpirationYear = $input->getString('ExpirationYear',null);
        if(empty($ExpirationYear)){
            //$response->Invalidate(JText::_('COM_JFPORTAL_MODEL_CREDITCARD_EXPIRATION_YEAR_REQUIRED'));
            //echo json_encode($response);
            echo JText::_('COM_JFPORTAL_MODEL_CREDITCARD_EXPIRATION_YEAR_REQUIRED');
            return;
        }

        $CVV2 = $input->getString('CVV2',null);
        if(empty($CVV2)){
            //$response->Invalidate(JText::_('COM_JFPORTAL_MODEL_CREDITCARD_CVV2_REQUIRED'));
            //echo json_encode($response);
            echo json_encode(JText::_('COM_JFPORTAL_MODEL_CREDITCARD_CVV2_REQUIRED'));
            return;
        }
        
        //Run the verification. An exception is either an API error or a real validation error. We do not distinguish between the two
        try{
            IFSApi::validateNewCreditCard($CardType, $ifs_id, $CardNumber, $ExpirationMonth, $ExpirationYear, $CVV2);
        } catch(Exception $e){
            //$response->Invalidate($e->getMessage());
            //echo json_encode($response);
            echo $e->getMessage();
            return;
        }

        //Everything checks out
        //echo json_encode($response);
        echo 'true';
        return;
    }


}

/**
 * Class for standardized communicating through ajax.
 * The object is json_encoded and echoed to stdout
 */
class JfportalControllerCreditcardVerifyResponse{
    public $success = true;
    public $message = '';

    public function Invalidate($message){
        $this->success = false;
        $this->message=$message;
    }
}