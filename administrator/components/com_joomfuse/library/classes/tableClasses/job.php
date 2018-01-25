<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.tableClass.job
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseTableJob extends JoomfuseIFSTable {
    
    /**
     * Returns the Infusionsoft table name
     * @return string
     */
    public function getName(){
        return 'Job';
    }

    /**
     * Returns an array of JoomfuseAPIField elements describing the table fields
     * Last retrieved from from http://help.infusionsoft.com/developers/tables/contactgroup on May 28th 2013
     * @return array:JoomfuseAPIField
     */
    protected function declareAPIFields(){
        return array(
        new JoomfuseAPIField('Id', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('ContactId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('DateCreated', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE, time()),
        new JoomfuseAPIField('DueDate', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE, time()),
        new JoomfuseAPIField('JobNotes', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('JobRecurringId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('JobStatus', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('JobTitle', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('OrderStatus', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('OrderType', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('ProductId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('ShipCity', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('ShipCompany', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('ShipCountry', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('ShipFirstName', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('ShipLastName', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('ShipMiddleName', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('ShipPhone', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('ShipState', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('ShipStreet1', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('ShipStreet2', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('ShipZip', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('StartDate', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE, time())
        );
    }
}