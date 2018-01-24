<?php
/*------------------------------------------------------------------------
# com_guru
# ------------------------------------------------------------------------
# author    iJoomla
# copyright Copyright (C) 2013 ijoomla.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.ijoomla.com
# Technical Support:  Forum - http://www.ijoomla.com.com/forum/index/
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport ('joomla.application.component.controller');

$doc = JFactory::getDocument();

$siteApp = JFactory::getApplication('site');
$siteTemplate = $siteApp->getTemplate();

if(file_exists(JPATH_SITE.DIRECTORY_SEPARATOR."templates".DIRECTORY_SEPARATOR.$siteTemplate.DIRECTORY_SEPARATOR."html".DIRECTORY_SEPARATOR."com_guru".DIRECTORY_SEPARATOR."css".DIRECTORY_SEPARATOR."guru.css")){
	$doc->addStyleSheet(JURI::root()."templates/".$siteTemplate."/html/com_guru/css/guru.css");
}
else{
	$doc->addStyleSheet(JURI::root()."components/com_guru/css/guru.css");
}

if(file_exists(JPATH_SITE.DIRECTORY_SEPARATOR."templates".DIRECTORY_SEPARATOR.$siteTemplate.DIRECTORY_SEPARATOR."html".DIRECTORY_SEPARATOR."com_guru".DIRECTORY_SEPARATOR."css".DIRECTORY_SEPARATOR."custom.css")){
	$doc->addStyleSheet(JURI::root()."templates/".$siteTemplate."/html/com_guru/css/custom.css");
}
else{
	$doc->addStyleSheet(JURI::root().'components/com_guru/css/custom.css');
}

$task = JFactory::getApplication()->input->get("task", "");
$ajax = JFactory::getApplication()->input->get("ajax", 0);

if($task != "checkExistingUserU" && $task != "checkExistingUserE"){
	// Load uikit framework
	//$doc->addStyleSheet(JURI::root().'components/com_guru/css/uikit.almost-flat.min.css');
	//echo '<link rel="stylesheet" href="'.JURI::root().'components/com_guru/css/uikit.almost-flat.min.css" />';
}

$doc->addStyleSheet(JURI::root()."components/com_guru/css/tooltip.min.css");
// load FontAwesome -------------------------------------------
$doc->addStyleSheet(JURI::root()."components/com_guru/css/font-awesome.min.css");
$doc->addStyleSheet(JURI::root()."components/com_guru/css/fontello.css");
$db = JFactory::getDBO();

$sql = "SELECT guru_turnoffjq, rtl FROM #__guru_config WHERE id=1";
$db->setQuery($sql);
$db->query();
$settings = $db->loadAssocList();

$guru_turnoffjq = $settings["0"]["guru_turnoffjq"];
$rtl = $settings["0"]["rtl"];

if(intval($guru_turnoffjq) != 0){
	$doc->addScript(JURI::root().'components/com_guru/js/jquery_1_11_2.js');
}

$doc->addScript(JURI::root().'components/com_guru/js/jquery.height_equal.js');

$export = JFactory::getApplication()->input->get("export", "");

if($ajax == 0 && $task != "checkExistingUserU" && $task != "checkExistingUserE" && $export == "" && $task != "upload_ajax_image" && $task != "export_csv" && $task != "export_pdf" && $task != "saveMark"){
	echo '
		<script type="text/javascript">
			guru_site_host = "'.JURI::root().'";
		</script>
		<script type="text/javascript" src="'.JURI::root().'components/com_guru/js/ukconflict.js"></script>
		<script type="text/javascript" src="'.JURI::root().'components/com_guru/js/uikit.min.js"></script>
		<script type="text/javascript" src="'.JURI::root().'components/com_guru/js/tooltip.min.js"></script>
	';
}

$doc->addScript(JURI::root().'components/com_guru/js/accordion.js');

if($rtl == 0){ // LTR
	// do nothing
}
elseif($rtl == 1){ // RTL
	if($task != "get_comments" && $task != "get_lessons" && $task != "get_lesson_description" && $task != "insert_comment" && $task != "ajax_add_video" && $task != "ajax_add_mass_video" && $task != "upload_ajax_image"){
		echo '<link rel="stylesheet" href="'.JURI::root().'components/com_guru/css/rtl.css" />';
	}
}

class guruController extends JControllerLegacy {
	var $_customer = null;
	function __construct() {
		parent::__construct();
	}

	function display ($cachable = false, $urlparams = Array()){
		parent::display(false, null);	
	}

	function setclick($msg = ''){
	}
};
?>