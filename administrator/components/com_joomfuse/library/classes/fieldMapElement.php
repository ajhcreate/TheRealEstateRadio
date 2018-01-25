<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.fieldMapElement
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseFieldMapElement{
    private $name = null;            //The human-readable name of this field
    private $joomlaField = null;     //The joomla field name/id
    private $ifsField = null;        //the Infusionsoft field name (remember that custom fields start with an underscore)
    private $fieldType = null;

    const IFS_FIELD_TYPE_STRING = 1;
    const IFS_FIELD_TYPE_INT = 2;
    const IFS_FIELD_TYPE_DATE = 3;
    const IFS_FIELD_TYPE_DOUBLE = 4;

    public function __construct($name, $joomlaField, $ifsField, $ifsFieldType){
        //Sanitize the parameters
        if(empty($name) || empty($joomlaField) || empty($ifsField) || empty($ifsFieldType)){
            throw new Exception('FieldMapElement::__construct received an empty parameter', 1);
        }

        //Make sure we received the correct $ifsFieldType type
        if(($ifsFieldType !== self::IFS_FIELD_TYPE_STRING)
        && ($ifsFieldType !== self::IFS_FIELD_TYPE_INT)
        && ($ifsFieldType !== self::IFS_FIELD_TYPE_DATE)
        ){
            throw new Exception('JoomfuseFieldMapElement::__construct received received an ifsFieldType parameter of an incorrect value: '.$ifsFieldType, 2);
        }

        //Assign the values
        $this->name = $name;
        $this->joomlaField = $joomlaField;
        $this->ifsField = $ifsField;
        $this->fieldType = $ifsFieldType;
    }

    public function getAPIField($value){
        return new JoomfuseAPIField($this->ifsField, $this->fieldType, $value);
    }

    public function getName(){return $this->name;}
    public function getJoomlaField(){return $this->joomlaField;}
    public function getIFSField(){return $this->ifsField;}

    /**
     * Translate the given Joomla-sourced value to an appropriate format for the given value.
     * Pretty rudimentary translation. We only look for dates and cast them to timestamps
     * @param mixed $value		The value to translate
     * @param number $type		The type as defined in the consts of JoomfuseFieldMapElement
     * @return mixed			The translated value
     */
    public static function castJoomlaValueToInfusionsoft($value, $type){
        //Default cast is to String
        $result = (String) $value;

        //TODO-GN: WARNING: we supress the strtotime php warnings/stricts here. This is not a bright idea
        switch($type){
            //If the type is date, try to cast it to a timestamp. If it fails, set the null value
            case self::IFS_FIELD_TYPE_DATE:
                $tmp = @strtotime($value);
                $result = $tmp ? $tmp : NULL;
                break;
        }

        return $result;
    }
    
    /**
     * Translate the given IFS-sourced value to an appropriate format for the given value.
     * Pretty rudimentary translation. We only look for dates and cast them to SQL dates, no timezones
     * @param mixed $value		The value to translate
     * @param number $type		The type as defined in the consts of JoomfuseFieldMapElement
     * @return mixed			The translated value
     */
    public static function castInfusionsoftValueToJoomla($value, $type){
        //Default cast is to String
        $result = (String) $value;

        //TODO-GN: WARNING: we supress the strtotime php warnings/stricts here. This is not a bright idea
        switch($type){
            //If the type is date, try to cast it to a timestamp. If it fails, just use the string value
            case self::IFS_FIELD_TYPE_DATE:
                $tmp = @strtotime($value);
                $result = $tmp ? date("Y-m-d H:i:s",$tmp) : $result;
                break;
        }

        return $result;
    }
    
    
}