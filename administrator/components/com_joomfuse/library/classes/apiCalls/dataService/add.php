<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.apiCalls.dataService.add
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseApiCallAdd extends JoomfuseDataService{

    private $table = null;
    private $updateFields = array();

    public function __construct($apiLocation, $table, array $updateFields){
        parent::__construct($apiLocation);
        
        //Sanitize the parameters
        foreach($updateFields AS $field){
            if(!is_a($field, 'JoomfuseAPIField')){
                throw new Exception('JoomfuseApiCallAdd::__construct received a non-JoomfuseAPIField as an update field', 2);
            }
        }
        if(empty($updateFields)){
            throw new Exception('JoomfuseApiCallAdd::__construct received an empty set of update fields', 2);
        }

        //Assign the values we need to compose the API request
        $this->table = $table;
        foreach ($updateFields AS $field){
            /* @var $field JoomfuseAPIField */
            $this->updateFields[$field->getFieldName()] = $field->getAPIValue(true);
        }
    }

    protected function getCallName(){return 'add';}

    protected function getCallArray($apiKey){
        return array(
        php_xmlrpc_encode($apiKey),
        php_xmlrpc_encode($this->table),
        php_xmlrpc_encode($this->updateFields, array('auto_dates'))
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
        return 'Create a row in '.$this->table .' with values ('.implode(',', array_keys($this->updateFields)).') with values ('.implode(',', $this->updateFields).')';
    }

}