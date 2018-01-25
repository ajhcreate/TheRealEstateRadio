<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.ifsTable
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

//Load all the class implementations
JLoader::register('JoomfuseTableContactGroup', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/tableClasses/contactGroup.php');
JLoader::register('JoomfuseTableContact', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/tableClasses/contact.php');
JLoader::register('JoomfuseTableContactGroupCategory', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/tableClasses/contactGroupCategory.php');
JLoader::register('JoomfuseTableContactGroupAssign', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/tableClasses/contactGroupAssign.php');
JLoader::register('JoomfuseTableDataFormField', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/tableClasses/dataFormField.php');
JLoader::register('JoomfuseTableDataFormGroup', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/tableClasses/dataFormGroup.php');
JLoader::register('JoomfuseTableDataFormTab', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/tableClasses/dataFormTab.php');
JLoader::register('JoomfuseTableActionSequence', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/tableClasses/actionSequence.php');
JLoader::register('JoomfuseTableCProgram', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/tableClasses/cProgram.php');
JLoader::register('JoomfuseTableSubscriptionPlan', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/tableClasses/subscriptionPlan.php');
JLoader::register('JoomfuseTableRecurringOrder', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/tableClasses/recurringOrder.php');
JLoader::register('JoomfuseTableCreditcard', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/tableClasses/creditCard.php');
JLoader::register('JoomfuseTableInvoice', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/tableClasses/invoice.php');
JLoader::register('JoomfuseTableJob', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/tableClasses/job.php');
JLoader::register('JoomfuseTableProduct', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/tableClasses/product.php');



abstract class JoomfuseIFSTable{
    protected $api_fields = null;

    public function __construct(){
        $this->setAPIFields();
    }

    /**
     * Returns the Infusionsoft table name
     * @return string
     */
    abstract public function getName();

    /**
     * Returns an array of JoomfuseAPIField elements describing the table fields
     * @return array:JoomfuseAPIField
     */
    abstract protected function declareAPIFields();

    public function getAPIFields(){
        return $this->api_fields;
    }

    private function setAPIFields(){
        //Fetch the api fields from the concrete implementation
        $api_fields = $this->declareAPIFields();
        foreach($api_fields AS $field){
            if(!is_a($field, 'JoomfuseAPIField')){
                throw new Exception('JoomfuseIFSTable::setAPIFields received a non-JoomfuseAPIField from class '.__CLASS__, 1);
            }
        }

        $this->api_fields = $api_fields;
    }
}