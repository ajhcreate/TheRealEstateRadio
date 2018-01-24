<?php
/**
 * @package   OSMap
 * @copyright 2007-2014 XMap - Joomla! Vargas - Guillermo Vargas. All rights reserved.
 * @copyright 2016 Open Source Training, LLC. All rights reserved.
 * @contact   www.joomlashack.com, help@joomlashack.com
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
 */

namespace Alledia\OSMapPluginCache;

use Alledia\OSMap;

defined('_JEXEC') or die();

/**
 * Sitemap item
 */
class CachedItem extends OSMap\Sitemap\BaseItem
{
    /**
     * The constructor
     *
     * @param object  $itemData
     * @param id      $currentMenuItemId
     *
     * @return void
     */
    public function __construct(&$itemData, $currentMenuItemId)
    {
        parent::__construct($itemData, $currentMenuItemId);

        $this->fullLink                 = $this->fulllink;
        $this->rawLink                  = $this->link;
        $this->ignore                   = false;
        $this->duplicate                = (bool)$this->duplicate;
        $this->published                = (bool)$this->published;
        $this->newsItem                 = (bool)$this->news_item;
        $this->hasImages                = (bool)$this->has_images;
        $this->isInternal               = (bool)$this->is_internal;
        $this->isMenuItem               = $this->is_menu_item;
        $this->settingsHash             = $this->settings_hash;
        $this->adapter                  = new \stdClass;
        $this->name                     = $this->title;
        $this->keywords                 = '';
        $this->visibleForRobots         = (bool)$this->visible_robots;
        $this->parentIsVisibleForRobots = (bool)$this->parent_visible_robots;
        $this->visibleForXML            = (bool)$this->visible_xml;
        $this->visibleForHTML           = (bool)$this->visible_html;
        $this->level                    = (int)$this->level;

        // We avoid to unset those attribute because this class is instantiated
        // many times, so it would be expensive. Just set as null to save memory.
        $this->news_item             = null;
        $this->has_images            = null;
        $this->is_internal           = null;
        $this->is_menu_item          = null;
        $this->settings_hash         = null;
        $this->visible_robots        = null;
        $this->parent_visible_robots = null;
        $this->visible_xml           = null;
        $this->visible_html          = null;
        $this->fulllink              = null;

        $this->extractComponentFromLink();
    }
}
