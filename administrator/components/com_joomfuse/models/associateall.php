<?php
/**
 * Joomfuse AssociateAll model
 * @package     admin.com_joomfuse
 * @subpackage	models.associateall
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

//We build upon the Main model
JLoader::registerPrefix('JoomfuseModel', JPATH_ADMINISTRATOR.'/components/com_joomfuse/models');

/**
 *  Model for the associateall view
 *  Assists the main view in associating all unassociated users
 */
class JoomfuseModelAssociateall extends JModelItem
{
    /**
     * Fetches the amount of pending/unassociated users
     * @throws Exception
     */
    public function getNumUnassociatedEntries(){
        //Fetch the base query and select the count
        $db = JFactory::getDbo();
        $query = $this->getBaseQuery($db);
        $query->select('COUNT(*)');
        
        //Execute the query and return.
        $db->setQuery($query);
        return $db->loadResult();
    }
    
    /**
     * 
     */
    public function associateNextUserBatch(){
        //Fetch the next 2 Joomla user id's that are not associated
        $db = JFactory::getDbo();
        $query = $this->getBaseQuery($db);
        $query->select('users.id');
        
        //Execute the query with 0,0 limitstart/limit
        $db->setQuery($query, 0, 2);
        $ids = $db->loadColumn();
        foreach($ids AS $id){
            //Simply load the contact to trigger the association
            IFSContact::getInstanceByUserId($id);
        }
    }
    
    /**
     * @return JDatabaseQuery
     */
    protected function getBaseQuery(JDatabase $db){
        $query = $db->getQuery((true));
        $query->from('#__users AS users');
        $query->leftJoin('#__joomfuse_users AS jfusers ON jfusers.id=users.id');
        $query->where('jfusers.id IS NULL');
        
        return $query;
    }
}
