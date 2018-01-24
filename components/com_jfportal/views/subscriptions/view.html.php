<?php
/**
 * Joomfuse Portal views
 * @package     site.com_jfportal
 * @subpackage	views.subscriptions
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

// import Joomla view library
jimport('joomla.application.component.view');

JLoader::register('IFSFactory', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/ifsfactory.php');

/**
 * HTML View class for the Joomfuse Portal Component, view 'subscriptions'
 */
class JfportalViewSubscriptions extends JViewLegacy{
	// Overwriting JView display method
	function display($tpl = null) {
	    //Fetch the list of applicable subscriptions from the model
	    $this->items = $this->get('Items');
	    
	    //Save state/params
	    $this->state = $this->get('state');
	    $this->params = JFactory::getApplication()->getParams();
	    $this->creditcards = $this->get('creditcards');
	    $this->pagination = $this->get('pagination');
	    
		// Display the view
		parent::display($tpl);
	}
}
