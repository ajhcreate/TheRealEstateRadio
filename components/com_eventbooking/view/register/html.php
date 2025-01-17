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

class EventbookingViewRegisterHtml extends RADViewHtml
{
	/**
	 * Display interface to user
	 */
	public function display()
	{
		// Load common js code
		$document = JFactory::getDocument();
		$document->addScriptDeclaration(
			'var siteUrl = "' . EventbookingHelper::getSiteUrl() . '";'
		);
		$document->addScript(JUri::root(true) . '/media/com_eventbooking/assets/js/paymentmethods.js');
		EventbookingHelper::addLangLinkForAjax();

		$config                = EventbookingHelper::getConfig();
		$this->bootstrapHelper = new EventbookingHelperBootstrap($config->twitter_bootstrap_version);
		$layout                = $this->getLayout();

		if ($layout == 'cart')
		{
			$this->displayCart();

			return;
		}

		$input   = $this->input;
		$eventId = $input->getInt('event_id', 0);
		$event   = EventbookingHelperDatabase::getEvent($eventId);

		$user         = JFactory::getUser();
		$accessLevels = $user->getAuthorisedViewLevels();

		if (empty($event)
			|| !$event->published
			|| !in_array($event->access, $accessLevels)
			|| !in_array($event->registration_access, $accessLevels)
		)
		{
			if (!$user->id && $event && $event->published)
			{
				JFactory::getApplication()->redirect(JRoute::_('index.php?option=com_users&view=login&return=' . base64_encode(JUri::getInstance()->toString())), JText::_('EB_LOGIN_TO_REGISTER'));
			}
			else
			{
				JFactory::getApplication()->redirect('index.php', JText::_('EB_ERROR_REGISTRATION'));
			}
		}

		if (!EventbookingHelper::acceptRegistration($event))
		{
			if ($event->activate_waiting_list == 2)
			{
				$waitingList = $config->activate_waitinglist_feature;
			}
			else
			{
				$waitingList = $event->activate_waiting_list;
			}
			
			if ($event->cut_off_date != JFactory::getDbo()->getNullDate())
			{
				$registrationOpen = ($event->cut_off_minutes < 0);
			}
			else
			{
				$registrationOpen = ($event->number_event_dates > 0);
			}

			if (!$waitingList || !$registrationOpen)
			{
				JFactory::getApplication()->redirect(JUri::root(), JText::_('EB_ERROR_REGISTRATION'));
			}
		}

		if ($event->event_password)
		{
			$passwordPassed = JFactory::getSession()->get('eb_passowrd_' . $event->id, 0);

			if (!$passwordPassed)
			{
				$return = base64_encode(JUri::getInstance()->toString());
				JFactory::getApplication()->redirect(JRoute::_('index.php?option=com_eventbooking&view=password&event_id=' . $event->id . '&return=' . $return . '&Itemid=' . $input->getInt('Itemid', 0), false));
			}
		}

		// Page title
		$pageTitle = JText::_('EB_EVENT_REGISTRATION');
		$pageTitle = str_replace('[EVENT_TITLE]', $event->title, $pageTitle);
		$document->setTitle($pageTitle);

		// Breadcrumb
		$this->generateBreadcrumb($event, $layout);

		switch ($layout)
		{
			case 'group':
				$this->displayGroupForm($event, $input);
				break;
			default:
				$this->displayIndividualRegistrationForm($event, $input);
				break;
		}
	}

	/**
	 * Display individual registration Form
	 *
	 * @param object   $event
	 * @param RADInput $input
	 *
	 * @throws Exception
	 */
	protected function displayIndividualRegistrationForm($event, $input)
	{
		$config    = EventbookingHelper::getConfig();
		$user      = JFactory::getUser();
		$userId    = $user->get('id');
		$eventId   = $event->id;
		$rowFields = EventbookingHelper::getFormFields($eventId, 0);

		foreach ($rowFields as $rowField)
		{
			if ($rowField->fieldtype == 'File')
			{
				JFactory::getDocument()->addScript(JUri::root(true) . '/media/com_eventbooking/assets/js/ajaxupload.js');
				break;
			}
		}

		if (($event->event_capacity > 0) && ($event->event_capacity <= $event->total_registrants))
		{
			$waitingList = true;
		}
		else
		{
			$waitingList = false;
		}

		$captchaInvalid = $input->getInt('captcha_invalid', 0);

		if ($captchaInvalid)
		{
			$data = $input->post->getData();
		}
		else
		{
			$data = EventbookingHelper::getFormData($rowFields, $eventId, $userId, $config);

			// IN case there is no data, get it from URL (get for example)
			if (empty($data))
			{
				$data = $input->getData();
			}
		}

		if ($userId && !isset($data['first_name']))
		{
			//Load the name from Joomla default name
			$name = $user->name;

			if ($name)
			{
				$pos = strpos($name, ' ');
				if ($pos !== false)
				{
					$data['first_name'] = substr($name, 0, $pos);
					$data['last_name']  = substr($name, $pos + 1);
				}
				else
				{
					$data['first_name'] = $name;
					$data['last_name']  = '';
				}
			}
		}

		if ($userId && !isset($data['email']))
		{
			$data['email'] = $user->email;
		}

		if ($config->get('auto_populate_form_data') === '0')
		{
			$data = array();
		}

		if (!isset($data['country']) || !$data['country'])
		{
			$data['country'] = $config->default_country;
		}

		//Get data
		$form = new RADForm($rowFields);

		if ($captchaInvalid)
		{
			$useDefault = false;
		}
		else
		{
			$useDefault = true;
		}

		$form->bind($data, $useDefault);
		$form->prepareFormFields('calculateIndividualRegistrationFee();');
		$paymentMethod = $input->post->getString('payment_method', os_payments::getDefautPaymentMethod(trim($event->payment_methods)));

		if ($waitingList)
		{
			if (is_callable('EventbookingHelperOverrideHelper::calculateIndividualRegistrationFees'))
			{
				$fees = EventbookingHelperOverrideHelper::calculateIndividualRegistrationFees($event, $form, $data, $config, null);
			}
			else
			{
				$fees = EventbookingHelper::calculateIndividualRegistrationFees($event, $form, $data, $config, null);
			}
		}
		else
		{
			if (is_callable('EventbookingHelperOverrideHelper::calculateIndividualRegistrationFees'))
			{
				$fees = EventbookingHelperOverrideHelper::calculateIndividualRegistrationFees($event, $form, $data, $config, $paymentMethod);
			}
			else
			{
				$fees = EventbookingHelper::calculateIndividualRegistrationFees($event, $form, $data, $config, $paymentMethod);
			}
		}

		$expMonth            = $input->post->getInt('exp_month', date('m'));
		$expYear             = $input->post->getInt('exp_year', date('Y'));
		$lists['exp_month']  = JHtml::_('select.integerlist', 1, 12, 1, 'exp_month', ' class="input-small" ', $expMonth, '%02d');
		$currentYear         = date('Y');
		$lists['exp_year']   = JHtml::_('select.integerlist', $currentYear, $currentYear + 10, 1, 'exp_year', 'class="input-small"', $expYear);
		$data['coupon_code'] = $input->post->getString('coupon_code', '');

		$methods            = os_payments::getPaymentMethods(trim($event->payment_methods));
		$options            = array();
		$options[]          = JHtml::_('select.option', 'Visa', 'Visa');
		$options[]          = JHtml::_('select.option', 'MasterCard', 'MasterCard');
		$options[]          = JHtml::_('select.option', 'Discover', 'Discover');
		$options[]          = JHtml::_('select.option', 'Amex', 'American Express');
		$lists['card_type'] = JHtml::_('select.genericlist', $options, 'card_type', ' class="inputbox" ', 'value', 'text');

		if (($event->enable_coupon == 0 && $config->enable_coupon) || $event->enable_coupon == 1 || $event->enable_coupon == 3)
		{
			$enableCoupon = 1;
		}
		else
		{
			$enableCoupon = 0;
		}

		// Check to see if there is payment processing fee or not
		$showPaymentFee = false;

		foreach ($methods as $method)
		{
			if ($method->paymentFee)
			{
				$showPaymentFee = true;
				break;
			}
		}

		// Add support for deposit payment
		$paymentType = $input->post->getInt('payment_type', $config->get('default_payment_type', 0));

		if ($config->activate_deposit_feature && $event->deposit_amount > 0)
		{
			$options               = array();
			$options[]             = JHtml::_('select.option', 0, JText::_('EB_FULL_PAYMENT'));
			$options[]             = JHtml::_('select.option', 1, JText::_('EB_DEPOSIT_PAYMENT'));
			$lists['payment_type'] = JHtml::_('select.genericlist', $options, 'payment_type', ' class="input-large" onchange="showDepositAmount(this);" ', 'value', 'text',
				$paymentType);
			$depositPayment        = 1;
		}
		else
		{
			$depositPayment = 0;
		}

		$this->loadCaptcha();

		// Reset some values if waiting list is activated
		if ($waitingList)
		{
			$enableCoupon   = false;
			$depositPayment = false;
			$paymentType    = false;
			$showPaymentFee = false;
		}
		else
		{
			$form->setEventId($eventId);
		}

		if ($event->has_multiple_ticket_types)
		{
			$this->ticketTypes = EventbookingHelperData::getTicketTypes($event->id);
		}

		// Assign these parameters
		$this->paymentMethod        = $paymentMethod;
		$this->config               = $config;
		$this->event                = $event;
		$this->methods              = $methods;
		$this->enableCoupon         = $enableCoupon;
		$this->userId               = $userId;
		$this->lists                = $lists;
		$this->depositPayment       = $depositPayment;
		$this->paymentType          = $paymentType;
		$this->message              = EventbookingHelper::getMessages();
		$this->fieldSuffix          = EventbookingHelper::getFieldSuffix();
		$this->form                 = $form;
		$this->totalAmount          = $fees['total_amount'];
		$this->taxAmount            = $fees['tax_amount'];
		$this->discountAmount       = $fees['discount_amount'];
		$this->lateFee              = $fees['late_fee'];
		$this->depositAmount        = $fees['deposit_amount'];
		$this->amount               = $fees['amount'];
		$this->paymentProcessingFee = $fees['payment_processing_fee'];
		$this->showPaymentFee       = $showPaymentFee;
		$this->discountRate         = $fees['discount_rate'];
		$this->bundleDiscountAmount = $fees['bundle_discount_amount'];
		$this->waitingList          = $waitingList;

		parent::display();
	}

	/**
	 * Display Group Registration Form
	 *
	 * @param object   $event
	 * @param RADInput $input
	 *
	 * @throws Exception
	 */
	protected function displayGroupForm($event, $input)
	{
		$config = EventbookingHelper::getConfig();
		$user   = JFactory::getUser();
		$db     = JFactory::getDbo();
		$query  = $db->getQuery(true);

		// Check to see whether we need to load ajax file upload script
		$query->select('COUNT(*)')
			->from('#__eb_fields')
			->where('fieldtype="File"')
			->where('published=1')
			->where(' `access` IN (' . implode(',', $user->getAuthorisedViewLevels()) . ')');

		if ($config->custom_field_by_category)
		{
			//Get main category of the event
			$categoryQuery = $db->getQuery(true);
			$categoryQuery->select('category_id')
				->from('#__eb_event_categories')
				->where('event_id = ' . $event->id)
				->where('main_category = 1');
			$db->setQuery($categoryQuery);
			$categoryId = (int) $db->loadResult();

			$query->where('(category_id = -1 OR id IN (SELECT field_id FROM #__eb_field_categories WHERE category_id=' . $categoryId . '))');
		}
		else
		{
			$negEventId = -1 * $event->id;
			$subQuery   = $db->getQuery(true);
			$subQuery->select('field_id')
				->from('#__eb_field_events')
				->where("(event_id = $event->id OR (event_id < 0 AND event_id != $negEventId))");

			$query->where(' (event_id = -1 OR id IN (' . (string) $subQuery . '))');
		}

		$db->setQuery($query);
		$totalFileFields = $db->loadResult();

		if ($totalFileFields)
		{
			JFactory::getDocument()->addScript(JUri::root(true) . '/media/com_eventbooking/assets/js/ajaxupload.js');
		}

		$this->event           = $event;
		$this->message         = EventbookingHelper::getMessages();
		$this->fieldSuffix     = EventbookingHelper::getFieldSuffix();
		$this->config          = $config;
		$this->captchaInvalid  = $input->get('captcha_invalid', 0);
		$this->showBillingStep = EventbookingHelper::showBillingStep($event->id);

		if (($event->event_capacity > 0) && ($event->event_capacity <= $event->total_registrants))
		{
			$waitingList = true;
		}
		else
		{
			$waitingList = false;
		}

		$this->bypassNumberMembersStep = false;

		if ($event->max_group_number > 0 && ($event->max_group_number == $event->min_group_number))
		{
			$session = JFactory::getSession();
			$session->set('eb_number_registrants', $event->max_group_number);
			$this->bypassNumberMembersStep = true;
		}

		$this->waitingList = $waitingList;

		$this->loadCaptcha(true);

		EventbookingHelperJquery::colorbox('eb-colorbox-term');

		parent::display();
	}

	/**
	 * Display registration page in case shopping cart is enabled
	 *
	 * @throws Exception
	 */
	protected function displayCart()
	{
		$app    = JFactory::getApplication();
		$input  = $this->input;
		$db     = JFactory::getDbo();
		$config = EventbookingHelper::getConfig();
		$user   = JFactory::getUser();
		$userId = $user->get('id');
		$cart   = new EventbookingHelperCart();
		$items  = $cart->getItems();

		if (!count($items))
		{
			$url = JRoute::_('index.php?option=com_eventbooking&Itemid=' . $input->getInt('Itemid', 0));
			$app->redirect($url, JText::_('EB_NO_EVENTS_FOR_CHECKOUT'));
		}

		$eventId   = (int) $items[0];
		$query     = $db->getQuery(true);
		$rowFields = EventbookingHelper::getFormFields(0, 4);

		// Including ajax file upload if necessary
		foreach ($rowFields as $rowField)
		{
			if ($rowField->fieldtype == 'File')
			{
				JFactory::getDocument()->addScript(JUri::root(true) . '/media/com_eventbooking/assets/js/ajaxupload.js');
				break;
			}
		}

		$captchaInvalid = $input->getInt('captcha_invalid', 0);

		if ($captchaInvalid)
		{
			$data = $input->post->getData();
		}
		else
		{
			$data = EventbookingHelper::getFormData($rowFields, $eventId, $userId, $config);

			// IN case there is no data, get it from URL (get for example)
			if (empty($data))
			{
				$data = $input->getData();
			}
		}

		if ($userId && !isset($data['first_name']))
		{
			//Load the name from Joomla default name
			$name = $user->name;

			if ($name)
			{
				$pos = strpos($name, ' ');

				if ($pos !== false)
				{
					$data['first_name'] = substr($name, 0, $pos);
					$data['last_name']  = substr($name, $pos + 1);
				}
				else
				{
					$data['first_name'] = $name;
					$data['last_name']  = '';
				}
			}
		}

		if ($userId && !isset($data['email']))
		{
			$data['email'] = $user->email;
		}

		if ($config->get('auto_populate_form_data') === '0')
		{
			$data = array();
		}

		if (!isset($data['country']) || !$data['country'])
		{
			$data['country'] = $config->default_country;
		}

		//Get data
		$form = new RADForm($rowFields);

		if ($captchaInvalid)
		{
			$useDefault = false;
		}
		else
		{
			$useDefault = true;
		}

		$form->bind($data, $useDefault);
		$form->prepareFormFields('calculateCartRegistrationFee();');
		$paymentMethod       = $input->post->getString('payment_method', os_payments::getDefautPaymentMethod());
		$expMonth            = $input->post->getInt('exp_month', date('m'));
		$expYear             = $input->post->getInt('exp_year', date('Y'));
		$lists['exp_month']  = JHtml::_('select.integerlist', 1, 12, 1, 'exp_month', ' class="input-small" ', $expMonth, '%02d');
		$currentYear         = date('Y');
		$lists['exp_year']   = JHtml::_('select.integerlist', $currentYear, $currentYear + 10, 1, 'exp_year', 'class="input-small"', $expYear);
		$data['coupon_code'] = $input->post->getString('coupon_code', '');

		if (is_callable('EventbookingHelperOverrideHelper::calculateCartRegistrationFee'))
		{
			$fees = EventbookingHelperOverrideHelper::calculateCartRegistrationFee($cart, $form, $data, $config, $paymentMethod);
		}
		else
		{
			$fees = EventbookingHelper::calculateCartRegistrationFee($cart, $form, $data, $config, $paymentMethod);
		}

		$events  = $cart->getEvents();
		$methods = os_payments::getPaymentMethods();

		$options            = array();
		$options[]          = JHtml::_('select.option', 'Visa', 'Visa');
		$options[]          = JHtml::_('select.option', 'MasterCard', 'MasterCard');
		$options[]          = JHtml::_('select.option', 'Discover', 'Discover');
		$options[]          = JHtml::_('select.option', 'Amex', 'American Express');
		$lists['card_type'] = JHtml::_('select.genericlist', $options, 'card_type', ' class="inputbox" ', 'value', 'text');

		//Coupon will be enabled if there is at least one event has coupon enabled, same for deposit payment
		$enableCoupon  = 0;
		$enableDeposit = 0;
		$eventTitles   = array();

		foreach ($events as $event)
		{
			if ($event->enable_coupon > 0 || ($event->enable_coupon == 0 && $config->enable_coupon))
			{
				$enableCoupon = 1;
			}

			if ($event->deposit_amount > 0)
			{
				$enableDeposit = 1;
			}

			$eventTitles[] = $event->title;
		}

		##Add support for deposit payment
		$paymentType = $input->post->getInt('payment_type', $config->get('default_payment_type', 0));

		if ($config->activate_deposit_feature && $enableDeposit)
		{
			$options               = array();
			$options[]             = JHtml::_('select.option', 0, JText::_('EB_FULL_PAYMENT'));
			$options[]             = JHtml::_('select.option', 1, JText::_('EB_DEPOSIT_PAYMENT'));
			$lists['payment_type'] = JHtml::_('select.genericlist', $options, 'payment_type', ' class="input-large" onchange="showDepositAmount(this);" ', 'value', 'text',
				$paymentType);
			$depositPayment        = 1;
		}
		else
		{
			$depositPayment = 0;
		}

		// Check to see if there is payment processing fee or not
		$showPaymentFee = false;

		foreach ($methods as $method)
		{
			if ($method->paymentFee)
			{
				$showPaymentFee = true;
				break;
			}
		}

		// Load captcha
		$this->loadCaptcha();

		// Assign these parameters
		$this->paymentMethod        = $paymentMethod;
		$this->lists                = $lists;
		$this->config               = $config;
		$this->methods              = $methods;
		$this->enableCoupon         = $enableCoupon;
		$this->userId               = $userId;
		$this->lists                = $lists;
		$this->depositPayment       = $depositPayment;
		$this->message              = EventbookingHelper::getMessages();
		$this->fieldSuffix          = EventbookingHelper::getFieldSuffix();
		$this->form                 = $form;
		$this->totalAmount          = $fees['total_amount'];
		$this->taxAmount            = $fees['tax_amount'];
		$this->discountAmount       = $fees['discount_amount'];
		$this->bunldeDiscount       = $fees['bundle_discount_amount'];
		$this->lateFee              = $fees['late_fee'];
		$this->depositAmount        = $fees['deposit_amount'];
		$this->paymentProcessingFee = $fees['payment_processing_fee'];
		$this->amount               = $fees['amount'];
		$this->items                = $events;
		$this->eventTitle           = implode(', ', $eventTitles);
		$this->form                 = $form;
		$this->showPaymentFee       = $showPaymentFee;
		$this->paymentType          = $paymentType;
		$this->formData             = $data;
		$this->useDefault           = $useDefault;

		parent::display();
	}

	/**
	 * Generate Breadcrumb for event detail page, allow users to come back to event details
	 *
	 * @param JTable $event
	 * @param string $layout
	 */
	protected function generateBreadcrumb($event, $layout)
	{
		$app      = JFactory::getApplication();
		$active   = $app->getMenu()->getActive();
		$pathway  = $app->getPathway();
		$menuView = !empty($active->query['view']) ? $active->query['view'] : null;

		if ($menuView == 'calendar' || $menuView == 'upcomingevents')
		{
			$pathway->addItem($event->title, JRoute::_(EventbookingHelperRoute::getEventRoute($event->id, 0, $app->input->getInt('Itemid'))));
		}

		if ($layout == 'default')
		{
			$pathway->addItem(JText::_('EB_INDIVIDUAL_REGISTRATION'));
		}
		else
		{
			$pathway->addItem(JText::_('EB_GROUP_REGISTRATION'));
		}
	}

	/**
	 * Load captcha for registration form
	 *
	 * @param bool $initOnly
	 *
	 * @throws Exception
	 */
	protected function loadCaptcha($initOnly = false)
	{
		$config      = EventbookingHelper::getConfig();
		$user        = JFactory::getUser();
		$showCaptcha = 0;

		if ($config->enable_captcha && ($user->id == 0 || $config->bypass_captcha_for_registered_user !== '1'))
		{
			$captchaPlugin = JFactory::getApplication()->getParams()->get('captcha', JFactory::getConfig()->get('captcha'));

			if (!$captchaPlugin)
			{
				// Hardcode to recaptcha, reduce support request
				$captchaPlugin = 'recaptcha';
			}

			$plugin = JPluginHelper::getPlugin('captcha', $captchaPlugin);

			if ($plugin)
			{
				$showCaptcha = 1;

				if ($initOnly)
				{
					JCaptcha::getInstance($captchaPlugin)->initialise('dynamic_recaptcha_1');
				}
				else
				{
					$this->captcha = JCaptcha::getInstance($captchaPlugin)->display('dynamic_recaptcha_1', 'dynamic_recaptcha_1', 'required');
				}
			}
			else
			{
				JFactory::getApplication()->enqueueMessage(JText::_('EB_CAPTCHA_NOT_ACTIVATED_IN_YOUR_SITE'), 'error');
			}
		}

		$this->showCaptcha = $showCaptcha;
	}
}
