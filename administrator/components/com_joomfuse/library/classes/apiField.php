<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.apiField
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseAPIField{
    private $ifsFieldName = null;
    private $ifsFieldType = null;
    private $ifsFieldValue = null;
    
    public function __construct($ifsFieldName, $ifsFieldType, $ifsFieldValue){
        //Sanitize the parameters. Field value is allowed to be empty
        if(empty($ifsFieldName) || empty($ifsFieldType)){
            throw new Exception('JoomfuseAPIField::__construct received an empty parameter', 1);
        }
        
        
        
        //Save the values
        $this->ifsFieldName = $ifsFieldName;
        $this->ifsFieldType = $ifsFieldType;
        $this->ifsFieldValue = $ifsFieldValue;
    }
    
    public function getValue(){return $this->ifsFieldValue;}
    
    public function getType(){return $this->ifsFieldType;}
    
    public function getAPIValue($ignoreWildcards=false){
        //Cast to string for string types. Also remove any wildcard characters which may open doors to exploits
        if($this->ifsFieldType == JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING){
            if(!$ignoreWildcards){
                return str_replace(array('%','*'), '', ''.$this->ifsFieldValue);
            } else {
                return ''.$this->ifsFieldValue;
            }
        }
        
        //Cast to int for int types
        if($this->ifsFieldType == JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT){
            return (int) $this->ifsFieldValue;
        }
        
        //Cast to double for double types
        if($this->ifsFieldType == JoomfuseFieldMapElement::IFS_FIELD_TYPE_DOUBLE){
            return (double) $this->ifsFieldValue;
        }
        
        //If we're dealing with dates (timestamps), return a properly formatted string
        if($this->ifsFieldType == JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE){
            return $this->ifsFieldValue ? date('Ymd\TH:i:s',$this->ifsFieldValue) : '-null-';
        }
    }
    
    public function getFieldName(){return $this->ifsFieldName;}
    
}