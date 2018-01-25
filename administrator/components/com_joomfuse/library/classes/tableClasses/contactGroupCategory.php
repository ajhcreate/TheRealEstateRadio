<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.tableClass.contactGroupCategory
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseTableContactGroupCategory extends JoomfuseIFSTable {
    
    /**
     * Returns the Infusionsoft table name
     * @return string
     */
    public function getName(){
        return 'ContactGroupCategory';
    }
    
    /**
     * Returns an array of JoomfuseAPIField elements describing the table fields
     * Last retrieved from from http://help.infusionsoft.com/developers/tables/contactgroup on May 28th 2013
     * @return array:JoomfuseAPIField 
     */
    protected function declareAPIFields(){
        return array(
            new JoomfuseAPIField('Id', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
            new JoomfuseAPIField('CategoryName', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
            new JoomfuseAPIField('CategoryDescription', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0)
        );
    }

}