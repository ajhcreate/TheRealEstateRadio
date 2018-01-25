<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.tableClass.dataFormGroup
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseTableDataFormGroup extends JoomfuseIFSTable {
    /**
     * Returns the Infusionsoft table name
     * @return string
     */
    public function getName(){
        return 'DataFormGroup';
    }

    /**
     * Returns an array of JoomfuseAPIField elements describing the table fields
     * Last retrieved from from http://help.infusionsoft.com/developers/tables/DataFormGroup on May 19th 2014
     * @return array:JoomfuseAPIField
     */
    protected function declareAPIFields(){
        return array(
        new JoomfuseAPIField('Id', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('TabId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('Name', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, '')
        );
    }
}