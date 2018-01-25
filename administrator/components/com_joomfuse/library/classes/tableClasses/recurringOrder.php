<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.tableClass.recurringOrderWithContact
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseTableRecurringOrder extends JoomfuseIFSTable {
    /**
     * Returns the Infusionsoft table name
     * @return string
     */
    public function getName(){
        return 'RecurringOrder';
    }
    
    //'State' known values
    const STATUS_ACTIVE = 'Active';
    const STATUS_INACTIVE = 'Inactive';
    
    //'BillingCycle' known values
    const CYCLE_UNKNOWN = 0;
    const CYCLE_DAILY = 6;
    const CYCLE_WEEKLY = 3;
    const CYCLE_MONTHLY = 2;
    const CYCLE_YEARLY = 1;

    /**
     * Returns an array of JoomfuseAPIField elements describing the table fields
     * Last retrieved from from http://help.infusionsoft.com/developers/tables/DataFormTab on May 19th 2014
     * @return array:JoomfuseAPIField
     */
    protected function declareAPIFields(){
        return array(
        new JoomfuseAPIField('Id', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('AffiliateId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('AutoCharge', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('BillingAmt', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DOUBLE, 0),
        new JoomfuseAPIField('BillingCycle', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('CC1', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('CC2', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('ContactId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('EndDate', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE, false),
        new JoomfuseAPIField('Frequency', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('LastBillDate', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE, false),
        new JoomfuseAPIField('LeadAffiliateId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),      
        new JoomfuseAPIField('MaxRetry', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('MerchantAccountId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('NextBillDate', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE, false),  
        new JoomfuseAPIField('NumDaysBetweenRetry', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('OriginatingOrderId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('PaidThruDate', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE, false),       
        new JoomfuseAPIField('ProductId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('ProgramId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),       
        new JoomfuseAPIField('PromoCode', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('Qty', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('ReasonStopped', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('ShippingOptionId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0),
        new JoomfuseAPIField('StartDate', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE, false),  
        new JoomfuseAPIField('Status', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, ''),
        new JoomfuseAPIField('SubscriptionPlanId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, 0)
        );
    }
}