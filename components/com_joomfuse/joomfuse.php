<?php
/**
 * Joomfuse main
 * @package     site.com_joomfuse
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

$controller = JControllerLegacy::getInstance('Joomfuse');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
