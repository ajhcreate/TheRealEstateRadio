<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.apiCalls.invoiceService.chargeInvoice
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseApiCallChargeInvoice extends JoomfuseInvoiceService{
    private $invoiceId = null;
    private $notes = null;
    private $cardId = null;
    private $merchantId = null;
    private $bypassComissions = null;

    public function __construct($apiLocation, $invoiceID, $notes, $creditCardID, $merchantAccountID, $bypassComissions){
        parent::__construct($apiLocation);

        //Assign the values we need to compose the API request
        $this->invoiceId = (int)$invoiceID;
        if(!$this->invoiceId){
            throw new Exception('JoomfuseApiCallChargeInvoice::__construct received an invalid/empty invoiceID', 1);
        }

        //Even an empty string is allowed
        $this->notes = (String)$notes;

        $this->cardId = (int)$creditCardID;
        if(!$this->cardId){
            throw new Exception('JoomfuseApiCallChargeInvoice::__construct received an invalid/empty card Id: ', 2);
        }

        $this->merchantId = (int)$merchantAccountID;
        if(!$this->merchantId){
            throw new Exception('JoomfuseApiCallChargeInvoice::__construct received an invalid/empty merchant Id', 2);
        }

        $this->bypassComissions = $bypassComissions ? true : false;
    }

    protected function getCallName(){return 'chargeInvoice';}

    protected function getCallArray($apiKey){
        return array(
        php_xmlrpc_encode($apiKey),
        php_xmlrpc_encode((int)$this->invoiceId),
        php_xmlrpc_encode((String)$this->notes),
        php_xmlrpc_encode((int)$this->cardId),
        php_xmlrpc_encode((int)$this->merchantId),
        php_xmlrpc_encode((bool)$this->bypassComissions)
        );
    }

    protected function validateResult(xmlrpcresp $result){
        if(!isset($result->val)){
            throw new Exception('chargeInvoice received no val to check',1);
        }
        
        if(!isset($result->val['Successful'])){
            throw new Exception('chargeInvoice received a val without the Successful val to check',2);
        }
        
        if(!$result->val['Successful']){
            $message = (isset($result->val['Message']) && $result->val['Message']) ? $result->val['Message'] : 'Unknown chargeInvoice API call validation error';
            throw new Exception($message,3);
        }
        
        return true;
    }

    protected function getResultObject(xmlrpcresp $result){
        return $result->value();
    }


    /* (non-PHPdoc)
     * @see JoomfuseApiCall::getLogAPIDisplayName()
     */
    protected function getLogExplain(){
        return 'Charging Invoice Id '.$this->invoiceId.' with card Id '.$this->cardId;
    }

}