<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.fieldMapping
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseFieldMapping{
    private $creator = null;    //The owner classs/plugin of this plugin, so we know who to call when we want to retrieve the values
    private $fields = array();  //The array of FieldMapElements that contains the field associations

    public function __construct($creator){
        //Sanitize the parameter
        if(empty($creator)){
            throw new Exception('FieldMapping::__construct was called with an empty parameter',1);
        }

        if(!class_exists($creator)){
            throw new Exception('FieldMapping::__construct was given a non-existent class as a parameter',2);
        }

        $this->creator = $creator;
    }

    /**
     * Enter description here ...
     * @return array:JoomfuseFieldMapElement 
     */
    public function getFields(){return $this->fields;}

    public function addField(JoomfuseFieldMapElement $element){
        $this->fields[] = $element;
    }
    
    public function getCreator(){return $this->creator;}
}
