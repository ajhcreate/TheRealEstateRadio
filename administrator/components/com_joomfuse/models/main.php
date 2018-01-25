<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	models.main
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 *  Model for main back-end view (main/list-users)
 */
class JoomfuseModelMain extends JModelList
{
    protected $text_prefix = 'COM_JOOMFUSE';
    
    /**
     * Typical constructor with the filter fields.
     * Note that we use a single naming convention for the fields, 
     *  so no double-entries needed (like com_content)
     */
    public function __construct($config = array()){
        if (empty($config['filter_fields'])){
            $config['filter_fields'] = array(
                'joomfuseusers.ifs_id', 'ifs_id',
                'jusers.id', 'id',
                'jusers.name', 'name', 
                'jusers.email', 'email', 
                'joomfuseusers.last_update', 'last_update', 
                'associated'
            );
        }
    
        parent::__construct($config);
    }
    

    /* 
     * Simple populateState() overriding to extract the submitted or session-stored
     *  values for our filters
     * 
     * @see JModelAdmin::populateState()
     */
    protected function populateState($ordering = 'jusers.id', $direction = 'desc'){
        $app = JFactory::getApplication();
         
        //Get/set the search filters
        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

        $associated = $this->getUserStateFromRequest($this->context . '.filter.associated', 'filter_associated');
        $this->setState('filter.associated', $associated);

        parent::populateState($ordering, $direction);
    }

    
    /**
     * Builds the SQL list query according to the filters/ordering
     * 
     * @return JDatabaseQuery
     */
    protected function getListQuery() {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        /*
         * Compose the query
         */
        //Select everything and start from the #__users table
        $query->select('jusers.*, joomfuseusers.ifs_id, joomfuseusers.last_update');
        $query->from($db->quoteName('#__users').' AS jusers');
        $query->join('LEFT', $db->quoteName('#__joomfuse_users').' AS joomfuseusers ON joomfuseusers.id = jusers.id');
        
        //If we are filtering by 'associated' do an INNER JOIN, otherwise a LEFT JOIN
        $associated = $this->getState('filter.associated','*');
        if(is_numeric($associated)){
            if((int)$associated){
                $query->where('joomfuseusers.id IS NOT NULL');
            } else {
                $query->where('joomfuseusers.id IS NULL');
            }
        }
        
        //See if we need to filter by name/email or ifs/joomla ids
        $search = $this->getState('filter.search','');
        if($search){
            $query->where('
                (
                    ( jusers.name LIKE (' . $db->quote('%'.$search.'%').') ) OR
                    ( jusers.email LIKE (' . $db->quote('%'.$search.'%').') ) OR
                    ( jusers.id = '.(int)$search.' ) OR 
                    ( joomfuseusers.ifs_id = '.(int)$search.' )
                )
                ');
        }

        //Append ordering
        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering', 'jusers.id');
        $orderDirn = $this->state->get('list.direction', 'desc');

        $query->order($db->escape($orderCol . ' ' . $orderDirn));
        
        return $query;
    }
    
    public function getNumUnassociatedEntries(){
        //Start by cloning the current query.
        $query = clone $this->_getListQuery();
        
        //@TODO: Test for by-reference interruption to the main query
        
        //Clear any WHERE statements and add our own  
        $query->clear('where')->where('joomfuseusers.id IS NULL');
        
        //Just return the _getListCount result as it does all we need:
        //  It fetches the number of results for the given query
        return $this->_getListCount($query);
    }
    
}
