<?php
/**
 * @package   OSMap
 * @copyright 2007-2014 XMap - Joomla! Vargas - Guillermo Vargas. All rights reserved.
 * @copyright 2016 Open Source Training, LLC. All rights reserved.
 * @contact   www.joomlashack.com, help@joomlashack.com
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
 */

namespace Alledia\OSMap\Sitemap\ItemAdapter;

use Alledia\OSMap;

defined('_JEXEC') or die();

class GenericPro extends Generic
{
    /**
     * @var string
     */
    protected $robots;

    /**
     * Gets the visible state for robots. Each adapter will check specific params. Returns
     * true if the item is visible.
     *
     * @return bool
     */
    public function checkVisibilityForRobots()
    {
        $robots = $this->getRobotsSettings();

        return $robots !== 'noindex, nofollow';
    }

    /**
     * Returns the generic robots settings, grabbing from the global settings
     *
     * @return string
     */
    protected function getRobotsSettings()
    {
        // Get the item's robots settings
        if (isset($this->item->params)) {
            $this->robots = $this->item->params->get('robots');
        }

        // Check if the robots is empty (set to global is the same as empty)
        if (empty($this->robots)) {
            // Get the global configuration for robots
            $this->robots = OSMap\Factory::getConfig()->get('robots', '');
        }

        return $this->robots;
    }
}
