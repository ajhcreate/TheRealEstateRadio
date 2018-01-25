<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.apiCalls.invoiceService
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

//Include all contact service implementations
class_exists('JoomfuseApiCallValidateNewCreditCard') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCalls/invoiceService/validateNewCreditCard.php';
class_exists('JoomfuseApiCallChargeInvoice') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCalls/invoiceService/chargeInvoice.php';


abstract class JoomfuseInvoiceService extends JoomfuseApiCall{

    //Concrete implementation for JoomfuseApiCall->getServiceName()
    protected function getServiceName(){return 'InvoiceService';}
}