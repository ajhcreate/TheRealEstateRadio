/**
 * 
 */
jQuery(document).ready(function(){
	//Move the 'template row' outsite the form.
	//This way, the non-js version has the extra line to use and javascript-enabled submits do not post the template row
	jQuery('.joomfuserepeatable_template_row').appendTo('body');
	
	//Setup the 'add row' button
	jQuery('.joomfuserepeatable_addrow').click(function(){
		//Since there can be many joomfuserepeatable elements in the page, find which one this button is for
		container = jQuery(this).parents('.joomfuserepeatable_container').first();
		containerId = container.attr('id');
		
		//Locate the appropriate template row, as we've moved it outside the form and into <body>
		template_row = jQuery('.joomfuserepeatable_template_row[data-forrepeatable="'+containerId+'"]');
		if(!template_row.length){alert('error, no template row found. Please contact the developer');return;}
		
		//If jQuery.chosen is present, destroy any chosen instances before the deep clone (this should trigger only once or a bug appears)
		if(typeof jQuery.fn.chosen != 'undefined'){
			template_row.find('select').chosen('destroy').removeClass('chzn-done');
		}
		
		//DEEP Clone the template row and remove the template-related data. The tr display:none will go away later on (after the chosen lib modifications)
		clone = template_row.clone(true);
		clone.removeClass('joomfuserepeatable_template_row').removeAttr('data-forrepeatable');
		
		//Append the cloned row to the correct position in the table
		clone.appendTo(container.find('table tbody'));
		
		//Use the same handler as the ui.sortable to take care of the field names/id's
		joomfuserepeatable_reorder_names();
		
		//if jQuery chosen is active, Re-initialize chosen. 
		//We (badly) assume that the chosen selector was 'select' and the options were the default ones
		if(typeof jQuery.fn.chosen != 'undefined'){
			clone.find('select').chosen({"disable_search_threshold":10,"allow_single_deselect":true,"placeholder_text_multiple":"Select some options","placeholder_text_single":"Select an option","no_results_text":"No results match"});
		}
		
		//Display the cloned row (hidden because the template rows have display:none
		clone.slideDown();
	});
	
	//Setup the sortable lib
	jQuery('.joomfuserepeatable_container table tbody').sortable({ 
		containment: "parent",
		handle: '.sortable-handler',
		update: joomfuserepeatable_reorder_names
		//connectWith: '.joomfuserepeatable_row',
		//update : function(){alert('sorted');}
		
			});
});

/*
 * onClick handler for the 'remove' href/icons.
 * Binding to the event is done via html onclick property.
 */
function joomfuserepeatable_remove_row(element){
	jQuery(element).parents('tr').first().remove();
	joomfuserepeatable_reorder_names();
}

/*
 * Re-initialize form element names and id's. Called from add-row and the sortable onChange
 */
function joomfuserepeatable_reorder_names(){
	//Foreach joomfuserepeatable field
	jQuery('.joomfuserepeatable_container').each(function(){
		row_num = 0;
		//Foreach row of child elements
		jQuery(this).find('tr').each(function(){
			//Go through all of the field elements and look for id's/names signalling that this is an element that must be changed
			jQuery(this).find('*').each(function(){
				attr_id = jQuery(this).attr('id');
				attr_name = jQuery(this).attr('name');
				//elements that have names and with id's starting with 'jform_' are the ones we're looking for 
				if(typeof attr_name == 'undefined' || typeof attr_id == 'undefined' || attr_id.search('jform_') != 0 || attr_name.search('\\[[0-9]+\\]') < 0){
					return;
				}
				
				//Assign the new id and name values
				jQuery(this).attr('id',attr_id.replace(/\_[0-9]+\_/,'_'+row_num+'_'));
				jQuery(this).attr('name',attr_name.replace(/\[[0-9]+\]/,'['+row_num+']'));
			});
		
		row_num++;
		});
	});
}