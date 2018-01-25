<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.tableClass.dataFormField
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseTableDataFormField extends JoomfuseIFSTable {
    //Infusionsoft Field Types
    //WARNING: adding new const values here means that we must also update the JFormFieldJoomfuseifsfield with the new entries
    const DataFormFieldValue_DataType_PhoneNumber = 1;
    const DataFormFieldValue_DataType_SocialSecurityNumber  = 2;
    const DataFormFieldValue_DataType_Currency = 3;
    const DataFormFieldValue_DataType_Percent = 4;
    const DataFormFieldValue_DataType_State = 5;
    const DataFormFieldValue_DataType_YesNo = 6;
    const DataFormFieldValue_DataType_Year = 7;
    const DataFormFieldValue_DataType_Month = 8;
    const DataFormFieldValue_DataType_DayofWeek = 9;
    const DataFormFieldValue_DataType_Name = 10;
    const DataFormFieldValue_DataType_DecimalNumber = 11;
    const DataFormFieldValue_DataType_WholeNumber = 12;
    const DataFormFieldValue_DataType_Date = 13;
    const DataFormFieldValue_DataType_DateTime = 14;
    const DataFormFieldValue_DataType_Text = 15;
    const DataFormFieldValue_DataType_TextArea = 16;
    const DataFormFieldValue_DataType_ListBox = 17;
    const DataFormFieldValue_DataType_Website = 18;
    const DataFormFieldValue_DataType_Email = 19;
    const DataFormFieldValue_DataType_Radio = 20;
    const DataFormFieldValue_DataType_Dropdown = 21;
    const DataFormFieldValue_DataType_User = 22;
    const DataFormFieldValue_DataType_Drilldown = 23;
    
    //Fixed Infusionsoft Form Id's
    const DataFormFieldValue_FormId_Contact = -1;
    const DataFormFieldValue_FormId_ReferralPartner = -3;
    const DataFormFieldValue_FormId_Opportunity = -4;
    const DataFormFieldValue_FormId_TaskNoteApt = -5;
    const DataFormFieldValue_FormId_Company = -6;
    const DataFormFieldValue_FormId_Order = -9;
    
    /**
     * Returns the Infusionsoft table name
     * @return string
     */
    public function getName(){
        return 'DataFormField';
    }

    /**
     * Returns an array of JoomfuseAPIField elements describing the table fields
     * Last retrieved from from http://help.infusionsoft.com/developers/tables/DataFormField on May 16h 2014
     * @return array:JoomfuseAPIField
     */
    protected function declareAPIFields(){
        return array(
        new JoomfuseAPIField('DataType', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('Id', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('FormId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('GroupId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('Name', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Label', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('DefaultValue', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Values', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('ListRows', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0)
        );
    }
    
    /**
     * Translates the IFS field types (from this table) to the appropriate JoomfuseFieldMapElement type
     * Pretty crude translation at the moment, Everything is a string except for date/time
     * @param number $dataType		The dataType as defined from the JoomfuseTableDataFormField consts
     * @return number				The JoomfuseFieldMapElement const field type
     */
    public static function translateDataTypeToFieldType($dataType){
        $type = JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING;
        switch($dataType){
            case self::DataFormFieldValue_DataType_Date:
            case self::DataFormFieldValue_DataType_DateTime:
                $type = JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE;
                break;
        }
        
        return $type;
    }
}