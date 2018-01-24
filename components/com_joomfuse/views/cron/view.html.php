<?php
/**
 * Joomfuse views
 * @package     site.com_joomfuse
 * @subpackage	views.cron
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

// import Joomla view library
jimport('joomla.application.component.view');

JLoader::register('IFSFactory', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/ifsfactory.php');

/**
 * HTML View class for the Joomfuse Component, view 'Cron'
 * 
 */
class JoomfuseViewCron extends JViewLegacy
{
	// Overwriting JView display method
	function display($tpl = null) 
	{
		
		$this->numCrons = IFSFactory::cronCheck();		

		// Display the view
		parent::display($tpl);
	}
}
