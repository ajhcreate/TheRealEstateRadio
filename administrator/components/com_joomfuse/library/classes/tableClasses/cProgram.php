<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.tableClass.cProgram
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseTableCProgram extends JoomfuseIFSTable {
    
    /**
     * Returns the Infusionsoft table name
     * @return string
     */
    public function getName(){
        return 'CProgram';
    }
    
    /**
     * Returns an array of JoomfuseAPIField elements describing the table fields
     * Last retrieved from from http://help.infusionsoft.com/developers/tables/contactgroup on May 28th 2013
     * @return array:JoomfuseAPIField 
     */
    protected function declareAPIFields(){
        return array(
            new JoomfuseAPIField('Id', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
            new JoomfuseAPIField('Active', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
            new JoomfuseAPIField('BillingType', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, 0),
            new JoomfuseAPIField('DefaultCycle', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, 0),
            new JoomfuseAPIField('DefaultFrequency', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
            new JoomfuseAPIField('DefaultPrice', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
            new JoomfuseAPIField('Description', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, 0),
            new JoomfuseAPIField('Family', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, 0),
            new JoomfuseAPIField('HideInStore', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
            //new JoomfuseAPIField('LargeImage', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, 0),
            new JoomfuseAPIField('ProductId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
            new JoomfuseAPIField('ProgramName', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, 0),
            new JoomfuseAPIField('ShortDescription', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, 0),
            new JoomfuseAPIField('Sku', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, 0),
            new JoomfuseAPIField('Status', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
            new JoomfuseAPIField('Taxable', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0)
        );
    }

}