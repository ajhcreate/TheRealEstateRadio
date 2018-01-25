<?php
/**
 * Joomfuse fields
 * @package     admin.com_joomfuse
 * @subpackage	models.fields.joomfuseposttarget
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

//Import/register the IFSFactory that takes care of all the required files
class_exists('IFSFactory') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/ifsfactory.php';
JLoader::register('IFSApi', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/ifsapi.php');

//Load the field element that we extend upon
JFormHelper::loadFieldClass('note');

/**
 * Joomfuse field for listing all Infusionsoft tags in a select list
 * @author Georgios Ntampitzias (nonickch@gmail.com)
 *
 */
class JFormFieldJoomfuseposttarget extends JFormFieldNote {
    //The field class must know its own type through the variable $type.
    protected $type = 'joomfuseposttarget';

    /* (non-PHPdoc)
     * @see JFormFieldSpacer::getLabel()
     */
    protected function getLabel(){
        //Compose the url of the site
        $postURL = JUri::root().'index.php?option=com_joomfuse&view=joomfuse&format=raw';
        
        $class = $this->element['class'] ? ' class="' . trim((string) $this->element['class']) . '"' : '';
        $description = (string) $this->element['description'];
        
        $html = array();
        $html[] = $postURL;
		$html[] = !empty($description) ? JText::_($description) : '';
        
        return '<div ' . $class . ' title="'. htmlspecialchars($description).'">'.'Your HTTP POSTS must be made to the following URL: <a href="'.$postURL.'" onclick="return false;" >'.$postURL.'</a></div>';
    }
}