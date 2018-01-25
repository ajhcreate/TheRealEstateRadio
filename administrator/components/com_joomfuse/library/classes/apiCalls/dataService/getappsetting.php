<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.apiCalls.dataService.getAppSetting
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseApiCallGetappsetting extends JoomfuseDataService{
    private $moduleName = null;
    private $appSetting = null;

    public function __construct($apiLocation, $moduleName, $appSetting){
        parent::__construct($apiLocation);

        //Sanitize the parameters
        if(empty($moduleName) || !is_string($moduleName)){
            throw new Exception('JoomfuseApiCallGetappsetting::__construct received an non-String or empty moduleName field', 1);
        }
        if(empty($appSetting) || !is_string($appSetting)){
            throw new Exception('JoomfuseApiCallGetappsetting::__construct received an non-String or empty appSetting field', 1);
        }


        //Assign the values we need to compose the API request
        $this->moduleName = (String)$moduleName;
        $this->appSetting = (String)$appSetting;
    }

    protected function getCallName(){return 'getAppSetting';}

    protected function getCallArray($apiKey){
        return array(
        php_xmlrpc_encode($apiKey),
        php_xmlrpc_encode($this->moduleName),
        php_xmlrpc_encode($this->appSetting)
        );
    }

    protected function validateResult(xmlrpcresp $result){
        //Nothing to do here
        return true;
    }

    protected function getResultObject(xmlrpcresp $result){
        $resultValue = $result->value();
        return $resultValue ? $resultValue : '';
    }


    /* (non-PHPdoc)
     * @see JoomfuseApiCall::getLogAPIDisplayName()
     */
    protected function getLogExplain(){
        return 'Fetch the '.$this->moduleName.'/'.$this->appSetting.' app configuration';
    }

}