<?php
/**
 * @package         Regular Labs Library
 * @version         18.1.3203
 * 
 * @author          Peter van Westen <info@regularlabs.com>
 * @link            http://www.regularlabs.com
 * @copyright       Copyright © 2018 Regular Labs All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

namespace RegularLabs\Library\Condition;

defined('_JEXEC') or die;

/**
 * Class ZooItem
 * @package RegularLabs\Library\Condition
 */
class ZooItem
	extends Zoo
{
	public function pass()
	{
		if ( ! $this->request->id || $this->request->option != 'com_zoo')
		{
			return $this->_(false);
		}

		if ($this->request->view != 'item')
		{
			return $this->_(false);
		}

		$pass = false;

		// Pass Article Id
		if ( ! $this->passItemByType($pass, 'ContentId'))
		{
			return $this->_(false);
		}

		// Pass Author
		if ( ! $this->passItemByType($pass, 'Author'))
		{
			return $this->_(false);
		}

		return $this->_($pass);
	}
}
