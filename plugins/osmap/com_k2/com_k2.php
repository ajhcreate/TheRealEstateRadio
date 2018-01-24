<?php
/**
 * @package   OSMap
 * @copyright 2007-2014 XMap - Joomla! Vargas. All rights reserved.
 * @copyright 2016 Open Source Training, LLC. All rights reserved..
 * @author    Guillermo Vargas <guille@vargas.co.cr>
 * @author    Mohammad Hasani Eghtedar <m.h.eghtedar@gmail.com>
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

use Alledia\OSMap;
use Alledia\OSMap\Sitemap\Collector;
use Alledia\OSMap\Sitemap\Item;
use Joomla\Utilities\ArrayHelper;

defined('_JEXEC') or die('Restricted access');

/** Adds support for K2  to OSMap */
class osmap_com_k2
{
    public static $maxAccess = 0;

    public static $suppressDups = false;

    public static $suppressSub = false;

    /** Get the content tree for this kind of content */
    public static function getTree(&$osmap, &$parent, &$params)
    {
        $tag        = null;
        $limit      = null;
        $id         = null;
        $link_query = parse_url($parent->link);
        parse_str(html_entity_decode($link_query['query']), $link_vars);

        $parm_vars = $parent->params->toArray();

        $option = static::getParam($link_vars, 'option', "");

        if ($option != "com_k2") {
            return;
        }

        $view     = static::getParam($link_vars, 'view', "");
        $showMode = static::getParam($params, 'showk2items', "always");

        if ($showMode == "never" || ($showMode == "xml" && $osmap->view == "html") || ($showMode == "html" && $osmap->view == "xml")) {
            return;
        }

        static::$suppressDups = (static::getParam($params, 'suppressdups', 'yes') == "yes");
        static::$suppressSub  = (static::getParam($params, 'subcategories', "yes") != "yes");

        if ($view == "item") {   // for Items the sitemap already contains the correct reference
            if (!isset($osmap->IDS)) {
                $osmap->IDS = "";
            }

            $osmap->IDS = $osmap->IDS . "|" . static::getParam($link_vars, 'id', $id);

            return;
        }

        if ($osmap->view == "xml") {
            static::$maxAccess = 1;   // XML sitemaps will only see content for guests
        } else {
            static::$maxAccess = OSMap\Helper\General::getAuthorisedViewLevels();
        }

        switch (static::getParam($link_vars, 'task', "")) {
            case "user":
                $tag  = static::getParam($link_vars, 'id', $id);
                $ids  = array_key_exists('userCategoriesFilter',
                    $parm_vars) ? $parm_vars['userCategoriesFilter'] : array("");
                $mode = "single user";
                break;

            case "tag":
                $tag  = static::getParam($link_vars, 'tag', "");
                $ids  = array_key_exists('categoriesFilter', $parm_vars) ? $parm_vars['categoriesFilter'] : array("");
                $mode = "tag";
                break;

            case "category":
                $ids  = explode("|", static::getParam($link_vars, 'id', ""));
                $mode = "category";
                break;

            case "":
                switch (static::getParam($link_vars, 'layout', "")) {
                    case "category":
                        if (array_key_exists('categories', $parm_vars)) {
                            $ids = $parm_vars["categories"];
                        } else {
                            $ids = '';
                        }

                        $mode = "categories";
                        break;

                    case "latest":
                        $limit = static::getParam($parm_vars, 'latestItemsLimit', "");
                        if (static::getParam($parm_vars, 'source', "") == "0") {
                            $ids  = array_key_exists("userIDs", $parm_vars) ? $parm_vars["userIDs"] : '';
                            $mode = "latest user";
                        } else {
                            $ids  = array_key_exists("categoryIDs", $parm_vars) ? $parm_vars["categoryIDs"] : '';
                            $mode = "latest category";
                        }
                        break;

                    default:
                        return;
                }
                break;

            default:
                return;
        }

        $priority   = static::getParam($params, 'priority', $parent->priority);
        $changefreq = static::getParam($params, 'changefreq', $parent->changefreq);

        if ($priority == '-1') {
            $priority = $parent->priority;
        }

        if ($changefreq == '-1') {
            $changefreq = $parent->changefreq;
        }

        $params['priority']   = $priority;
        $params['changefreq'] = $changefreq;

        $db = JFactory::getDbo();
        static::processTree($db, $osmap, $parent, $params, $mode, $ids, $tag, $limit);

        return;
    }

    /**
     * @param JDatabaseDriver $db
     * @param int             $catid
     * @param object[]        $allrows
     */
    public static function collectByCat($db, $catid, &$allrows)
    {
        if (!(int)$catid) {
            return;
        }

        $query = $db->getQuery(true)
            ->select(
                array(
                    'id',
                    'title',
                    'alias',
                    'created',
                    'modified',
                    'publish_up',
                    'metakey',
                    'language'
                )
            )
            ->from('#__k2_items')
            ->where(
                array(
                    'published = 1',
                    'trash = 0',
                    sprintf('(publish_down = %s OR publish_down > NOW())', $db->quote('0000-00-00')),
                    'catid = ' . (int)$catid
                )
            )
            ->order('1 DESC');

        if ($rows = $db->setQuery($query)->loadObjectList()) {
            $allrows = array_merge($allrows, $rows);
        }

        $query = $db->getQuery(true)
            ->select('id, name, alias, language')
            ->from('#__k2_categories')
            ->where(
                array(
                    'published = 1',
                    'trash = 0',
                    'parent = ' . (int)$catid
                )
            )
            ->order('id ASC');

        if ($rows = $db->setQuery($query)->loadObjectList()) {
            foreach ($rows as $row) {
                static::collectByCat($db, $row->id, $allrows);
            }
        }
    }

    /**
     * @param JDatabaseDriver $db
     * @param Collector       $osmap
     * @param Item            $parent
     * @param array           $params
     * @param string          $mode
     * @param int[]           $ids
     * @param mixed           $tag
     * @param int             $limit
     */
    public static function processTree($db, &$osmap, &$parent, &$params, $mode, $ids, $tag, $limit)
    {
        $query = $db->getQuery(true)
            ->select(
                array(
                    'id',
                    'title',
                    'alias',
                    'created',
                    'modified',
                    'publish_up',
                    'metakey',
                    'language'
                )
            )
            ->from('#__k2_items')
            ->where(
                array(
                    'published = 1',
                    'trash = 0',
                    sprintf('(publish_down = %s OR publish_down > NOW())', $db->quote('0000-00-00')),
                    sprintf('access IN (%s)', static::$maxAccess)
                )
            );


        $ids = array_filter(array_map('intval', (array)$ids));

        switch ($mode) {
            case "single user":
                $query->where('created_by = ' . (int)$tag);


                if ($ids) {
                    $query->where(sprintf('catid in (%s)', join(',', $ids)));
                }

                $query->order('1 DESC');

                $rows = $db->setQuery($query)->loadObjectList();
                break;

            case "tag":
                $query = $db->getQuery(true)
                    ->select(
                        array(
                            'c.id',
                            'title',
                            'alias',
                            'c.created',
                            'c.modified',
                            'c.publish_up',
                            'c.language'
                        )
                    )
                    ->from('#__k2_tags AS a')
                    ->innerJoin('#__k2_tags_xref AS b ON a.id =  b.tagId')
                    ->innerJoin('#__k2_items AS c ON c.id = b.itemID')
                    ->where(
                        array(
                            'c.published = 1',
                            'c.trash = 0',
                            sprintf('(c.publish_down = %s OR c.publish_down > NOW())', $db->quote('0000-00-00')),
                            'a.Name = ' . $db->quote($tag),
                            sprintf('c.access IN (%s)', static::$maxAccess)
                        )
                    );
                if ($ids) {
                    $query->where(sprintf('c.catid IN (%s)', join(',', $ids)));
                }

                $query->order('1 DESC');

                $rows = $db->setQuery($query)->loadObjectList();
                break;

            case "category":
                $catid = empty($ids[0]) ? 0 : $ids[0];
                $query
                    ->where('catid = ' . (int)$catid)
                    ->order('1 DESC');

                $rows = $db->setQuery($query)->loadObjectList();
                break;

            case "categories":
                if (!static::$suppressSub) {
                    if ($ids) {
                        $query->where(sprintf('catid IN (%s)', join(',', $ids)));
                    }
                    $query->order('1 DESC');

                    $rows = $db->setQuery($query)->loadObjectList();

                } else {
                    $rows = array();
                    foreach ($ids as $id) {
                        $nextRows = array();
                        static::collectByCat($db, $id, $nextRows);
                        $rows = array_merge($rows, $nextRows);
                    }
                }
                break;

            case "latest user":
                $rows = array();

                foreach ($ids as $id) {
                    $userQuery = clone $query;
                    $userQuery->order('1 DESC');

                    $userQuery->where('created_by = ' . $id);
                    if ($nextRows = $db->setQuery($userQuery, 0, $limit)->loadObjectList()) {
                        $rows = array_merge($rows, $nextRows);
                    }
                }
                break;

            case "latest category":
                $rows = array();

                foreach ($ids as $id) {
                    $categoryQuery = clone $query;
                    $categoryQuery->order('1 DESC');

                    $categoryQuery->where('catid = ' . $id);

                    if ($nextRows = $db->setQuery($categoryQuery, 0, $limit)->loadObjectList()) {
                        $rows = array_merge($rows, $nextRows);
                    }
                }
                break;

            default:
                return;
        }

        $osmap->changeLevel(1);
        $node = (object)array('id' => $parent->id);

        if ($rows == null) {
            $rows = array();
        }

        foreach ($rows as $row) {
            if (!(static::$suppressDups && isset($osmap->IDS) && strstr($osmap->IDS, "|" . $row->id))) {
                static::addNode($osmap, $node, $row, false, $parent, $params);
            }
        }

        if ($mode == "category" && !static::$suppressSub) {
            if (!empty($ids[0])) {
                $query = $db->getQuery(true)
                    ->select('id, name, alias, language')
                    ->from('#__k2_categories')
                    ->where(
                        array(
                            'published = 1',
                            'trash = 0',
                            'parent = ' . $ids[0],
                            sprintf('access IN (%s)', static::$maxAccess)
                        )
                    )
                    ->order('id ASC');

                if ($rows = $db->setQuery($query)->loadObjectList()) {
                    foreach ($rows as $row) {
                        if (!isset($osmap->IDS)) {
                            $osmap->IDS = "";
                        }

                        if (!(static::$suppressDups && strstr($osmap->IDS, "|c" . $row->id))) {
                            static::addNode($osmap, $node, $row, true, $parent, $params);
                            $newID    = array();
                            $newID[0] = $row->id;
                            static::processTree($db, $osmap, $parent, $params, $mode, $newID, "", "");
                        }
                    }
                }
            }
        }

        $osmap->changeLevel(-1);
    }

    /**
     * @param Collector $osmap
     * @param object    $node
     * @param object    $row
     * @param bool      $iscat
     * @param object    $parent
     * @param array     $params
     */
    public static function addNode($osmap, $node, $row, $iscat, &$parent, &$params)
    {
        $node->modified  = $row->modified;
        $node->created   = $row->created;
        $node->publishUp = $row->publish_up;

        $node->newsItem = 1;
        $node->keywords = $row->metakey;

        if (!isset($osmap->IDS)) {
            $osmap->IDS = "";
        }

        $node->browserNav = $parent->browserNav;
        $node->pid        = $row->id;
        $node->uid        = 'k2.item.' . $row->id;
        $node->name       = ($iscat ? $row->name : $row->title);
        $node->priority   = $params['priority'];
        $node->changefreq = $params['changefreq'];

        if ($iscat) {
            $osmap->IDS .= "|c" . $row->id;
            $node->link       = 'index.php?option=com_k2&view=itemlist&task=category&id=' . $row->id . ':' . $row->alias . '&Itemid=' . $parent->id;
            $node->expandible = true;
        } else {
            $osmap->IDS .= "|" . $row->id;
            $node->link       = 'index.php?option=com_k2&view=item&id=' . $row->id . ':' . $row->alias . '&Itemid=' . $parent->id;
            $node->expandible = false;
        }
        $node->tree = array();

        $osmap->printNode($node);
    }

    public static function &getParam($arr, $name, $def)
    {
        $var = ArrayHelper::getValue($arr, $name, $def, '');

        return $var;
    }
}
