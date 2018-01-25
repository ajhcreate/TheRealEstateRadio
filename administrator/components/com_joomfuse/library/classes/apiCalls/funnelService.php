<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.apiCalls.funnelService
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

//Include all contact service implementations
class_exists('JoomfuseApiCallAchieveGoal') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCalls/funnelService/achieveGoal.php';


abstract class JoomfuseFunnelService extends JoomfuseApiCall{

    //Concrete implementation for JoomfuseApiCall->getServiceName()
    protected function getServiceName(){return 'FunnelService';}
}