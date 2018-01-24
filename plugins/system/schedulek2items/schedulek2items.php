<?php
/**
 * @package        Joomla
 * @subpackage     Membership Pro
 * @author         Tuan Pham Ngoc
 * @copyright      Copyright (C) 2012 - 2016 Ossolution Team
 * @license        GNU/GPL, see LICENSE.php
 */

defined('_JEXEC') or die;

class plgSystemScheduleK2items extends JPlugin
{
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);

		JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_k2/tables');
	}

	/**
	 * Render setting form
	 *
	 * @param PlanOSMembership $row
	 *
	 * @return array
	 */
	public function onEditSubscriptionPlan($row)
	{
		ob_start();
		$this->drawSettingForm($row);
		$form = ob_get_clean();

		return array('title' => JText::_('OSM_SCHEULE_K2ITEM_MANAGER'),
		             'form'  => $form,
		);
	}

	/**
	 * Store setting into database, in this case, use params field of plans table
	 *
	 * @param OSMembershipTablePlan $row
	 * @param bool                  $isNew true if create new plan, false if edit
	 */
	public function onAfterSaveSubscriptionPlan($context, $row, $data, $isNew)
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		//remove old date before save
		if (!$isNew)
		{
			$query->delete('#__osmembership_schedule_k2items')
				->where('plan_id = ' . (int) $row->id);
			$db->setQuery($query);
			$db->execute();
		}

		//save new data
		if (!empty($data['schedule_k2item_id']))
		{
			$articleIds = $data['schedule_k2item_id'];
			$numberDays = $data['schedule_k2item_number_days'];

			for ($i = 0; $n = count($articleIds), $i < $n; $i++)
			{
				$articleId = (int) $articleIds[$i];
				$numberDay = (int) $numberDays[$i];

				if ($articleId > 0 && $numberDays > 0)
				{

					$query->clear()
						->insert('#__osmembership_schedule_k2items')
						->columns('plan_id, item_id, number_days')
						->values("$row->id, $articleId, $numberDay");
					$db->setQuery($query);
					$db->execute();
				}

			}

		}
	}

	/**
	 * Render setting form
	 *
	 * @param JTable $row
	 *
	 * @return array
	 */
	public function onProfileDisplay($row)
	{
		ob_start();
		$this->drawScheduleContent($row);
		$form = ob_get_contents();
		ob_end_clean();

		return array('title' => JText::_('OSM_MY_SCHEDULE_CONTENT'),
		             'form'  => $form,
		);
	}

	/**
	 * Protect access to articles
	 *
	 * @return bool
	 *
	 * @throws Exception
	 */
	public function onAfterRoute()
	{
		$app = JFactory::getApplication();

		if ($app->isAdmin())
		{
			return true;
		}

		$user = JFactory::getUser();

		if ($user->authorise('core.admin'))
		{
			return true;
		}

		$option = $app->input->getCmd('option');
		$view   = $app->input->getCmd('view');
		$task   = $app->input->getCmd('task');

		if ($option != 'com_k2' || ($view != 'item' && $task != 'download'))
		{
			return true;
		}

		$db       = JFactory::getDbo();
		$query    = $db->getQuery(true);
		$k2ItemId = $app->input->getInt('id');

		$query->select('*')
			->from('#__osmembership_schedule_k2items')
			->where('item_id = ' . $k2ItemId);
		$db->setQuery($query);
		$rows = $db->loadObjectList();

		if (empty($rows))
		{
			return true;
		}

		require_once JPATH_ROOT . '/components/com_osmembership/helper/subscription.php';

		$canAccess     = false;
		$subscriptions = OSMembershipHelperSubscription::getUserSubscriptionsInfo();

		foreach ($rows as $row)
		{
			if (isset($subscriptions[$row->plan_id]))
			{
				$subscription = $subscriptions[$row->plan_id];

				if ($subscription->active_in_number_days >= $row->number_days)
				{
					$canAccess = true;
					break;
				}
			}
		}

		if (!$canAccess)
		{
			require_once JPATH_ROOT . '/components/com_osmembership/helper/helper.php';

			OSMembershipHelper::loadLanguage();

			throw new Exception(JText::_('OSM_SCHEDULE_ITEM_LOCKED'), 403);
		}
	}

	/**
	 * Display form allows users to change settings on subscription plan add/edit screen
	 *
	 * @param object $row
	 */
	private function drawSettingForm($row)
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('*')
			->from('#__osmembership_schedule_k2items')
			->where('plan_id = ' . (int) $row->id)
			->order('id');
		$db->setQuery($query);
		$k2Items             = $db->loadObjectList();
		$numberItemsEachTime = $this->params->get('number_new_articles_each_time', 10);
		?>
		<div class="row-fluid">
			<div class="span9">
				<table class="adminlist table table-striped" id="schedule_k2item">
					<thead>
					<tr>
						<th class="nowrap center"><?php echo JText::_('OSM_TITLE'); ?></th>
						<th class="nowrap center"><?php echo JText::_('OSM_NUMBER_DAYS'); ?></th>
						<th class="nowrap center"><?php echo JText::_('OSM_REMOVE'); ?></th>
					</tr>
					</thead>
					<tbody id="additional_documents">
					<?php
					for ($i = 0, $n = (count($k2Items) + $numberItemsEachTime); $i < $n; $i++)
					{
						if (isset($k2Items[$i]))
						{
							$k2Item = $k2Items[$i];
						}
						else
						{
							$k2Item              = new stdClass;
							$k2Item->item_id     = 0;
							$k2Item->number_days = null;
						}
						?>
						<tr id="schedule_k2item_container_<?php echo $i; ?>">
							<td><?php echo static::getArticleInput($k2Item->item_id, 'schedule_k2item_' . $i); ?></td>
							<td class="center"><input type="text" class="input-mini"
							                          name="schedule_k2item_number_days[]"
							                          value="<?php echo $k2Item->number_days; ?>"/></td>
							<td>
								<button type="button" class="btn btn-danger"
								        onclick="removeScheduleItem(<?php echo $i; ?>)"><i
										class="icon-remove"></i><?php echo JText::_('OSM_REMOVE'); ?></button>
							</td>
						</tr>
						<?php
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
		<script language="JavaScript">
			var clickedLinkId = '';
			(function ($) {
				jSelectItem = function (id, title, catid, object, link, lang) {
					$('#' + clickedLinkId + '_title').val(title);
					$('#' + clickedLinkId + '_id').val(id);
					jModalClose();
				}

				removeScheduleItem = (function (id) {
					if (confirm('<?php echo JText::_('OSM_REMOVE_ITEM_CONFIRM'); ?>')) {
						$('#schedule_k2item_container_' + id).remove();
					}
				})

				$(document).ready(function () {
					$('#schedule_k2item a.modal').click(function (event) {
						clickedLinkId = this.id;
					});
				});
			})(jQuery)
		</script>
		<?php
	}

	/**
	 * Display Display List of K2 items which the current subscriber can download from his subscription
	 *
	 * @param object $row
	 */
	private function drawScheduleContent($row)
	{
		$config = OSMembershipHelper::getConfig();

		$subscriptions = OSMembershipHelperSubscription::getUserSubscriptionsInfo();

		if (empty($subscriptions))
		{
			return;
		}

		$accessiblePlanIds = array_keys($subscriptions);

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('a.id, a.catid, a.title, a.alias, a.hits, c.name AS category_title, b.plan_id, b.number_days')
			->from('#__k2_items AS a')
			->innerJoin('#__k2_categories AS c ON a.catid = c.id')
			->innerJoin('#__osmembership_schedule_k2items AS b ON a.id = b.item_id')
			->where('b.plan_id IN (' . implode(',', $accessiblePlanIds) . ')')
			->order('b.number_days');
		$db->setQuery($query);
		$items = $db->loadObjectList();

		if (empty($items))
		{
			return;
		}

		require_once JPATH_ROOT . '/components/com_k2/helpers/route.php';
		?>
		<table class="adminlist table table-striped" id="adminForm">
			<thead>
			<tr>
				<th class="title"><?php echo JText::_('OSM_TITLE'); ?></th>
				<th class="title"><?php echo JText::_('OSM_CATEGORY'); ?></th>
				<th class="title center"><?php echo JText::_('OSM_ACCESSIBLE_ON'); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php
			foreach ($items as $item)
			{
				$articleLink  = JRoute::_(K2HelperRoute::getItemRoute($item->id, $item->catid));
				$subscription = $subscriptions[$item->plan_id];
				$date         = JFactory::getDate($subscription->active_from_date);
				$date->add(new DateInterval('P' . $item->number_days . 'D'));
				?>
				<tr>
					<td>
						<i class="icon-file"></i>
						<?php
						if ($subscription->active_in_number_days >= $item->number_days)
						{
							?>
							<a href="<?php echo $articleLink ?>" target="_blank"><?php echo $item->title; ?></a>
							<?php
						}
						else
						{
							echo $item->title . ' <span class="label">' . JText::_('OSM_LOCKED') . '</span>';
						}
						?>
					</td>
					<td><?php echo $item->category_title; ?></td>
					<td class="center">
						<?php echo JHtml::_('date', $date->format('Y-m-d H:i:s'), $config->date_format); ?>
					</td>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
		<?php
	}

	/**
	 * Generate article selection box
	 *
	 * @param int    $fieldValue
	 * @param string $fieldId
	 *
	 * @return string
	 */
	private static function getArticleInput($fieldValue, $fieldId)
	{

		// Initialize variables.
		JHtml::_('behavior.modal');
		$link = 'index.php?option=com_k2&amp;view=items&amp;task=element&amp;layout=modal&amp;tmpl=component&amp;' . JSession::getFormToken() . '=1';

		$table = JTable::getInstance('k2item', 'Table');

		if ($fieldValue)
		{
			$table->load($fieldValue);
		}
		else
		{
			$table->title = '';
		}

		$html   = array();
		$html[] = '<div class="input-prepend input-append">';
		$html[] = '<div class="media-preview add-on"><span title="" class="hasTipPreview"><span class="icon-eye"></span></span></div>';
		$html[] = '	<input type="text" disabled="disabled" class="input-small hasTipImgpath" id="' . $fieldId . '_title"' . ' value="' . htmlspecialchars($table->title, ENT_COMPAT, 'UTF-8') . '"' .
			' disabled="disabled"/>';
		// Create the user select button.
		$html[] = '<a id="' . $fieldId . '" title="" rel="{handler: \'iframe\', size: {x: 800, y: 500}}" data-toggle="modal" role="button" class="btn hasTooltip modal" href="' . $link . '" data-original-title data-original-title="Select or Change article"><span class="icon-file"></span> Select</a>';
		$html[] = '</div>';
		// Create the real field, hidden, that stored the user id.
		$html[] = '<input type="hidden" id="' . $fieldId . '_id" name="schedule_k2item_id[]" value="' . $fieldValue . '" />';

		return implode("\n", $html);
	}
}
