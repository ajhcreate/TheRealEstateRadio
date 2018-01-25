<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.tableClass.contactGroupAssign
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseTableContactGroupAssign extends JoomfuseIFSTable {
    
    /**
     * Returns the Infusionsoft table name
     * @return string
     */
    public function getName(){
        return 'ContactGroupAssign';
    }
    
    /**
     * Returns an array of JoomfuseAPIField elements describing the table fields
     * Last retrieved from from http://help.infusionsoft.com/developers/tables/contactgroup on May 28th 2013
     * @return array:JoomfuseAPIField 
     */
    protected function declareAPIFields(){
        //@TODO-GN: We also have the joined Contact.* fields available. Do we use these?
        return array(
            new JoomfuseAPIField('GroupId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
            new JoomfuseAPIField('ContactGroup', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
            new JoomfuseAPIField('DateCreated', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE, time()),
            new JoomfuseAPIField('ContactId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0)
        );
    }

}