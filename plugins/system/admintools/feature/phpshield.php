<?php
/**
 * @package   AdminTools
 * @copyright Copyright (c)2010-2017 Nicholas K. Dionysopoulos
 * @license   GNU General Public License version 3, or later
 */

defined('_JEXEC') or die;

/**
 * This class will intercept and block all variables that start with the php:// string.
 * Such kind of attacks are used in LFI vulnerabilitis to actually _read_ the contents of the file.
 * For example:
 *  include($something . ".php");
 *
 * could be exploited with:
 *  http://localhost/index.php?page=php://filter/convert.base64-encode/resource=index
 *
 * PHP won't interpret the resource as code, but will encode it in base64, displaying the source code
 *
 */
class AtsystemFeaturePhpshield extends AtsystemFeatureAbstract
{
	protected $loadOrder = 355;

	/**
	 * Is this feature enabled?
	 *
	 * @return bool
	 */
	public function isEnabled()
	{
		if (!$this->container->platform->isFrontend())
		{
			return false;
		}

		if ($this->skipFiltering)
		{
			return false;
		}

		return ($this->cparams->getValue('phpshield', 1) == 1);
	}

	/**
	 * PHP wrapper inclusion block. If any query string parameter starts with the php:// string it will be blocked
	 */
	public function onAfterInitialise()
	{
		$hashes = array('get', 'post');
		// Block every request that contain the php:// wrapper, such as
		// http://localhost/ex1.php?page=php://filter/convert.base64-encode/resource=PAGE
		$pattern = 'php://';

		foreach ($hashes as $hash)
		{
			$input = $this->input->$hash;
			$ref = new ReflectionProperty($input, 'data');
			$ref->setAccessible(true);
			$allVars = $ref->getValue($input);

			if (empty($allVars))
			{
				continue;
			}

			if ($this->match_array_and_scan($pattern, $allVars))
			{
				$extraInfo = "Hash      : $hash\n";
				$extraInfo .= "Variables :\n";
				$extraInfo .= print_r($allVars, true);
				$extraInfo .= "\n";
				$this->exceptionsHandler->blockRequest('phpshield', null, $extraInfo);
			}
		}
	}

	private function match_array_and_scan($pattern, $array)
	{
		$result = false;

		if (is_array($array))
		{
			foreach ($array as $key => $value)
			{
				if (!empty($this->exceptions) && in_array($key, $this->exceptions))
				{
					continue;
				}

				if (is_array($value))
				{
					$result = $this->match_array_and_scan($pattern, $value);
				}
				else
				{
					$result = (stripos($value, $pattern) === 0);
				}
			}
		}
		elseif (is_string($array))
		{
			$result = (stripos($array, $pattern) === 0);
		}

		return $result;
	}
}