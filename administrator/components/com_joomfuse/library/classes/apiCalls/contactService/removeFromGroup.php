<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.apiCalls.contactService.removeFromGroup
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseApiCallRemoveFromGroup extends JoomfuseApiCallGroupfunctions{

    //Concrete implementation for JoomfuseApiCall->getServiceName()
    protected function getCallName(){return 'removeFromGroup';}

    /* (non-PHPdoc)
     * @see JoomfuseApiCall::getLogExplain()
     */
    protected function getLogExplain(){
        return 'Remove tag id '.$this->groupId.' to contact id '.$this->contactId;
    }
}