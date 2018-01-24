<?php 
/**
 * @package Social Ads
 * @copyright Copyright (C) 2009 -2010 Techjoomla, Tekdi Web Solutions . All rights reserved.
 * @license GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link     http://www.techjoomla.com
 */
defined('_JEXEC') or die('Restricted access');

$lang = JFactory::getLanguage();
$extension = 'plg_gurupayment_stripe';
$base_dir = JPATH_ADMINISTRATOR;
$language_tag = '';
$lang->load($extension, $base_dir, $language_tag, true);

$notify_url = $vars->notify_url;

parse_str($notify_url, $output);
$order_id = @intval($output["order_id"]);

$stripe_first_name = $_SESSION["stripe_first_name"];
$stripe_last_name = $_SESSION["stripe_last_name"];
$stripe_card_number = $_SESSION["stripe_card_number"];
$stripe_cvc = $_SESSION["stripe_cvc"];
$stripe_month = $_SESSION["stripe_month"];
$stripe_year = $_SESSION["stripe_year"];

$name = trim($stripe_first_name);

if(trim($stripe_last_name) != ""){
	$name .= " ".trim($stripe_last_name);
}

$user = JFactory::getUser();
$user_email = $user->email;

?>

<div class="uk-section uk-section-default uk-section-large uk-text-center">
	<h3 class="uk-margin-remove"><?php echo JText::_("PLG_PAYMENT_IN_PENDING"); ?></h3>
	<img src="<?php echo JURI::root(); ?>/plugins/gurupayment/stripe/stripe/tmpl/ellipsis_big.gif" alt="">
</div>

<script type="text/javascript" src="https://js.stripe.com/v1/"></script>

<script type="text/javascript">
	Stripe.setPublishableKey("<?php echo $this->params->get("publishable_key"); ?>");
	
	function stripeResponseHandler(status, response) {
	    if (response.error) {
	    	// show errors returned by Stripe
	        jQuery(".payment-errors").html(response.error.message);
			// re-enable the submit button
			jQuery('#stripe-submit').attr("disabled", false);
	    } else {
	        var form$ = jQuery("#stripe-payment-form");
	        // token contains id, last4, and card type
	        var token = response['id'];
	        // insert the token into the form so it gets submitted to the server
	        form$.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
	        // and submit
	        form$.get(0).submit();
	    }
	}
	
	jQuery(document).ready(function($) {
		$("#stripe-payment-form").submit(function(event) {
			// disable the submit button to prevent repeated clicks
			$('#stripe-submit').attr("disabled", "disabled");
			// send the card details to Stripe
			Stripe.createToken({
				number: $('.card-number').val(),
				cvc: $('.card-cvc').val(),
				exp_month: $('.card-expiry-month').val(),
				exp_year: $('.card-expiry-year').val()
			}, stripeResponseHandler);

			// prevent the form from submitting with the default action
			return false;
		});
	});
</script>

<style type="text/css">
	.uk-section-large {
	    padding-bottom: 10px !important;
	}
</style>

<div style="display: none;">
	<h2>Submit a payment</h2>

	<form action="<?php echo $vars->notify_url; ?>" method="POST" id="stripe-payment-form">
		<div class="form-row">
			<label>Card Number</label>
			<input type="text" size="20" autocomplete="off" class="card-number" value="<?php echo $stripe_card_number; ?>" />
		</div>

		<div class="form-row">
			<label>CVC</label>
			<input type="text" size="4" autocomplete="off" class="card-cvc" value="<?php echo $stripe_cvc; ?>" />
		</div>

		<div class="form-row">
			<label>Expiration (MM/YYYY)</label>
			<input type="text" size="2" class="card-expiry-month" value="<?php echo $stripe_month; ?>" />
			<span> / </span>
			<input type="text" size="4" class="card-expiry-year" value="<?php echo $stripe_year; ?>" />
		</div>

		<input type="hidden" name="action" value="stripe" />
		<input type="hidden" name="redirect" value="<?php echo $vars->notify_url; ?>"/>
		<input type="hidden" name="stripe_nonce" value="<?php echo rand(0, 10000); ?>"/>
		<input type="hidden" name="order_id" value="<?php echo $order_id; ?>"/>
		<input type="hidden" name="description" value="<?php echo $vars->item_name; ?>"/>

		<input type="hidden" name="amount" value="<?php echo $vars->amount * 100; ?>" />
		<input type="hidden" name="currency" value="usd" />
		<input type="hidden" name="user_email" value="<?php echo $user_email; ?>" />
		<input type="hidden" name="user_name" value="<?php echo $name; ?>" />

		<button type="submit" id="stripe-submit" class="stripe-button">Submit Payment</button>
	</form>
</div>

<div class="payment-errors"></div>

<script type="text/javascript">
	jQuery( document ).ready(function() {
		jQuery("#stripe-submit").click();
	});
</script>