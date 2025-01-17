<?php
/**
 * @package            Joomla
 * @subpackage         Event Booking
 * @author             Tuan Pham Ngoc
 * @copyright          Copyright (C) 2010 - 2017 Ossolution Team
 * @license            GNU/GPL, see LICENSE.php
 */
// no direct access
defined('_JEXEC') or die;

class EventbookingViewRegistrantsHtml extends RADViewList
{
	protected function prepareView()
	{
		parent::prepareView();

		$user = JFactory::getUser();

		if (!$user->authorise('eventbooking.registrantsmanagement', 'com_eventbooking'))
		{
			if ($user->get('guest'))
			{
				JFactory::getApplication()->redirect('index.php?option=com_users&view=login&return=' . base64_encode(JUri::getInstance()->toString()));
			}
			else
			{
				JFactory::getApplication()->redirect(JUri::root(), JText::_('NOT_AUTHORIZED'));
			}
		}

		$fieldSuffix = EventbookingHelper::getFieldSuffix();
		$db          = JFactory::getDbo();
		$query       = $db->getQuery(true);
		$config      = EventbookingHelper::getConfig();

		//Get list of events
		$query->select('id, title' . $fieldSuffix . ' AS title, event_date')
			->from('#__eb_events')
			->where('published = 1')
			->order($config->sort_events_dropdown);

		if ($config->hide_past_events_from_events_dropdown)
		{
			$currentDate = $db->quote(JHtml::_('date', 'Now', 'Y-m-d'));
			$query->where('(DATE(event_date) >= ' . $currentDate . ' OR DATE(event_end_date) >= ' . $currentDate . ')');
		}

		if ($config->only_show_registrants_of_event_owner)
		{
			$query->where('created_by = ' . (int) $user->id);
		}

		$db->setQuery($query);
		$rows = $db->loadObjectList();

		$options   = array();
		$options[] = JHtml::_('select.option', 0, JText::_('EB_SELECT_EVENT'), 'id', 'title');

		if ($config->show_event_date)
		{
			for ($i = 0, $n = count($rows); $i < $n; $i++)
			{
				$row       = $rows[$i];
				$options[] = JHtml::_('select.option', $row->id,
					$row->title . ' (' . JHtml::_('date', $row->event_date, $config->date_format, null) . ')' . '', 'id', 'title');
			}
		}
		else
		{
			$options = array_merge($options, $rows);
		}

		$this->lists['filter_event_id'] = JHtml::_('select.genericlist', $options, 'filter_event_id', ' class="inputbox" onchange="submit();"', 'id', 'title',
			$this->state->filter_event_id);
		$options                        = array();
		$options[]                      = JHtml::_('select.option', -1, JText::_('EB_REGISTRATION_STATUS'));
		$options[]                      = JHtml::_('select.option', 0, JText::_('EB_PENDING'));
		$options[]                      = JHtml::_('select.option', 1, JText::_('EB_PAID'));

		if ($config->activate_waitinglist_feature)
		{
			$options[] = JHtml::_('select.option', 3, JText::_('EB_WAITING_LIST'));
		}

		$options[]                       = JHtml::_('select.option', 2, JText::_('EB_CANCELLED'));
		$this->lists['filter_published'] = JHtml::_('select.genericlist', $options, 'filter_published', ' class="input-medium" onchange="submit()" ', 'value', 'text',
			$this->state->filter_published);

		$this->config     = $config;
		$this->coreFields = EventbookingHelper::getPublishedCoreFields();

		$this->addToolbar();
	}

	/**
	 * Override addToolbar method to add custom csv export function
	 * @see RADViewList::addToolbar()
	 */
	protected function addToolbar()
	{
		require_once JPATH_ADMINISTRATOR . '/includes/toolbar.php';

		if (!EventbookingHelperAcl::canDeleteRegistrant())
		{
			$this->hideButtons[] = 'delete';
		}

		parent::addToolbar();

		JToolbarHelper::custom('resend_email', 'envelope', 'envelope', 'EB_RESEND_EMAIL', true);
		JToolbarHelper::custom('export', 'download', 'download', 'EB_EXPORT_REGISTRANTS', false);
	}
}
