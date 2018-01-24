<?php
/**
 * Joomfuse Portal views
 * @package     site.com_jfportal
 * @subpackage	views.creditcard.tmpl.default
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
$isNew = (isset($this->item->Id) && $this->item->Id )? false : true;

JHtml::_('bootstrap.framework');
JHtml::_('formbehavior.chosen');
if(JFactory::getConfig()->get('debug',false)){
    JFactory::getDocument()->addScript('components/com_jfportal/views/creditcard/tmpl/jquery.validate.js');
} else {
    JFactory::getDocument()->addScript('components/com_jfportal/views/creditcard/tmpl/jquery.validate.min.js');
}

JHTML::_('behavior.tooltip');

//@TODO-GN: Add the Status on top, h1?
//@TODO-GN: Obfuscate CardNumber/Type field names so we can possibly avoid browser-sniffing viruses?
//@TODO-GN: See which CC names we need when creating the CC
//@TODO-GN: Form validation
//@TODO-GN: Check for new entry creations / link to it
//@TODO-GN: CC number needs minlength or the models start screaming about a missing Last4
?>

<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('#cc_form').validate({
		    errorPlacement: function(label, element) {
		        label.addClass('alert alert-error');
		        label.insertAfter(element);
		    },
		    rules: {
		    	CardNumber: {
		    		required: true,
		    		creditcard: true
		    	}
		    }
		});
	});
		
</script>

<form id="cc_form" method="post">
	<input type="hidden" name="option" value="com_jfportal" />
	<input type="hidden" name="task" value="creditcard.save" />
	<input type="hidden" name="Id" value="<?php echo $isNew ? '' : (int)$this->item->Id; ?>" />
	<?php echo JHtml::_( 'form.token' ); ?>

	<?php if($this->params->get('show_details_CardType',true)):?>
		<!-- Card Type -->
		<div class="row-fluid CardType">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARD_CREDITCARD_TYPE');?>*</div>
			<div class="span6">
				<select name="CardType" id="CardType" class="cc_group" required>
					<?php if(!empty($cardName) && !in_array($cardName, $this->creditCardTypes)):?>
						<option value="" selected="selected">Unsupported Card Type</option>
					<?php endif?>
					<?php foreach($this->creditCardTypes AS $cardName):?>
						<option value="<?php echo $cardName?>"<?php echo isset($this->item->CardType) && $this->item->CardType==$cardName ? 'selected="selected"' : ''?> ><?php echo $cardName?></option>
					<?php endforeach;?>
				</select>
			</div>
		</div>
	<?php endif;?>
	
	<?php if($isNew):?>
		<!-- Card Number -->
		<div class="row-fluid CardNumber">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARD_CREDITCARD_NUMBER');?>*</div>
			<div class="span6">
				<input type="text" id="cnum" class="cc_group" name="CardNumber" id="CardNumber" autocomplete="off" />
			</div>
		</div>
	<?php elseif($this->params->get('show_details_Last4',true)):?>
		<!-- Card Last4 -->
		<div class="row-fluid Last4">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARD_CREDITCARD_LAST_4');?></div>
			<div class="span6">
				<input type="text" disabled="disabled" value="<?php echo $this->item->Last4?>" size="4" maxlength="4" class="input-mini"/>
			</div>
		</div>
	<?php endif;?>
	
	<?php if($isNew || $this->params->get('show_details_cvv2',false)):?>
		<!-- CVV 2 -->
		<div class="row-fluid CVV2">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARD_CVV2');?>*</div>
			<div class="span6 <?php echo !$isNew?'hasTooltip':''?>" <?php echo !$isNew ?'title="&lt;strong&gt;Important Note&lt;/strong&gt;&lt;br /&gt;The CVV2 value will never be displayed in this field. If you wish to overwrite the current value, please type in the new CVV2&lt;br/&gt;Otherwise leave this field empty"' : '';?>>
				<input type="text" class="cc_group" <?php echo $isNew? 'required' : ''?> name="CVV2" id="CVV2" autocomplete="off" />
			</div>
		</div>
	<?php endif;?>
	
	<?php if($isNew || $this->params->get('show_details_ExpirationDate',true)):?>
		<!-- Expiration Month -->
		<div class="row-fluid ExpirationDate">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARD_CREDITCARD_EXPIRATION_DATE');?>*</div>
			<div class="span6">
				<select name="ExpirationMonth" id="ExpirationMonth" class="span2 cc_group" required>
					<?php if(isset($this->item->ExpirationMonth)):?>
						<option value="<?php echo $this->item->ExpirationMonth;?>"><?php echo $this->item->ExpirationMonth; ?></option>
					<?php endif;?>
					<?php for($i=1; $i<13; $i++):?>
						<?php if(isset($this->item->ExpirationMonth) && $i == $this->item->ExpirationMonth){continue;} //We have already listed current values at the top of the select element?>
						<option value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT);;?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT);?></option>
					<?php endfor;?>
				</select>
				<select name="ExpirationYear" id="ExpirationYear" class="span3 cc_group" required>
					<?php if(isset($this->item->ExpirationYear)):?>
						<option value="<?php echo $this->item->ExpirationYear;?>"><?php echo $this->item->ExpirationYear; ?></option>
					<?php endif;?>
					<?php for($i = (date('Y')) ; $i<=date('Y')+10; $i++):?>
						<?php if(isset($this->item->ExpirationYear) && $i == $this->item->ExpirationYear){continue;} //We have already listed current values at the top of the select element?>
						<option value="<?php echo $i;?>"><?php echo $i; ?></option>
					<?php endfor;?>
				</select>
			</div>
		</div>
	<?php endif;?>
	
	<?php if($this->params->get('show_details_FirstName',false)):?>
		<!-- First Name -->
		<div class="row-fluid FirstName">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARD_CREDITCARD_FIRST_NAME');?></div>
			<div class="span6">
				<input type="text" name="FirstName" value="<?php echo isset($this->item->FirstName) ? $this->item->FirstName : '';?>" class="input-medium" />
			</div>
		</div>
	<?php endif;?>
	
	<?php if($this->params->get('show_details_LastName',false)):?>
		<!-- Last Name -->
		<div class="row-fluid LastName">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARD_CREDITCARD_LAST_NAME');?></div>
			<div class="span6">
				<input type="text" name="LastName" value="<?php echo isset($this->item->LastName) ? $this->item->LastName : '';?>" class="input-medium" />
			</div>
		</div>
	<?php endif;?>
	
	<?php if($isNew || $this->params->get('show_details_NameOnCard',true)):?>
		<!-- Name On Card -->
		<div class="row-fluid NameOnCard">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARD_CREDITCARD_NAME_ON_CARD');?>*</div>
			<div class="span6">
				<input type="text" name="NameOnCard" value="<?php echo isset($this->item->NameOnCard) ? $this->item->NameOnCard : '';?>" required class="input-medium" />
			</div>
		</div>
	<?php endif;?>
	
	<?php if($this->params->get('show_details_BillName',false)):?>
		<!-- Bill Name -->
		<div class="row-fluid BillName">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARD_CREDITCARD_BILL_NAME');?></div>
			<div class="span6">
				<input type="text" name="BillName" value="<?php echo isset($this->item->BillName) ? $this->item->BillName : '';?>" class="input-medium" />
			</div>
		</div>
	<?php endif;?>
	
	<?php if($isNew || $this->params->get('show_details_BillAddress1',true)):?>
		<!-- Billing Address 1 -->
		<div class="row-fluid BillAddress1">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARD_CREDITCARD_BILL_ADDRESS_1');?>*</div>
			<div class="span6">
				<input type="text" name="BillAddress1" value="<?php echo isset($this->item->BillAddress1) ? $this->item->BillAddress1 : '';?>" required class="input-medium" />
			</div>
		</div>
	<?php endif;?>
	
	<?php if($this->params->get('show_details_BillAddress2',false)):?>
		<!-- Billing Address 1 -->
		<div class="row-fluid BillAddress2">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARD_CREDITCARD_BILL_ADDRESS_2');?></div>
			<div class="span6">
				<input type="text" name="BillAddress2" value="<?php echo isset($this->item->BillAddress2) ? $this->item->BillAddress2 : '';?>" class="input-medium" />
			</div>
		</div>
	<?php endif;?>
	
	<?php if($isNew || $this->params->get('show_details_BillZip',false)):?>
		<!-- Billing Zip -->
		<div class="row-fluid BillZip">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARD_CREDITCARD_BILL_ZIP');?>*</div>
			<div class="span6">
				<input type="text" name="BillZip" value="<?php echo isset($this->item->BillAddress2) ? $this->item->BillAddress2 : '';?>" required class="input-medium" />
			</div>
		</div>
	<?php endif;?>
	
	<?php if($isNew || $this->params->get('show_details_BillCity',true)):?>
		<!-- Billing City -->
		<div class="row-fluid BillCity">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARD_CREDITCARD_BILL_CITY');?>*</div>
			<div class="span6">
				<input type="text" name="BillCity" value="<?php echo isset($this->item->BillCity) ? $this->item->BillCity : '';?>" required class="input-medium" />
			</div>
		</div>
	<?php endif;?>
	
	<?php if($this->params->get('show_details_BillState',false)):?>
		<!-- Billing State -->
		<div class="row-fluid BillState">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARD_CREDITCARD_BILL_STATE');?></div>
			<div class="span6">
				<input type="text" name="BillState" value="<?php echo isset($this->item->BillState)?$this->item->BillState:''?>" class="input-medium" />
			</div>
		</div>
	<?php endif;?>
	
	<?php if($isNew || $this->params->get('show_details_BillCountry',true)):?>
		<!-- Billing Country -->
		<div class="row-fluid BillCountry">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARD_CREDITCARD_BILL_COUNTRY');?>*</div>
			<div class="span6">
				<select name="BillCountry" required>
					<?php if(!isset($this->item->BillCountry) || empty($this->item->BillCountry)):?>
						<option value="" ><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARD_CREDITCARD_BILL_SELECT_COUNTRY')?></option>
					<?php endif;?>
					<?php foreach(JoomfuseTableCreditcard::$AllowedBillingCountryValues AS $country):?>
						<option value="<?php echo $country?>" <?php echo (isset($this->item->BillCountry) && $this->item->BillCountry == $country)?'selected="selected"':'';?>><?php echo $country?></option>
					<?php endforeach;?>
				</select>
			</div>
		</div>
	<?php endif;?>
	
	<?php if($this->params->get('show_details_PhoneNumber',false)):?>
		<!-- Phone Number -->
		<div class="row-fluid PhoneNumber">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARD_CREDITCARD_PHONE_NUMBER');?></div>
			<div class="span6">
				<input type="text" name="PhoneNumber" value="<?php echo isset($this->item->PhoneNumber)?$this->item->PhoneNumber:''?>" class="input-medium" />
			</div>
		</div>
	<?php endif;?>
	
	<?php if($this->params->get('show_details_MaestroIssueNumber',false)):?>
		<!-- Maestro Issue number -->
		<div class="row-fluid MaestroIssueNumber">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARD_CREDITCARD_MAESTRO_ISSUE_NUMBER');?></div>
			<div class="span6">
				<input type="text" name="MaestroIssueNumber" value="<?php echo isset($this->item->MaestroIssueNumber)?$this->item->MaestroIssueNumber:''?>" class="input-medium" />
			</div>
		</div>
	<?php endif;?>
	
	<?php if($this->params->get('show_details_StartDate',false)):?>
		<!-- Maestro Issue number -->
		<div class="row-fluid StartDate">
			<div class="span6 text-right"><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARD_CREDITCARD_START_DATE');?></div>
			<div class="span6">
				<select name="StartMonth" class="span2">
					<?php if(isset($this->item->StartDateMonth)):?>
						<option value="<?php echo $this->item->StartDateMonth;?>"><?php echo $this->item->StartDateMonth; ?></option>
					<?php endif;?>
					<?php for($i=1; $i<13; $i++):?>
						<?php if(isset($this->item->StartDateMonth) && $i == $this->item->StartDateMonth){continue;} //We have already listed current values at the top of the select element?>
						<option value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT);?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT);?></option>
					<?php endfor;?>
				</select>
				<select name="StartDateYear" class="span3">
					<?php if(isset($this->item->StartYear)):?>
						<option value="<?php echo $this->item->StartDateYear;?>"><?php echo $this->item->StartDateYear; ?></option>
					<?php endif;?>
					<?php for($i = (date('Y')-10) ; $i<=date('Y'); $i++):?>
						<?php if(isset($this->item->StartYear) && $i == $this->item->StartYear){continue;} //We have already listed current values at the top of the select element?>
						<option value="<?php echo $i;?>"><?php echo $i; ?></option>
					<?php endfor;?>
				</select>
			</div>
		</div>
	<?php endif;?>
	
	<div class="row-fluid submitButtons text-center">
		<!-- Submit button -->
	    <?php if($isNew):?>
			<button class="btn btn-success validate" name="submit"><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARD_ACTION_SUBMIT_NEW'); ?></button>
	    <?php else:?>
			<button class="btn btn-success validate" name="submit" onclick="return confirm('<?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARD_ACTION_SUBMIT_EDIT_CONFIRM');?>')" ><?php echo JText::_('COM_JFPORTAL_VIEW_CREDITCARD_ACTION_SUBMIT_EDIT'); ?></button>
	    <?php endif;?>
	</div>
</form>
<?php //var_dump($this->item); ?>
<?php //var_dump($this->creditCardTypes);?>