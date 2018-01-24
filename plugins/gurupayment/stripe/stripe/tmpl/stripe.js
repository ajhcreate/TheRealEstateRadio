function scroolToStripe(){
	var top = jQuery('#promocode').position().top - 300;
	jQuery(window).scrollTop( top );
}

function submitStripeForm(){
	jQuery("#digistorecartcontinue button").click();
}

function digiChangePayment($payment){
	if($payment == "stripe"){
		jQuery("#stripe-form").show();
		//scroolToStripe();
	}
	else{
		jQuery("#stripe-form").hide();
	}
}

jQuery( document ).ready(function() {
	jQuery("#stripe-form").insertAfter(".uk-alert.uk-margin-top");

	var processor = jQuery("#processor").val();

	if(processor == "stripe"){
		jQuery("#stripe-form").show();
		//scroolToStripe();
	}
});


function validateStripeCart(){
	if(jQuery("#processor").val() != "stripe"){
		//jQuery('#adminForm').submit();
		document.adminForm.submit();
		return true;
	}

	if(jQuery(".stripe_first_name").val() == ""){
		alert(jQuery("#lang-first-name").val());
		return false;
	}

	if(jQuery(".stripe_last_name").val() == ""){
		alert(jQuery("#lang-last-name").val());
		return false;
	}

	if(jQuery(".card-number").val() == ""){
		alert(jQuery("#lang-card").val());
		return false;
	}

	if(jQuery(".card_cvc").val() == ""){
		alert(jQuery("#lang-card-code").val());
		return false;
	}

	jQuery(".payment-errors").html("");
	jQuery(".stripe-loading").show();
	var public_key = jQuery("#public-key").val();
	Stripe.setPublishableKey(public_key);

	var returnCheck = Stripe.createToken({
		number: jQuery('.card-number').val(),
		cvc: jQuery('.card-cvc').val(),
		exp_month: jQuery('.card-expiry-month').val(),
		exp_year: jQuery('.card-expiry-year').val()
	}, stripeResponseHandler);
}

function validateCheckout(){
	var dateTime = new Date();
	var current_month = dateTime.getMonth();

	/*if(jQuery(".stripe_first_name").val() != "" && jQuery(".stripe_last_name").val() != "" && jQuery(".card-number").val() != "" && jQuery(".card_cvc").val() != ""){
		jQuery("#stripe-checkout").removeClass("stripe-invalid-checkout");
	}
	else{
		jQuery("#stripe-checkout").addClass("stripe-invalid-checkout");
	}*/
}

function stripeResponseHandler(status, response) {
	if (response.error) {
    	// show errors returned by Stripe
        jQuery(".payment-errors").html(response.error.message);
        jQuery(".stripe-loading").hide();

        return false;
    }
    else{
    	var token = response['id'];
    	var site_root = jQuery("#stripe-site-root").val();

    	ajax_url = site_root+"index.php?option=com_ajax&group=gurupayment&plugin=GurupaymentStripe&format=json";
		var data = {
		   	'token': token,
		   	'action': 'validateToken'
		};
		jQuery.post(ajax_url, data, function(ajax_response) {
			if(ajax_response !== true && ajax_response != 1){
				jQuery(".payment-errors").html(ajax_response);
				jQuery(".stripe-loading").hide();

				return false;
			}
			else{
				jQuery(".stripe-loading").hide();
				jQuery(".payment-errors").html("");

				jQuery("#hidden-firstname").val(jQuery(".stripe_first_name").val());
				jQuery("#hidden-lastname").val(jQuery(".stripe_last_name").val());

				ajax_url = site_root+"index.php?option=com_ajax&group=gurupayment&plugin=GurupaymentStripe&format=json";
				var data = {
				   	'firstname': jQuery(".stripe_first_name").val(),
				   	'lastname': jQuery(".stripe_last_name").val(),
				   	'action': 'setUserName'
				};
				jQuery.post(ajax_url, data, function(response) {
					//jQuery('#adminForm').submit();
					document.adminForm.submit();
				});				
			}
		});
    }
}