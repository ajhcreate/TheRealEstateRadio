<?php
/**
 * Joomfuse views
 * @package     admin.com_joomfuse
 * @subpackage	views.main
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Main JoomFuse view listing all JF associations
 *
 * @package     Joomla.Administrator
 * @subpackage  com_joomfuse
 */
class JoomfuseViewMain extends JViewLegacy
{
    protected $items;

    protected $pagination;

    protected $state;

    /**
     * Display the view
     */
    public function display($tpl = null){
        //Retrieve the IFS user list
        $this->items		= $this->get('Items');
        $this->pagination	= $this->get('Pagination');
        $this->state		= $this->get('State');
        $this->app_name      = JComponentHelper::getParams('com_joomfuse')->get('app_name','');
        
        //Fetch the filter data
        $this->filterForm    = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');
        
        //Fetch the number of unassociated users (so we can show the associate-all button)
        $this->numUnassociated = $this->get('numUnassociatedEntries');

        // Check for errors.
        if (count($errors = $this->get('Errors')))
        {
            JError::raiseError(500, implode("\n", $errors));
            return false;
        }

        $this->addToolbar();
        parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     */
    protected function addToolbar(){
        //Add the page title
        JToolbarHelper::title(JText::_('COM_JOOMFUSE'), 'list');
        
        //Add the 're-associate entries' button
        JToolbarHelper::custom('main.reAssociateUsers','loop','loop','Re-Associate Entries', true);
        
        
        //See if we need to add the 'associate all' button
        if($this->numUnassociated){
            //JToolbarHelper::custom('main.associateAllUsers','arrow-up-4','arrow-up-4','Mass-associate ALL Entries', false);
            JToolbarHelper::modal('associateAllModal', 'icon-arrow-up-4', 'Associate all missing ('.$this->numUnassociated.')');
        }
        
        //Add the component preferences button
        JToolbarHelper::preferences('com_joomfuse');
    }

}
