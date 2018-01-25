<?php
/**
* @copyright	Copyright (C) 2013 Jsn Project company. All rights reserved.
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* @package		Easy Profile
* website		www.easy-profile.com
* Technical Support : Forum -	http://www.easy-profile.com/support.html
*/

defined('_JEXEC') or die;


JFormHelper::loadFieldClass('radio');

/**
 * Form Field class for the Joomla Framework.
 *
 * @package     Joomla.Libraries
 * @subpackage  Form
 * @since       3.1
 */
class JFormFieldRadiolist extends JFormFieldRadio
{
	public $type = 'Radiolist';

	public $isNested = null;
	
	public $table = null;

	protected $comParams = null;

	/**
	 * Constructor
	 *
	 * @since  3.1
	 */
	public function __construct()
	{
		parent::__construct();

		// Load com_jsn config
		$this->comParams = JComponentHelper::getParams('com_jsn');
	}

	
	protected function getInput()
	{
		if($this->element['optioninline']==1) $inline='inline';
		else $inline='';
		$html=array();
		$from=array('<label','<input','</label>');
		$to=array('<span','<label class="radio '.$inline.'"><input ','</span></label>');
		$html[]=str_replace($from,$to,parent::getInput());
		return implode('', $html);
	}
	public function getOptions()
	{
		return parent::getOptions();
	}

}
