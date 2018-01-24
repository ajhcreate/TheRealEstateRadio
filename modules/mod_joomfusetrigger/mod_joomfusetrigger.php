<?php
/**
 * Joomfuse trigger module
 * @package     site.mod_joomfusetrigger
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

//Include the Joomfuse Factory
JLoader::register('IFSFactory', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/ifsfactory.php');

//Retrieve and check the tags
$taglist = $params->get('taglist',array());
if(!$taglist){
    return;
}

//Retrieve the contact object
$ifs_contact = IFSFactory::getUserContact();

//Assign the tags to the contact object
foreach($taglist AS $entry){
    $ifs_contact->assignIFSTag((int)$entry->tag);
}


//Load the template, if any (default.php is empty)
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
require JModuleHelper::getLayoutPath('mod_joomfusetrigger', $params->get('layout', 'default'));
