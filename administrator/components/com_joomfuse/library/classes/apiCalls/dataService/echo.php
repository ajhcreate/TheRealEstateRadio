<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.apiCalls.dataService.echo
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseApiCallEcho extends JoomfuseDataService{
    private $echoString = 'Joomfuse';

    //Concrete implementation for JoomfuseApiCall->getServiceName()
    protected function getCallName(){return 'echo';}

    protected function getCallArray($apiKey){
        return array(php_xmlrpc_encode($this->echoString));
    }
    
    protected function validateResult(xmlrpcresp $result){
        if($result->value() != $this->echoString){
            throw new Exception('Echo service did not receive the same string as a reply. Sent: "'.$this->echoString.'" and received "'.$result->value().'"', 1);
        }
        
        return true;
    }
    
    /* (non-PHPdoc)
     * @see JoomfuseApiCall::execute()
     */
    public function execute($apiKey=''){
        //The echo service does not require an API key.
        return parent::execute($apiKey);
    }
    
    protected function getResultObject(xmlrpcresp $result){
        return $result->value();
    }
}