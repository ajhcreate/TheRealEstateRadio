<?php
/**
 * Joomfuse Portal main
 * @package     site.com_jfportal
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

$controller = JControllerLegacy::getInstance('jfportal');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
