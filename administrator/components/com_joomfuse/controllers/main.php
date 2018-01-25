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
 * The Main Joomfuse controller
 *
 * @package     Joomla.Administrator
 * @subpackage  com_joomfuse
 */
class JoomfuseControllerMain extends JControllerForm{

	/**
	 * 
	 * Re-associate a set of contacts
	 * 
	 */
	public function reAssociateUsers(){
	    //Check the token
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		
		//Default redirect location
		$this->setRedirect(JRoute::_('index.php?option=com_joomfuse&view=main'));
		
		//Basic vars
		$app = JFactory::getApplication();
		$jinput = $app->input;
		
		//Get the user ids
		$cids = $jinput->get('cid',array(),'ARRAY');
		if(empty($cids)){
		    $app->enqueueMessage('No entries selected for re-association','error');
		    return;
		}
		
		//Truncate the number of id's to 10
		if(count($cids)>10){
		    $dropped_ids = array_slice($cids, 9);
		    $cids = array_slice($cids, 0,10);
		    $app->enqueueMessage('Due to performance reasons, the number of users to re-associate was reduced to 10<br/>The following user ids have not been re-associated: '.implode(',', $dropped_ids),'warning');
		}
		
		//Re-associate each contact id seperately
		$association_count = 0;
		foreach($cids AS $user_id){
		    try{
		        $this->reAssociateContact($user_id);
		    }catch(Exception $e){
		        $app->enqueueMessage('Error while re-associating the user with id '.$user_id.': '.$e->getMessage(),'error');
		        continue;
		    }
		    
		    $association_count++;
		}
		
		
		//Success! Well.. maybe
		if($association_count){
		  $app->enqueueMessage($association_count.' entries re-associated');
		}
		return;
	}
	
	/**
	 * Associates a specific user with an IFS contact
	 */
	public function associateUser(){
	    //Check the token
	    JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
	    
	    //Default redirect location
	    $this->setRedirect(JRoute::_('index.php?option=com_joomfuse&view=main'));
	    
	    //Basic vars
	    $app = JFactory::getApplication();
	    $jinput = $app->input;
	    
	    //Get the user id
	    if(!($user_id = $jinput->getUint('user_id'))){
	        $app->enqueueMessage('No entry selected for re-association','error');
	        return;
	    }
	    
	    //Attempt to create an association by simply loading the contact.
	    try{
	        $this->associateContactForUserId($user_id);
	    }catch(Exception $e){
	        $app->enqueueMessage('Error while associating the user with id '.$user_id.': '.$e->getMessage(),'error');
	        return;
	    }
	    
	    //Success!
	    $app->enqueueMessage('User association successful','success');
	    return;
	}
	
	
	/**
	 * Re-associates a Joomla user with the appropriate Contact Id
	 * Will ignore a non-existent association and will proceed with just the association
	 * 
	 * @param int $user_id         The Joomla User id that needs re-association
	 * @throws Exception           In case of an error
	 */
	protected function reAssociateContact($user_id){
	    //Basic sanity checks on the user id
	    if(empty($user_id) || !is_numeric($user_id)){
	        IFSFactory::logError('JoomfuseControllerMain::performUserContactReassociation received an invalid user_id: '.$user_id, JLog::NOTICE);
	        throw new Exception('This user id is invalid');
	    }
	    
	    //Load the IFSUserTable row, if it exists, and delete it
	    $table = JTable::getInstance('IFSUser');
	    if($table->load($user_id)){
    	    if(!$table->delete()){
    	        throw new Exception('Failed to remove the association: '.$table->getError());
    	    }
	    }
	    
	    //Done. Return the association result
	    return $this->associateContactForUserId($user_id);
	}
	
	/**
	 * Associates a joomla user with the appropriate Contact Id
	 * 
	 * @param int $user_id     The joomla user id
	 * @throws Exception       In case of an error
	 */
	protected function associateContactForUserId($user_id){
	    //Basic sanity checks on the user id
	    if(empty($user_id) || !is_numeric($user_id)){
	        IFSFactory::logError('JoomfuseControllerMain::associateContact received an invalid user_id: '.$user_id, JLog::NOTICE);
	        throw new Exception('The user id is invalid');
	    }
	    
	    //The association is a simple as loading the user contact.
	    //We also propagate up any possible Exceptions from this
	    IFSFactory::getUserContact($user_id);
	    
	    //Done
	    return;
	}

}
