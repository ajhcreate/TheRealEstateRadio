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

EventbookingHelperJquery::equalHeights();

$timeFormat = $config->event_time_format ? $config->event_time_format : 'g:i a';
$rootUri    = JUri::root(true);
?>
<div class="eb-calendar">
	<ul class="eb-month-browser regpro-calendarMonthHeader clearfix">
		<li class="eb-calendar-nav">
			<a href="<?php echo $previousMonthLink; ?>" rel="nofollow"><img src="<?php echo $rootUri;?>/media/com_eventbooking/assets/images/calendar_previous.png" alt="<?php echo $listMonth[$previousMonth - 1] ;?>" /></a>
		</li>
		<li id="eb-current-month">
			<?php echo $searchMonth; ?>
			<?php echo $searchYear; ?>
		</li>
		<li class="eb-calendar-nav">
			<a href="<?php echo $nextMonthLink ; ?>" rel="nofollow"><img src="<?php echo $rootUri?>/media/com_eventbooking/assets/images/calendar_next.png" alt="<?php echo $listMonth[$nextMonth - 1];?>" /></a>
		</li>
	</ul>
	<ul class="eb-weekdays">
		<?php
		foreach ($data["daynames"] as $dayName)
		{
		?>
			<li class="eb-day-of-week regpro-calendarWeekDayHeader">
				<?php echo $dayName; ?>
			</li>
		<?php
		}
		?>
	</ul>
	<ul class="eb-days clearfix">
	<?php
		$eventIds = array();
		$dataCount = count($data["dates"]);
		$dn=0;

		for ($w=0; $w<6 && $dn < $dataCount; $w++)
		{
			$rowClass = 'eb-calendar-row-'.$w;

			for ($d=0; $d<7 && $dn < $dataCount; $d++)
			{
				$currentDay = $data["dates"][$dn];
				switch ($currentDay["monthType"])
				{
					case "prior":
					case "following":
					?>
						<li class="eb-calendarDay calendar-day regpro-calendarDay <?php echo $rowClass; ?>"></li>
					<?php
					break;
					case "current":
					?>
					<li class="eb-calendarDay calendar-day regpro-calendarDay <?php echo $rowClass; ?>">
						<div class="date day_cell"><span class="day"><?php echo $data["daynames"][$d] ?>,</span> <span class="month"><?php echo $listMonth[$month - 1]; ?></span> <?php echo $currentDay['d']; ?></div>
						<?php
						foreach ($currentDay["events"] as $key=> $event)
						{
							$color =   EventbookingHelper::getColorCodeOfEvent($event->id);
							$eventIds[] = $event->id;

							if ($config->show_thumb_in_calendar && $event->thumb && file_exists(JPATH_ROOT . '/media/com_eventbooking/images/thumbs/' . $event->thumb))
							{
								$thumbSource = $rootUri . '/media/com_eventbooking/images/thumbs/' . $event->thumb;
							}
							else
							{
								$thumbSource = $rootUri . '/media/com_eventbooking/assets/images/calendar_event.png';
							}

							$eventId = $event->id;

							if ($config->show_children_events_under_parent_event && $event->parent_id > 0)
							{
								$eventId = $event->parent_id;
							}
							?>
							<div class="date day_cell">
								<a class="eb_event_link" href="<?php echo JRoute::_(EventbookingHelperRoute::getEventRoute($eventId, isset($categoryId) ? $categoryId : 0, $Itemid)); ?>" title="<?php echo $event->title; ?>" <?php if ($color) echo 'style="background-color:#'.$color.';"' ; ?>>
									<img border="0" align="top" title="<?php echo $event->title; ?>" src="<?php echo $thumbSource; ?>" />
									<?php
										if ($config->show_event_time && strpos($event->event_date, '00:00:00') === false)
										{
											echo $event->title.' ('.JHtml::_('date', $event->event_date, $timeFormat, null).')' ;
										}
										else
										{
											echo $event->title ;
										}
									?>
								</a>
							</div>
						<?php
						}
					echo "</li>\n";
					break;
				}
				$dn++;
			}
		}
	?>
	</ul>
</div>
<?php
	if ($config->show_calendar_legend && empty($categoryId))
	{
		$categories = EventbookingHelper::getCategories($eventIds);
	?>
		<div id="eb-calendar-legend" class="clearfix">
			<ul>
				<?php
					foreach ($categories as $category)
					{
					?>
						<li>
							<span class="eb-category-legend-color" style="background: #<?php echo $category->color_code; ?>"></span>
							<a href="<?php echo JRoute::_(EventbookingHelperRoute::getCategoryRoute($category->id, $Itemid)); ?>"><?php echo $category->name; ?></a>
						</li>
					<?php
					}
				?>
			</ul>
		</div>
	<?php
	}
?>
<script type="text/javascript">
		Eb.jQuery(document).ready(function($) {
			<?php
				for ($i = 0 ; $i < $w; $i++)
				{
				?>
					$("ul.eb-days li.<?php echo 'eb-calendar-row-'.$i ?>").equalHeights(100);
				<?php
				}
			?>
		});
</script>