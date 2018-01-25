<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.apiCalls.productService.deactivatecreditcard
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseApiCallDeactivatecreditcard extends JoomfuseProductService{
	private $cardId;
	
	/**
	 * Simple constructor with all the require API call parameters
	 * @param String $apiLocation	The API location
	 * @param String $email			The email to be opted-in
	 * @param String $reason		(Optional) The reason for the opt-in
	 */
	public function __construct($apiLocation, $cardId){
		parent::__construct($apiLocation);
		
		$this->cardId = (int)$cardId;
	}
	
	protected function getCallName(){
		return 'deactivateCreditCard';
	}
	
	protected function getCallArray($apiKey){
		return array(
				php_xmlrpc_encode($apiKey),
				php_xmlrpc_encode($this->cardId)
		);
	}
	
	protected function getResultObject(xmlrpcresp $result){
		return $result->value();
	}
	
	protected function validateResult(xmlrpcresp $result){
		//Nothing to do here
		return true;
	}
	
	
}
