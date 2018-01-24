<?php
/**
 * @package        Joomla
 * @subpackage     Membership Pro
 * @author         Tuan Pham Ngoc
 * @copyright      Copyright (C) 2012 - 2017 Ossolution Team
 * @license        GNU/GPL, see LICENSE.php
 */

defined('_JEXEC') or die;

class plgSystemScheduleContent extends JPlugin
{
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_osmembership/table');
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
		$form = ob_get_contents();
		ob_end_clean();

		return array('title' => JText::_('OSM_SCHEULE_CONTENT_MANAGER'),
		             'form'  => $form,
		);
	}

	/**
	 * Store setting into database, in this case, use params field of plans table
	 *
	 * @param PlanOsMembership $row
	 * @param bool             $isNew true if create new plan, false if edit
	 */
	public function onAfterSaveSubscriptionPlan($context, $row, $data, $isNew)
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		//remove old date before save
		if (!$isNew)
		{
			$query->delete('#__osmembership_schedulecontent')
				->where('plan_id=' . (int) $row->id);
			$db->setQuery($query);
			$db->execute();
		}

		//save new data
		if (!empty($data['schedule_article_id']))
		{
			$articleIds = $data['schedule_article_id'];
			$numberDays = $data['schedule_article_number_days'];

			for ($i = 0; $n = count($articleIds), $i < $n; $i++)
			{
				$articleId = (int) $articleIds[$i];
				$numberDay = (int) $numberDays[$i];

				if ($articleId > 0 && $numberDays > 0)
				{
					$query->clear()
						->insert('#__osmembership_schedulecontent')
						->columns('plan_id, article_id, number_days')
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

		if ($option != 'com_content' || $view != 'article')
		{
			return true;
		}

		$db        = JFactory::getDbo();
		$query     = $db->getQuery(true);
		$articleId = $app->input->getInt('id');

		$query->select('*')
			->from('#__osmembership_schedulecontent')
			->where('article_id = ' . $articleId);
		$db->setQuery($query);
		$rows = $db->loadObjectList();

		if (empty($rows))
		{
			return;
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

			throw new Exception(JText::_('OSM_SCHEDULE_CONTENT_LOCKED'), 403);
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
			->from('#__osmembership_schedulecontent')
			->where('plan_id = ' . (int) $row->id)
			->order('id');
		$db->setQuery($query);
		$articles               = $db->loadObjectList();
		$numberArticlesEachTime = $this->params->get('number_new_articles_each_time', 10);
		?>
		<div class="row-fluid">
			<div class="span9">
				<table class="adminlist table table-striped" id="schedule_articles">
					<thead>
					<tr>
						<th class="nowrap center"><?php echo JText::_('OSM_TITLE'); ?></th>
						<th class="nowrap center"><?php echo JText::_('OSM_NUMBER_DAYS'); ?></th>
						<th class="nowrap center"><?php echo JText::_('OSM_REMOVE'); ?></th>
					</tr>
					</thead>
					<tbody id="additional_documents">
					<?php
					for ($i = 0, $n = (count($articles) + $numberArticlesEachTime); $i < $n; $i++)
					{
						if (isset($articles[$i]))
						{
							$article = $articles[$i];
						}
						else
						{
							$article              = new stdClass;
							$article->article_id  = 0;
							$article->number_days = null;
						}
						?>
						<tr id="schedule_article_container_<?php echo $i; ?>">
							<td><?php echo static::getArticleInput($article->article_id, 'schedule_article_' . $i); ?></td>
							<td class="center"><input type="text" class="input-mini"
							                          name="schedule_article_number_days[]"
							                          value="<?php echo $article->number_days; ?>"/></td>
							<td>
								<button type="button" class="btn btn-danger"
								        onclick="removeScheduleArticle(<?php echo $i; ?>)"><i
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
				scheduleContentSelectArticle = function (id, title, catid, object, link, lang) {
					$('#' + clickedLinkId + '_title').val(title);
					$('#' + clickedLinkId + '_id').val(id);
					jModalClose();
				}

				removeScheduleArticle = (function (id) {
					if (confirm('<?php echo JText::_('OSM_REMOVE_ITEM_CONFIRM'); ?>')) {
						$('#schedule_article_container_' + id).remove();
					}
				})

				$(document).ready(function () {
					$('#schedule_articles a.modal').click(function (event) {
						clickedLinkId = this.id;
					});
				});
			})(jQuery)
		</script>
		<?php
	}

	/**
	 * Display Display List of Documents which the current subscriber can download from his subscription
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
		$query->select('a.id, a.catid, a.title, a.alias, a.hits, c.title AS category_title, b.plan_id, b.number_days')
			->from('#__content AS a')
			->innerJoin('#__categories AS c ON a.catid = c.id')
			->innerJoin('#__osmembership_schedulecontent AS b ON a.id = b.article_id')
			->where('b.plan_id IN (' . implode(',', $accessiblePlanIds) . ')')
			->where('a.state = 1')
			->order('plan_id')
			->order('b.number_days');
		$db->setQuery($query);
		$items = $db->loadObjectList();

		if (empty($items))
		{
			return;
		}

		require_once JPATH_ROOT . '/components/com_content/helpers/route.php';
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
				$articleLink  = JRoute::_(ContentHelperRoute::getArticleRoute($item->id, $item->catid));
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
		$link = 'index.php?option=com_content&amp;view=articles&amp;layout=modal&amp;function=scheduleContentSelectArticle&amp;tmpl=component&amp;' . JSession::getFormToken() . '=1';

		$table = JTable::getInstance('content');
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
		$html[] = '<input type="hidden" id="' . $fieldId . '_id" name="schedule_article_id[]" value="' . $fieldValue . '" />';

		return implode("\n", $html);
	}
}
