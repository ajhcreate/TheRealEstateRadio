<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_joomfuse
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

//Load the IFSFactory and all relevant classes
require_once JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/ifsfactory.php';

/**
 * The associateall Joomfuse controller
 *
 * @package     Joomla.Administrator
 * @subpackage  com_joomfuse
 */
class JoomfuseControllerAssociateall extends JControllerLegacy{
    
    public function associateAll(){
        try{
            //CSRF check
            if(!JSession::checkToken('get')){throw new Exception(JText::_('JINVALID_TOKEN'));}
            
            //Fetch the model
            $model = $this->getModel('Associateall','JoomfuseModel');
            
            //Associate the next 10 users
            $model->associateNextUserBatch();
    
            //Fetch the remaining unassociated users
            $item = $model->getNumUnassociatedEntries();
            
            //Echo the response
            echo new JResponseJson($item);
        }catch(Exception $e){
            //Catch-all error messaging
            echo new JResponseJson($e);
        }
         
        //Done
        JFactory::getApplication()->close();
    }
    
}