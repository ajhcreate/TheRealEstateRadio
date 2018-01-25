<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.tableClass.contact
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseTableContact extends JoomfuseIFSTable {
    /**
     * Returns the Infusionsoft table name
     * @return string
     */
    public function getName(){
        return 'Contact';
    }

    /**
     * Returns an array of JoomfuseAPIField elements describing the table fields
     * Last retrieved from from http://help.infusionsoft.com/developers/tables/contactgroup on May 28th 2013
     * @return array:JoomfuseAPIField
     */
    protected function declareAPIFields(){
        return array(
        new JoomfuseAPIField('Id', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('Address1Type', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Address2Street1', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Address2Street2', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Address2Type', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Address3Street1', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Address3Street2', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Address3Type', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Anniversary', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE, time()),
        new JoomfuseAPIField('AssistantName', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('AssistantPhone', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('BillingInformation', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Birthday', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE, time()),
        new JoomfuseAPIField('City', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('City2', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('City3', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Company', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('AccountId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('CompanyID', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('ContactNotes', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('ContactType', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Country', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Country2', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Country3', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('CreatedBy', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('DateCreated', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE, time()),
        new JoomfuseAPIField('Email', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('EmailAddress2', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('EmailAddress3', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Fax1', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Fax1Type', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Fax2', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Fax2Type', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('FirstName', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Groups', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('JobTitle', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('LastName', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('LastUpdated', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE, time()),
        new JoomfuseAPIField('LastUpdatedBy', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('Leadsource', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('LeadSourceId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('MiddleName', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Nickname', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('OwnerID', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('Password', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Phone1', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Phone1Ext', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Phone1Type', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Phone2', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Phone2Ext', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Phone2Type', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Phone3', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Phone3Ext', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Phone3Type', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Phone4', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Phone4Ext', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Phone4Type', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Phone5', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Phone5Ext', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Phone5Type', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('PostalCode', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('PostalCode2', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('PostalCode3', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('ReferralCode', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('SpouseName', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('State', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('State2', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('State3', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('StreetAddress1', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('StreetAddress2', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Suffix', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Title', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Username', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Validated', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Website', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('ZipFour1', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('ZipFour2', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('ZipFour3', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, '')
        );
    }
}