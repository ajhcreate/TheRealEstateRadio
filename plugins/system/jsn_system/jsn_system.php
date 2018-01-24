<?php
/**
* @copyright	Copyright (C) 2013 Jsn Project company. All rights reserved.
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* @package		Easy Profile
* website		www.easy-profile.com
* Technical Support : Forum -	http://www.easy-profile.com/support.html
*/

defined('_JEXEC') or die;

class plgSystemJsn_System extends JPlugin
{
	public function onAfterRoute()
	{
		$app=JFactory::getApplication();
		
		// Load Config
		$config = JComponentHelper::getParams('com_jsn');

		// Backend Users Override
		require_once(JPATH_ADMINISTRATOR.'/components/com_jsn/defines.php');

		if(JSN_TYPE != 'free') defined('JSN_ENV') or die;

		if(JSN_TYPE != 'free' && $app->isAdmin() && JFactory::getApplication()->input->get('option')=='com_users' && JFactory::getApplication()->input->get('view','users')=='users' && JFactory::getApplication()->input->get('task','')=='' && JFactory::getApplication()->input->get('tmpl','')=='')
			$app->redirect('index.php?option=com_jsn&view=users');

		// Restore User Views on Create and Edit User
		if(JSN_TYPE != 'free' && $app->isAdmin() && JFactory::getApplication()->input->get('option')=='com_jsn' && JFactory::getApplication()->input->get('view','')=='user' && JFactory::getApplication()->input->get('task','')=='')
		{
			if(JFactory::getApplication()->input->get('id','')) $app->redirect('index.php?option=com_users&view=users&task=user.edit&id='.JFactory::getApplication()->input->get('id',''));
			else $app->redirect('index.php?option=com_users&view=user&task=user.add');
		}

		
		// Load Language for modules
		if($app->isAdmin() && (JFactory::getApplication()->input->get('option')=='com_modules' || JFactory::getApplication()->input->get('option')=='com_advancedmodules')) // Added advanced module configuration
		{
			$lang = JFactory::getLanguage();
			$lang->load('com_jsn');
		}
		
		if($config->get('logintype', 'USERNAME')=='MAIL')
		{
			// Reset Password with Email config
			if(JFactory::getApplication()->input->get('task')=='reset.confirm')
			{
				$input = JFactory::getApplication()->input;
				$form=$input->post->get('jform', array(), 'array');
				if(isset($form['username'])){
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query->select('a.username')->from('#__users as a')->where('email = '.$db->quote($form['username']));
					$db->setQuery( $query );
					if($username=$db->loadResult()){
						$form['username']=$username;
						$input->post->set('jform', $form);
						JFactory::getApplication()->input->set('jform', $form);
					}
				}
			}
			// Register with Email config (Bug username in email)
			if(JFactory::getApplication()->input->get('task')=='registration.register' || ($app->isAdmin() && JFactory::getApplication()->input->get('option')=='com_users' && JFactory::getApplication()->input->get('layout')=='edit' && JFactory::getApplication()->input->get('id',-1)==0 ))
			{
				$input = JFactory::getApplication()->input;
				$form=$input->post->get('jform', array(), 'array');
				if($app->isSite()) $form['username']=$form['email1'];
				else  $form['username']=$form['email'];
				$input->post->set('jform', $form);
				JFactory::getApplication()->input->set('jform', $form);
			}
			if(JFactory::getApplication()->input->get('task')=='registration.activate')
			{
				$db = JFactory::getDbo();
				$token=JFactory::getApplication()->input->get('token',false);
				if($token){
					// Get the user id based on the token.
					$query = $db->getQuery(true);
					$query->select($db->quoteName('id'))
						->from($db->quoteName('#__users'))
						->where($db->quoteName('activation') . ' = ' . $db->quote($token))
						->where($db->quoteName('block') . ' = ' . 1)
						->where($db->quoteName('lastvisitDate') . ' = ' . $db->quote($db->getNullDate()));
					$db->setQuery($query);
					try
					{
						$userId = (int) $db->loadResult();
						$user = JFactory::getUser($userId);
						$com_users_config = JComponentHelper::getParams('com_users');
						if($com_users_config->get('useractivation',1)!=2 || ($com_users_config->get('useractivation',1)==2 && $user->getParam('activate',0)))
						{
							$user->tmp_username=$user->username;
							$user->username=$user->email;
						}
					}
					catch (RuntimeException $e)
					{
						$this->setError(JText::sprintf('COM_USERS_DATABASE_ERROR', $e->getMessage()), 500);
					}
				}
			}
		}
		
		if($app->isSite())
		{
			// ---- Edit Profiles from Frontend
			$user=JFactory::getUser();
			
			$session = JFactory::getSession();
			$original_id=$session->get('jsn_original_id',0);
			if(empty($original_id)){
				$session->set('jsn_original_id', (int) $user->id );
				$original_id=$user->id;
			}
			if($user->authorise('core.edit', 'com_users') && JFactory::getApplication()->input->get('option','')=='com_users' && JFactory::getApplication()->input->get('layout','')=='edit' && JFactory::getApplication()->input->get('user_id',0) > 0)
			{
				// Check Super User
				$editUser=JFactory::getUser(JFactory::getApplication()->input->get('user_id',0));
				if(in_array(8,$editUser->groups) && !in_array(8,$user->groups))
				{
					$lang = JFactory::getLanguage();
					$lang->load('com_jsn');
					$app->enqueueMessage(JText::_('COM_JSN_NOCHANGEADMIN'),'error');
					$app->redirect(JRoute::_('index.php?option=com_jsn&view=profile&id='.JFactory::getApplication()->input->get('user_id',0),false));
				}
				// Change edit id
				$app->setUserState('com_users.edit.profile.id', (int) JFactory::getApplication()->input->get('user_id') );
			}
			else if($user->authorise('core.edit', 'com_users') && JFactory::getApplication()->input->get('option','')=='com_users' && JFactory::getApplication()->input->get('task','')=='profile.save')
			{
				// Check Super User
				$editUser=JFactory::getUser(JFactory::getApplication()->input->get('user_id',0));
				if(in_array(8,$editUser->groups) && !in_array(8,$user->groups))
				{
					$lang = JFactory::getLanguage();
					$lang->load('com_jsn');
					$app->enqueueMessage(JText::_('COM_JSN_NOCHANGEADMIN'),'error');
					$app->redirect(JRoute::_('index.php?option=com_jsn&view=profile',false));
				}
				// Change user e editid
				$input = JFactory::getApplication()->input;
				$form=$input->post->get('jform', array(), 'array');
				if(isset($form['id']) && $form['id']!=$user->id)
				{
					$user->id=$form['id'];
					JSession::getFormToken();
					$input->post->set(JSession::getFormToken(),1);
					$app->setUserState('com_users.edit.profile.id', (int) $form['id'] );
				}
			}
			else if($user->id!=$original_id)
			{
				// Restore User
				$app->setUserState('com_users.edit.profile.id', (int) $original_id );
				$session->set('user', new JUser($original_id));
				// Redirect
				$menu = $app->getMenu();
				$profileMenu=$menu->getItems('link','index.php?option=com_jsn&view=profile',true);
				if(isset($profileMenu->id))
				{
					$app->redirect(JRoute::_('index.php?option=com_jsn&id='.$user->id.'&view=profile&Itemid='.$profileMenu->id,false));
				}
				else{
					$app->redirect(JRoute::_('index.php?option=com_jsn&id='.$user->id.'&view=profile&Itemid='.$menu->getDefault()->id,false));
				}
			}
			else 
			{
				$app->setUserState('com_users.edit.profile.id', (int) $original_id );
			}
			
			// ---- Load JSN Plugins
			JPluginHelper::importPlugin('jsn');

			// ---- Redirect
			if(JFactory::getApplication()->input->get('option')=='com_users' && JFactory::getApplication()->input->get('view')=='profile' && JFactory::getApplication()->input->get('layout')!='edit' && JFactory::getApplication()->input->get('task','')=='')
			{
				$profileMenu=JFactory::getApplication()->getMenu()->getItems('link','index.php?option=com_jsn&view=profile',true);
				if(isset($profileMenu->id)) $Itemid=$profileMenu->id;
				else $Itemid='';
				$app->redirect(JRoute::_('index.php?option=com_jsn&view=profile&Itemid='.$Itemid,false));
			}
			
			// ---- Cookie problem when access to other profiles
			$user->set('cookieLogin','');
			
			// ---- Check if required fields are not empty
			$checkRequired=$config->get('forcerequired',0);
			if($user->id && $checkRequired && !(JFactory::getApplication()->input->get('option','')=='com_jsn' && JFactory::getApplication()->input->get('view','')=='opField'))
			{
				require_once(JPATH_SITE.'/components/com_jsn/helpers/helper.php');
				$user=JsnHelper::getUser();
				
				$excludeFromCheck=JsnHelper::excludeFromProfile($user);
				$access=$user->getAuthorisedViewLevels();
				$db=JFactory::getDbo();
				$query = $db->getQuery(true);
				$query->select('a.alias')->from('#__jsn_fields AS a')->join('LEFT','#__jsn_fields AS b ON a.parent_id = b.id')->where('a.level = 2')->where('a.published = 1')->where('a.required > 0')->where('a.edit = 1')->where('a.access IN ('.implode(',',$access).')')->where('b.access IN ('.implode(',',$access).')');
				$db->setQuery( $query );
				$requiredFields = $db->loadColumn();
				$required=true;
				foreach($requiredFields as $requiredField)
				{
					$formFormatRequiredField='jform['.$requiredField.']';
					if(!in_array($formFormatRequiredField,$excludeFromCheck) && (!isset($user->$requiredField) || $user->$requiredField=='')) $required=false;
				}
				if(!$required)
				{
					if(JFactory::getApplication()->input->get('option')=='com_users' && JFactory::getApplication()->input->get('view')=='profile' && JFactory::getApplication()->input->get('layout')=='edit')
					{
						$lang = JFactory::getLanguage();
						$lang->load('com_jsn');
						if(JFactory::getApplication()->input->get('task')!='profile.save' && JFactory::getApplication()->input->get('task')!='save') $app->enqueueMessage(JText::_('COM_JSN_COMPLETEREGISTRATION'),'warning');
					}
					else{
						if(JFactory::getApplication()->input->get('task')!='profile.save' && JFactory::getApplication()->input->get('task')!='save' && JFactory::getApplication()->input->get('task')!='user.logout') $app->redirect(JRoute::_('index.php?option=com_users&view=profile&layout=edit',false));
					}
				
				}
				else
				{
					JFactory::getSession()->set('redirectAfterLogin',null);
				}
			}
			if( $config->get('layout', 1) && JFactory::getApplication()->input->get('option')=='com_users' && ( ( JFactory::getApplication()->input->get('view')=='profile' && JFactory::getApplication()->input->get('layout')=='edit' ) || (JFactory::getApplication()->input->get('view')=='registration' && JFactory::getApplication()->input->get('layout','')=='') ) )
			{
				$active=JFactory::getApplication()->getMenu()->getActive();
				if(empty($active)) {
					$active=JFactory::getApplication()->getMenu()->getDefault();
					$active->home=0;
				}
				$active->query['layout']='easyprofile';
				JFactory::getApplication()->getMenu()->setActive($active->id);
			}
		}
	}
	
	function onAfterRender()
    {
		$app = JFactory::getApplication();
		require_once(JPATH_ADMINISTRATOR.'/components/com_jsn/defines.php');
		if (!$app->isAdmin() && JSN_TYPE == 'pro'){
			$config = JComponentHelper::getParams('com_jsn');
			$buttons_everywhere_tag = $config->get('buttons_everywhere_tag','');
			if(empty($buttons_everywhere_tag)) $buttons_everywhere_tag = 'socialconnect';
			$page=JResponse::getBody();
			$page=str_replace('{'.$buttons_everywhere_tag.'_icon}', '<div class="socialconnect icon"></div>', $page);
			$page=str_replace('{'.$buttons_everywhere_tag.'}', '<div class="socialconnect"></div>', $page);
			require_once(JPATH_SITE.'/components/com_jsn/helpers/helper.php');
			$user=JsnHelper::getUser();
			if(!$user->guest)
			{
				$output=array();
				$output[]='<div class="socialconnect_unlink">';
				if(!empty($user->facebook_id)) $output[]='<div><a class="zocial facebook" href="index.php?option=com_jsn&amp;view=facebook&task=unset">'.JText::_('COM_JSN_UNLINK').'</a></div>';
				if(!empty($user->twitter_id)) $output[]='<div><a class="zocial twitter" href="index.php?option=com_jsn&amp;view=twitter&task=unset">'.JText::_('COM_JSN_UNLINK').'</a></div>';
				if(!empty($user->google_id)) $output[]='<div><a class="zocial googleplus" href="index.php?option=com_jsn&amp;view=google&task=unset">'.JText::_('COM_JSN_UNLINK').'</a></div>';
				if(!empty($user->linkedin_id)) $output[]='<div><a class="zocial linkedin" href="index.php?option=com_jsn&amp;view=linkedin&task=unset">'.JText::_('COM_JSN_UNLINK').'</a></div>';
				$output[]='</div>';
				$page=str_replace('{'.$buttons_everywhere_tag.'_unlink}', implode('', $output), $page);
			}
			else $page=str_replace('{'.$buttons_everywhere_tag.'_unlink}', '', $page);
			
			JResponse::setBody($page);
		}
	}
	
	public function onBeforeCompileHead()
	{
		require_once(JPATH_ADMINISTRATOR.'/components/com_jsn/defines.php');
		$xml = JFactory::getXML(JPATH_ADMINISTRATOR .'/components/com_jsn/jsn.xml');
		$version = (string)$xml->version;

		$app=JFactory::getApplication();

		// Load Config
		$config = JComponentHelper::getParams('com_jsn');

		// Remove Remind Username if Login type is Email
		if($config->get('logintype', 'USERNAME')=='MAIL' && !$app->isAdmin())
		{
			JHtml::_('jquery.framework');
			$doc = JFactory::getDocument();
			$script='jQuery(document).ready(function($){$("a[href$=\'?view=remind\']").parent("li").remove();});';
			$doc->addScriptDeclaration( $script );
		}

		// Javascript for Tabs
		if(!$app->isAdmin() && JFactory::getApplication()->input->get('option')=='com_users' && $config->get('tabs',2))
		{
			JHtml::_('jquery.framework');
			// Tabs
			$doc = JFactory::getDocument();
			$script='
			var stepbystep='.($config->get('tabs',2)==1 || JSN_TYPE == 'free' ? 'false' : 'true' ).';
			var jsn_prev_button="'.JText::_('JPREV').'";
			var jsn_next_button="'.JText::_('JNEXT').'";
			';
			$doc->addScriptDeclaration( $script );
			$doc->addScript(JURI::root().'components/com_jsn/assets/js/tabs.js?v='.$version);
			$doc->addScript(JURI::root().'components/com_jsn/assets/js/tabs.effects.min.js?v='.$version);
			$doc->addStylesheet(JURI::root().'components/com_jsn/assets/css/tabs.min.css?v='.$version);
		}
		elseif(!$app->isAdmin() && JFactory::getApplication()->input->get('option')=='com_users')
		{
			JHtml::_('jquery.framework');
			$doc = JFactory::getDocument();
			$script='
			jQuery(document).ready(function($){
				$(\'#member-registration [type="submit"],#member-profile [type="submit"]\').click(function(){
					var found=false;			
					$(\'#member-registration .invalid,#member-profile .invalid\').each(function(){
						if(!found){
							if(jQuery(window).scrollTop()>100)
								jQuery(\'html, body\').animate({
								         scrollTop: jQuery("#system-message-container").offset().top-100
								     }, 300);
						}
						found=true;
					});		
				});
			});
			';
			$doc->addScriptDeclaration( $script );
		}
		// Javascript for com_users
		if(JFactory::getApplication()->input->get('option')=='com_users' || (JFactory::getApplication()->input->get('option')=='com_admin' && JFactory::getApplication()->input->get('view')=='profile'))
		{
			JHtml::_('jquery.framework');
			$doc = JFactory::getDocument();
			$doc->addScript(JURI::root().'components/com_jsn/assets/js/privacy.js?v='.$version);
			$doc->addScript(JURI::root().'components/com_jsn/assets/js/name.js?v='.$version);
		}

		// Javascript to resume form
		if(!$app->isAdmin() && JFactory::getApplication()->input->get('option')=='com_users' && JFactory::getApplication()->input->get('view')=='registration')
		{
			JHtml::_('jquery.framework');
			$doc = JFactory::getDocument();
			$script='
			jQuery(document).ready(function($){
				function deserialize(el,data) {
				    var f = el,
				        map = {},
				        find = function (selector) { return f.is("form") ? f.find(selector) : f.filter(selector); };
				    jQuery.each(data.split("&"), function () {
				        var nv = this.split("="),
				            n = decodeURIComponent(nv[0]),
				            v = nv.length > 1 ? decodeURIComponent(nv[1]) : null;
				        if (!(n in map)) {
				            map[n] = [];
				        }
				        map[n].push(v);
				    })
				    jQuery.each(map, function (n, v) {
				    	var x = n.replace("jform[","").replace("]","").replace("[]","");
				    	var el = find("[name=\'" + n + "\']");
				    	if(!jQuery("#"+ x + ".slim").length && !jQuery("#jsn_"+ x + "Modal").length)
				        	el.val(v).trigger("liszt:updated");
				    })
				    return el;
				};
				function serializeAndEncode(el) {
				    return $.map(el.serializeArray(), function(val) {
				        return [val.name, encodeURIComponent(val.value)].join(\'=\');
				    }).join(\'&\');
				};
				var data = sessionStorage.getItem("form.registration");
				if(data != null){
					deserialize($(\'#member-registration\'),data);
				}
				sessionStorage.setItem("form.registration",null);
				$(\'#member-registration\').submit(function(){
						sessionStorage.setItem("form.registration",serializeAndEncode($(\'#member-registration\')));
				});
			});
			';
			$doc->addScriptDeclaration( $script );
		}
		
		// Javascript for Condition (com_users and userlist search form)
		if((JFactory::getApplication()->input->get('option','')=='com_users' && JFactory::getApplication()->input->get('layout','')=='edit') || (JFactory::getApplication()->input->get('option','')=='com_users' && JFactory::getApplication()->input->get('layout','')=='' && JFactory::getApplication()->input->get('view','')=='registration') || (JFactory::getApplication()->input->get('option','')=='com_jsn' && JFactory::getApplication()->input->get('view','')=='list') || (JFactory::getApplication()->input->get('option')=='com_admin' && JFactory::getApplication()->input->get('view')=='profile'))
		{
			JHtml::_('jquery.framework');
			require_once(JPATH_SITE.'/components/com_jsn/helpers/helper.php');
			$user=JsnHelper::getUser();
			$access=$user->getAuthorisedViewLevels();
			$doc = JFactory::getDocument();
			$db=JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('a.*')->from('#__jsn_fields AS a')->join('LEFT','#__jsn_fields AS b ON a.parent_id = b.id')->where('a.level = 2')->where('a.published = 1')->where('a.access IN ('.implode(',',$access).')')->where('b.access IN ('.implode(',',$access).')')->order($db->escape('a.lft') . ' ASC');
			$db->setQuery( $query );
			$fields = $db->loadObjectList('alias');
			$script='jQuery(document).ready(function($){
				var hideFieldset=$("#member-profile fieldset.hide,#member-registration fieldset.hide").length;
				$(".spacer").closest(".control-group,.form-group").addClass("spacer-container");
				function checkFieldset(){
					$("#member-profile fieldset:not(.radio ):not(.checkboxes ),#member-registration fieldset:not(.radio ):not(.checkboxes )").each(function(){
						if($(this).find(".control-group.hide,.form-group.hide").length==$(this).find(".control-group:not(.spacer-container),.form-group:not(.spacer-container)").length){
							$(this).hide().addClass("hide");
						}
						else {
							$(this).show().removeClass("hide");							
						}
						
					});'
				.(!$app->isAdmin() && $config->get('tabs',2) ? '	if($("#member-profile fieldset.hide,#member-registration fieldset.hide").length!=hideFieldset){
						hideFieldset=$("#member-profile fieldset.hide,#member-registration fieldset.hide").length;
						tabs($);
					}' : '').
				($app->isAdmin() ? '
					$("#myTabContent > div.tab-pane").each(function(){
						if($(this).find(".control-group:not(.hide)").length){
							$(\'a[href="#\'+$(this).attr(\'id\')+\'"]\').parent().show().removeClass("hide");	
						}
						else {
							$(\'a[href="#\'+$(this).attr(\'id\')+\'"]\').parent().hide().addClass("hide");					
						}
						
					});
					' : '')
				.'}
				';
			foreach($fields as $field)
			{
				// Load Conditions
				if(!empty($field->conditions)) $field->conditions=json_decode($field->conditions);
				else $field->conditions = array();
				// Add field hidden in form
				$skip=array(/*'password','email',*/'registerdate','lastvisitdate');
				if(!$app->isAdmin() && !($config->get('admin_frontend', 0) && $user->authorise('core.edit', 'com_users')) && ((JFactory::getApplication()->input->get('option')=='com_users' && JFactory::getApplication()->input->get('layout')=='edit' && $field->edit==0) || (JFactory::getApplication()->input->get('option')=='com_users' && JFactory::getApplication()->input->get('view')=='registration' && JFactory::getApplication()->input->get('task','')=='' && $field->register==0)) && !in_array($field->alias,$skip) && $field->type!='delimeter')
				{
					$alias=$field->alias;
					$userValue=(isset($user->$alias) ? $user->$alias : '');
					if(is_array($userValue)) $userValue=implode(',',$userValue);
					$script.='if(!$("#jform_'.str_replace('-','_',$field->alias).'").length) $("form#member-registration,form#member-profile").after("<input type=\"hidden\" id=\"jform_'.str_replace('-','_',$field->alias).'\" value=\"'.str_replace(array("\n","\r"), '',$userValue).'\" />");';
					$field->type="hidden";
				}
				// Conditions
				foreach($field->conditions as $condition)
				{
					if( !in_array($condition->action,array('fields_show','fields_hide') ) || empty($condition->fields_target) ) continue;
					$twoWays = $condition->two_ways;
					$actionShowFields = ($condition->action == 'fields_show' ? true : false);

					switch($condition->operator)
					{
						case 1:
							$operator='==';
							$operator_post='';
						break;
						case 2:
							$operator='>';
							$operator_post='';
						break;
						case 3:
							$operator='<';
							$operator_post='';
						break;
						case 4:
							$operator='.indexOf';
							$operator_post='!=-1';
						break;
						case 5:
							$operator='!=';
							$operator_post='';
						break;
						case 6:
							$operator='.indexOf';
							$operator_post='!=-1';
						break;
					}
					// Field to Show/Hide
					$fieldsTarget='';
					foreach($condition->fields_target as $field_target)
					{
						$fieldsTarget.='#jform_'.str_replace('-','_',$field_target).',';
						$fieldsTarget.='#jform_privacy_'.str_replace('-','_',$field_target).',';
					}
					$fieldsTarget=trim($fieldsTarget,',');
					// Field to Check
					if($condition->to=='_custom') $valueToCheck='var valToCheck="'.$condition->custom_value.'";';
					else $valueToCheck='
						var valToCheck=$("#jform_'.str_replace('-','_',$condition->to).'").val();
						$("#jform_'.str_replace('-','_',$condition->to).' input:checked").each(function(){
							if(valToCheck=="") valToCheck=$(this).val();
							else valToCheck=valToCheck+","+$(this).val();
						});
					';
					// Field to Bind
					if($condition->to=='_custom') $fieldToBind='#jform_'.str_replace('-','_',$field->alias);
					else $fieldToBind='#jform_'.str_replace('-','_',$field->alias).',#jform_'.str_replace('-','_',$condition->to);
					// Show/Hide Script
					$script_showStart = 'if($(this).is(".norequired")){
									$(this).addClass("required").removeClass("norequired").attr("required","required").attr("aria-required","true");
									$(this).find("input[type!=\'checkbox\']").addClass("required").removeClass("norequired").attr("required","required").attr("aria-required","true");
								}
								$(this).closest(".control-group,.form-group").show().removeClass("hide");';
					$script_hideStart = 'if($(this).is(".required") || $(this).is("[aria-required=\'true\']") || $(this).is("[required=\'required\']")){
									$(this).addClass("norequired").removeClass("required").removeAttr("required").attr("aria-required","false");
									$(this).find("input[type!=\'checkbox\']").addClass("norequired").removeClass("required").removeAttr("required").attr("aria-required","false");
								}
								$(this).closest(".control-group,.form-group").hide().addClass("hide");';
					$script_showSlide = 'if($(this).is(".norequired")){
									$(this).addClass("required").removeClass("norequired").attr("required","required").attr("aria-required","true");
									$(this).find("input[type!=\'checkbox\']").addClass("required").removeClass("norequired").attr("required","required").attr("aria-required","true");
								}
								$(this).closest(".control-group,.form-group").slideDown().removeClass("go-to-hide hide");checkFieldset();';
					$script_hideSlide = 'if($(this).is(".required") || $(this).is("[aria-required=\'true\']") || $(this).is("[required=\'required\']")){
									$(this).addClass("norequired").removeClass("required").removeAttr("required").attr("aria-required","false");
									$(this).find("input[type!=\'checkbox\']").addClass("norequired").removeClass("required").removeAttr("required").attr("aria-required","false");
								}
								$(this).closest(".control-group,.form-group").addClass("go-to-hide").slideUp(function(){$(this).filter(".go-to-hide").addClass("hide").removeClass("go-to-hide");checkFieldset();});';

					// Code
					$scriptval='
						var val=$("#jform_'.str_replace('-','_',$field->alias).'").val();
					';
					if($field->type=='radiolist')
						$scriptval='
							var val=$("#jform_'.str_replace('-','_',$field->alias).' input:checked").val();
						';
					if($field->type=='checkboxlist')
						$scriptval='
							var val="";
							$("#jform_'.str_replace('-','_',$field->alias).' input:checked").each(function(){
								if(val=="") val=$(this).val();
								else val=val+","+$(this).val();
							});
						';
					$script.='
						'.$scriptval.'
						if(val==null || val==undefined) val="";
						'.$valueToCheck.'
						if(valToCheck==null || valToCheck==undefined) valToCheck="";
						if($("#jform_'.str_replace('-','_',$field->alias).'").length) if(val'.$operator.'(valToCheck)'.$operator_post.')
							$("'.$fieldsTarget.'").each(function(){
								'.($actionShowFields ? $script_showStart : $script_hideStart).'
							});
						';
						if($twoWays) $script.='else
							$("'.$fieldsTarget.'").each(function(){
								'.($actionShowFields ? $script_hideStart : $script_showStart).'
							});';
						$script.='checkFieldset();
						$("'.$fieldToBind.'").bind("change keyup",function(){
							'.$scriptval.'
							if(val==null || val==undefined) val="";
							'.$valueToCheck.'
							if(valToCheck==null || valToCheck==undefined) valToCheck="";
							if(val'.$operator.'(valToCheck)'.$operator_post.')
								$("'.$fieldsTarget.'").each(function(){
									'.($actionShowFields ? $script_showSlide : $script_hideSlide).'
								});
							';
							if($twoWays) $script.='else
								$("'.$fieldsTarget.'").each(function(){
									'.($actionShowFields ? $script_hideSlide : $script_showSlide).'
								});';
						$script.='
						});';
					
				}
			}
			$script.='});';
			$doc->addScriptDeclaration( $script );
		}

		// Javascript Avatar Letters
		if(!$app->isAdmin() && $config->get('avatarletters',0) && $config->get('avatar',1) == 1 && JSN_TYPE != 'free')
		{
			$doc = JFactory::getDocument();
			$doc->addScript(JURI::root().'components/com_jsn/assets/js/avatarletters.min.js?v='.$version);
		}
		
		// Javascript Options Page (Backend)
		if($app->isAdmin() && JFactory::getApplication()->input->get('option')=='com_config' && JFactory::getApplication()->input->get('component')=='com_jsn' )
		{
			$script='jQuery(document).ready(function($){
				$("#jform_layout0, #jform_layout1").change(function(){
					if( $("#jform_layout1").is(":checked") ) {
						$("#jform_layout_width").closest(".control-group").show();
						$("#jform_layout_maxwidth").closest(".control-group").show();
						$("#jform_layout_form").closest(".control-group").show();
					}
					else {
						$("#jform_layout_width").closest(".control-group").hide();
						$("#jform_layout_maxwidth").closest(".control-group").hide();
						$("#jform_layout_form").closest(".control-group").hide();
					}
					$("#jform_layout_width0").change();
				});
				$("#jform_layout_width0, #jform_layout_width1").change(function(){
					if( $("#jform_layout_width1").is(":checked") ) {
						$("#jform_layout_maxwidth").closest(".control-group").show();
					}
					else {
						$("#jform_layout_maxwidth").closest(".control-group").hide();
					}
				});
				$("#jform_layout0").change();
				$("#jform_layout_width0").change();
				'.(JSN_TYPE == 'free' ? '
					if($("#jform_tabs2").prop("checked")) {$("#jform_tabs1 + label").addClass("active btn-success");$("#jform_tabs1").prop("checked",true).change();}
					$("#jform_tabs2 + label").remove();
					$("#jform_tabs2").after("<label class=\"btn disabled\">'.JText::_('COM_JSN_STEPBYSTEP').' - <b>NOT AVAILABLE IN FREE</b></label>");
					$("#jform_avatarletters1 + label").remove();
					$("#jform_avatarletters1").after("<label class=\"btn disabled\">'.JText::_('JYES').' - <b>NOT AVAILABLE IN FREE</b></label>");
					$("#jform_activatenewmail1 + label").remove();
					$("#jform_activatenewmail1").after("<label class=\"btn disabled\">'.JText::_('JYES').' - <b>NOT AVAILABLE IN FREE</b></label>");
					if($("#jform_avatar2").prop("checked")) {$("#jform_avatar1 + label").addClass("active btn-success");$("#jform_avatar1").prop("checked",true).change();} 
					$("#jform_avatar2 + label").remove();
					$("#jform_avatar2").after("<label class=\"btn disabled\">Gravatar - <b>NOT AVAILABLE IN FREE</b></label>");
					' : '').'
				'.(JSN_TYPE != 'pro' ? '
					$("#jform_export_all_fields0 + label,#jform_export_all_fields1 + label").remove();
					$("#jform_export_all_fields").append("<label class=\"btn disabled\"><b>ONLY PRO</b></label>");
					$("#jform_export_separator").after("<label class=\"btn disabled\"><b>ONLY PRO</b></label>");
					$("#jform_export_separator").remove();
					$("#jform_export_list_fields").closest(".control-group").remove();
					' : '').'
			});';
			$doc = JFactory::getDocument();
			$doc->addScriptDeclaration( $script );
		}

		// Add Bootstrap CSS
		if(!$app->isAdmin() && (JFactory::getApplication()->input->get('option')=='com_users' || JFactory::getApplication()->input->get('option')=='com_jsn') && $config->get('bootstrap',0))
		{
			$doc = JFactory::getDocument();
			$doc->addStylesheet(JURI::root().'media/jui/css/bootstrap.min.css');
			$dir = $doc->direction;
			if($dir=='rtl')
			{
				$doc->addStylesheet(JURI::root().'media/jui/css/bootstrap-rtl.css');
			}
		}

		// Add Bootstrap Icons
		if(!$app->isAdmin() && (JFactory::getApplication()->input->get('option')=='com_users' || JFactory::getApplication()->input->get('option')=='com_jsn') && $config->get('bootstrap_icons',0))
		{
			$doc = JFactory::getDocument();
			$doc->addStylesheet(JURI::root().'media/jui/css/icomoon.css');
		}
		
		// Add Javascript Bootstrap on profile page
		if(JFactory::getApplication()->input->get('option')=='com_jsn' && JFactory::getApplication()->input->get('view','profile')=='profile')
		{
			JHtml::_('bootstrap.framework');
			$doc = JFactory::getDocument();
			$doc->addScript(JURI::root().'components/com_jsn/assets/js/tabs.js?v='.$version);
			$doc->addScript(JURI::root().'components/com_jsn/assets/js/tabs.effects.min.js?v='.$version);
			$doc->addStylesheet(JURI::root().'components/com_jsn/assets/css/tabs.min.css?v='.$version);
		}

		// Add Style to Site (Components, Modules and Plugins)
		if($app->isSite() || (JFactory::getApplication()->input->get('option')=='com_users' || (JFactory::getApplication()->input->get('option')=='com_admin' && JFactory::getApplication()->input->get('view')=='profile')))
		{
			$doc = JFactory::getDocument();
			$doc->addStylesheet(JURI::root().'components/com_jsn/assets/css/style.min.css?v='.$version);
			$dir = $doc->direction;
			if($dir=='rtl')
			{
				$doc->addStylesheet(JURI::root().'components/com_jsn/assets/css/style-rtl.min.css?v='.$version);
			}
		}
	}
	
	public function onInstallerBeforePackageDownload(&$url, &$headers)
    {
    		require_once(JPATH_ADMINISTRATOR.'/components/com_jsn/defines.php');

            $uri = JUri::getInstance($url);

            // I don't care about download URLs not coming from our site
            $host = $uri->getHost();
            if ($host != 'www.easy-profile.com')
            {
                    return true;
            }

            // Get the download ID
            $config = JComponentHelper::getParams('com_jsn');
            $dlcode = $config->get('download_id', '');

            // If the download ID is invalid, return without any further action
            if (!preg_match('/^([0-9]{1,}:)?[0-9a-f]{32}$/i', $dlcode))
            {
                    return true;
            }

            // Append the Download ID to the download URL
            if (!empty($dlcode))
            {
            		$uri->setVar('t', JSN_TYPE);
                    $uri->setVar('dlcode', $dlcode);
                    $url = $uri->toString();
            }

            return true;
    }

    public function onCustomFieldsPrepareDom($field, DOMElement $parent, JForm $form)
	{
		$name = $form->getName();
		$id = (int) $form->getValue('id');
		if($name == 'com_users.profile' && $id > 0){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('item_id')->from('#__fields_values')->where('field_id = '. (int) $field->id)->where('item_id = '.(int) $id);
			$db->setQuery($query);
			if(!$db->loadResult()){
				$form->setValue($field->name,'com_fields','');
			}
		}
	}
}
