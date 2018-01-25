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

class JoomfuseTableInvoice extends JoomfuseIFSTable {
    //PayStatus column
    const INVOICE_PAY_STATUS_UNPAID = 0;
    const INVOICE_PAY_STATUS_PAID = 1;
    const INVOICE_PAY_STATUS_UNKNOWN = -1;    //In case we missed something
    
    //CreditStatus column
    const INVOICE_CREDIT_STATUS_NONE = 0;
    const INVOICE_CREDIT_STATUS_PARTIAL = 1;
    
    //RefundStatus column
    const INVOICE_REFUND_STATUS_NONE = 0;
    const INVOICE_REFUND_STATUS_REFUNDED = 1;
    const INVOICE_REFUND_STATUS_UNKNOWN = -1;    //In case we missed something
    
    /**
     * Returns the Infusionsoft table name
     * @return string
     */
    public function getName(){
        return 'Invoice';
    }

    /**
     * Returns an array of JoomfuseAPIField elements describing the table fields
     * Last retrieved from from http://help.infusionsoft.com/developers/tables/contactgroup on May 28th 2013
     * @return array:JoomfuseAPIField
     */
    protected function declareAPIFields(){
        return array(
        new JoomfuseAPIField('Id', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('AffiliateId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('ContactId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('CreditStatus', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('DateCreated', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE, time()),
        new JoomfuseAPIField('Description', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('InvoiceTotal', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DOUBLE, 0),
        new JoomfuseAPIField('InvoiceType', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DOUBLE, 0),
        new JoomfuseAPIField('JobId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('LeadAffiliateId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('PayPlanStatus', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('PayStatus', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('ProductSold', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('PromoCode', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('RefundStatus', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('Synced', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('TotalDue', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DOUBLE, 0),
        new JoomfuseAPIField('TotalPaid', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DOUBLE, 0)
        );
    }
}