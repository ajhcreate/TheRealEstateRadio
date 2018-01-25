<?php
/**
 * Joomfuse views
 * @package     admin.com_joomfuse
 * @subpackage	views.associateall
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * View assisting the mass-association of unassociated
 * users in JoomFuse 
 *
 * @package     Joomla.Administrator
 * @subpackage  com_joomfuse
 */
class JoomfuseViewAssociateall extends JViewLegacy
{
    /**
     * Display the view
     */
    public function display($tpl = null){
        $this->num_unassociated = $this->get('numUnassociatedEntries');
        parent::display($tpl);
    }
    
}
