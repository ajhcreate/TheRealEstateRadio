<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.apiCalls.contactService.addToGroup
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseApiCallCreateContact extends JoomfuseContactService{
    
    //Concrete implementation for JoomfuseApiCall->getServiceName()
    protected function getCallName(){return 'add';}
    
    protected function checkParameters(){
        //Make sure there is no infusionsoft id set
        return true;
    }
    
    protected function validateResult(xmlrpcresp $result){
        //If the API said ok, we can't really argue with it... (nothing to check for)
        return true;
    }
    
    protected function getResultObject(xmlrpcresp $result){
        return $result->value();
    }
}