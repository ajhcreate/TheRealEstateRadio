<?php
/**
 * Joomfuse views
 * @package     admin.com_joomfuse
 * @subpackage	views.associateall.tmpl.default
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('jquery.framework');
JHtml::_('bootstrap.framework');
?>
<!-- The scroll bar container -->
<div class="span12" id="associateAllUsers">
	<h1>Processing...</h1>
	<div class="progress progress-striped active" data-totalentries="<?php echo $this->num_unassociated;?>">
		<div class="bar" style="width: 0%;"></div>
	</div>
</div>

<!-- The error message container -->
<div class="span12 alert alert-error" id="associateAllErrorContainer" style="display:none;"></div>

<script type="text/javascript">
jQuery(document).ready(function(){
	jfAssociateAllTick();
});

//Make a json request to update part of the unassociated users
function jfAssociateAllTick(){
	//Migrate  users at a time
	jQuery.ajax({
		dataType: "json",
		url: 'index.php',
		data: {option:'com_joomfuse', task:'associateall.associateAll', format:'json', '<?php echo JSession::getFormToken()?>':'1'},
		success: jfAssociateAllResponseHandler,
		//@TODO: The following does not work
		//error: jfAssociateAllError('Network error: Error while reaching the site back-end')
		});
}

//Handle the ajax responses from the controller
function jfAssociateAllResponseHandler(data){
	//If an error took place, break out of the loop for good
	if(typeof data.success=="undefined" || !data.success){
		message = data.message ? data.message : 'An unknown error has taken place while associating your users. If this persists, please contact support';
		message += ' If this error persists, please contact support'; 
		jfAssociateAllError(message);
		return;
	}

	//Make sure that the progress report value is present and sane
	if(typeof data.data=="undefined" || parseInt(data.data)<0) {
		jfAssociateAllError('Invalid progress response. If this persists, please contact support');
		return;
	}

	//Calculate the progress percentage
	totalEntries = parseInt(jQuery('#associateAllUsers .progress').attr('data-totalentries'));
	totalEntries = totalEntries ? totalEntries : 1;	//Avoid division by 0
	remainingEntries = parseInt(data.data);
	progressPercentage = ((totalEntries - parseInt(remainingEntries)) * 100) / totalEntries;
	
	jQuery('#associateAllUsers .progress .bar').css('width',progressPercentage+'%');

	//Done. Trigger another tick, unless there's no more users to process
	if(remainingEntries > 0){
		jfAssociateAllTick();
	} else {
		jQuery('#associateAllUsers h1').html('Done');
	}
}

//Handle all error messages
function jfAssociateAllError(message){
	jQuery('#associateAllErrorContainer').text(message).show();
}
</script>