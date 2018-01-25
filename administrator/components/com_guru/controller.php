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
$document = JFactory::getDocument();

class guruAdminController extends JControllerLegacy {

	function __construct() {
		parent::__construct();
		
		$ajax_req = JFactory::getApplication()->input->get("no_html", 0);
		$squeeze = JFactory::getApplication()->input->get("sbox", 0);
		$squeeze2 = JFactory::getApplication()->input->get("tmpl", 0);
		$task = JFactory::getApplication()->input->get("task");
		$export = JFactory::getApplication()->input->get("export", "");
		$export1 = JFactory::getApplication()->input->get("export1", "");
		$controller = JFactory::getApplication()->input->get("controller", "");
		
		if($export != "" || $export1 != ""){
			// do nothing
		}
		elseif(!$ajax_req && $task != "savesbox"&& $task != "save2" && $task != "export_button" && $task != "export" && $task != "savequizzes" && $task !="savequestionedit" && $task != "savequestion" && $task != "savequestionandclose"){
			$document = JFactory::getDocument();
			$document->addStyleSheet("components/com_guru/css/general.css");
			$document->addStyleSheet("components/com_guru/css/tmploverride.css");
			
			$document->addStyleSheet( 'components/com_guru/css/bootstrap.min.css' );
			$document->addStyleSheet( 'components/com_guru/css/font-awesome.min.css' );
			$document->addStyleSheet( 'components/com_guru/css/ace-fonts.css' );
			if($controller != "guruInstall"){
				$document->addStyleSheet( 'components/com_guru/css/ace.min.css' );
			}
			$document->addStyleSheet( 'components/com_guru/css/fullcalendar.css' );
			$document->addStyleSheet( 'components/com_guru/css/g_admin_modal.css' );
			
			require_once (JPATH_COMPONENT_ADMINISTRATOR.DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'chtmlinput.php');

  			$view = $this->getView('guruDtree', 'html');
  			if (!$squeeze2 && !$squeeze){
	  		?>
	  		
			<?php
				$view->showDtree();
				?>
					
			<?php
  			}
		}

	}

	function display ($cachable = false, $urlparams = array()) {
		parent::display($cachable, $urlparams);	
	}

	function debugStop($msg = ''){
       	$app = JFactory::getApplication('administrator');
	  	echo $msg;
		$app->close();
	}
};

?>
