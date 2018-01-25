<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.tableClass.invoice
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseTableProduct extends JoomfuseIFSTable {
    /**
     * Returns the Infusionsoft table name
     * @return string
     */
    public function getName(){
        return 'Product';
    }

    /**
     * Returns an array of JoomfuseAPIField elements describing the table fields
     * Last retrieved from from http://help.infusionsoft.com/developers/tables/contactgroup on May 28th 2013
     * @return array:JoomfuseAPIField
     */
    protected function declareAPIFields(){
        return array(
            new JoomfuseAPIField('Id', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
            new JoomfuseAPIField('BottomHTML', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
            new JoomfuseAPIField('CityTaxable', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
            new JoomfuseAPIField('CountryTaxable', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
            new JoomfuseAPIField('DateCreated', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE, time()),
            new JoomfuseAPIField('Description', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
            new JoomfuseAPIField('HideInStore', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
            new JoomfuseAPIField('InventoryLimit', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
            new JoomfuseAPIField('InventoryNotifiee', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
            new JoomfuseAPIField('IsPackage', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
            new JoomfuseAPIField('LargeImage', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
            new JoomfuseAPIField('LastUpdated', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE, time()),
            new JoomfuseAPIField('NeedsDigitalDelivery', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
            new JoomfuseAPIField('ProductName', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
            new JoomfuseAPIField('ProductPrice', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DOUBLE, 0),
            //new JoomfuseAPIField('Shippable	', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
            new JoomfuseAPIField('ShippingTime', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
            new JoomfuseAPIField('ShortDescription', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
            new JoomfuseAPIField('Sku', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
            new JoomfuseAPIField('StateTaxable', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
            new JoomfuseAPIField('Status', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
            new JoomfuseAPIField('Taxable', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
            new JoomfuseAPIField('TopHTML', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
            new JoomfuseAPIField('Weight', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DOUBLE, 0)
        );
    }
}