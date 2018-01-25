<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.apiCalls.funnelService.achieveGoal
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseApiCallAchieveGoal extends JoomfuseFunnelService{
    private $integration;
    private $callName;
    private $contactId;

    /**
     * Simple constructor with all the require API call parameters
     * @param String $apiLocation	The API location
     * @param String $email			The email to be opted-in
     * @param String $reason		(Optional) The reason for the opt-in
     */
    public function __construct($apiLocation, $contactId,  $callName, $integration){
        parent::__construct($apiLocation);

        //Assign the values we need to compose the API request
        $this->contactId = (int)$contactId;
        if(!$this->contactId){
            throw new Exception('JoomfuseApiCallAchieveGoal::__construct received an invalid/empty contactId', 1);
        }
        
        //Default integration name is 'JoomFuse'
        if(!$integration){
            $integration = 'JoomFuse';
        }

        $this->callName = (String)$callName;
        if(!$this->callName){
            throw new Exception('JoomfuseApiCallAchieveGoal::__construct received an invalid/empty callName', 2);
        }

        $this->integration = (String)$integration;
        if(!$this->integration){
            throw new Exception('JoomfuseApiCallAchieveGoal::__construct received an invalid/empty integration', 3);
        }


    }

    protected function getCallName(){
        return 'achieveGoal';
    }

    protected function getCallArray($apiKey){
        return array(
        php_xmlrpc_encode($apiKey),
        php_xmlrpc_encode($this->integration),
        php_xmlrpc_encode($this->callName),
        php_xmlrpc_encode($this->contactId)
        );
    }

    protected function getResultObject(xmlrpcresp $result){
        return $result->value();
    }

    protected function validateResult(xmlrpcresp $result){
        //Nothing to do here
        return true;
    }


}
