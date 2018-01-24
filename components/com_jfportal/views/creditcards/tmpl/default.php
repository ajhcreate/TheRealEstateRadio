<?php
/**
 * Joomfuse Portal views
 * @package     site.com_jfportal
 * @subpackage	views.creditcards.tmpl.default
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

//jQuery.chosen for the select elements
JHtml::_('bootstrap.framework');
JHtml::_('formbehavior.chosen','select');

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
		
		jQuery('.deactivate_cc').click(function(){
			if(confirm(jQuery(this).attr('data-confirmtext'))){
				jQuery('#task').val('creditcard.deactivate');
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
			
			 	<select name="filter_status" id="filter_status" class="input-medium" onchange="this.form.submit();">
			 		<option value="-1"><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARDS_FILTER_STATUS')?></option>
			 		<option value="3"<?php echo $this->state->get('filter.status') == 3 ? 'selected="selected"':''?> ><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARDS_FILTER_STATUS_3')?></option>
			 	    <option value="1" <?php echo $this->state->get('filter.status') == 1 ? 'selected="selected"':''?> ><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARDS_FILTER_STATUS_1')?></option>
			 	    <option value="2"<?php echo $this->state->get('filter.status') == 2 ? 'selected="selected"':''?> ><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARDS_FILTER_STATUS_2')?></option>
			 	    <option value="4"<?php echo $this->state->get('filter.status') == 4 ? 'selected="selected"':''?> ><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARDS_FILTER_STATUS_4')?></option>
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
		<input type="hidden" name="Id" id="Id" value="" />
		<input type="hidden" name="return" value="<?php echo base64_encode(JUri::getInstance()->toString());?>" />
		<?php echo JHtml::_( 'form.token' ); ?>
	</fieldset>
	
	
    <?php if(!count($this->items)):?>
		<h2><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARDS_NO_CREDITCARDS'); ?></h2>
    <?php endif;?>
	
	<table id="jf_cards_table" class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<?php if($this->params->get('show_CardType',true)):?>
					<th id="jf_cards_table_header_cardtype">
					    <?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_CREDITCARDS_CARD_TYPE', 'creditcards.cardType', $listDirn, $listOrder); ?>
					</th>
				<?php endif;?>
				<?php if($this->params->get('show_BillAddress1',false)):?>
					<th id="jf_cards_table_header_billaddress1"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_CREDITCARDS_BILL_ADDRESS_1', 'creditcards.billaddress1', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_BillAddress2',false)):?>
					<th id="jf_cards_table_header_billaddress2"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_CREDITCARDS_BILL_ADDRESS_2', 'creditcards.billaddress2', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_BillZip',false)):?>
					<th id="jf_cards_table_header_billazip"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_CREDITCARDS_BILL_ZIP', 'creditcards.billzip', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_BillCity',false)):?>
					<th id="jf_cards_table_header_billCity"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_CREDITCARDS_BILL_CITY', 'creditcards.billcity', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_BillState',false)):?>
					<th id="jf_cards_table_header_billState"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_CREDITCARDS_BILL_STATE', 'creditcards.billstate', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_BillCountry',false)):?>
					<th id="jf_cards_table_header_billCountry"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_CREDITCARDS_BILL_COUNTRY', 'creditcards.billcountry', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_BillName',false)):?>
					<th id="jf_cards_table_header_billName"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_CREDITCARDS_BILL_NAME', 'creditcards.billname', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_Expiration',true)):?>
					<th id="jf_cards_table_header_expiration"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_CREDITCARDS_EXPIRATION', 'creditcards.expiration', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_FirstName',false)):?>
					<th id="jf_cards_table_header_firstname"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_CREDITCARDS_FIRSTNAME', 'creditcards.firstname', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_LastName',false)):?>
					<th id="jf_cards_table_header_lastname"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_CREDITCARDS_LASTNAME', 'creditcards.lastname', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_NameOnCard',true)):?>
					<th id="jf_cards_table_header_nameoncard"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_CREDITCARDS_NAMEONCARD', 'creditcards.nameoncard', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_MaestroIssueNumber',false)):?>
					<th id="jf_cards_table_header_maestroissuenumber"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_CREDITCARDS_MAESTRO_ISSUE_NUMBER', 'creditcards.maestroissuenumber', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_PhoneNumber',false)):?>
					<th id="jf_cards_table_header_phonenumber"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_CREDITCARDS_PHONE_NUMBER', 'creditcards.phonenumber', $listDirn, $listOrder); ?></th>
				<?php endif;?>		
				
				<?php if($this->params->get('show_Last4',true)):?>
					<th id="jf_cards_table_header_last4"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_CREDITCARDS_LAST4', 'creditcards.last4', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_ShipFirstName',false)):?>
					<th id="jf_cards_table_header_shipFirstName"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_CREDITCARDS_SHIP_FIRSTNAME', 'creditcards.shipfirstname', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_ShipLastName',false)):?>
					<th id="jf_cards_table_header_shipLastName"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_CREDITCARDS_SHIP_LASTNAME', 'creditcards.shiplastname', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_ShipName',false)):?>
					<th id="jf_cards_table_header_shipName"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_CREDITCARDS_SHIP_NAME', 'creditcards.shipname', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_StartDate',false)):?>
					<th id="jf_cards_table_header_startdate"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_CREDITCARDS_START_DATE', 'creditcards.startdate', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_Status',true)):?>
					<th id="jf_cards_table_header_status"><?php echo JHtml::_('grid.sort', 'COM_JFPORTAL_VIEW_CREDITCARDS_STATUS', 'creditcards.status', $listDirn, $listOrder); ?></th>
				<?php endif;?>
				<?php if($this->params->get('show_Actions',true)):?>
					<?php if ($this->params->get('cc_alow_deactivation',true)):?>
						<th id="jf_cards_table_header_actions"><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARDS_ACTIONS'); ?></th>
					<?php endif;?>
				<?php endif;?>

			</tr>
		</thead>
		<tbody>
			<?php foreach($this->items AS $i=>$item):?>
				<tr class="cat-list-row<?php echo $i % 2; ?> <?php echo $item->Status == JoomfuseTableCreditcard::CARD_STATUS_DELETED || $item->Status == JoomfuseTableCreditcard::CARD_STATUS_INVALID || $item->Status == JoomfuseTableCreditcard::CARD_STATUS_INVALID ? 'error':''?> <?php echo $item->Status == JoomfuseTableCreditcard::CARD_STATUS_INACTIVE ? 'warning' : '' ?>">
					<?php if($this->params->get('show_CardType',true)):?>
						<!-- Card Type -->
						<td>
							<?php if ($this->params->get('show_details',true)) :?>
								<a href="<?php echo JRoute::_('index.php?option=com_jfportal&view=creditcard&task=edit&Id='.$item->Id)?>">
						            <?php echo (isset($item->CardType) && $item->CardType) ? $item->CardType : JText::_('COM_JFPORTAL_VIEW_CREDITCARDS_CARD_TYPE_UNKNOWN'); ?>
						    	</a>
						    <?php else:?>
						    	<?php echo (isset($item->CardType) && $item->CardType) ? $item->CardType : JText::_('COM_JFPORTAL_VIEW_CREDITCARDS_CARD_TYPE_UNKNOWN'); ?>
						    <?php endif;?>
						</td>
					<?php endif;?>
					<?php if($this->params->get('show_BillAddress1',false)):?>
						<!-- Bill Address 1 -->
						<td><?php echo $item->BillAddress1; ?></td>
					<?php endif;?>
					<?php if($this->params->get('show_BillAddress2',false)):?>
						<!-- Bill Address 2 -->
						<td><?php echo $item->BillAddress2; ?></td>
					<?php endif;?>
					<?php if($this->params->get('show_BillZip',false)):?>
						<!-- Bill Address 2 -->
						<td><?php echo $item->BillZip; ?></td>
					<?php endif;?>
					<?php if($this->params->get('show_BillCity',false)):?>
						<!-- Billing City -->
						<td><?php echo $item->BillCity; ?></td>
					<?php endif;?>
					<?php if($this->params->get('show_BillState',false)):?>
						<!-- Billing State -->
						<td><?php echo $item->BillState; ?></td>
					<?php endif;?>
					<?php if($this->params->get('show_BillCountry',false)):?>
						<!-- Billing Country -->
						<td><?php echo $item->BillCountry; ?></td>
					<?php endif;?>
					<?php if($this->params->get('show_BillName',false)):?>
						<!-- Billing Name -->
						<td><?php echo $item->BillName; ?></td>
					<?php endif;?>
					
					<?php if($this->params->get('show_Expiration',true)):?>
						<!-- Expiration Date -->
						<td><?php echo (isset($item->expirationDate) && $item->expirationDate) ? JHtml::date($item->expirationDate, $item->ExpirationDate_format, null) : JText::_('COM_JFPORTAL_VIEW_CREDITCARDS_EXPIRATION'); ?></td>
					<?php endif;?>
					
					<?php if($this->params->get('show_FirstName',false)):?>
						<!-- Card First Name -->
						<td><?php echo (isset($item->FirstName) && $item->FirstName) ? $item->FirstName : '' ?></td>
					<?php endif?>
					
					<?php if($this->params->get('show_LastName',false)):?>
						<!-- Card Last Name -->
						<td><?php echo (isset($item->LastName) && $item->LastName) ? $item->LastName : '' ?></td>
					<?php endif?>
					
					<?php if($this->params->get('show_NameOnCard',true)):?>
						<!-- Name on Card -->
						<td><?php echo (isset($item->NameOnCard) && $item->NameOnCard) ? $item->NameOnCard : '' ?></td>
					<?php endif?>
					<?php if($this->params->get('show_MaestroIssueNumber',false)):?>
						<!-- Maestro issue number -->
						<td><?php echo $item->MaestroIssueNumber; ?></td>
					<?php endif?>
					<?php if($this->params->get('show_PhoneNumber',false)):?>
						<!-- Phone Number -->
						<td><?php echo $item->PhoneNumber; ?></td>
					<?php endif?>
					
					
					<?php if($this->params->get('show_Last4',true)):?>
						<!-- Last 4 -->
						<td><?php echo (isset($item->Last4) && $item->Last4) ? $item->Last4 : '' ?></td>
					<?php endif?>
					
					<?php if($this->params->get('show_ShipFirstName',false)):?>
						<!-- Shipping First Name -->
						<td><?php echo (isset($item->ShipFirstName) && $item->ShipFirstName) ? $item->ShipFirstName : '' ?></td>
					<?php endif?>
					
					<?php if($this->params->get('show_ShipLastName',false)):?>
						<!-- Shipping Last Name -->
						<td><?php echo (isset($item->ShipLastName) && $item->ShipLastName) ? $item->ShipLastName : '' ?></td>
					<?php endif?>
					
					<?php if($this->params->get('show_ShipName',false)):?>
						<!-- Shipping Full Name -->
						<td><?php echo (isset($item->ShipName) && $item->ShipName) ? $item->ShipName : '' ?></td>
					<?php endif?>
					<?php if($this->params->get('show_StartDate',false)):?>
						<!-- Start Date -->
						<td><?php echo $item->StartDate ? JHtml::date($item->StartDate, $item->StartDate_format, null) : ''; ?></td>
					<?php endif?>
					
					<?php if($this->params->get('show_Status',true)):?>
						<!-- Shipping Full Name -->
						<td><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARDS_STATUS_'.$item->Status) ?></td>
					<?php endif?>
					
					<?php if($this->params->get('show_Actions',true)):?>
						<!-- Action buttons -->
						<?php if ($this->params->get('cc_alow_deactivation',true)):?>
							<td>
							    <?php if($item->Status == JoomfuseTableCreditcard::CARD_STATUS_OK):?>
									<button class="btn btn-danger deactivate_cc" name="Id" data-confirmtext="<?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARDS_ACTION_DEACTIVATE_CONFIRM')?>" value="<?php echo $item->Id?>"><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARDS_ACTION_DEACTIVATE');?></button>
							    <?php endif;?>
							</td>
						<?php endif;?>
					<?php endif;?>
					
				</tr>	
			<?php endforeach;?>
		</tbody>
	</table>
	<?php if ($this->params->get('cc_alow_addition',true)):?>
		<a href="<?php echo JRoute::_('index.php?option=com_jfportal&view=creditcard&task=new')?>" class="btn btn-success">
		    <?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARDS_ADD_NEW')?>
		</a>
	<?php endif;?>
	
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
<?php //var_dump($this->items);?>