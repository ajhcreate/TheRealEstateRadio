/**
 * 
 */

jQuery(document).ready(function(){
	//Initialize values (post-install of the first upgrade with this code we do not have any hidden field values)
	jQuery('select').each(joomfuseFieldTypeChanged);
	
	//Add the onChange event for all the ifsfield select elements.
	//Since joomfuserepeatable deep clones elements, we're going to retain this on cloned rows
	jQuery('select').change(joomfuseFieldTypeChanged);
	
	
	function joomfuseFieldTypeChanged(select){
		select = jQuery(this);
		selectedOption = select.find('option[data-ifsfieldtype]:selected');
		
		//Prune non-joomfuseprofilefield selects 
		if(selectedOption.length != 1){return;}
		
		//We ARE assuming we're part of the joomfuserepeatable structure
		select.closest('tr').find('input[data-fieldtypecontainer]').val(selectedOption.attr('data-ifsfieldtype'));
		//alert(select.closest('tr').find('input[data-fieldtypecontainer]').val());
	}
});