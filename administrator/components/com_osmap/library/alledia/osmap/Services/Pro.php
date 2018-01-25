<?php
/**
 * @package   OSMap
 * @copyright 2007-2014 XMap - Joomla! Vargas - Guillermo Vargas. All rights reserved.
 * @copyright 2016 Open Source Training, LLC. All rights reserved.
 * @contact   www.joomlashack.com, help@joomlashack.com
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
 */

namespace Alledia\OSMap\Services;

use Pimple\Container as Pimple;
use Pimple\ServiceProviderInterface;
use Alledia\OSMap;

defined('_JEXEC') or die();

/**
 * Class Services
 *
 * Pimple services for OSMap. The container must be instantiated with
 * at least the following values:
 *
 * new \OSMap\Container(
 *    array(
 *       'configuration' => new Configuration($config)
 *    )
 * )
 *
 * @package OSMap
 */
class Pro extends Free
{
    /**
     * Registers the image helper
     */
    protected function registerHelper(Pimple $pimple)
    {
        $pimple['imagesHelper'] = function (OSMap\Container $c) {
            return new OSMap\Helper\ImagesPro;
        };
    }
}
