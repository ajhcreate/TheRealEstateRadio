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

jimport('joomla.application.menu');
jimport( 'joomla.html.parameter' );

class plgGurupaymentPaypaypal extends JPlugin{

	var $_db = null;
    
	function plgGurupaymentPaypaypal(&$subject, $config){
		$this->_db = JFactory :: getDBO();
		parent :: __construct($subject, $config);
	}
	
	function onReceivePayment(&$post){
		if($post['processor'] != 'paypaypal'){
			return 0;
		}	
		
		$params = new JRegistry($post['params']);
		$default = $this->params;
        
		$out['sid'] = $post['sid'];
		$out['order_id'] = $post['order_id'];
		$out['processor'] = $post['processor'];
		if(isset($post['txn_id'])){
			$out['processor_id'] = JRequest::getVar('tx', $post['txn_id']);
		}
		else{
			$out['processor_id'] = "";
		}
		if(isset($post['custom'])){
			$out['customer_id'] = JRequest::getInt('cm', $post['custom']);
		}
		else{
			$out['customer_id'] = "";
		}
		if(isset($post['mc_gross'])){
			$out['price'] = JRequest::getVar('amount', JRequest::getVar('mc_amount3', JRequest::getVar('mc_amount1', $post['mc_gross'])));
		}
		else{
			$out['price'] = "";
		}
		$out['pay'] = $post['pay'];
		if(isset($post['email'])){
			$out['email'] = $post['email'];
		}
		else{
			$out['email'] = "";
		}
		$out["Itemid"] = $post["Itemid"];

		if($params->get('paypaypal_errorlog', $default->get('paypaypal_errorlog'))) error_log("\n\n[Start get post]: ".print_r($post,true),3,JPATH_ROOT.DS.'plugins'.DS.'gurupayment'.DS.'papaypal_log.txt');

		if($out['pay'] == 'ipn'){
			$s_info = jcsPPGetInfo($params, $post, $default);
			if ($params->get('paypaypal_errorlog', $default->get('paypaypal_errorlog'))){
				error_log("\n[Return Paypal]: ".print_r($s_info,true), 3, JPATH_ROOT.DS.'plugins'.DS.'gurupayment'.DS.'papaypal_log.txt');
			}
			$database = JFactory::getDBO();

			if(isset($s_info['txn_type'])){
				switch($s_info['txn_type']){
					case "subscr_signup":
						break;
					case "send_money":
					case "web_accept":
					case "subscr_payment":
						switch ($s_info['payment_status']){
							case 'Processed':
							case 'Completed':
								break;
							case 'Refunded':
								return;
								break;
							case 'In-Progress':
							case 'Pending':
								$out['pay'] = 'fail';
								break;
							default:
								return;
						}
						break;

					case 'recurring_payment':
						break;
								
					case "subscr_failed":
							break;
					case "subscr_eot":
					case "subscr_cancel":
						return;
						break;
					case "new_case":
						return;
						break;
					case "adjustment":
						default: 
						break;
				}
			}
		}
		return $out;
	}

	function onSendPayment(&$post){
		if($post['processor'] != 'paypaypal'){
			return false;
		}
		$params = new JRegistry($post['params']);
		$param['option'] = $post['option'];
		$param['controller'] = $post['controller'];
		$param['task'] = $post['task'];
		$param['processor'] = $post['processor'];
		$param['order_id'] = @$post['order_id'];
		$param['sid'] = @$post['sid'];
		$param['Itemid'] = isset($post['Itemid']) ? $post['Itemid'] : '0';
	
		$return = JURI::root().'index.php?option=com_guru&controller=guruBuy&processor='.$param['processor'].'&task='.$param['task'].'&sid='.$param['sid'].'&order_id='.$post['order_id'].'&customer_id='.intval($post['customer_id']).'&pay=wait';
		$cancel_return = JURI::root().'index.php?option=com_guru&controller=guruBuy&processor='.$param['processor'].'&task='.$param['task'].'&sid='.$param['sid'].'&order_id='.$post['order_id'].'&pay=fail';
		$notify = JURI::base().'index.php?'.PPArray2Url($param).'&customer_id='.intval($post['customer_id']).'&pay=ipn';		

		unset($param);
		
		if($params->get('paypaypal_print_ipn', 0) && true){
			print  "<pre>";
			print_r(urldecode($notify));
			print  "</pre>";
			exit;
		}

		$param['upload'] = 1;
		$param['no_note'] = 1;
		$param['notify_url'] = $notify;
		$param['return'] = $return;
		$param['cancel_return'] = $cancel_return;
		$param['lc'] = $params->get('paypaypal_lc');
		$param['no_shipping'] = $params->get('paypaypal_ship');
		$param['cmd'] = "_cart";
		$param['custom'] = $post['customer_id'];
		$param['rm'] = "2";
		$param['business'] = $params->get('paypaypal_email');
		$param['currency_code'] = $post["config"]["0"]["currency"];
		$param['discount_amount_cart'] = @floatval($post['order_amount']);				
		
		if(!$param['business'] || !$param['currency_code']){
			JError::raiseWarning(403, JText::_('PLG_PAYPAMENT_PAYPAL_ERROR'));
			return;
		}
		
		$url = 'https://www.paypal.com/us/cgi-bin/webscr'; //?'.PPArray2Url($param);
		if($params->get('paypaypal_sandbox')){
			$url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; //?'.PPArray2Url($param);
		}

        include(JPATH_COMPONENT_SITE.DS.'helpers'.DS.'form.creator.php');

        $form = new guruFormCreator('PayPalPayment', $url);

        foreach($param AS $k => $v){
            $out[] = "$k=$v";
            $form->addHiddenField($k, $v);
        }
        $poz = 1;
		foreach($post['products'] as $i => $item){
			if ($i < 0){
				continue;
			}	
            $form->addHiddenField('item_name_'.($poz), str_replace('"', "'", $item["name"]));
            $form->addHiddenField('amount_'.($poz), sprintf("%.2f",$item["value"]));
            $form->addHiddenField('quantity_'.($poz), "1");
			$poz++;
        }
		$form->addAutoSubmit();		
        $z = $form->toString();
		return $z;
	}
	
	function onCheckParams($params){
		$db = JFactory::getDBO();
		$sql = "SELECT element FROM #__extensions WHERE folder = 'gurupayment' AND element = 'paypaypal'";
		$db->setQuery($sql);
		$title = $db->loadResult();
		if($params->get('paypaypal_email') == '')
		JError::raiseNotice(100, $title.': '.JText::_('PLG_PAYPAMENT_PAYPAL_ERROR_EMAIL'));
		if($params->get('paypaypal_requre') && !$params->get('paypaypal_ipn'))
		JError::raiseNotice(100, $title.': '.JText::_('PLG_PAYPAMENT_PAYPAL_ERROR_IPN'));
	}
}


function jcsPPGetInfo($params, $post, $default){
	$req = 'cmd=_notify-validate';
	foreach ($_POST as $key => $value) {
		$value = urlencode(stripslashes($value));
		$req .= "&$key=$value";
	}
	$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

	if($params->get('paypaypal_sandbox', $default->get('paypaypal_sandbox'))){
		$fp = fsockopen ('www.sandbox.paypal.com', 80, $errno, $errstr, 30);
		if($params->get('paypaypal__errorlog', $default->get('paypaypal__errorlog'))) error_log("\n[Open socket Sandbox]",3, JPATH_ROOT.DS.'plugins'.DS.'gurupayment'.DS.'papaypal_log.txt');

	}
	else {
		$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
		if($params->get('paypaypal__errorlog', $default->get('paypaypal__errorlog'))) error_log("\n[Open socket]: ",3, JPATH_ROOT.DS.'plugins'.DS.'gurupayment'.DS.'papaypal_log.txt');

	}
	jimport('joomla.filesystem.file');
	if ($fp){
		if($params->get('paypaypal__errorlog', $default->get('paypaypal__errorlog'))) error_log("\n[Connected]: ",3, JPATH_ROOT.DS.'plugins'.DS.'gurupayment'.DS.'papaypal_log.txt');
		fputs ($fp, $header . $req);
		while (!feof($fp)) {
			$res = fgets ($fp, 1024);

			if (strcmp ($res, "VERIFIED") == 0) {

				if($params->get('paypaypal_errorlog', $default->get('paypaypal_errorlog'))) error_log("\n[Verified]: ",3,JPATH_ROOT.DS.'plugins'.DS.'gurupayment'.DS.'papaypal_log.txt');
				return $_POST;
			}
			else if (strcmp ($res, "INVALID") == 0) {
				if($params->get('paypaypal_errorlog', $default->get('paypaypal_errorlog'))) error_log("\n\n[Invalid]: ".print_r($res,true),3,JPATH_ROOT.DS.'plugins'.DS.'gurupayment'.DS.'papaypal_log.txt');
			}

		}
		fclose ($fp);
	}
	else{
		if($params->get('paypaypal_errorlog', $default->get('paypaypal_errorlog'))){
			error_log("\n\n[Connect Error]: ".$errno.$errstr,3,JPATH_ROOT.DS.'plugins'.DS.'gurupayment'.DS.'papaypal_log.txt');
		}	
	}
	return false;
}

function PPArray2Url($param){
	foreach($param AS $k => $v){
		$out[] = "$k=$v";
	}
	return implode('&', $out );
}
?>