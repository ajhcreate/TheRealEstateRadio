<?php
/**
 * @package   OSMap
 * @copyright 2007-2014 XMap - Joomla! Vargas. All rights reserved.
 * @copyright 2016 Open Source Training, LLC. All rights reserved..
 * @author    Guillermo Vargas <guille@vargas.co.cr>
 * @author    Joomlashack <help@joomlashack.com>
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 *
 * This file is part of OSMap.
 *
 * OSMap is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * OSMap is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OSMap. If not, see <http://www.gnu.org/licenses/>.
 */

use Alledia\OSMap\Sitemap\Collector;
use Alledia\OSMap\Sitemap\Item;
use Joomla\Utilities\ArrayHelper;

defined('_JEXEC') or die('Restricted access');

// Fixes warnings from inside SobiPro library. Not diresctly used here.
// Only removes if SobiPro fixed that on its code.
if (!defined('DS') && defined('DIRECTORY_SEPARATOR')) {
    define('DS', DIRECTORY_SEPARATOR);
}

/** Adds support for SobiPro categories to OSMap */
class osmap_com_sobipro
{
    /**
     * @var bool
     */
    protected $sobiInstalled = null;

    /**
     * @var object[]
     */
    public static $sectionConfig = array();

    public function __construct()
    {
        $lang      = JFactory::getLanguage();
        $extension = 'plg_osmap_com_sobipro';

        $lang->load($extension, JPATH_ADMINISTRATOR, null, false, true)
            || $lang->load($extension, JPATH_PLUGINS . '/osmap/com_sobipro', null, false, true);
    }

    /*
    * This function is called before a menu item is printed. We use it to set the
    * proper uniqueid for the item and indicate whether the node is expandible or not
    */
    public function prepareMenuItem($node, &$params)
    {
        $link_query = parse_url($node->link);
        parse_str(html_entity_decode($link_query['query']), $link_vars);
        $sid = ArrayHelper::getValue($link_vars, 'sid', 0);

        $db = JFactory::getDbo();
        $db->setQuery(
            $db->getQuery(true)
                ->select('*')
                ->from('#__sobipro_object')
                ->where('id = ' . (int)$sid)
        );
        $row = $db->loadObject();

        $node->uid = 'com_sobiproo' . $sid;

        if ($row->oType == 'section' || $row->oType == 'category') {
            $node->expandible = true;
        } else {
            $node->expandible = false;
        }
    }

    /** Get the content tree for this kind of content */
    public function getTree($osmap, $parent, &$params)
    {
        if (!$this->loadSobi()) {
            return;
        }

        $link_query = parse_url($parent->link);
        parse_str(html_entity_decode($link_query['query']), $link_vars);
        $sid  = ArrayHelper::getValue($link_vars, 'sid', 1);
        $task = ArrayHelper::getValue($link_vars, 'task', null);

        if (in_array($task, array('search', 'entry.add'))) {
            return;
        }

        $db = JFactory::getDbo();
        $db->setQuery(
            $db->getQuery(true)
                ->select('*')
                ->from('#__sobipro_object')
                ->where('id = ' . (int)$sid)
        );
        $object = $db->loadObject();

        if ($object->oType == 'entry') {
            return;
        } elseif ($object->oType == 'category') {
            $sectionId = self::findCategorySection($object->parent);
        } else {
            $sectionId = $sid;
        }

        self::$sectionConfig = self::getSectionConfig($sectionId);

        $params['include_entries'] = ArrayHelper::getValue($params, 'include_entries', 1);

        $priority   = ArrayHelper::getValue($params, 'cat_priority', $parent->priority);
        $changefreq = ArrayHelper::getValue($params, 'cat_changefreq', $parent->changefreq);

        if ($priority == '-1') {
            $priority = $parent->priority;
        }

        if ($changefreq == '-1') {
            $changefreq = $parent->changefreq;
        }

        $params['cat_priority']   = $priority;
        $params['cat_changefreq'] = $changefreq;

        $priority   = ArrayHelper::getValue($params, 'entry_priority', $parent->priority);
        $changefreq = ArrayHelper::getValue($params, 'entry_changefreq', $parent->changefreq);

        if ($priority == '-1') {
            $priority = $parent->priority;
        }

        if ($changefreq == '-1') {
            $changefreq = $parent->changefreq;
        }

        $params['entry_priority']   = $priority;
        $params['entry_changefreq'] = $changefreq;

        $date = JFactory::getDate();

        $params['now'] = $date->toSql();

        if ($params['include_entries'] > 0) {
            $params['limit'] = '';
            $params['days']  = '';

            $limit = ArrayHelper::getValue($params, 'max_entries', '');
            if (intval($limit)) {
                $params['limit'] = $limit;
            }

            $days = ArrayHelper::getValue($params, 'max_age', '');
            if (intval($days)) {
                $params['days'] = ' a.publish_up >=\'' . strftime("%Y-%m-%d %H:%M:%S",
                        $osmap->now - ($days * 86400)) . "' ";
            }
        }

        osmap_com_sobipro::getCategoryTree($osmap, $parent, $sid, $params);
    }

    /**
     * @param Collector $osmap
     * @param Item      $parent
     * @param int       $sid
     * @param array     $params
     *
     * @return void
     */
    public function getCategoryTree($osmap, $parent, $sid, &$params)
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true)
            ->select(
                array(
                    'a.id',
                    'a.nid',
                    'a.name',
                    'b.pid AS pid',
                    'l.sValue AS translatedName'
                )
            )
            ->from('#__sobipro_object AS a')
            ->innerJoin('#__sobipro_relations AS b ON a.id = b.id')
            ->innerJoin('#__sobipro_language AS l ON a.id = l.id')
            ->where(
                array(
                    'a.parent  = ' . $db->quote($sid),
                    'a.oType = ' . $db->quote('category'),
                    'b.oType = a.oType',
                    'a.state = 1',
                    'a.approved = 1',
                    'l.otype = ' . $db->quote('category'),
                    'l.language = ' . $db->quote(JFactory::getLanguage()->getTag()),
                    'l.skey = ' . $db->quote('name')
                )
            );

        $ordering  = ArrayHelper::getValue($params, 'categories_order', 'b.position');
        $direction = ArrayHelper::getValue($params, 'categories_orderdir', 'ASC');

        $query->order($ordering . ' ' . $direction);

        $db->setQuery($query);
        $rows = $db->loadObjectList();

        $modified = time();

        $osmap->changeLevel(1);

        foreach ($rows as $row) {
            $name = !empty($row->name) ? $row->name : $row->translatedName;

            $node             = new stdclass;
            $node->id         = $parent->id;
            $node->uid        = 'com_sobiproc' . $row->id; // Unique ID
            $node->browserNav = $parent->browserNav;
            $node->name       = html_entity_decode($name);
            $node->modified   = $modified;
            $node->link       = SPJoomlaMainFrame::url(array('sid' => $row->id, 'title' => $name), false, false);
            $node->priority   = $params['cat_priority'];
            $node->changefreq = $params['cat_changefreq'];
            $node->expandible = true;
            $node->secure     = $parent->secure;

            if ($osmap->printNode($node) !== false) {
                osmap_com_sobipro::getCategoryTree($osmap, $parent, $row->id, $params);
            }
        }

        if ($params['include_entries'] > 0) {
            $query = $db->getQuery(true)
                ->select(
                    array(
                        'a.id',
                        'c.baseData AS name',
                        'a.updatedTime AS modified',
                        'b.validSince AS publish_up',
                        'b.pid AS catid'
                    )
                )
                ->from('#__sobipro_object AS a')
                ->innerJoin('#__sobipro_relations AS b ON a.id = b.id')
                ->innerJoin('#__sobipro_field_data c ON a.id = c.sid')
                ->where(
                    array(
                        'a.state = 1',
                        'b.oType = ' . $db->quote('entry'),
                        'b.pid = ' . (int)$sid,
                        'a.approved = 1',
                        sprintf(
                            '(a.validUntil >= %s OR a.validUntil = %s)',
                            $db->quote($params['now']),
                            $db->quote($db->getNullDate())
                        ),
                        sprintf(
                            '(a.validSince <= %s OR a.validSince = %s)',
                            $db->quote($params['now']),
                            $db->quote($db->getNullDate())
                        ),
                        'c.fid = ' . (int)self::$sectionConfig['name_field']->sValue,
                        'c.section = ' . (int)self::$sectionConfig['name_field']->section
                    )
                );

            $ordering  = ArrayHelper::getValue($params, 'entries_order', 'b.position');
            $direction = ArrayHelper::getValue($params, 'entries_orderdir', 'ASC');

            if (!in_array($ordering, array('b.position', 'a.counter', 'b.validSince', 'a.updatedTime', 'c.baseData'))) {
                $ordering = 'b.position';
            }

            $query->order($ordering . ' ' . $direction);

            if (!empty($params['days'])) {
                $query->where($params['days']);
            }

            $limit = (int)$params['limit'] ?: 0;
            $db->setQuery($query, 0, $limit);
            $rows = $db->loadObjectList();

            if (!empty($rows)) {
                foreach ($rows as $row) {
                    $node             = new stdclass;
                    $node->id         = $parent->id;
                    $node->uid        = 'com_sobiproe' . $row->id; // Unique ID
                    $node->browserNav = $parent->browserNav;
                    $node->name       = html_entity_decode($row->name);
                    $node->modified   = $row->modified ? $row->modified : $row->publish_up;
                    $node->priority   = $params['entry_priority'];
                    $node->changefreq = $params['entry_changefreq'];
                    $node->expandible = false;
                    $node->secure     = $parent->secure;
                    $node->link       = SPJoomlaMainFrame::url(
                        array(
                            'sid'   => $row->id,
                            'pid'   => $row->catid,
                            'title' => $row->name
                        ),
                        false,
                        false
                    );

                    $node->visibleForXML  = in_array($params['include_entries'], array(1, 2));
                    $node->visibleForHTML = in_array($params['include_entries'], array(1, 3));

                    $osmap->printNode($node);
                }
            }
        }

        $osmap->changeLevel(-1);
    }

    /**
     * @param int $sectionId
     *
     * @return object[]
     */
    protected static function getSectionConfig($sectionId)
    {
        $db = JFactory::getDbo();
        $db->setQuery(
            $db->getQuery(true)
                ->select('*')
                ->from('#__sobipro_config')
                ->where('section = ' . (int)$sectionId)
        );
        return $db->loadObjectList('sKey');
    }

    /**
     * Confirms that SobiPro is properly initialized
     *
     * @return bool
     */
    protected function loadSobi()
    {
        if ($this->sobiInstalled === null) {
            $this->sobiInstalled = false;

            $sobiRoot = JPATH_ROOT;
            $sobiPath = $sobiRoot . '/components/com_sobipro';
            if (is_dir($sobiPath)) {
                // Initialize SobiPro
                define('SOBI_CMS', version_compare(JVERSION, '3.0.0', 'ge') ? 'joomla3' : 'joomla16');
                define('SOBIPRO', true);
                define('SOBI_ROOT', $sobiRoot);
                define('SOBI_PATH', $sobiPath);
                define('SOBI_LIVE_PATH', 'components/com_sobipro');
                require_once($sobiPath . '/lib/base/fs/loader.php');

                SPLoader::loadClass('sobi');
                Sobi::Initialise();
                if (!class_exists('SPJoomlaMainFrame')) {
                    // Earlier versions of SobiPro need a boost
                    $path = SOBI_PATH . '/lib/cms/joomla_common/base/mainframe.php';
                    if (is_file($path)) {
                        require_once $path;
                    }
                }

                // SobiPro is installed. Set state if initialized and provide warning if it didn't
                if (!($this->sobiInstalled = class_exists('SPJoomlaMainFrame'))) {
                    JFactory::getApplication()->enqueueMessage(JText::_('OSMAP_SOBIPRO_WARN_INIT'), 'warn');
                }
            }
        }

        return $this->sobiInstalled;
    }

    /**
     * Recursive method to find the category for a section
     *
     * @param int $sid
     *
     * @return int
     */
    protected static function findCategorySection($sid)
    {
        $db = JFactory::getDbo();
        $db->setQuery(
            $db->getQuery(true)
                ->select('id, parent, oType')
                ->from('#__sobipro_object')
                ->where('id = ' . (int)$sid)
        );
        $row = $db->loadObject();

        if ($row->oType == 'section') {
            return $row->id;
        } else {
            return self::findCategorySection($row->parent);
        }
    }
}
