<?php
/**
 * Joomfuse Portal views
 * @package     site.com_jfportal
 * @subpackage	views.subscriptions.tmpl.default_subscription
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<div id="details_<?php echo $this->item->Id; ?>" name="details_<?php echo $this->item->Id; ?>" class="<?php echo $this->params->get('modal_classname','');?>">
	<?php if($this->params->get('show_details_ProgramName',true) && isset($this->item->CProgram) && $this->item->CProgram->ProgramName !== null) :?>
		<div class="modal-header">
			<h3><?php echo ($this->item->CProgram->ProgramName) ? $this->item->CProgram->ProgramName : JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_SUBSCRIPTION_NAME_UNKNOWN'); ?></h3>
		</div>
	<?php endif?>
	
	<?php if($this->params->get('show_details_AutoCharge',true) && $this->item->AutoCharge !== null) :?>
		<div class="row-fluid AutoCharge">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_AUTOCHARGE');?></div>
			<div class="span6"><?php echo ($this->item->AutoCharge) ? ($this->item->AutoCharge ? JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_AUTOCHARGE_YES') : JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_AUTOCHARGE_NO') ) : JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_AUTOCHARGE_UNKNOWN'); ?></div>
		</div>
	<?php endif;?>
	
	<?php if($this->params->get('show_details_BillingAmt',true) && isset($this->item->BillingAmt) && $this->item->BillingAmt !== null) :?>
		<div class="row-fluid BillingAmt">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_PRICE');?></div>
			<div class="span6"><?php echo ($this->item->BillingAmt) ? JText::sprintf('COM_JFPORTAL_VIEW_SUBSCRIPTION_PRICE_VALUE',$this->item->BillingAmt) : JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_PRICE_UNKOWN'); ?></div>
		</div>
	<?php endif;?>
	
	<?php if($this->params->get('show_details_BillingCycle',true) && isset($this->item->BillingCycle) && $this->item->BillingCycle !== null) :?>
		<div class="row-fluid BillingCycle">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_BILLING_CYCLE');?></div>
			<div class="span6">
		        <?php if($this->item->Frequency > 1):?>
			        <?php echo JText::sprintf('COM_JFPORTAL_VIEW_SUBSCRIPTION_BILLING_CYCLE_VALUE_'.$this->item->BillingCycle.'_MULTIPLE',$this->item->Frequency); ?>
		        <?php else:?>
	                <?php echo ($this->item->BillingCycle) ? JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_BILLING_CYCLE_VALUE_'.$this->item->BillingCycle) : JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_BILLING_CYCLE_UNKOWN'); ?>
	            <?php endif;?>
			</div>
		</div>
	<?php endif;?>
	
	<?php if($this->params->get('show_details_CC1',true) && isset($this->item->CC1) && $this->item->CC1 !== null) :?>
		<div class="row-fluid CC1">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_CC1');?></div>
	        <?php if(!$this->item->CC1):?>
				<div class="span6"><?php echo JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_CC1_UNKNOWN')?></div>
	        <?php else:?>
				<div class="span6">
			        <?php echo JText::sprintf('COM_JFPORTAL_VIEW_SUBSCRIPTION_CC1_VALUE_STATUS_'.$this->item->CC1->Status.'_TYPE_AND_LAST4', $this->item->CC1->CardType , $this->item->CC1->Last4, $this->item->CC1->ExpirationMonth, $this->item->CC1->ExpirationYear)?>
				</div>
	        <?php endif?>
		</div>
	   <?php endif;?>
		    <?php if($this->params->get('show_details_LastBillDate',true) && isset($this->item->LastBillDate) && $this->item->LastBillDate !== null) :?>
		<div class="row-fluid LastBillDate">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_SUBSCRIPTION_LAST_BILL_DATE');?></div>
			<div class="span6"><?php echo isset($this->item->LastBillDate) ? JHtml::date($this->item->LastBillDate, $this->item->LastBillDate_format, null) : JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_SUBSCRIPTION_LAST_BILL_DATE_UNKNOWN'); ?></div>
		</div>
	   <?php endif;?>
		    <?php if($this->params->get('show_details_MaxRetry',true) && isset($this->item->MaxRetry) && $this->item->MaxRetry !== null) :?>
		<div class="row-fluid MaxRetry">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_SUBSCRIPTION_MAX_RETRIES');?></div>
			<div class="span6"><?php echo ($this->item->MaxRetry) ? $this->item->MaxRetry : JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_SUBSCRIPTION_MAX_RETRIES_UNKOWN'); ?></div>
		</div>
	<?php endif;?>
	
	<?php if($this->params->get('show_details_NextBillDate',true) && isset($this->item->NextBillDate) && $this->item->NextBillDate !== null) :?>
		<div class="row-fluid NextBillDate">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_SUBSCRIPTION_NEXT_BILL_DATE');?></div>
			<div class="span6"><?php echo isset($this->item->NextBillDate) ? JHtml::date($this->item->NextBillDate, $this->item->NextBillDate_format, null) : JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_SUBSCRIPTION_NEXT_BILL_DATE_UNKNOWN'); ?></div>
		</div>
	<?php endif;?>
	<?php if($this->params->get('show_details_NumDaysBetweenRetry',true) && isset($this->item->NumDaysBetweenRetry) && $this->item->NumDaysBetweenRetry !== null) :?>
		<div class="row-fluid NumDaysBetweenRetry">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_SUBSCRIPTION_NUM_DAYS_BETWEEN_RETRIES');?></div>
			<div class="span6"><?php echo ($this->item->NumDaysBetweenRetry) ? $this->item->NumDaysBetweenRetry : JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_SUBSCRIPTION_NUM_DAYS_BETWEEN_RETRIES_UNKOWN'); ?></div>
		</div>
	<?php endif;?>
	<?php if($this->params->get('show_details_StartDate',true) && isset($this->item->StartDate) && $this->item->StartDate !== null) :?>
		<div class="row-fluid StartDate">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_SUBSCRIPTION_START_DATE');?></div>
			<div class="span6"><?php echo isset($this->item->StartDate) ? JHtml::date($this->item->StartDate, $this->item->StartDate_format, null) : JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_SUBSCRIPTION_START_DATE_UNKNOWN'); ?></div>
		</div>
	<?php endif;?>
	<?php if($this->params->get('show_details_EndDate',true) && isset($this->item->EndDate) && $this->item->EndDate !== null) :?>
		<div class="row-fluid StartDate">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_SUBSCRIPTION_END_DATE');?></div>
			<div class="span6"><?php echo isset($this->item->EndDate) ? JHtml::date($this->item->EndDate, $this->item->EndDate_format, null) : JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_SUBSCRIPTION_END_DATE_UNKNOWN'); ?></div>
		</div>
	<?php endif;?>
	<?php if($this->params->get('show_details_Status',true) && isset($this->item->Status) && $this->item->Status !== null) :?>
		<div class="row-fluid Status">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_STATUS');?></div>
			<div class="span6"><?php echo ($this->item->Status) ? 
	            ($this->item->Status == 'Active' ? JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_STATUS_ACTIVE') : JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_STATUS_INACTIVE') ) : 
	            JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_STATUS_UNKNOWN'); ?>
			</div>
		</div>
	<?php endif;?>
    <?php if($this->params->get('show_details_Cancel',true) && $this->item->is_editable  && $this->item->Status == JoomfuseTableRecurringOrder::STATUS_ACTIVE):?>
		<div class="">
			<form action="<?php echo JRoute::_('index.php?option=com_jfportal&view=subscriptions')?>" method="post">
				<input type="hidden" name="task" id="task" value="subscription.cancel" />
				<input type="hidden" name="cc_id" id="cc_id" value="" />
				<input type="hidden" name="return" value="<?php echo base64_encode(JRoute::_('index.php?option=com_jfportal&view=subscriptions'));?>" />
		        <?php echo JHtml::_( 'form.token' ); ?>
				<div class="row-fluid Cancel text-center">
					<button class="btn btn-danger" onclick="return confirm('<?php echo JText::sprintf('COM_JFPORTAL_VIEW_SUBSCRIPTIONS_ACTION_CANCEL_CONFIRM', $this->item->CProgram->ProgramName);?>')" name="id" value="<?php echo $this->item->Id?>"><?php echo JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTION_ACTION_CANCEL'); ?></button>
				</div>
			</form>
		</div>
	<?php endif;?>
</div>