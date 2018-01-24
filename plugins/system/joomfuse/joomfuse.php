<?php
/**
 * Joomfuse system plugin
 * @package     Joomfuse.plugin
 * @subpackage	system.Joomfuse
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/ifsfactory.php';
//JLoader::register('PlgSystemDebug', JPATH_BASE.'/plugins/system/debug/debug.php');

/**
 * Joomfuse system plugin.
 *
 * @package     Joomfuse.Plugin
 * @subpackage  System.joomfuse
 */
class PlgSystemJoomfuse extends JPlugin{
	//@TODO-GN: check for JDebug and JDocumentHTML before outputting debug info
	//@TODO-GN: format debug info

	protected static $cronRun = false;

	//@TODO-GN: sometime in initialization event (some other event maybe?) just IFSFactory::getUserContact so we can have the initialState

	public function __construct(&$subject, $config = array()){
		parent::__construct($subject, $config);

		//See if we need to run the cron job
		$params = JComponentHelper::getParams('com_joomfuse');
		$cronCanRun = $params->get('alwaysCheckCron',true) ? true: false;    //See if the cron runs only via the view
		$cronCanRun = $cronCanRun && (!self::$cronRun);        //See if the cron has already run
		$cronCanRun = $cronCanRun && (JFactory::getDocument()->getType() === 'html');    //See if this is an html render
		$cronCanRun = $cronCanRun && JFactory::getApplication()->isSite();               //See if this the front-end
		if($cronCanRun){
			self::$cronRun = true;
			IFSFactory::cronCheck();
		}
	}

	/**
	 * We HAVE to bind to __destruct (or otherwise use the script-exit functions)
	 * since $app->redirect exit's the script before events like OnAfterRender
	 */
	public function __destruct(){
		//public function onAfterRender(){
		IFSContact::saveAllData();

		//If debugging is enabled, we assume the Joomla debug plugin is enabled (bad idea) and print the info
		if (JDEBUG && JFactory::getDocument()->getType() === 'html'
				&& JFactory::getApplication()->input->get('option','') !== 'community'
				&& JFactory::getApplication()->input->get('option','') !== 'com_community'
		){
			$this->printLogs();
		}
	}

	protected function printLogs(){
		$body = JFactory::getApplication()->getBody();
		$callLog = JoomfuseApiCall::getCallLog();

		/* It appears that JSession is not accessible during __destruct
		 //Juggle the logs in between sessions so we can display logs that take place in between redirects (the common way of saving/updating JUsers)
		$session = JFactory::getSession();

		//Hairy attempt at detecting a JApplication::redirect() so we can store the log for displaying in the next page
		if(empty($body)){
		$session->set('CallLog',$callLog,'JoomFuse');
		return;
		}

		if($old_call_log = $session->get('CallLog',false,'JoomFuse')){
		//Delete the old call log since we get to show it now
		$session->set('CallLog', null, 'JoomFuse');
		$callLog = array_merge($callLog, $old_call_log);
		}
		*/

		//Calculate some statistics
		$totalTime = 0;
		foreach($callLog AS $entry){
			$totalTime += $entry->duration;
		}
		$avgTime = count($callLog)? $totalTime / count($callLog) : 0;

		//We assume that the debug plugin is also enabled
		$html = array();
		$html[] = '<div id="system-debug" class="profiler">';
		$html[] = '<h1>JoomFuse Debug Console</h1>';

		$barClass = 'bar-success';
		$labelClass = 'label-success';
		if($avgTime > 1){
			$barClass = 'bar-danger';
			$labelClass = 'label-important';
		} else if($avgTime > 0.5){
			$barClass = 'bar-warning';
			$labelClass = 'label-warning';
		}

		$list = array();
		foreach($callLog AS $id=>$logEntry){
			$htmlAccordions = JHtml::_('bootstrap.startAccordion', 'dbg_joomfuse_apicall_' . $id, array('active' => ''));

			if(!empty($logEntry->callArray)){
				$htmlAccordions .= JHtml::_('bootstrap.addSlide', 'dbg_joomfuse_apicall_' . $id, 'Call Params', 'dbg_joomfuse_apicall_parameters_' . $id)
				. nl2br(print_r($logEntry->callArray,true))
				. JHtml::_('bootstrap.endSlide');
			}


			if(!empty($logEntry->resultObject)){
				$htmlAccordions .= JHtml::_('bootstrap.addSlide', 'dbg_joomfuse_apicall_' . $id, 'Result Object', 'dbg_joomfuse_apicall_resultobject_' . $id)
				. nl2br(print_r($logEntry->resultObject,true))
				. JHtml::_('bootstrap.endSlide');
			}

			/*
			 $htmlAccordions .= JHtml::_('bootstrap.addSlide', 'dbg_joomfuse_apicall_' . $id, 'Stack Trace', 'dbg_joomfuse_apicall_stacktrace_' . $id)
			. nl2br(print_r($logEntry->stackTrace,true))
			. JHtml::_('bootstrap.endSlide');

			$htmlAccordions .= JHtml::_('bootstrap.endAccordion');
			*/

			$timingLabel = 'label-success';
			if($logEntry->duration > 1){
				$timingLabel = 'label-important';
			} else if($logEntry->duration > 0.5){
				$timingLabel = 'label-warning';
			}
			$htmlTiming = '<div style="margin: 0px 0 5px;">
			<span class="dbg-query-time">
			<span class="label '.$timingLabel.'">'.round($logEntry->duration,3).'&nbsp;s</span>
			</span>
			</div>';

			$titleClass = $logEntry->faultCode ? 'label-important' : '';
			$explain = !empty($logEntry->explain) ? '<br/><span>'.$logEntry->explain.'</span>':'';

			$list[] = '<a name="dbg-joomfuse-apicall-"'.$id.'></a>'
			.'<span class="'.$titleClass.'">'.$logEntry->callName.'</span>'
			.$explain
			. $htmlTiming
			//. $htmlBar
			//. $htmlQuery
			. $htmlAccordions;
		}

		$innerHTML = array();
		$innerHTML[] = '<h4>'.count($callLog).' API queries logged <span class="label ' . $labelClass . '">'.round($totalTime,3).'&nbsp;s</span></h4><br />';
		$innerHTML[] = '<ol><li>' . implode('<hr /></li><li>', $list) . '<hr /></li></ol>';

		$html[] = implode('', $innerHTML);

		$html[] = '</div>';


		//echo '<h1>JoomFuse API call Information</h1>';
		//echo '<h2>'.count($callLog).' API calls for a total of '.round($totalTime,3).' seconds execution time (avg: '.round($avgTime,3).' secs/call)</h2>';
		//var_dump($callLog);
		//echo implode('', $html);

		//$body[0] = str_replace('</body>', implode('', $html) . '</body>', $body[0]);

		//JFactory::getApplication()->setBody(str_replace('</body>', implode('', $html) . '</body>', $body));
		echo implode('', $html);
	}



	function onAfterRender() {

		//See if we're allowed to run now
		if (!$this->canReplaceShortcodes()){
			return;
		}

		//Only run for html doctypes
		if(JFactory::getDocument()->getType() != 'html'){
			return;
		}
		 
		$body = JResponse::getBody();
		if ($this->replaceShortCodes($body)) {
			JResponse::setBody($body);
		}

	}

	function replaceShortCodes(&$body) {
		//Extrapolate the field maps
		JPluginHelper::importPlugin('joomfuse');
		$dispatcher = JEventDispatcher::getInstance();
		$fieldMaps = array();
		$user_id = JFactory::getUser()->get('id',0);
		
		
		if($user_id){
			$results_array = $dispatcher->trigger('getJoomFuseContactFields',array($user_id, false));
			foreach($results_array AS $results){
				foreach($results AS $result){
					/* @var $result JoomfuseAPIField */
					$value = $result->getValue();
					if($result->getType() == JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE ){
						if($formatted_date = JHtml::date($value, JText::_('DATE_FORMAT_LC5'), false)){
							$value = $formatted_date;
						}
					}
					$fieldMaps[$result->getFieldName()] = $value;
				}
			}
		}
		 
		$matches = '';
		preg_match_all('/{JoomFuse\s*(.*?)}/i', $body, $matches, PREG_SET_ORDER);
		// No matches, skip this
		if(!count($matches)){
			return;
		}

		//var_dump($fieldMaps);
		//var_dump($matches);

		//Fetch the matches and check for the id
		foreach($matches AS $match){
			//Basic sanity check
			if(!is_array($match) || !$match ){
				JFactory::getApplication()->enqueueMessage('Invalid JoomFuse shortcode detected', 'error');
				continue;
			}
			if(count($match) != 2){
				JFactory::getApplication()->enqueueMessage('Invalid JoomFuse shortcode detected: '.$match[0], 'error');
			}

			//See if the IFS field name is known
			$fieldName = $match[1];
			$replace = isset($fieldMaps[$fieldName]) ? $fieldMaps[$fieldName] : '';
			if(!isset($fieldMaps[$fieldName]) && $user_id){
				JFactory::getApplication()->enqueueMessage('JoomFuse shortcodes: IFS Field name '.$fieldName .' is not mapped in any active plugins and/or JoomFuse. Cannot fetch a value', 'warning');
			}
			$body = str_replace($match[0], $replace, $body);
		}

		//All done
		return true;
	}

	function canReplaceShortcodes() {
		$app	= JFactory::getApplication();
		 
		//Don't run in the back-end
		if ($app->isAdmin()){
			return false;
		}

		//Don't run in the indexer
		if ($app->input->get('option') == "com_search" && JFactory::getApplication()->input->get('type') == "component"){
			return false;
		}
		 

		/*
		 //don't run if in edit mode and flag enabled
		if ($app->input->get('layout') == 'edit' && JFactory::getApplication()->input->get('type') == "component" && $params->get('editenabled',0) == 0)
			return true;
		*/
		 

		// Everything checks out
		return true;
	}

}
