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
 * Class RedshopProduct
 * @package RegularLabs\Library\Condition
 */
class RedshopProduct
	extends Redshop
{
	public function pass()
	{
		if ( ! $this->request->id || $this->request->option != 'com_redshop' || $this->request->view != 'product')
		{
			return $this->_(false);
		}

		return $this->passSimple($this->request->id);
	}
}
