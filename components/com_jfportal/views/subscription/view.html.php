<?php
/**
 * Joomfuse Portal views
 * @package     site.com_jfportal
 * @subpackage	views.subscription
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

// import Joomla view library
jimport('joomla.application.component.view');

JLoader::register('IFSFactory', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/ifsfactory.php');

/**
 * HTML View class for the Joomfuse Portal Component, view 'subscription'
 */
class JfportalViewSubscription extends JViewLegacy{
	// Overwriting JView display method
	function display($tpl = null) {
	    //Fetch the list of applicable subscriptions from the model
	    $this->item = $this->get('Item');
	    
	    //Save state/params
	    $this->state = $this->get('state');
	    $this->params = JFactory::getApplication()->getParams();
	    
	    //Retrieve the date formatting overrides
	    $this->startDate_format = $this->params->get('StartDate_format','') ? $this->params->get('StartDate_format','') : null;
	    $this->nextBillDate_format = $this->params->get('nextBillDate_format','') ? $this->params->get('nextBillDate_format','') : null;
	    
		// Display the view
		parent::display($tpl);
	}
}
