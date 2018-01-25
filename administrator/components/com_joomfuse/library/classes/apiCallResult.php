<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.apiCallResult
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseApiCallResult{
    private $wasSuccess = false;
    private $apiFunctionName = false;
    private $apiErrorMessage = 'invalid JoomfuseApiCallResult constructor';
    private $apiErrorCode = 0;
    private $result = false;    //The result object, if this was a call that returns some data. Each implementation returns it's own class
    
    
    public function __construct($success, $apiFunctionName, $apiErrorMessage='', $apiErrorCode=0){
        $this->wasSuccess = (bool) $success;
        $this->apiErrorMessage = $apiErrorMessage;
        $this->apiErrorCode = $apiErrorCode;
        $this->apiFunctionName = $apiFunctionName;
    }
    
    public function wasSuccess(){
        return $this->wasSuccess;
    }
    
    public function getAPIErrorMessage(){
        return $this->apiErrorMessage;
    }
    
    public function getAPIErrorCode(){
        return $this->apiErrorCode;
    }
    
    public function assignResult($result){
        $this->result = $result;
    }
    
    public function getResult(){return $this->result;}
}