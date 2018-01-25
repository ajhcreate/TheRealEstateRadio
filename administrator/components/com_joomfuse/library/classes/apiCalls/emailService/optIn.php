<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.apiCalls.emailService.optIn
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseApiCallOptIn extends JoomfuseEmailService{
	private $email;
	private $reason;
	
	/**
	 * Simple constructor with all the require API call parameters
	 * @param String $apiLocation	The API location
	 * @param String $email			The email to be opted-in
	 * @param String $reason		(Optional) The reason for the opt-in
	 */
	public function __construct($apiLocation, $email, $reason){
		parent::__construct($apiLocation);
		
		$this->email = $email;
		$this->reason = $reason;
	}
	
	protected function getCallName(){
		return 'optIn';
	}
	
	protected function getCallArray($apiKey){
		return array(
				php_xmlrpc_encode($apiKey),
				php_xmlrpc_encode($this->email),
				php_xmlrpc_encode($this->reason)
		);
	}
	
	protected function getResultObject(xmlrpcresp $result){
		//@TODO-GN: Is this correct?
		return $result->value();
	}
	
	protected function validateResult(xmlrpcresp $result){
		//Nothing to do here
		return true;
	}
	
	
}
