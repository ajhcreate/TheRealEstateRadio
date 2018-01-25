<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.apiCalls.dataService.findByField
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseApiCallFindByField extends JoomfuseDataService{

    private $table = null;
    private $apiFieldName; /* @var $apiField JoomfuseAPIField */
    private $apiFieldValue;
    private $returnFields = array();

    public function __construct($apiLocation, $table, JoomfuseAPIField $apiField, array $returnFields, $ignoreEscapeChars = false){
        parent::__construct($apiLocation);

        //Sanitize the parameters
        foreach($returnFields AS $field){
            if(!is_a($field, 'JoomfuseAPIField')){
                throw new Exception('JoomfuseApiCallFindByField::__construct received a non-JoomfuseAPIField as a return field', 1);
            }
        }

        //Assign the values we need to compose the API request
        $this->table = $table;
        $this->apiFieldName = $apiField->getFieldName();
        $this->apiFieldValue = $apiField->getValue($ignoreEscapeChars);
        foreach ($returnFields AS $field){
            /* @var $field JoomfuseAPIField */
            $this->returnFields[] = $field->getFieldName();
        }
    }

    protected function getCallName(){return 'findByField';}

    protected function getCallArray($apiKey){
        return array(
        php_xmlrpc_encode($apiKey),
        php_xmlrpc_encode($this->table),
        php_xmlrpc_encode((int)$this->limit),
        php_xmlrpc_encode((int)$this->page),
        php_xmlrpc_encode($this->apiFieldName),
        php_xmlrpc_encode($this->apiFieldValue),
        php_xmlrpc_encode($this->returnFields)
        );
    }

    protected function validateResult(xmlrpcresp $result){
        //Nothing to do here
        return true;
    }

    protected function getResultObject(xmlrpcresp $result){
        $returnArray = array();
        
        if(!is_array($result->value())){
            return $returnArray;
        }
        
        //Extract all the requested values from the result array
        foreach($result->value() AS $val){
            $obj = new stdClass();
            foreach($this->returnFields AS $field){
                //Infusionsoft does not return empty fields when they exist but have no content
                if(isset($val[$field])){
                    $obj->$field = $val[$field];
                }
            }
            $returnArray[] = $obj;
        }
        
        return $returnArray;
    }
    

    /* (non-PHPdoc)
     * @see JoomfuseApiCall::getLogAPIDisplayName()
     */
    protected function getLogExplain(){
        return 'Fetch '.$this->limit .' (page: '.$this->page.') entries from '.$this->table .' where '.$this->apiFieldName.' is '.$this->apiFieldValue. '(return fields:'.implode(', ',$this->returnFields).')';
    }

}