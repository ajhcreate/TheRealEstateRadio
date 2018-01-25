<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.tableClass.SubscriptionPlan
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseTableSubscriptionPlan extends JoomfuseIFSTable {
    
    /**
     * Returns the Infusionsoft table name
     * @return string
     */
    public function getName(){
        return 'SubscriptionPlan';
    }
    
    /**
     * Returns an array of JoomfuseAPIField elements describing the table fields
     * Last retrieved from from https://developer.infusionsoft.com/docs/table-schema/ on Jule 5th 2017
     * @return array:JoomfuseAPIField 
     */
    protected function declareAPIFields(){
        return array(
            new JoomfuseAPIField('Id', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        	new JoomfuseAPIField('Active', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        	new JoomfuseAPIField('Cycle', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, 0),
        	new JoomfuseAPIField('Frequency', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        	new JoomfuseAPIField('NumberOfCycles', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        	new JoomfuseAPIField('PlanPrice', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DOUBLE, 0),
        	new JoomfuseAPIField('PreAuthorizeAmount', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DOUBLE, 0),
        	new JoomfuseAPIField('ProductId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        	new JoomfuseAPIField('Prorate', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0)
        );
    }

}