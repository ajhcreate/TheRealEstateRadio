<?php
/**
 * Joomfuse Portal views
 * @package     site.com_jfportal
 * @subpackage	views.invoices.tmpl.default
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

//jQuery.chosen for the select elements
JHTML::_('behavior.framework');
JHtml::_('bootstrap.framework');
JHtml::_('formbehavior.chosen','.chosen-select');
JHtml::_('behavior.modal');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

//@TODO-GN: Sorting by TotalDue seems to incorrectly sort some entries

?>

<!-- Standard table ordering javascript from com_users -->
<script type="text/javascript">
	Joomla.orderTable = function()
	{
		table = document.getElementById("sortTable");
		direction = document.getElementById("filter_order_Dir");
		order = table.options[table.selectedIndex].value;
		if (order != '<?php echo $listOrder; ?>')
		{
			dirn = 'asc';
		}
		else
		{
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
	}

	jQuery(document).ready(function(e){
		jQuery('.pay_invoice').click(function(){
			cardId = jQuery(this).siblings('.paymentCC').val();
			if(!cardId){
				alert('Could not locate the selected Credit Card');
				e.preventDefault();
				return false;
			}

			jQuery('#cc_id').val(cardId);
			jQuery('#task').val('invoice.pay');
		});
	});
</script>

<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post" name="adminForm" id="adminForm" class="form-inline">
	<fieldset class="filters btn-toolbar clearfix">
		<div class="row-fluid">
		<?php if ($this->params->get('show_filters',true)) :?>
			<?php if( $this->params->get('show_filters',true) && $this->params->get('show_PayStatus',true)):?>
			 		<select name="filter_status" id="filter_status" class="chosen-select pull-left input-medium" onchange="this.form.submit();">
			 			<option value="0"><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICES_FILTER_STATUS')?></option>
			 	    	<option value="1" <?php echo $this->state->get('filter.status') == 1 ? 'selected="selected"':''?> ><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICES_FILTER_STATUS_PAID')?></option>
			 	    	<option value="-1"<?php echo $this->state->get('filter.status') == -1 ? 'selected="selected"':''?> ><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICES_FILTER_STATUS_UNPAID')?></option>
			 		</select>
			<?php endif;?>
			
			<?php if( $this->params->get('show_filters',true) && $this->params->get('show_CreditStatus',false)):?>
			 		<select name="filter_creditstatus" id="filter_creditstatus" class="chosen-select pull-left input-medium" onchange="this.form.submit();">
			 			<option value="0"><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICES_FILTER_CREDIT_STATUS')?></option>
			 	    	<option value="1" <?php echo $this->state->get('filter.creditstatus') == 1 ? 'selected="selected"':''?> ><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICES_FILTER_CREDIT_STATUS_PARTIAL')?></option>
			 	    	<option value="-1"<?php echo $this->state->get('filter.creditstatus') == -1 ? 'selected="selected"':''?> ><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICES_FILTER_CREDIT_STATUS_NONE')?></option>
			 		</select>
			<?php endif;?>
			
			<?php if($this->params->get('show_filters',true) && $this->params->get('show_RefundStatus',true)):?>
			 		<select name="filter_refundstatus" id="filter_refundstatus" class="chosen-select pull-left input-medium" onchange="this.form.submit();">
			 			<option value="0"><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICES_FILTER_REFUND_STATUS')?></option>
			 	    	<option value="1" <?php echo $this->state->get('filter.refundstatus') == 1 ? 'selected="selected"':''?> ><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICES_FILTER_REFUND_STATUS_YES')?></option>
			 	    	<option value="-1"<?php echo $this->state->get('filter.refundstatus') == -1 ? 'selected="selected"':''?> ><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICES_FILTER_REFUND_STATUS_NO')?></option>
			 		</select>
			<?php endif;?>
			
		<?php endif; ?>
		
		<?php if ($this->params->get('show_pagination_limit',true)) : ?>
			<div class="btn-group input-mini pull-right">
				<label for="limit" class="element-invisible">
					<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
				</label>
				<?php echo $this->pagination->getLimitBox(); ?>
			</div>
		<?php endif; ?>
		</div> <!-- end of .row-fluid -->

		<input type="hidden" name="filter_order" value="" />
		<input type="hidden" name="filter_order_Dir" id="filter_order_Dir" value="<?php echo $listOrder;?>" />
		<input type="hidden" name="limitstart" value="" />
		<input type="hidden" name="task" id="task" value="" />
		<!-- <input type="hidden" name="id" id="id" value="" /> -->
		<input type="hidden" name="cc_id" id="cc_id" value="" />
		<input type="hidden" name="return" value="<?php echo base64_encode(JUri::getInstance()->toString());?>" />
		<?php echo JHtml::_( 'form.token' ); ?>
	</fieldset>
	
	
    <?php if(!count($this->items)):?>
		<h2><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICES_YOU_HAVE_NO_INVOICES'); ?></h2>
    <?php endif;?>
	
	<table id="jf_invoices_table" class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th id="jf_invoices_table_header_description"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_INVOICES_TABLE_HEADER_DESCRIPTION', 'invoices.Description', $listDirn, $listOrder); ?></th>
				<?php if($this->params->get('show_PayStatus',true)):?>
					<th id="jf_invoices_table_header_pay_status"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_INVOICES_TABLE_HEADER_PAY_STATUS', 'invoices.PayStatus', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_CreditStatus',false)):?>
					<th id="jf_invoices_table_header_credit_status"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_INVOICES_TABLE_HEADER_CREDIT_STATUS', 'invoices.CreditStatus', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_DateCreated',true)):?>
					<th id="jf_invoices_table_header_date_created"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_INVOICES_TABLE_HEADER_DATE_CREATED', 'invoices.DateCreated', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_InvoiceTotal',true)):?>
					<th id="jf_invoices_table_header_invoice_total"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_INVOICES_TABLE_HEADER_INVOICE_TOTAL', 'invoices.InvoiceTotal', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_InvoiceType',false)):?>
					<th id="jf_invoices_table_header_invoice_type"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_INVOICES_TABLE_HEADER_INVOICE_TYPE', 'invoices.InvoiceType', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_ProductSold',false)):?>
					<th id="jf_invoices_table_header_product_sold"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_INVOICES_TABLE_HEADER_PRODUCT_SOLD', 'invoices.ProductSold', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_PromoCode',false)):?>
					<th id="jf_invoices_table_header_promo_code"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_INVOICES_TABLE_HEADER_PROMO_CODE', 'invoices.PromoCode', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_RefundStatus',true)):?>
					<th id="jf_invoices_table_header_refund_status"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_INVOICES_TABLE_HEADER_REFUND_STATUS', 'invoices.RefundStatus', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				
				<?php if($this->params->get('show_how_TotalDue',false)):?>
					<th id="jf_invoices_table_header_total_due"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_INVOICES_TABLE_HEADER_TOTAL_DUE', 'invoices.TotalDue', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				
				<?php if($this->params->get('show_TotalPaid',false)):?>
					<th id="jf_invoices_table_header_total_paid"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_INVOICES_TABLE_HEADER_TOTAL_PAID', 'invoices.TotalPaid', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				
				<?php if($this->params->get('show_actions',true)):?>
					<th id="jf_subs_table_header_action"><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICES_TABLE_HEADER_ACTIONS'); ?></th>
				<?php endif;?>
			</tr>
		</thead>
		<tbody>
			<?php foreach($this->items AS $i=>$item):?>
				<tr class="cat-list-row<?php echo $i % 2; ?> <?php echo ($item->PayStatus == JoomfuseTableInvoice::INVOICE_PAY_STATUS_PAID) ? '' : 'error'; ?>" >
			    
			    	<!-- The invoice item name -->
					<td headers="categorylist_header_title" class="list-title">
						<?php if ($this->params->get('show_details',1)) :?>
							<?php if ($this->params->get('show_details',1) == 1) :    //Modal details?>
								<a href="#details_<?php echo $item->Id; ?>"  class="modal" rel="{size: {x: <?php echo $this->params->get('modal_width',400)?>, y: <?php echo $this->params->get('modal_height',400)?>}, closable: true}"><?php echo isset($item->Description) && $item->Description ? $item->Description : JText::_('COM_JFPORTAL_VIEW_INVOICES_TABLE_DESCRIPTION_NO_VALUE'); ?></a>
							<?php else: //Normal-link details?>
								<a href="<?php echo JRoute::_('index.php?option=com_jfportal&view=invoice&&id='.$item->Id)?>"><?php echo isset($item->Description) && $item->Description ? $item->Description : JText::_('COM_JFPORTAL_VIEW_INVOICES_TABLE_DESCRIPTION_NO_VALUE'); ?></a>
							<?php endif;?>
						<?php else:?>
								<span><?php echo isset($item->Description) && $item->Description ? $item->Description : JText::_('COM_JFPORTAL_VIEW_INVOICES_TABLE_DESCRIPTION_NO_VALUE'); ?></span>
						<?php endif;?>
					</td>
					
					<?php if($this->params->get('show_PayStatus',true)):?>
						<!-- Payment Status -->
						<td><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICES_TABLE_HEADER_PAY_STATUS_'.$item->PayStatus); ?></td>
					<?php endif; ?>
					
					<?php if($this->params->get('show_CreditStatus',false)):?>
						<!-- Credit Status -->
						<td><?php echo (isset($item->CreditStatus) && $item->CreditStatus == JoomfuseTableInvoice::INVOICE_CREDIT_STATUS_PARTIAL) ? JText::_('COM_JFPORTAL_VIEW_INVOICES_TABLE_CREDIT_STATUS_PARTIAL') : JText::_('COM_JFPORTAL_VIEW_INVOICES_TABLE_CREDIT_STATUS_NONE'); ?></td>
					<?php endif;?>
					
					<?php if($this->params->get('show_DateCreated',true)):?>
						<!-- Invoice Creation Date -->
						<td><?php echo (isset($item->DateCreated) && $item->DateCreated) ? JHtml::date($item->DateCreated, $item->DateCreated_format, null) : JText::_('COM_JFPORTAL_VIEW_INVOICES_TABLE_DATE_CREATED_NONE'); ?></td>
					<?php endif; ?>
					
					<?php if($this->params->get('show_InvoiceTotal',true)):?>
						<!-- Invoice Total -->
						<td><?php echo (isset($item->InvoiceTotal) && is_numeric($item->InvoiceTotal))? '$'.$item->InvoiceTotal : JText::_('COM_JFPORTAL_VIEW_INVOICES_TABLE_HEADER_INVOICE_TOTAL_NONE'); ?></td>
					<?php endif; ?>
					
					<?php if($this->params->get('show_InvoiceType',false)):?>
						<!-- Invoice Type -->
						<td><?php echo (isset($item->InvoiceType) && !empty($item->InvoiceType))? $item->InvoiceType : JText::_('COM_JFPORTAL_VIEW_INVOICES_TABLE_HEADER_INVOICE_TYPE_NONE'); ?></td>
					<?php endif; ?>
					
					<?php if($this->params->get('show_ProductSold',false)):?>
						<!-- Products Sold -->
						<td><?php echo (isset($item->ProductSoldNames) && !empty($item->ProductSoldNames))? implode('<br/>',$item->ProductSoldNames) : JText::_('COM_JFPORTAL_VIEW_INVOICES_TABLE_HEADER_PRODUCT_SOLD_UNKNOWN'); ?></td>
					<?php endif; ?>
					
					<?php if($this->params->get('show_PromoCode',false)):?>
						<!-- Promo Code -->
						<td><?php echo (isset($item->PromoCode) && !empty($item->PromoCode))? $item->PromoCode : JText::_('COM_JFPORTAL_VIEW_INVOICES_TABLE_HEADER_PROMO_CODE_UNKNOWN'); ?></td>
					<?php endif; ?>
					
					<?php if($this->params->get('show_RefundStatus',true)):?>
						<!-- Refund Status -->
						<td><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICES_TABLE_REFUND_STATUS_'.$item->RefundStatus); ?></td>
					<?php endif; ?>
					
					<?php if($this->params->get('show_how_TotalDue',false)):?>
						<!-- Total Due -->
						<td><?php echo (isset($item->TotalDue) && is_numeric($item->TotalDue))? '$'.$item->TotalDue : JText::_('COM_JFPORTAL_VIEW_INVOICES_TABLE_TOTAL_DUE_NONE'); ?></td>
					<?php endif; ?>
					
					<?php if($this->params->get('show_TotalPaid',false)):?>
						<!-- Total Paid -->
						<td><?php echo (isset($item->TotalDue) && is_numeric($item->TotalPaid))? '$'.$item->TotalPaid : JText::_('COM_JFPORTAL_VIEW_INVOICES_TABLE_TOTAL_PAID_NONE'); ?></td>
					<?php endif; ?>
					
					
					<?php if($this->params->get('show_actions',true)):?>
						<td>
							<?php if(isset($item->PayStatus) && $item->PayStatus == JoomfuseTableInvoice::INVOICE_PAY_STATUS_UNPAID): ?>
								<div class="payInvoiceContact text-center">
									<?php if(!count($this->creditCards)):?>
										<span class="noCreditCardFound"><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICES_TABLE_PAY_INVOICE_NO_CC_FOUND')?></span>
									<?php else:?>
										<button class="btn btn-success pay_invoice" name="id" value="<?php echo $item->Id?>" data-confirmtext="<?php echo JText::_('MEOW?');?>"  onclick="return confirm('<?php echo JText::_('COM_JFPORTAL_VIEW_INVOICE_PAY_CONFIRM');?>')" ><?php echo JText::_('COM_JFPORTAL_VIEW_INVOICES_TABLE_PAY_INVOICE');?></button>
										<select class="chosen-select paymentCC">
										    <?php foreach($this->creditCards AS $creditCard):?>
										    	<option value="<?php echo $creditCard->Id?>"><?php echo $creditCard->CardType?> <?php echo $creditCard->Last4?></option>
										    <?php endforeach;?>
										</select>
									<?php endif;?>
								</div>
							<?php endif;?>
						</td>
					<?php endif;?>
					
				</tr>	
			<?php endforeach;?>
		</tbody>
	</table>
	
	<!-- Pagination -->
	<?php if (!empty($this->items) && ($this->pagination->pagesTotal > 1)) : ?>
		<div class="pagination">
			<p class="counter pull-right">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</p>
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
	<?php endif;?>
	
</form>	<!-- End of #adminForm -->

<?php if ($this->params->get('show_details', 1) == 1) :    //Modal details?>
	<div id="modal_container" style="display:none;">
    <?php foreach($this->items AS $item):?>
		<?php $this->item = $item; //Assign a value for the default_invoice template?>
		<?php echo $this->loadTemplate('invoice');?>
	<?php endforeach;?>
	</div>
<?php endif;?>