<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.apiCalls.invoiceService.validateCreditCard
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseApiCallValidateNewCreditCard extends JoomfuseInvoiceService{

    private $cardType = null;
    private $contactId = null;
    private $cardNumber = null;
    private $expirationMonth = null;
    private $expirationYear = null;
    private $cvv2 = null;

    public function __construct($apiLocation, $cardType, $contactId, $cardNumber, $expirationMonth, $expirationYear, $cvv2){
        parent::__construct($apiLocation);

        //Assign the values we need to compose the API request
        $this->cardType = (String)$cardType;
        if(!$this->cardType){
            throw new Exception('JoomfuseApiCallValidateNewCreditCard::__construct received an invalid/empty Card Type', 1);
        }

        $this->contactId = (int)$contactId;
        if(!$this->contactId){
            throw new Exception('JoomfuseApiCallValidateNewCreditCard::__construct received an invalid/empty Contact Id: '.$contactId, 2);
        }

        $this->cardNumber = (String)$cardNumber;
        if(!$this->cardNumber){
            throw new Exception('JoomfuseApiCallValidateNewCreditCard::__construct received an invalid/empty card Number: ', 2);
        }

        $this->expirationMonth = (String)$expirationMonth;
        if(!$this->expirationMonth){
            throw new Exception('JoomfuseApiCallValidateNewCreditCard::__construct received an invalid/empty Expiration Month', 2);
        }

        $this->expirationYear = (String)$expirationYear;
        if(!$this->expirationYear){
            throw new Exception('JoomfuseApiCallValidateNewCreditCard::__construct received an invalid/empty Expiration Year', 2);
        }

        $this->cvv2 = (String)$cvv2;
        if(!$this->cvv2){
            throw new Exception('JoomfuseApiCallValidateNewCreditCard::__construct received an invalid/empty CVV2', 2);
        }
    }

    protected function getCallName(){return 'validateCreditCard';}

    protected function getCallArray($apiKey){
        return array(
        php_xmlrpc_encode($apiKey),
        php_xmlrpc_encode(array(
            'CardType' => $this->cardType,
            'ContactId' => $this->contactId,
            'CardNumber' => $this->cardNumber,
            'ExpirationMonth' => $this->expirationMonth,
            'ExpirationYear' => $this->expirationYear,
            'CVV' => $this->cvv2
            ))
        );
    }

    protected function validateResult(xmlrpcresp $result){
        //Nothing to do here
        return true;
    }

    protected function getResultObject(xmlrpcresp $result){
        return $result->value();
    }


    /* (non-PHPdoc)
     * @see JoomfuseApiCall::getLogAPIDisplayName()
     */
    protected function getLogExplain(){
        return 'Validating Credit Card for Contact Id'.$this->contactId.'. Card details redacted.';
    }

}