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

class EventbookingModelCategory extends RADModelAdmin
{
	/**
	 * Prepare and sanitise the table data prior to saving.
	 *
	 * @param JTable $row A reference to a JTable object.
	 *
	 * @return void
	 */
	protected function prepareTable($row, $task, $sourceId = 0)
	{
		if ($row->parent > 0)
		{
			$db    = $this->getDbo();
			$query = $db->getQuery(true);
			// Calculate level
			$query->clear();
			$query->select('`level`')
				->from('#__eb_categories')
				->where('id = ' . (int) $row->parent);
			$db->setQuery($query);
			$row->level = (int) $db->loadResult() + 1;
		}
		else
		{
			$row->level = 1;
		}

		parent::prepareTable($row, $task, $sourceId);
	}

	/**
	 * A protected method to get a set of ordering conditions.
	 *
	 * @param JTable $row A JTable object.
	 *
	 * @return array An array of conditions to add to ordering queries.
	 */

	protected function getReorderConditions($row)
	{
		return array('`parent` = ' . (int) $row->parent);
	}

	/**
	 * Initialize data for new category
	 */
	public function initData()
	{
		parent::initData();

		$this->data->show_on_submit_event_form = 1;
		$this->data->submit_event_access = 1;
	}
}
