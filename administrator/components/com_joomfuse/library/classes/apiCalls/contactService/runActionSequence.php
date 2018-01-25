<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.apiCalls.contactService.runActionSequence
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseApiCallRunActionSequence extends JoomfuseApiCall{
    protected $contactId = null;
    protected $actionsetId = null;

    /**
     * Constructs a ContactService API call
     * @param array $api_fields
     * @throws Exception			In case the API parameters given are bad
     */
    public function __construct($apiLocation, $contactId, $actionsetId){
        parent::__construct($apiLocation);
        
        //Sanitize the parameters
        if(!is_numeric($contactId) || !intval($contactId)){
            throw new Exception('JoomfuseApiCallRunActionSequence::__construct received a non-numeric/valid $contactId: '.$contactId, 1);
        }

        if(!is_numeric($actionsetId) || !intval($actionsetId)){
            throw new Exception('JoomfuseApiCallRunActionSequence::__construct received a non-numeric/valid $actionsetId: '.$actionsetId, 2);
        }

        //Save the parameters
        $this->contactId = intval($contactId);
        $this->actionsetId = intval($actionsetId);
    }

    //Concrete implementation for JoomfuseApiCall->getServiceName()
    protected function getServiceName(){return 'ContactService';}

    //Concrete implementation for JoomfuseApiCall->getServiceName()
    protected function getCallName(){return 'runActionSequence';}

    protected function getCallArray($apiKey){
        return array(
        php_xmlrpc_encode($apiKey),
        php_xmlrpc_encode($this->contactId),
        php_xmlrpc_encode($this->actionsetId)
        );
    }

    protected function checkParameters(){
        //Make sure there is no infusionsoft id set
        return true;
    }

    protected function validateResult(xmlrpcresp $result){
        //If the API said ok, we can't really argue with it... (nothing to check for)
        return true;
    }

    protected function getResultObject(xmlrpcresp $result){
        return $result->value();
    }
}