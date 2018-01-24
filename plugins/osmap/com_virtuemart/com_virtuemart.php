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

defined('_JEXEC') or die('Restricted access');

use Alledia\OSMap;
use Joomla\Utilities\ArrayHelper;


/** Adds support for Virtuemart categories to OSMap */
class osmap_com_virtuemart
{
    /**
     * @var array
     */
    protected static $categoriesCache = array();

    /**
     * @var string
     */
    protected static $language = null;

    /*
     * This function is called before a menu item is printed. We use it to set the
     * proper uniqueid for the item and indicate whether the node is expandible or not
     */
    public static function prepareMenuItem($node, &$params)
    {
        $app = JFactory::getApplication();

        $linkQuery = parse_url($node->link);

        parse_str(html_entity_decode($linkQuery['query']), $linkVars);

        $view = ArrayHelper::getValue($linkVars, 'view', '');

        $catId  = ArrayHelper::getValue($linkVars, 'virtuemart_category_id', 0);
        $prodId = ArrayHelper::getValue($linkVars, 'virtuemart_product_id', 0);

        if (!in_array($view, array('categories', 'category'))) {
            if (empty($catId)) {
                $menu       = $app->getMenu();
                $menuParams = $menu->getParams($node->id);
                $catId      = $menuParams->get('virtuemart_category_id', 0);
            }

            if (empty($prodId)) {
                $menu       = $app->getMenu();
                $menuParams = $menu->getParams($node->id);
                $prodId     = $menuParams->get('virtuemart_product_id', 0);
            }

            if ($prodId && $catId) {
                $node->uid        = 'com_virtuemartc' . $catId . 'p' . $prodId;
                $node->expandible = false;
            } elseif ($catId) {
                $node->uid        = 'com_virtuemartc' . $catId;
                $node->expandible = true;
            }
        } else {
            $menu       = $app->getMenu();
            $menuParams = $menu->getParams($node->id);
            $catId      = $menuParams->get('virtuemart_category_id', 0);

            $node->uid        = 'com_virtuemart.' . $view;
            $node->expandible = true;
        }
    }

    /** Get the content tree for this kind of content */
    public static function getTree($collector, $parent, $params)
    {
        $linkQuery = parse_url($parent->link);

        parse_str(html_entity_decode($linkQuery['query']), $linkVars);

        $params['Itemid'] = intval(ArrayHelper::getValue($linkVars, 'Itemid', $parent->id));

        $categories = array();
        if (isset($linkVars['virtuemart_category_id'])) {
            $categories[] = intval(ArrayHelper::getValue($linkVars, 'virtuemart_category_id'));
        } else {
            // We don't have a category set for the current menu/view. Let's use the global setting
            $categories = ArrayHelper::getValue($params, 'global_categories', array());
        }

        if (empty($categories)) {
            return true;
        }

        $params['include_products']          = (int)ArrayHelper::getValue($params, 'include_products', 1);
        $params['include_product_images']    = ArrayHelper::getValue($params, 'include_product_images', 1);
        $params['product_image_license_url'] = trim(ArrayHelper::getValue($params, 'product_image_license_url', ''));
        $params['product_image_limit']       = (int)ArrayHelper::getValue($params, 'product_image_limit', 1);

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

        $priority   = ArrayHelper::getValue($params, 'prod_priority', $parent->priority);
        $changefreq = ArrayHelper::getValue($params, 'prod_changefreq', $parent->changefreq);

        if ($priority == '-1') {
            $priority = $parent->priority;
        }

        if ($changefreq == '-1') {
            $changefreq = $parent->changefreq;
        }

        $params['prod_priority']   = $priority;
        $params['prod_changefreq'] = $changefreq;

        if (!empty($categories)) {
            foreach ($categories as $catId) {
                self::getCategoryTree($collector, $parent, $params, $catId);
            }
        }

        self::$categoriesCache = array();

        return true;
    }

    /** Virtuemart support */
    public static function getCategoryTree($collector, $parent, $params, $catId = null)
    {
        $children = self::getChildCategories($catId);

        if (!empty($children)) {
            $collector->changeLevel(1);

            foreach ($children as $row) {
                $node = new stdClass;

                $node->id         = $parent->id;
                $node->uid        = $parent->uid . 'c' . $row->virtuemart_category_id;
                $node->browserNav = $parent->browserNav;
                $node->name       = htmlspecialchars_decode(stripslashes($row->category_name));
                $node->priority   = $params['cat_priority'];
                $node->changefreq = $params['cat_changefreq'];
                $node->expandible = true;
                $node->link       = 'index.php?option=com_virtuemart&amp;view=category&amp;virtuemart_category_id='
                    . $row->virtuemart_category_id . '&amp;Itemid=' . $parent->id;

                if ($params['include_product_images']) {
                    $node->images = array();
                }

                if ($collector->printNode($node) !== false) {
                    self::getCategoryTree($collector, $parent, $params, $row->virtuemart_category_id);
                }

                $node = null;
            }

            $children = null;

            $collector->changeLevel(-1);
        }

        if ($params['include_products'] > 0 && !is_null($catId)) {
            $collector->changeLevel(1);

            $products = self::getProducts($catId);

            foreach ($products as $row) {
                $node = new stdClass;

                $node->id         = $parent->id;
                $node->uid        = $parent->uid . 'c' . $row->virtuemart_category_id . 'p' . $row->virtuemart_product_id;
                $node->browserNav = $parent->browserNav;
                $node->priority   = $params['prod_priority'];
                $node->changefreq = $params['prod_changefreq'];
                $node->name       = htmlspecialchars_decode($row->product_name);
                $node->modified   = strtotime($row->modified_on);
                $node->expandible = false;
                $node->link       = 'index.php?option=com_virtuemart&amp;view=productdetails&amp;virtuemart_product_id='
                    . $row->virtuemart_product_id . '&amp;virtuemart_category_id='
                    . $row->virtuemart_category_id . '&amp;Itemid=' . $parent->id;

                $node->visibleForXML  = in_array($params['include_products'], array(1, 2));
                $node->visibleForHTML = in_array($params['include_products'], array(1, 3));

                if ($params['include_product_images']) {
                    $node->images = array();

                    $images = self::getProductImages($row->virtuemart_product_id, $params['product_image_limit']);

                    foreach ($images as $image) {
                        if (isset($image->file_url)) {
                            $imageNode = new stdClass;
                            $imageNode->src     = JURI::base() . $image->file_url;
                            $imageNode->title   = htmlspecialchars_decode($row->product_name);
                            $imageNode->license = $params['product_image_license_url'];

                            $node->images[] = $imageNode;
                        }
                    }
                }

                $collector->printNode($node);
            }

            $collector->changeLevel(-1);
        }
    }

    protected static function getDefaultLang()
    {
        if (static::$language === null) {
            $langParams = JComponentHelper::getParams('com_languages');
            $defaultLang = $langParams->get('site', 'en-GB'); //use default joomla
            static::$language = strtolower(strtr($defaultLang,'-','_'));
        }

        return static::$language;
    }

    protected static function getChildCategories($catId)
    {
        if (!isset(self::$categoriesCache[$catId])) {
            $db = OSMap\Factory::getDbo();

            $query = $db->getQuery(true)
                ->select(
                    array(
                        'c.virtuemart_category_id',
                        'cn.category_name'
                    )
                )
                ->from('#__virtuemart_categories AS c')
                ->innerJoin('#__virtuemart_category_categories AS cc ON (c.virtuemart_category_id = cc.category_child_id)')
                ->innerJoin('#__virtuemart_categories_' . self::getDefaultLang() . ' AS cn ON (c.virtuemart_category_id = cn.virtuemart_category_id)')
                ->where(
                    array(
                        'cc.category_parent_id = ' . $db->quote((int) $catId),
                        'c.published = 1'
                    )
                );
            $db->setQuery($query);

            self::$categoriesCache[$catId] = $db->loadObjectList();
        }

        return self::$categoriesCache[$catId];
    }

    protected static function getProductImages($productId, $limit)
    {
        $db = OSMap\Factory::getDbo();

        $query = $db->getQuery(true)
            ->select(
                array(
                    'm.file_url'
                )
            )
            ->from('#__virtuemart_product_medias AS pm')
            ->innerJoin('#__virtuemart_medias AS m ON (pm.virtuemart_media_id = m.virtuemart_media_id)')
            ->where(
                array(
                    'pm.virtuemart_product_id = ' . $db->quote((int) $productId),
                )
            );

        if ((int) $limit > 0) {
            $query->setLimit($limit);
        }

        $db->setQuery($query);

        return $db->loadObjectList();
    }

    protected static function getProducts($catId)
    {
        $db = OSMap\Factory::getDbo();

        $query = $db->getQuery(true)
            ->select(
                array(
                    'p.virtuemart_product_id',
                    'c.virtuemart_category_id',
                    'pn.product_name',
                    'p.modified_on'
                )
            )
            ->from('#__virtuemart_products AS p')
            ->innerJoin('#__virtuemart_product_categories AS c ON (p.virtuemart_product_id = c.virtuemart_product_id)')
            ->innerJoin('#__virtuemart_products_' . self::getDefaultLang() . ' AS pn ON (p.virtuemart_product_id = pn.virtuemart_product_id)')
            ->where(
                array(
                    'c.virtuemart_category_id = ' . $db->quote((int) $catId),
                    'p.published = 1'
                )
            );
        $db->setQuery($query);

        return $db->loadObjectList();
    }
}
