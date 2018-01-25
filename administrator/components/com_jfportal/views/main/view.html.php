<?php
/**
 * Joomfuse Portal main view
 * @package     admin.com_jfportal
 * @subpackage	views.main
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JfportalViewMain extends JViewLegacy
{
    protected $items;

    protected $pagination;

    protected $state;

    /**
     * Display the view
     */
    public function display($tpl = null){
        //Add the preferences/configuration button
        JToolbarHelper::preferences('com_jfportal');
        
        //Add the page title
        JToolbarHelper::title('JF Portal', 'list');

        // Check for errors.
        if (count($errors = $this->get('Errors')))
        {
            JError::raiseError(500, implode("\n", $errors));
            return false;
        }
        
        parent::display($tpl);
        
        //JFactory::getApplication()->redirect('index.php?option=com_config&view=component&component=com_jfportal&return='.base64_encode(JUri::base()));
    }

}
