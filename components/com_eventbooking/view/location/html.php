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

class EventbookingViewLocationHtml extends RADViewHtml
{
	/**
	 * Display events from a location
	 */
	public function display()
	{
		$layout = $this->getLayout();

		if ($layout == 'form' || $layout == 'popup')
		{
			$this->displayForm();

			return;
		}

		$app      = JFactory::getApplication();
		$active   = $app->getMenu()->getActive();
		$model    = $this->getModel();
		$items    = $model->getData();
		$location = EventbookingHelperDatabase::getLocation($this->input->getInt('location_id'));
		$config   = EventbookingHelper::getConfig();

		if ($config->show_list_of_registrants)
		{
			EventbookingHelperJquery::colorbox('eb-colorbox-register-lists');
		}

		if ($config->multiple_booking)
		{
			if ($this->deviceType == 'mobile')
			{
				EventbookingHelperJquery::colorbox('eb-colorbox-addcart', '100%', '450px', 'false', 'false');
			}
			else
			{
				EventbookingHelperJquery::colorbox('eb-colorbox-addcart', '800px', 'false', 'false', 'false', 'false');
			}
		}

		if ($config->show_location_in_category_view)
		{
			$width  = (int) $config->get('map_width', 800);
			$height = (int) $config->get('map_height', 600);

			if ($this->deviceType == 'mobile')
			{
				EventbookingHelperJquery::colorbox('eb-colorbox-map', '100%', $height . 'px', 'true', 'false');
			}
			else
			{
				EventbookingHelperJquery::colorbox('eb-colorbox-map', $width . 'px', $height . 'px', 'true', 'false');
			}
		}

		// Process page meta data
		$params = EventbookingHelper::getViewParams($active, array('location'));

		if (!$params->get('page_title'))
		{
			if (!empty($location->name))
			{
				$params->set('page_title', $location->name);
			}
		}

		EventbookingHelperHtml::prepareDocument($params, $location);

		// Handle breadcrumb
		$pathway = $app->getPathway();
		$pathway->addItem($location->name);

		// Set the layout to display events from this location
		$layout = $this->getLayout();

		if ($layout == '' || $layout == 'default')
		{
			if (!empty($location->layout))
			{
				$this->setLayout($location->layout);
			}
		}

		$user                  = JFactory::getUser();
		$this->items           = $items;
		$this->config          = $config;
		$this->location        = $location;
		$this->pagination      = $model->getPagination();
		$this->nullDate        = JFactory::getDbo()->getNullDate();
		$this->viewLevels      = $user->getAuthorisedViewLevels();
		$this->userId          = $user->get('id');
		$this->bootstrapHelper = new EventbookingHelperBootstrap($config->twitter_bootstrap_version);

		parent::display();
	}

	/**
	 * Display Form to allow adding location for event
	 *
	 * @throws Exception
	 */
	protected function displayForm()
	{

		if (!JFactory::getUser()->authorise('eventbooking.addlocation', 'com_eventbooking'))
		{
			JFactory::getApplication()->redirect('index.php', JText::_('EB_NO_PERMISSION'));

			return;
		}

		$document = JFactory::getDocument();
		$document->addScriptDeclaration(
			'var siteUrl = "' . EventbookingHelper::getSiteUrl() . '";'
		);

		$config = EventbookingHelper::getConfig();
		$item   = $this->model->getLocationData();

		$options   = array();
		$options[] = JHtml::_('select.option', '', JText::_('EB_SELECT_COUNTRY'), 'id', 'name');
		$countries = EventbookingHelperDatabase::getAllCountries();

		foreach ($countries as $country)
		{
			$options[] = JHtml::_('select.option', $country->name, $country->name);
		}

		$lists['country']   = JHtml::_('select.genericlist', $options, 'country', '', 'value', 'text', $item->country);
		$lists['published'] = JHtml::_('select.booleanlist', 'published', '', $item->published);

		$this->item   = $item;
		$this->lists  = $lists;
		$this->config = $config;

		$this->bootstrapHelper = new EventbookingHelperBootstrap($config->twitter_bootstrap_version);

		parent::display();
	}
}
