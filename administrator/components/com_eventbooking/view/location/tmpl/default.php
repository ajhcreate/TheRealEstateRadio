<?php
/**
 * @package            Joomla
 * @subpackage         Event Booking
 * @author             Tuan Pham Ngoc
 * @copyright          Copyright (C) 2010 - 2017 Ossolution Team
 * @license            GNU/GPL, see LICENSE.php
 */
// no direct access
defined( '_JEXEC' ) or die;

JHtml::_('behavior.framework') ;

$config = EventbookingHelper::getConfig();
$mapApiKye = $config->get('map_api_key', 'AIzaSyDIq19TVV4qOX2sDBxQofrWfjeA7pebqy4');

if ($this->item->id)
{
	$coordinates = $this->item->lat.','.$this->item->long;
}
else
{
	$http     = JHttpFactory::getHttp();
	$url      = "https://maps.googleapis.com/maps/api/geocode/json?address=" . str_replace(' ', '+', $config->default_country) . "&key=" . $mapApiKye;
	$response = $http->get($url);
	if ($response->code == 200)
	{
		$output_deals = json_decode($response->body);
		$latLng = $output_deals->results[0]->geometry->location;
		$coordinates = $latLng->lat.','.$latLng->lng;
	}
	else
	{
		$coordinates = '37.09024,-95.712891';
	}
}

$editor = JFactory::getEditor();
?>
<script type="text/javascript">
	Joomla.submitbutton = function(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			Joomla.submitform( pressbutton );
			return;
		} else {
			//Should validate the information here
			if (form.name.value == "") {
				alert("<?php echo JText::_('EN_ENTER_LOCATION'); ?>");
				form.name.focus();
				return ;
			}
			Joomla.submitform( pressbutton );
		}
	}
</script>
<script src="https://maps.google.com/maps/api/js?key=<?php echo $mapApiKye; ?>" type="text/javascript"></script>
<script type="text/javascript">
	var map;
	var geocoder;
	var marker;

	Joomla.submitbutton = function(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			Joomla.submitform( pressbutton );
			return;
		} else {
			//Should validate the information here
			if (form.name.value == "") {
				alert("<?php echo JText::_('EN_ENTER_LOCATION'); ?>");
				form.name.focus();
				return ;
			}
			Joomla.submitform( pressbutton );
		}
	}
	function initialize() {
		geocoder = new google.maps.Geocoder();
		var mapDiv = document.getElementById('map-canvas');
		// Create the map object
		map = new google.maps.Map(mapDiv, {
				center: new google.maps.LatLng(<?php  echo $coordinates; ?>),
				zoom: 10,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				streetViewControl: false
		});
		// Create the default marker icon
		marker = new google.maps.Marker({
			map: map,
			position: new google.maps.LatLng(<?php echo $coordinates;?>),
			draggable: true
		});
		// Add event to the marker
		google.maps.event.addListener(marker, 'drag', function() {
			geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					if (results[0]) {
						document.getElementById('address').value = results[0].formatted_address;
						document.getElementById('coordinates').value = marker.getPosition().toUrlValue();
					}
				}
			});
		});
	}
	function getLocationFromAddress() {
		var address = document.getElementById('address').value;
		geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				marker.setPosition(results[0].geometry.location);
				$('coordinates').value = results[0].geometry.location.lat().toFixed(7) + ',' + results[0].geometry.location.lng().toFixed(7);
			} else {
				alert('We\'re sorry but your location was not found.');
			}
		});
	}
	// Initialize google map
	google.maps.event.addDomListener(window, 'load', initialize);
	// Search for addresses
	function getLocations(term) {
		var content = $('eventmaps_results');
		address = $('address').getSize();
		$('eventmaps_results').setStyle('width', address.x - 21);
		$('eventmaps_results').style.display = 'none';
		$$('#eventmaps_results li').each(function(el) {
			el.dispose();
		});
		if (term != '') {
			geocoder.geocode( {'address': term }, function(results, status) {
				if (status == 'OK') {
					results.each(function(item) {
						theli = new Element('li');
						thea = new Element('a', {
							href: 'javascript:void(0)',
							'text': item.formatted_address
						});
						thea.addEvent('click', function() {
							$('address').value = item.formatted_address;
							$('coordinates').value = item.geometry.location.lat().toFixed(7) + ',' + item.geometry.location.lng().toFixed(7);
							var location = new google.maps.LatLng(item.geometry.location.lat().toFixed(7), item.geometry.location.lng().toFixed(7));
							marker.setPosition(location);
							map.setCenter(location);
							$('eventmaps_results').style.display = 'none';
						});
						thea.inject(theli);
						theli.inject(content);
					});
					$('eventmaps_results').style.display = '';
				}
			});
		}
	}
	function clearLocations() {
		setTimeout( function () {
			$('eventmaps_results').style.display = 'none';
		},1000);
	}
</script>
<form action="index.php?option=com_eventbooking&view=location" method="post" name="adminForm" id="adminForm" class="form form-horizontal">
<div class="row-fluid">
	<div class="span6">
		<div class="control-group">
			<label class="control-label">
				<?php echo JText::_('EB_NAME'); ?>
			</label>
			<div class="controls">
				<input class="text_area" type="text" name="name" id="name" size="50" maxlength="250" value="<?php echo $this->item->name;?>" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">
				<?php echo JText::_('EB_LAYOUT'); ?>
			</label>
			<div class="controls">
				<?php echo $this->lists['layout']; ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">
				<?php echo JText::_('EB_CREATED_BY'); ?>
			</label>
			<div class="controls">
				<?php echo EventbookingHelper::getUserInput($this->item->user_id) ; ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">
				<?php echo JText::_('EB_ADDRESS'); ?>
			</label>
			<div class="controls">
				<input class="input-xlarge" type="text" name="address" id="address" size="70" autocomplete="off" onkeyup="getLocations(this.value)" onblur="clearLocations();" maxlength="250" value="<?php echo $this->item->address;?>" />
				<ul id="eventmaps_results" style="display:none;"></ul>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">
				<?php echo JText::_('EB_CITY'); ?>
			</label>
			<div class="controls">
				<input class="text_area" type="text" name="city" id="city" size="30" maxlength="250" value="<?php echo $this->item->city;?>" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">
				<?php echo JText::_('EB_STATE'); ?>
			</label>
			<div class="controls">
				<input class="text_area" type="text" name="state" id="state" size="30" maxlength="250" value="<?php echo $this->item->state;?>" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">
				<?php echo JText::_('EB_ZIP'); ?>
			</label>
			<div class="controls">
				<input class="text_area" type="text" name="zip" id="zip" size="20" maxlength="250" value="<?php echo $this->item->zip;?>" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">
				<?php echo JText::_('EB_COUNTRY'); ?>
			</label>
			<div class="controls">
				<?php echo $this->lists['country'] ; ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">
				<?php echo JText::_('EB_COORDINATES'); ?>
			</label>
			<div class="controls">
				<input class="text_area" type="text" name="coordinates" id="coordinates" size="30" maxlength="250" value="<?php echo $this->item->lat.','.$this->item->long;?>" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label"><?php echo JText::_('EB_IMAGE'); ?></label>
			<div class="controls">
				<?php echo EventbookingHelperHtml::getMediaInput($this->item->image, 'image'); ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">
				<?php echo  JText::_('EB_DESCRIPTION'); ?>
			</label>
			<div class="controls">
				<?php echo $editor->display( 'description',  $this->item->description , '100%', '250', '90', '10' ) ; ?>
			</div>
		</div>
		<?php
			if (JLanguageMultilang::isEnabled())
			{
			?>
				<div class="control-group">
					<label class="control-label">
						<?php echo JText::_('EB_LANGUAGE'); ?>
					</label>
					<div class="controls">
						<?php echo $this->lists['language'] ; ?>
					</div>
				</div>
			<?php
			}
		?>
		<div class="control-group">
			<label class="control-label">
				<?php echo JText::_('EB_PUBLISHED') ; ?>
			</label>
			<div class="controls">
				<?php echo $this->lists['published']; ?>
			</div>
		</div>
	</div>
	<div class="span6">
		<div class="control-group">
			<input type="button" onclick="getLocationFromAddress();" value="<?php echo JText::_('EB_PINPOINT'); ?> &raquo;" />
			<br/><br/>
			<div id="map-canvas" style="width: 95%; height: 400px"></div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
	<input type="hidden" name="id" value="<?php echo $this->item->id; ?>" />
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_( 'form.token' ); ?>
</form>
<style>
	#map-canvas img{
		max-width:none !important;
	}
</style>