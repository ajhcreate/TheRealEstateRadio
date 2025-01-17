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

class EventbookingModelCategory extends EventbookingModelList
{
	/**
	 * Builds a generic ORDER BY clause based on the model's state
	 *
	 * @param JDatabaseQuery $query
	 *
	 * @return $this
	 */
	protected function buildQueryOrder(JDatabaseQuery $query)
	{
		$params = JFactory::getApplication()->getParams();

		if ($filterOrder = $params->get('menu_filter_order'))
		{
			$this->setState('filter_order', $filterOrder);
		}

		if ($filterOrderDir = $params->get('menu_filter_order_dir'))
		{
			$this->setState('filter_order_Dir', $filterOrderDir);
		}

		return parent::buildQueryOrder($query);
	}
}
