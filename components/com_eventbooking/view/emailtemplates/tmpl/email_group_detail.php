<?php
/**
 * @package            Joomla
 * @subpackage         Event Booking
 * @author             Tuan Pham Ngoc
 * @copyright          Copyright (C) 2010 - 2017 Ossolution Team
 * @license            GNU/GPL, see LICENSE.php
 */

defined('_JEXEC') or die;
$nullDate = JFactory::getDbo()->getNullDate();
?>
<table width="100%" class="os_table" cellspacing="2" cellpadding="2">
	<tr>
		<td class="heading" colspan="2">
			<?php echo JText::_('EB_GENERAL_INFORMATION') ; ?>
		</td>
	</tr>
	<tr>
		<td class="title_cell">
			<?php echo  JText::_('EB_EVENT_TITLE') ?>
		</td>
		<td class="field_cell">
			<?php echo $rowEvent->title ; ?>
		</td>
	</tr>
	<?php
		if ($config->show_event_date)
		{
		?>
		<tr>
			<td class="title_cell">
				<?php echo  JText::_('EB_EVENT_DATE') ?>
			</td>
			<td class="field_cell">
				<?php
					if ($rowEvent->event_date == EB_TBC_DATE)
					{
						echo JText::_('EB_TBC');
					}
					else
					{
						echo JHTML::_('date', $rowEvent->event_date, $config->event_date_format, null) ;
					}
				?>
			</td>
		</tr>
		<?php
			if ($rowEvent->event_end_date != $nullDate)
			{
			?>
				<tr>
					<td class="title_cell">
						<?php echo  JText::_('EB_EVENT_END_DATE') ?>
					</td>
					<td class="field_cell">
						<?php echo JHtml::_('date', $rowEvent->event_end_date, $config->event_date_format, null); ?>
					</td>
				</tr>
			<?php
			}
		}
		if ($config->show_event_location_in_email && $rowLocation)
		{
			$location = $rowLocation ;
			$locationInformation = array();
			if ($location->address)
			{
				$locationInformation[] = $location->address;
			}
			if ($location->city)
			{
				$locationInformation[] = $location->city;
			}
			if ($location->state)
			{
				$locationInformation[] = $location->state;
			}
			if ($location->zip)
			{
				$locationInformation[] = $location->zip;
			}
			if ($location->country)
			{
				$locationInformation[] = $location->country;
			}
		?>
		<tr>
			<td class="title_cell">
				<?php echo  JText::_('EB_LOCATION') ?>
			</td>
			<td class="field_cell">
				<?php echo $location->name.' ('.implode(', ', $locationInformation).')' ; ?>
			</td>
		</tr>
		<?php
		}
	?>
	<tr>
		<td class="title_cell">
			<?php echo  JText::_('EB_NUMBER_REGISTRANTS') ?>
		</td>
		<td class="field_cell">
			<?php echo $row->number_registrants ; ?>
		</td>
	</tr>
	<?php
	$showBillingStep = EventbookingHelper::showBillingStep($row->event_id);
	if ($showBillingStep)
	{
	?>
	<tr>
		<td colspan="2" class="eb-heading">
			<?php echo JText::_('EB_BILLING_INFORMATION') ; ?>
		</td>
	</tr>
	<?php
		$fields = $form->getFields();
		foreach ($fields as $field)
		{
			if ($field->hideOnDisplay || $field->row->hide_on_email)
			{
				continue;
			}
			echo $field->getOutput(false);
		}
		if ($row->total_amount > 0)
		{
		?>
			<tr>
				<td class="title_cell">
					<?php echo JText::_('EB_AMOUNT'); ?>
				</td>
				<td class="field_cell">
					<?php echo EventbookingHelper::formatCurrency($row->total_amount, $config, $rowEvent->currency_symbol); ?>
				</td>
			</tr>
			<?php
			if ($row->discount_amount > 0)
			{
			?>
				<tr>
					<td class="title_cell">
						<?php echo  JText::_('EB_DISCOUNT_AMOUNT'); ?>
					</td>
					<td class="field_cell">
						<?php echo EventbookingHelper::formatCurrency($row->discount_amount, $config, $rowEvent->currency_symbol); ?>
					</td>
				</tr>
			<?php
			}
			if ($row->late_fee > 0)
			{
			?>
				<tr>
					<td class="title_cell">
						<?php echo  JText::_('EB_LATE_FEE'); ?>
					</td>
					<td class="field_cell">
						<?php echo EventbookingHelper::formatCurrency($row->late_fee, $config, $rowEvent->currency_symbol); ?>
					</td>
				</tr>
			<?php
			}
			if ($row->tax_amount > 0)
			{
			?>
				<tr>
					<td class="title_cell">
						<?php echo  JText::_('EB_TAX'); ?>
					</td>
					<td class="field_cell">
						<?php echo EventbookingHelper::formatCurrency($row->tax_amount, $config, $rowEvent->currency_symbol); ?>
					</td>
				</tr>
			<?php
			}
			if ($row->payment_processing_fee > 0)
			{
			?>
				<tr>
					<td class="title_cell">
						<?php echo  JText::_('EB_PAYMENT_FEE'); ?>
					</td>
					<td class="field_cell">
						<?php echo EventbookingHelper::formatCurrency($row->payment_processing_fee, $config, $rowEvent->currency_symbol); ?>
					</td>
				</tr>
			<?php
			}
			if ($row->discount_amount > 0 || $row->tax_amount > 0 || $row->payment_processing_fee > 0 || $row->late_fee > 0)
			{
			 ?>
				<tr>
					<td class="title_cell">
						<?php echo  JText::_('EB_GROSS_AMOUNT'); ?>
					</td>
					<td class="field_cell">
						<?php echo EventbookingHelper::formatCurrency($row->amount, $config, $rowEvent->currency_symbol) ; ?>
					</td>
				</tr>
			<?php
			}
		}
		if ($row->deposit_amount > 0)
		{
		?>
			<tr>
				<td class="title_cell">
					<?php echo JText::_('EB_DEPOSIT_AMOUNT'); ?>
				</td>
				<td class="field_cell">
					<?php echo EventbookingHelper::formatCurrency($row->deposit_amount, $config, $rowEvent->currency_symbol); ?>
				</td>
			</tr>
			<tr>
				<td class="title_cell">
					<?php echo JText::_('EB_DUE_AMOUNT'); ?>
				</td>
				<td class="field_cell">
					<?php echo EventbookingHelper::formatCurrency($row->amount - $row->deposit_amount, $config, $rowEvent->currency_symbol); ?>
				</td>
			</tr>
		<?php
		}
		if ($row->amount > 0 && $row->published != 3)
		{
		?>
			<tr>
				<td class="title_cell">
					<?php echo  JText::_('EB_PAYMEMNT_METHOD'); ?>
				</td>
				<td class="field_cell">
					<?php
					$method = os_payments::loadPaymentMethod($row->payment_method);
					if ($method)
					{
						echo JText::_($method->title) ;
					}
					?>
				</td>
			</tr>
			<?php
			if (!empty($last4Digits))
			{
			?>
				<tr>
					<td class="title_cell">
						<?php echo JText::_('EB_LAST_4DIGITS'); ?>
					</td>
					<td class="field_cell">
						<?php echo $last4Digits; ?>
					</td>
				</tr>
			<?php
			}
			?>
			<tr>
				<td class="title_cell">
					<?php echo JText::_('EB_TRANSACTION_ID'); ?>
				</td>
				<td class="field_cell">
					<?php echo $row->transaction_id ; ?>
				</td>
			</tr>
		<?php
		}
	}
	if ($config->collect_member_information && count($rowMembers))
	{
	?>
		<tr>
			<td class="heading" colspan="2">
				<?php echo JText::_('EB_MEMBERS_INFORMATION') ; ?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" class="os_member_list">
					<?php
						$rowFields = EventbookingHelper::getFormFields($row->event_id, 2);
						for ($i = 0 , $n  = count($rowMembers); $i < $n; $i++)
						{
							$memberForm = new RADForm($rowFields);
							if ($i %2 == 0)
							{
								echo "<tr>\n" ;
							}
							$rowMember = $rowMembers[$i] ;
							$memberData = EventbookingHelper::getRegistrantData($rowMember, $rowFields);
							$memberForm->bind($memberData);
							$memberForm->buildFieldsDependency();
							$fields = $memberForm->getFields();
							foreach ($fields as $field)
							{
								if ($field->hideOnDisplay || $field->row->hide_on_email)
								{
									unset($fields[$field->name]);
								}
							}
							$memberForm->setFields($fields);
						?>
							<td>
								<table class="os_table" width="100%" cellspacing="3" cellpadding="3">
									<tr>
										<td colspan="2" class="os_row_heading"><?php echo JText::sprintf('EB_MEMBER_INFORMATION', $i + 1) ; ?></td>
									</tr>
									<?php
										$fields = $memberForm->getFields();
										foreach ($fields as $field)
										{
											if ($i > 0 && $field->row->only_show_for_first_member)
											{
												continue;
											}
											echo $field->getOutput(false);
										}
									?>
								</table>
							</td>
						<?php
							if (($i + 1) %2 == 0)
							{
								echo "</tr>\n" ;
							}
						}
						if ($i %2 != 0)
						{
							echo "<td>&nbsp;</td></tr>" ;
						}
					?>
				</table>
			</td>
		</tr>
	<?php
	}
?>
</table>