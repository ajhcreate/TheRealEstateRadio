<?php
/**
 * Installer script for the Joomla JF Portal component
 * @package     Joomfuse.Portal.component
 * @subpackage	system.Joomfuse.Portal.installer
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

//Register the IFSFactory class
JLoader::register('IFSFactory',JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/ifsfactory.php');


class com_jfportalInstallerScript{
    protected $minJoomFuseVersion = '2.1.138';

    function preflight( $type, $parent ) {
        //Check for the existence of JoomFuse by checking for the IFSFactory class (we already registered the location)
        if(!class_exists('IFSFactory')){
            JFactory::getApplication()->enqueueMessage('JFPortal requires the JoomFuse extension to be present. Installation aborted','error');
        }

        //Check for the minimum JoomFuse version required
        $joomFuseManifestPath = JPATH_ADMINISTRATOR . '/components/com_joomfuse/joomfuse.xml';
        $xml = JFactory::getXML($joomFuseManifestPath);
        $version = $xml ? (string)$xml->version : '0.0.0';

        if (version_compare($version, $this->minJoomFuseVersion ) < 0){
            JFactory::getApplication()->enqueueMessage('This version of JFPortal requires a JoomFuse minimum version of '.$this->minJoomFuseVersion.'. Installation aborted','error');
            return false;
        }
    }

}
?>