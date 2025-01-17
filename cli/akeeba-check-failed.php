<?php
/**
 *  @package AkeebaBackup
 *  @copyright Copyright (c)2006-2017 Nicholas K. Dionysopoulos / Akeeba Ltd
 *  @license GNU General Public License version 3, or later
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *  --
 *
 *  Command-line script to schedule the File Alteration Monitor check
 */

// Define ourselves as a parent file
define('_JEXEC', 1);

// Setup and import the base CLI script
$minphp = '5.4.0';
$curdir = __DIR__;

require_once __DIR__ . '/../administrator/components/com_akeeba/Master/Cli/Base.php';

// Enable Akeeba Engine
define('AKEEBAENGINE', 1);

use Akeeba\Engine\Platform;

/**
 * Akeeba Backup Check failed application
 */
class AkeebaBackupCheckfailed extends AkeebaCliBase
{
	public function execute()
	{
		// Load the language files
		$paths	 = array(JPATH_ADMINISTRATOR, JPATH_ROOT);
		$jlang	 = JFactory::getLanguage();
		$jlang->load('com_akeeba', $paths[0], 'en-GB', true);
		$jlang->load('com_akeeba', $paths[1], 'en-GB', true);
		$jlang->load('com_akeeba' . '.override', $paths[0], 'en-GB', true);
		$jlang->load('com_akeeba' . '.override', $paths[1], 'en-GB', true);

		$debugmessage = '';
		if ($this->input->get('debug', -1, 'int') != -1)
		{
			if (!defined('AKEEBADEBUG'))
			{
				define('AKEEBADEBUG', 1);
			}
			$debugmessage = "*** DEBUG MODE ENABLED ***\n";
		}

		$version		 = AKEEBA_VERSION;
		$date			 = AKEEBA_DATE;

		$phpversion		 = PHP_VERSION;
		$phpenvironment	 = PHP_SAPI;

		if ($this->input->get('quiet', -1, 'int') == -1)
		{
			$year = gmdate('Y');
			echo <<<ENDBLOCK
Akeeba Backup Check failed backups CLI $version ($date)
Copyright (c) 2006-$year Akeeba Ltd / Nicholas K. Dionysopoulos
-------------------------------------------------------------------------------
Akeeba Backup is Free Software, distributed under the terms of the GNU General
Public License version 3 or, at your option, any later version.
This program comes with ABSOLUTELY NO WARRANTY as per sections 15 & 16 of the
license. See http://www.gnu.org/licenses/gpl-3.0.html for details.
-------------------------------------------------------------------------------
You are using PHP $phpversion ($phpenvironment)
$debugmessage
Checking for failed backups

ENDBLOCK;
		}

		// Load the engine
		$factoryPath = JPATH_ADMINISTRATOR . '/components/com_akeeba/BackupEngine/Factory.php';
		define('JPATH_COMPONENT_ADMINISTRATOR', JPATH_ADMINISTRATOR . '/components/com_akeeba');
		define('AKEEBAROOT', JPATH_ADMINISTRATOR . '/components/com_akeeba/akeeba');
		if (!file_exists($factoryPath))
		{
			echo "ERROR!\n";
			echo "Could not load the backup engine; file does not exist. Technical information:\n";
			echo "Path to " . basename(__FILE__) . ": " . __DIR__ . "\n";
			echo "Path to factory file: $factoryPath\n";
			die("\n");
		}
		else
		{
			try
			{
				require_once $factoryPath;
			}
			catch (Exception $e)
			{
				echo "ERROR!\n";
				echo "Backup engine returned an error. Technical information:\n";
				echo "Error message:\n\n";
				echo $e->getMessage() . "\n\n";
				echo "Path to " . basename(__FILE__) . ":" . __DIR__ . "\n";
				echo "Path to factory file: $factoryPath\n";
				die("\n");
			}
		}

		// Assign the correct platform
		Platform::addPlatform('joomla3x', JPATH_COMPONENT_ADMINISTRATOR . '/BackupPlatform/Joomla3x');

        define('AKEEBA_BACKUP_ORIGIN', 'cli');

        // Work around some misconfigured servers which print out notices
		if (function_exists('error_reporting'))
		{
			$oldLevel = error_reporting(0);
		}

		$container = \FOF30\Container\Container::getInstance('com_akeeba', [
			'input' => $this->input
		]);

		if (function_exists('error_reporting'))
		{
			error_reporting($oldLevel);
		}

		/** @var \Akeeba\Backup\Site\Model\Statistics $model */
		$model = $container->factory->model('Statistics')->tmpInstance();
        $result = $model->notifyFailed();

        echo implode("\n", $result['message']);

		exit();
	}
}
// Load the version file
require_once JPATH_ADMINISTRATOR . '/components/com_akeeba/version.php';

// Instanciate and run the application
AkeebaCliBase::getInstance('AkeebaBackupCheckfailed')->execute();