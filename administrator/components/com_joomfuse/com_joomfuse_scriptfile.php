<?php
/**
 * Installer script for the Joomla JoomFuse component
 * @package     Joomfuse.component
 * @subpackage	system.Joomfuse.installer
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');


class com_joomfuseInstallerScript{
    function update($parent) {
        //Check the JomSocial version
        $this->checkJomSocialVersion();
    }

    function install($parent) {
        //Check the JomSocial version
        $this->checkJomSocialVersion();
    }

    protected function checkJomSocialVersion(){
    	$file = JPATH_ADMINISTRATOR .'/components/com_community/community.xml';

    	//Abort if no JomSocial is found
    	if(!file_exists($file)){
    		return;
    	}
    	
        //Retrieve the JomSocial version
        $xml = JFactory::getXML($file);
        $version = $xml ? (string)$xml->version : '0.0.0';

        if (version_compare($version, '3.2.1.4' ) == 0){
            JFactory::getApplication()->enqueueMessage('JomSocial 3.2.1.4 is known to have a bug that makes all users of JomSocial have no groups. This leads to the mass-removal of contact tags associated with usergroups','warning');
            return false;
        }

        return true;
    }
}
?>