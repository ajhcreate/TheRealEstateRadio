<?php
/**
 * JFPortal plugin for JoomFuse
 * Mainly handles the cronjob events thrown from JoomFuse so we can execute any scheduled goal/actionsets
 * @package     site.com_joofuse.plugins
 * @subpackage	joomfuse.jfportal
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

//No direct access
defined( '_JEXEC' ) or die( '' );

// Import library dependencies
jimport( 'joomla.plugin.plugin' );

//Import/register the IFSFactory that takes care of all the required files
JLoader::register('IFSFactory', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/ifsfactory.php');
JLoader::register('PlgUserJoomfuse', JPATH_SITE.'/plugins/user/joomfuse/joomfuse.php');

/**
 * Joomfuse Cronjobs plugin
 * Handles all the joomfuse cronjob events
 *
 * @copyright	Copyright Zacaw Enterprises Inc. All rights reserved.
 * @since 		3.0
 */
class plgJoomfuseJfportal extends JPlugin{

    /**
     * Handles the cronjob calls for JF Portal
     * @param String $handler			The classname (or other key) so we can know if we're responsible for this cron job call
     * @param JRegistry $registry		The parameters for the cron job
     * @return boolean					false if we were not responsible for this cron job. True if otherwise
     */
    public function onJoomfuseCron($handler, JRegistry $registry){
        if($handler != __CLASS__){
            return false;
        }

        //We fecth contactId in case the user has been deleted in the meantime
        $contactId = (int)$registry->get('contactId');
        $actionsetId = (int)$registry->get('actionsetId');
        $goalIntegration = (String)$registry->get('goalIntegration');
        $goalName = (String)$registry->get('goalName');
        
        //Verify that we have to do something
        if(!$actionsetId && !$goalName){
            $message = 'plgJoomfuseJfportal received a cron job without an actionset or goalName';
            IFSFactory::logError($message);
            JFactory::getApplication()->enqueueMessage($message,'error');
            return false;
        }

        //Verify the contact id
        if(!$contactId){
            $message = 'plgJoomfuseJfportal received a cron job for an unknown contactId';
            IFSFactory::logError($message);
            JFactory::getApplication()->enqueueMessage($message,'error');
            return false;
        }

        //See if we had to run an actionset
        if($actionsetId){
            try{
                IFSApi::runActionSet($contactId, $actionsetId);
            } catch(Exception $e){
                $message = 'plgJoomfuseJfportal failed to run a cron-scheduled actionset: '.$e->getMessage();
                IFSFactory::logError($message);
                JFactory::getApplication()->enqueueMessage($message,'error');
                return false;
            }
        }
        
        //See if we had to run a goal
        if($goalName){
            if(!$goalIntegration){
                $message = 'plgJoomfuseJfportal received a goalName to execute ('.$goalName.') but no goalIntegration';
                IFSFactory::logError($message);
                JFactory::getApplication()->enqueueMessage($message,'error');
                return false;
            }
            
            try{
                IFSApi::achieveGoal($contactId, $goalName, $goalIntegration);
            }catch(Exception $e){
                $message = 'plgJoomfuseJfportal failed to run a cron-scheduled goal: '.$e->getMessage();
                IFSFactory::logError($message);
                JFactory::getApplication()->enqueueMessage($message,'error');
                return false;
            }
        }

        //All is well
        return true;
    }

}