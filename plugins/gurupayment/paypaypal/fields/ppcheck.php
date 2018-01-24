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

class JFormFieldPpcheck extends JFormField
{

	protected function getInput()
	{
		if(function_exists('fsockopen'))
		{
			if($fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30))
			{
				$html = 'fsockopen = <span style="color:green">'.JText::_('PLG_PAYPAMENT_PAYPAL_ENABLE').'</span>';
				fclose ($fp);
			}
			else 
			{
				$html = 'fsockopen = <span style="color:red">'.JText::_('PLG_PAYPAMENT_PAYPAL_ENABLE_NO_CONNECT').'</span>';
			}
		}else {
			$html = 'fsockopen = <span style="color:red">'.JText::_('PLG_PAYPAMENT_PAYPAL_DISABLE').'</span>';
		}
		return $html;
	}
}