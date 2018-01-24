<?php 
/**
 * @package Social Ads
 * @copyright Copyright (C) 2009 -2010 Techjoomla, Tekdi Web Solutions . All rights reserved.
 * @license GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link     http://www.techjoomla.com
 */
defined('_JEXEC') or die('Restricted access');

$lang = JFactory::getLanguage();
$extension = 'plg_gurupayment_payfast';
$base_dir = JPATH_ADMINISTRATOR;
$language_tag = '';
$lang->load($extension, $base_dir, $language_tag, true);

$notify_url = $vars->notify_url;

parse_str($notify_url, $output);
$order_id = @intval($output["order_id"]);

$user = JFactory::getUser();
$user_email = $user->email;

$data = array(
	// Merchant details
	'merchant_id' => $vars->merchant_id,
	'merchant_key' => $vars->merchant_key,
	'return_url' => $vars->return_url,
	'cancel_url' => $vars->cancel_url,
	'notify_url' => $vars->notify_url,

	// Buyer details
	'name_first' => $vars->name_first,
	'name_last'  => $vars->name_last,
	'email_address'=> $vars->email_address,
	
	// Transaction details
	'm_payment_id' => $vars->m_payment_id, //Unique payment ID to pass through to notify_url
	'amount' => number_format( sprintf( "%.2f", $vars->amount ), 2, '.', '' ), //Amount in ZAR
	'item_name' => $vars->item_name,
	'item_description' => '',
	'custom_int1' => '', //custom integer to be passed through           
	'custom_str1' => ''           
);

$pfHost = $vars->testingMode ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';

?>

<div style="display: none;">
	<form action="https://<?php echo $pfHost; ?>/eng/process" method="post" id="payfast-form">
		<?php
			foreach($data as $name=> $value){
              echo '<input name="'.$name.'" type="hidden" value="'.$value.'" />';
          	}
		?>

		<button type="submit" id="payfast-submit" class="payfast-button">Submit Payment</button>
	</form>
</div>

<script type="text/javascript">
	document.getElementById("payfast-form").submit();
</script>