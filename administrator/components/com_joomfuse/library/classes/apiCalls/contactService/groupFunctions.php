<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.apiCalls.contactService.groupFunctions
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class_exists('JoomfuseApiCallAddToGroup') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCalls/contactService/addToGroup.php';
class_exists('JoomfuseApiCallRemoveFromGroup') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCalls/contactService/removeFromGroup.php';

abstract class JoomfuseApiCallGroupfunctions extends JoomfuseApiCall{
    protected $contactId = null;
    protected $groupId = null;

    /**
     * Constructs a ContactService API call
     * @param array $api_fields
     * @throws Exception			In case the API parameters given are bad
     */
    public function __construct($apiLocation, $contactId, $groupId){
        parent::__construct($apiLocation);

        //Sanitize the parameters
        if(!is_numeric($contactId) || !intval($contactId)){
            throw new Exception('JoomfuseApiCallGroupfunctions::__construct received a non-numeric/valid $contactId: '.$contactId, 1);
        }

        if(!is_numeric($groupId) || !intval($groupId)){
            throw new Exception('JoomfuseApiCallGroupfunctions::__construct received a non-numeric/valid $contactId: '.$groupId, 2);
        }

        //Save the parameters
        $this->contactId = intval($contactId);
        $this->groupId = intval($groupId);
    }

    //Concrete implementation for JoomfuseApiCall->getServiceName()
    protected function getServiceName(){return 'ContactService';}

    protected function validateResult(xmlrpcresp $result){
        //If the API said ok, we can't really argue with it... (nothing to check for)
        return true;
    }

    protected function getCallArray($apiKey){
        return array(
        php_xmlrpc_encode($apiKey),
        php_xmlrpc_encode($this->contactId),
        php_xmlrpc_encode($this->groupId)
        );
    }

    protected function getResultObject(xmlrpcresp $result){
        //Nothing to return. Success/fail is all we get
        return;
    }
}