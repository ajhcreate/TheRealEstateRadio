<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.exceptions.registrationSuccess
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JoomfuseRegistrationSuccess extends Exception{
    private $jUser;
    
    public function __construct($caller, JUser $juser){ 
        $this->juser = $juser;
        
        $caller_name = get_class($caller)?get_class($caller):'Unknown';
        
        parent::__construct('User registration completed by a plugin. User id:'.$juser->get('id').' plugin class:'.$caller_name, $juser->get('id'));
    }
    
    public function getJUser(){return $this->jUser;}
}