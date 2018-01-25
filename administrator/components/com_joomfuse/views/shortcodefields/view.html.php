<?php
/**
 * Joomfuse view for displaying the editors-xtd shortcode fields
 * @package     admin.com_joomfuse
 * @subpackage	views.shortcodefields
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * View to edit an article.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_content
 * @since       1.6
 */
class JoomfuseViewShortcodefields extends JViewLegacy
{
    protected $items;

    protected $pagination;

    protected $state;

    /**
     * Display the view
     */
    public function display($tpl = null){
        //Retrieve the applicable field list
        $this->items		= $this->get('Items');

        parent::display($tpl);
    }

}
