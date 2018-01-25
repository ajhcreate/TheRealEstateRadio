<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.apiCalls.productService
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

//Include all contact service implementations
class_exists('JoomfuseApiCalldeactivateCreditCard') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCalls/productService/deactivatecreditcard.php';


abstract class JoomfuseProductService extends JoomfuseApiCall{
    //Concrete implementation for JoomfuseApiCall->getServiceName()
    protected function getServiceName(){return 'ProductService';}
}