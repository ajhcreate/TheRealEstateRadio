<?php
/**
 * Installer script for the user JoomFuse plugin
 * @package     Joomfuse.plugin
 * @subpackage	system.Joomfuse.installer
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');


class plgUserJoomfuseInstallerScript{
    function update($parent) {
        // Make sure that the plugin being updated is enabled. Otherwise output a warning
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select($db->qn('enabled'))
        ->from($db->qn('#__extensions'))
        ->where($db->qn('element').' = '.$db->q('joomfuse'))
        ->where($db->qn('type').' = '.$db->q('plugin'))
        ->where($db->qn('folder').' = '.$db->q('user'));
        
        $db->setQuery($query);
        try{
            if(!$db->loadResult()){
                JFactory::getApplication()->enqueueMessage('"JoomFuse User plugin" not activated. Please make sure that this is intentional','warning');
                echo '<br /><p><i class="icon-unpublish"></i>WARNING: "JoomFuse User plugin" currently not activated. Please make sure that this is intentional</p><br />';
            } else {
                echo '<br /><p><i class="icon-publish"></i>"JoomFuse User plugin" is already activated.</p><br />';
            }
        }catch (Exception $e){
            JFactory::getApplication()->enqueueMessage('Error while checking if plg_user_joomfuse is already enabled. Please make sure it is enabled from the plugin manager','warning');
        }
    }

    function install($parent) {
        // Activate the plugin ONLY on installations
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->update($db->qn('#__extensions'))
        ->set($db->qn('enabled').' = 1')
        ->where($db->qn('element').' = '.$db->q('joomfuse'))
        ->where($db->qn('type').' = '.$db->q('plugin'))
        ->where($db->qn('folder').' = '.$db->q('user'));

        $db->setQuery($query);
        try{
            $db->query();
            echo '<br /><p><i class="icon-publish"></i>"JoomFuse User plugin" activated</p><br />';
        }catch (Exception $e){
            JFactory::getApplication()->enqueueMessage('Error while enabling plg_user_joomfuse. Please enable the plugin manually','warning');
        }
         
    }
}
?>