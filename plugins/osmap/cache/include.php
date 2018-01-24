<?php
/**
 * @package   OSMap
 * @copyright 2007-2014 XMap - Joomla! Vargas - Guillermo Vargas. All rights reserved.
 * @copyright 2016 Open Source Training, LLC. All rights reserved.
 * @contact   www.joomlashack.com, help@joomlashack.com
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
 */

use Alledia\Framework;
use Alledia\OSMap;

defined('_JEXEC') or die();

if (!defined('OSMAPPLUGINCACHE_LOADED')) {
    require_once JPATH_ADMINISTRATOR . '/components/com_osmap/include.php';

    Framework\AutoLoader::register('\\Alledia\\OSMapPluginCache', __DIR__ . '/library');

    // Load the language file
    OSMap\Factory::getLanguage()->load('plg_osmap_cache', JPATH_ADMINISTRATOR);

    define('OSMAPPLUGINCACHE_LOADED', 1);
}
