<?php
/**
 * Joomfuse Portal admin
 * @package     admin.com_jfportal
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('IFSUser', JPATH_ADMINISTRATOR.'/components/com_joomfuse/helpers/ifsuser.php');

$controller = JControllerLegacy::getInstance('jfportal');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
