<?php
/**
* @copyright	Copyright (C) 2013 Jsn Project company. All rights reserved.
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* @package		Easy Profile
* website		www.easy-profile.com
* Technical Support : Forum -	http://www.easy-profile.com/support.html
*/

defined('_JEXEC') or die;


JFormHelper::loadFieldClass('checkboxes');

/**
 * Form Field class for the Joomla Framework.
 *
 * @package     Joomla.Libraries
 * @subpackage  Form
 * @since       3.1
 */
class JFormFieldCheckboxlist extends JFormFieldCheckboxes
{
	public $type = 'Checkboxlist';

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
		$version=new JVersion();
		if($version->RELEASE<'3.5'){
			$from=array('<label','</label>','<ul>','</ul>','<li','</li>');
			$to=array('<span','</span>','','','<label class="checkbox '.$inline.'"','</label>');
		}
		else{
			$from=array('class="checkbox"');
			$to=array('class="checkbox '.$inline.'"');
		}
		$html[]=str_replace($from,$to,parent::getInput());
		return implode('', $html);
	}
	public function getOptions()
	{
		return parent::getOptions();
	}

	protected function getLayoutData()
	{
		$hasValue = (isset($this->value) && !empty($this->value));
		if($hasValue && is_object($this->value)) $this->value = (array)$this->value;
		$data = parent::getLayoutData();
		return $data;
	}

}
