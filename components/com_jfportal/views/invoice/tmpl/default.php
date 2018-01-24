<?php
/**
 * Joomfuse Portal views
 * @package     site.com_jfportal
 * @subpackage	views.invoice.tmpl.default
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

//Required js libs
JHtml::_('bootstrap.framework');
JHtml::_('formbehavior.chosen','select');

?>
<div class="modal-body <?php echo $this->item->classname;?>">

	<div class="row-fluid Description">
		<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICE_DESCRIPTION');?>:</div>
		<div class="span6"><?php echo ($this->item->Description); ?></div>
	</div>
	
	<?php if($this->params->get('show_PayStatus',true)):?>
		<div class="row-fluid PayStatus">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICE_PAY_STATUS');?>:</div>
			<div class="span6"><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICE_PAY_STATUS_'.$this->item->PayStatus); ?></div>
		</div>
	<?php endif;?>
	
	<?php if($this->params->get('show_details_CreditStatus',true)):?>
		<div class="row-fluid CreditStatus">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICE_CREDIT_STATUS');?>:</div>
			<div class="span6"><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICE_CREDIT_STATUS_'.$this->item->CreditStatus); ?></div>
		</div>
	<?php endif;?>
	
	<?php if($this->params->get('show_details_DateCreated',true)):?>
		<div class="row-fluid DateCreated">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICE_DATE_CREATED');?>:</div>
			<div class="span6"><?php echo (isset($this->item->DateCreated) && $this->item->DateCreated) ? JHtml::date($this->item->DateCreated, $this->item->DateCreated_format, null) : JText::_('COM_JFPORTAL_VIEW_INVOICE_DATE_CREATED_UNKNOWN'); ?></div>
		</div>
	<?php endif;?>
	
	<?php if($this->params->get('show_details_InvoiceTotal',true)):?>
		<div class="row-fluid InvoiceTotal">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICE_TOTAL');?>:</div>
			<div class="span6"><?php echo $this->item->InvoiceTotal !== false ? '$'.$this->item->InvoiceTotal : JText::_('COM_JFPORTAL_VIEW_INVOICE_TOTAL_UNKNOWN') ; ?></div>
		</div>
	<?php endif;?>
	
	<?php if($this->params->get('show_details_InvoiceType',false)):?>
		<div class="row-fluid InvoiceType">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICE_TYPE');?>:</div>
			<div class="span6"><?php echo $this->item->InvoiceType ? $this->item->InvoiceType : JText::_('COM_JFPORTAL_VIEW_INVOICE_TYPE_UNKOWN') ; ?></div>
		</div>
	<?php endif;?>
	
	<?php if($this->params->get('show_details_ProductSold',false)):?>
		<div class="row-fluid ProductSold">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_PRODUCT_SOLD');?>:</div>
			<div class="span6"><?php echo (isset($this->item->ProductSoldNames) && !empty($this->item->ProductSoldNames)) ? implode('<br/>',$this->item->ProductSoldNames) : JText::_('COM_JFPORTAL_VIEW_PRODUCT_SOLD_UNKOWN') ; ?></div>
		</div>
	<?php endif;?>
	
	<?php if($this->params->get('show_details_PromoCode',false)):?>
		<div class="row-fluid PromoCode">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_PROMO_CODE');?>:</div>
			<div class="span6"><?php echo $this->item->PromoCode ? $this->item->PromoCode : JText::_('COM_JFPORTAL_VIEW_PROMO_CODE_UNKNOWN'); ?></div>
		</div>
	<?php endif;?>
	
	<?php if($this->params->get('show_details_RefundStatus',true)):?>
		<div class="row-fluid RefundStatus">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_REFUND_STATUS');?>:</div>
			<div class="span6"><?php echo JText::_('COM_JFPORTAL_VIEW_REFUND_STATUS_'.$this->item->RefundStatus); ?></div>
		</div>
	<?php endif;?>
	
	<?php if($this->params->get('show_details_TotalDue',false)):?>
		<div class="row-fluid TotalDue">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_TOTAL_DUE');?>:</div>
			<div class="span6"><?php echo $this->item->TotalDue ? '$'.$this->item->TotalDue : JText::_('COM_JFPORTAL_VIEW_TOTAL_DUE_UNKOWN') ; ?></div>
		</div>
	<?php endif;?>
	
	<?php if($this->params->get('show_details_TotalPaid',true)):?>
		<div class="row-fluid TotalPaid">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_TOTAL_PAID');?>:</div>
			<div class="span6"><?php echo $this->item->TotalPaid ? '$'.$this->item->TotalPaid : JText::_('COM_JFPORTAL_VIEW_TOTAL_PAID_UNKOWN') ; ?></div>
		</div>
	<?php endif;?>
	
	
	<?php if($this->params->get('show_details_actions',true) && isset($this->item->PayStatus) && $this->item->PayStatus == JoomfuseTableInvoice::INVOICE_PAY_STATUS_UNPAID ):?>
	    <?php if(!count($this->creditCards)):?>
	    	<p><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICE_PAY_NO_CREDITCARD_FOUND'); ?></p>
	    <?php else:?>
			<form action="<?php echo JRoute::_('index.php?option=com_jfportal&view=invoices')?>" method="post" class="form-inline text-center">
				<input type="hidden" name="task" id="task" value="invoice.pay" />
				<input type="hidden" name="cc_id" id="cc_id" value="" />
				<input type="hidden" name="return" value="<?php echo base64_encode(JRoute::_('index.php?option=com_jfportal&view=invoices'));?>" />
		        <?php echo JHtml::_( 'form.token' ); ?>
		        <button class="btn btn-danger control-label" onclick="return confirm('<?php echo JText::_('COM_JFPORTAL_VIEW_INVOICE_PAY_CONFIRM');?>')" name="id" value="<?php echo $this->item->Id?>"><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICE_PAY'); ?></button>
		        <select name="cc_id" class="paymentCC">
				    <?php foreach($this->creditCards AS $creditCard):?>
						<option value="<?php echo $creditCard->Id?>"><?php echo $creditCard->CardType?> <?php echo $creditCard->Last4?></option>
					<?php endforeach;?>
				</select>
			</form>
	    <?php endif;?>
	<?php endif;?>
	
</div>
<?php //var_dump($this->item); ?>