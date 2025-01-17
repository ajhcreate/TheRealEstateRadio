<?php
/**
 * @package   AdminTools
 * @copyright 2010-2017 Akeeba Ltd / Nicholas K. Dionysopoulos
 * @license   GNU General Public License version 3, or later
 */

namespace Akeeba\Engine\Util;

// Protection against direct access
defined('AKEEBAENGINE') or die();

use Akeeba\Engine\Factory;

/**
 * Retrieves the component configuration when Joomla! is not running, by digging directly into the Joomla!
 * database record.
 * @author Nicholas
 */
class Comconfig
{
	private static function loadConfig()
	{
		$db = Factory::getDatabase();

		$sql = $db->getQuery(true)
			->select($db->qn('params'))
			->from($db->qn('#__extensions'))
			->where($db->qn('element') . " = " . $db->q('com_admintools'));
		$db->setQuery($sql);
		$config_ini = $db->loadResult();

		// OK, Joomla! 1.6 stores values JSON-encoded so, what do I do? Right!
		$config_ini = json_decode($config_ini, true);
		if (is_null($config_ini) || empty($config_ini))
		{
			$config_ini = array();
		}

		return $config_ini;
	}

	public static function getValue($key, $default)
	{
		static $config;
		if (empty($config))
		{
			$config = self::loadConfig();
		}

		if (array_key_exists($key, $config))
		{
			return $config[$key];
		}
		else
		{
			return $default;
		}
	}
}