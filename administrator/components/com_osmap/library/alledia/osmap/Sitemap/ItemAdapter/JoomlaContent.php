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
use Joomla\Registry\Registry;

defined('_JEXEC') or die();

abstract class JoomlaContent extends GenericPro
{
    /**
     * @var string
     */
    protected $tableName = '#__table_name';

    /**
     * Returns the generic robots settings
     *
     * @return string
     */
    protected function getRobotsSettings()
    {
        $db = OSMap\Factory::getDbo();

        // Get the robots params from the row
        $query = $db->getQuery(true)
            ->select('metadata')
            ->from($db->quoteName($this->tableName))
            ->where($db->quoteName('id') . '=' . (int) $this->item->id);
        $row = $db->setQuery($query)->loadObject();

        if (!is_null($row)) {
            $metadata = new Registry($row->metadata);

            $this->robots = $metadata->get('robots');
        }

        // There is no params, so lets check the global settings
        if (is_null($this->robots)) {
            parent::getRobotsSettings();
        }

        return $this->robots;
    }
}
