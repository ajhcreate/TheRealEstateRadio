<?php
/**
 * Joomfuse Portal views
 * @package     site.com_jfportal
 * @subpackage	views.subscriptions.tmpl.default
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

//jQuery.chosen for the select elements
JHTML::_('behavior.framework');
JHtml::_('bootstrap.framework');
JHtml::_('formbehavior.chosen','select');
JHtml::_('behavior.modal');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

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

	jQuery(document).ready(function(){
		jQuery('.CC1_select').change(function(){
			subscriptionId = jQuery(this).attr('data-forsubscription');
			cardId = jQuery(this).val();
			jQuery('#id').val(subscriptionId);
			jQuery('#cc_id').val(cardId);
			jQuery('#task').val('subscription.changeCC');
			jQuery('#adminForm').submit();
			//alert(task);
		});

		jQuery('.cancel_subscription').click(function(){
			if(confirm(jQuery(this).attr('data-confirmtext'))){
				jQuery('#task').val('subscription.cancel');
				jQuery('#adminForm').submit();
			} else {
				return false;
			}
		});
	});
</script>

<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post" name="adminForm" id="adminForm" class="form-inline">
	<fieldset class="filters btn-toolbar clearfix">
		<div class="row-fluid">
		<?php if ($this->params->get('show_filter_status',true)) :?>
			 	<select name="filter_status" id="filter_status pull-left" class="input-medium" onchange="this.form.submit();">
			 		<option value="0"><?php echo JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTIONS_FILTER_STATUS')?></option>
			 	    <option value="1" <?php echo $this->state->get('filter.status') == 1 ? 'selected="selected"':''?> ><?php echo JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTIONS_FILTER_STATUS_ACTIVE')?></option>
			 	    <option value="-1"<?php echo $this->state->get('filter.status') == -1 ? 'selected="selected"':''?> ><?php echo JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTIONS_FILTER_STATUS_INACTIVE')?></option>
			 	</select>
			
		<?php endif; ?>
		<?php if ($this->params->get('show_pagination_limit',true)) : ?>
			<div class="btn-group pull-right">
				<label for="limit" class="element-invisible">
					<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
				</label>
				<?php echo $this->pagination->getLimitBox(); ?>
			</div>
		<?php endif; ?>
		</div>

		<input type="hidden" name="filter_order" value="" />
		<input type="hidden" name="filter_order_Dir" id="filter_order_Dir" value="<?php echo $listOrder;?>" />
		<input type="hidden" name="limitstart" value="" />
		<input type="hidden" name="task" id="task" value="" />
		<input type="hidden" name="id" id="id" value="" />
		<input type="hidden" name="cc_id" id="cc_id" value="" />
		<input type="hidden" name="return" value="<?php echo base64_encode(JUri::getInstance()->toString());?>" />
		<?php echo JHtml::_( 'form.token' ); ?>
	</fieldset>
	
	
    <?php if(!count($this->items)):?>
		<h2><?php echo JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTIONS_YOU_HAVE_NO_SUBSCRIPTIONS'); ?></h2>
    <?php endif;?>
	
	<table id="jf_subs_table" class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th id="jf_subs_table_header_subs"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_SUBSCRIPTIONS_SUBSCRIPTION', 'subscriptions.name', $listDirn, $listOrder); ?></th>
				<?php if($this->params->get('show_Status',true)):?>
					<th id="jf_subs_table_header_status"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_SUBSCRIPTIONS_STATUS', 'subscriptions.status', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_BillingCycle',true)):?>
					<th id="jf_subs_table_header_cycle"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_SUBSCRIPTIONS_BILLING_CYCLE', 'subscriptions.cycle', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_StartDate',false)):?>
					<th id="jf_subs_table_header_start"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_SUBSCRIPTIONS_START', 'subscriptions.substart', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_EndDate',false)):?>
					<th id="jf_subs_table_header_end"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_SUBSCRIPTIONS_END', 'subscriptions.subend', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_LastBillDate',false)):?>
					<th id="jf_subs_table_header_last_charge"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_SUBSCRIPTIONS_LAST_CHARGE', 'subscriptions.lastcharge', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_NextBillDate',false)):?>
					<th id="jf_subs_table_header_next_charge"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_SUBSCRIPTIONS_NEXT_CHARGE', 'subscriptions.nextcharge', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_BillingAmt',false)):?>
					<th id="jf_subs_table_header_price"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_SUBSCRIPTIONS_PRICE', 'subscriptions.price', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_CC1',true)):?>
					<th id="jf_subs_table_header_credit_cards"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_SUBSCRIPTIONS_CREDIT_CARDS', 'subscriptions.cc', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_actions',true)):?>
					<th id="jf_subs_table_header_credit_action"><?php echo JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTIONS_ACTION'); ?></th>
				<?php endif;?>
			</tr>
		</thead>
		<tbody>
			<?php foreach($this->items AS $i=>$item):?>
			    <?php if (!isset($item->Status) || $item->Status == 'Inactive') : ?>
				<tr class="system-unpublished cat-list-row<?php echo $i % 2; ?>">
			    <?php else: ?>
				<tr class="cat-list-row<?php echo $i % 2; ?>" >
			    <?php endif; ?>
			    
			    	<!-- The subscription name -->
					<td headers="categorylist_header_title" class="list-title">
						<?php if ($this->params->get('show_details',1)) :?>
							<?php if ($this->params->get('show_details',1) == 1) :    //Modal details?>
								<a href="#details_<?php echo $item->Id; ?>"  class="modal" rel="{size: {x: <?php echo $this->params->get('modal_width',400)?>, y: <?php echo $this->params->get('modal_height',400)?>}, closable: true}" style="display:block;"><?php echo (isset($item->CProgram) && isset($item->CProgram->ProgramName)) ? $item->CProgram->ProgramName : 'Unknown Subscription Name';?></a>
							<?php else:    //Normal link to details view ?>
								<a href="<?php echo JRoute::_('index.php?option=com_jfportal&view=subscription&id='.$item->Id)?>" ><?php echo (isset($item->CProgram) && isset($item->CProgram->ProgramName)) ? $item->CProgram->ProgramName : 'Unknown Subscription Name';?></a>
							<?php endif;?>
						<?php else:?>
							<span><?php echo (isset($item->CProgram) && isset($item->CProgram->ProgramName)) ? $item->CProgram->ProgramName : 'Unknown Subscription Name';?></span>
						<?php endif?>
					</td>
					
					<?php if($this->params->get('show_Status',true)):?>
						<!-- Subscription Status -->
						<td><?php echo (isset($item->Status) && $item->Status == 'Active') ? JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTIONS_STATUS_ACTIVE') : JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTIONS_STATUS_CANCELLED'); ?></td>
					<?php endif;?>
					
					<?php if($this->params->get('show_BillingCycle',true)):?>
						<!-- Billing Cycle -->
						<td>
						    <?php if($item->Frequency > 1):?>
						    	<?php echo JText::sprintf('COM_JFPORTAL_VIEW_SUBSCRIPTIONS_BILLING_CYCLE_'.$item->BillingCycle.'_MULTIPLE',$item->Frequency); ?>
						    <?php else:?>
						        <?php echo JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTIONS_BILLING_CYCLE_'.$item->BillingCycle.($item->Frequency > 1 ? '_MULTIPLE':'')); ?>
						    <?php endif;?>
						</td>
					<?php endif;?>
					
					<?php if($this->params->get('show_StartDate',false)):?>
						<!-- Subscription Start Date -->
						<td><?php echo (isset($item->StartDate) && $item->StartDate) ? JHtml::date($item->StartDate, $item->StartDate_format, null) : JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTIONS_START_UNKNOWN'); ?></td>
					<?php endif?>
					
					<?php if($this->params->get('show_EndDate',false)):?>
						<!-- Subscription End Date -->
						<td><?php echo (isset($item->EndDate) && $item->EndDate) ? JHtml::date($item->EndDate, $item->EndDate_format, null) : JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTIONS_END_UNKNOWN'); ?></td>
					<?php endif?>
					
					<?php if($this->params->get('show_LastBillDate',false)):?>
						<!-- Next bill Date -->
						<td><?php echo (isset($item->LastBillDate) && $item->LastBillDate) ? JHtml::date($item->LastBillDate, $item->LastBillDate_format, null) : JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTIONS_LAST_CHARGE_UNKNOWN'); ?></td>
					<?php endif;?>
					
					<?php if($this->params->get('show_NextBillDate',false)):?>
						<!-- Next bill Date -->
						<td><?php echo (isset($item->NextBillDate) && $item->NextBillDate) ? JHtml::date($item->NextBillDate, $item->NextBillDate_format, null) : JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTIONS_NEXT_CHARGE_UNKNOWN'); ?></td>
					<?php endif;?>
					
					<?php if($this->params->get('show_BillingAmt',false)):?>
						<!-- Subscription cost -->
						<td><?php echo isset($item->BillingAmt) ? JText::sprintf('COM_JFPORTAL_VIEW_SUBSCRIPTIONS_PRICE_AMOUNT',$item->BillingAmt) : JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTIONS_PRICE_UNKNOWN');?></td>
					<?php endif;?>
					
					<?php if($this->params->get('show_CC1',true)):?>
						<td>
							<select class="CC1_select" data-forsubscription="<?php echo $item->Id?>">
								<?php if(!isset($item->CC1) || !$item->CC1):?>
									<option value=""><?php echo JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTIONS_CREDIT_CARDS_NONE')?></option>
								<?php else:?>
									<option 
										value="<?php echo $item->CC1->Id?>"
										class="<?php echo $item->CC1->Status == 3 ? '': 'muted text-error jf_invalid_cc'?>"
										disabled="disabled"
										selected="selected"
										>
										    <?php echo 
										        (isset($item->CC1->Status) && $item->CC1->Status == 3) ? 
										        JText::sprintf('COM_JFPORTAL_VIEW_SUBSCRIPTIONS_CREDIT_CARDS_TYPE_AND_LAST4', $item->CC1->CardType , $item->CC1->Last4, $item->CC1->ExpirationMonth, $item->CC1->ExpirationYear) :
										        JText::sprintf('COM_JFPORTAL_VIEW_SUBSCRIPTIONS_CREDIT_CARDS_INVALID_'.$item->CC1->Status.'_TYPE_AND_LAST4', $item->CC1->CardType , $item->CC1->Last4, $item->CC1->ExpirationMonth, $item->CC1->ExpirationYear); ?>
										</option>
								<?php endif;?>
								
								<?php foreach($this->creditcards AS $creditcard):?>
									<?php if($creditcard->Status != 3 ||  (isset($item->CC1->Id) && $item->CC1->Id == $creditcard->Id) ){continue;}?>
									<option value="<?php echo $creditcard->Id?>" ><?php echo JText::sprintf('COM_JFPORTAL_VIEW_SUBSCRIPTIONS_CREDIT_CARDS_TYPE_AND_LAST4', $creditcard->CardType , $creditcard->Last4, $creditcard->ExpirationMonth, $creditcard->ExpirationYear); ?></option>
								<?php endforeach;?>
							</select>
						</td>
					<?php endif;?>
					
					<?php if($this->params->get('show_actions',true)):?>
						<td>
							<?php if($item->is_editable && $item->Status == JoomfuseTableRecurringOrder::STATUS_ACTIVE):?>
								<button class="btn btn-danger cancel_subscription"name="id" value="<?php echo $item->Id?>" data-confirmtext="<?php echo JText::sprintf('COM_JFPORTAL_VIEW_SUBSCRIPTIONS_ACTION_CANCEL_CONFIRM', $item->CProgram->ProgramName);?>" ><?php echo JText::_('COM_JFPORTAL_VIEW_SUBSCRIPTIONS_ACTION_CANCEL');?></button>
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

<div id="modal_container" style="display:none;">
<?php if ($this->params->get('show_details', 1) == 1) :    //Modal details?>
	<?php foreach($this->items AS $item):?>
	    <?php $this->item = $item; //Assign a value for the default_subscription template?>
	    <?php echo $this->loadTemplate('subscription');?>
	<?php endforeach;?>
<?php endif;?>
</div>