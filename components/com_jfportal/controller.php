<?php
/**
 * Joomfuse Portal admin controller
 * @package     admin.com_jfportal
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;


/**
 * JoomFuse Portal main controller
 * @author Georgios Ntampitzias and the JoomFuse Team
 *
 */
class JfportalController extends JControllerLegacy{
	/*
	 * Override the constructor in order to make sure JoomFuse is installed.
	 * If not installed, redirect to the global config page with an appropriate message
	 */
	public function __construct($config = array()){
	    parent::__construct($config);
	    
	    if(!class_exists('IFSFactory')){
	        $this->setRedirect('index.php','JoomFuse not installed. Cannot access JoomFuse Portal','error');
	    }
	}
}
