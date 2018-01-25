<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.apiCalls.contactService.updateContact
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseApiCallUpdateContact extends JoomfuseContactService{
    private $is_id;

    public function __construct($apiLocation, $api_fields, $is_id){
        parent::__construct($apiLocation, $api_fields);

        //Sanitize the is_id
        $id = intval($is_id);
        if(!$id){
            throw new Exception('JoomfuseApiCallUpdateContact::__construct did not receive a valid id: '.$is_id, 1);
        }

        $this->is_id = intval($is_id);
    }

    //Concrete implementation for JoomfuseApiCall->getServiceName()
    protected function getCallName(){return 'update';}

    protected function checkParameters(){
        //We have no special requirements since we have a custom constructor with the is_id
        return true;
    }

    protected function validateResult(xmlrpcresp $result){
        //@TODO-GN: at least check that the id matches
        return true;
    }

    protected function getResultObject(xmlrpcresp $result){
        //@TODO-GN: We should probably put is_id in here
        return true;
    }

    protected function getCallArray($apiKey){
        //Get the ContactService callArray
        $returnArray = parent::getCallArray($apiKey);

        //Inject the contactId in the call array, since we need an extra parameter for this API call
        $part1 = array(array_shift($returnArray));
        $returnArray = array_merge($part1,array(php_xmlrpc_encode((int)$this->is_id)), $returnArray);

        return $returnArray;
    }

    /* (non-PHPdoc)
     * @see JoomfuseApiCall::getLogExplain()
    
    protected function getLogExplain(){
        return 'Update contactid '.$this->is_id.' with contact fields: '.implode(', ', $this->call_params_fields);
    }
     */

}