<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.apiCalls.emailService
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

//Include all contact service implementations
class_exists('JoomfuseApiCallOptIn') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCalls/emailService/optIn.php';

/**
 * @author Georgios Ntampitzias (nonickch@gmail.com)
 * 
 * Email Service parent abstract class.
 * Nothing important here, just the service name.
 * This is due to the fact that the APIEmailService methods are all quite different from each other.
 *
 */
abstract class JoomfuseEmailService extends JoomfuseApiCall{
    //Concrete implementation for JoomfuseApiCall->getServiceName()
    protected function getServiceName(){return 'APIEmailService';}

}