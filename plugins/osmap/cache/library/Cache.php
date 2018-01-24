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

class Cache
{
    /**
     * @var int
     */
    protected $ordering;

    /**
     * @var int
     */
    protected $sitemapId;

    /**
     * @var bool
     */
    protected $triggeredRefresh = false;

    /**
     * Key for the cache which points to the last time the cache was updated,
     * or refreshed (format of time()).
     *
     * @var int;
     */
    protected $lastTimeUpdateCacheKey;

    /**
     * The cache instance with the information about updates in the cache,
     * like the last time the cache was refreshed.
     *
     * @var \JCache
     */
    protected $updateCache;

    /**
     * The constructor
     *
     * @param int $sitemapId
     */
    public function __construct($sitemapId)
    {
        $this->sitemapId = (int)$sitemapId;

        // Instantiate the cache for update info
        $this->updateCache = OSMap\Factory::getCache('plg_osmap_cache.lib.cache', '');
        $this->updateCache->setCaching(1);
        $this->lastTimeUpdateCacheKey = 'last-update-' . $this->sitemapId;
    }

    /**
     * Refreshes the whole cache for the current sitemap. Returns the total
     * of links non unique found.
     *
     * @return int
     */
    public function refresh()
    {
        $this->sitemap = OSMap\Factory::getSitemap($this->sitemapId, 'standard');
        $this->cleanupCacheTable(true);
        $this->ordering = 0;

        // Traverse the sitemap and register items in the tmp table
        $this->sitemap->traverse(array($this, 'registerItem'), false);

        // Move data from tmp to the live table
        $this->deployCacheData();

        // Cache the update info
        $this->updateCache->store(time(), $this->lastTimeUpdateCacheKey);

        return $this->ordering;
    }

    /**
     * Clean up the db table to receive the new items. If the param $tmpTable
     * is true, it will clean up the temporary table. If false, the live table.
     *
     * @param bool $tmpTable
     *
     * @return void
     */
    protected function cleanupCacheTable($tmpTable = true)
    {
        $db = OSMap\Factory::getDbo();
        // Images table
        $tableName = '#__osmap_itemscacheimg' . ($tmpTable ? '_tmp' : '');

        $query = $db->getQuery(true)
            ->delete($tableName)
            ->where('sitemap_id = ' . $db->quote($this->sitemapId));
        $db->setQuery($query)->execute();

        // Items table
        $tableName = '#__osmap_itemscache' . ($tmpTable ? '_tmp' : '');

        $query = $db->getQuery(true)
            ->delete($tableName)
            ->where('sitemap_id = ' . $db->quote($this->sitemapId));
        $db->setQuery($query)->execute();
    }

    /**
     * Method to register an item in the temporary cache table.
     *
     * @param OSMap\Sitemap\Item $item
     *
     * @return void
     */
    public function registerItem($item)
    {
        // Only cache links which will be displayed
        if ($item->ignore || !$item->published) {
            return;
        }

        $db = OSMap\Factory::getDbo();

        $columns = array(
            $db->quoteName('sitemap_id'),
            $db->quoteName('uid'),
            $db->quoteName('settings_hash'),
            $db->quoteName('ordering'),
            $db->quoteName('link'),
            $db->quoteName('fulllink'),
            $db->quoteName('changefreq'),
            $db->quoteName('priority'),
            $db->quoteName('title'),
            $db->quoteName('modified'),
            $db->quoteName('duplicate'),
            $db->quoteName('news_item'),
            $db->quoteName('menu_id'),
            $db->quoteName('menu_title'),
            $db->quoteName('menu_type'),
            $db->quoteName('visible_robots'),
            $db->quoteName('parent_visible_robots'),
            $db->quoteName('visible_xml'),
            $db->quoteName('visible_html'),
            $db->quoteName('level'),
            $db->quoteName('has_images'),
            $db->quoteName('is_internal'),
            $db->quoteName('is_menu_item')
        );

        $values = array(
            $db->quote($this->sitemap->id),
            $db->quote($item->uid),
            $db->quote(md5($item->fullLink)),
            $db->quote($this->ordering),
            $db->quote($item->link),
            $db->quote($item->fullLink),
            $db->quote($item->changefreq),
            $db->quote($item->priority),
            $db->quote($item->name),
            $db->quote($item->modified),
            $db->quote($item->duplicate ? 1 : 0),
            $db->quote(isset($item->newsItem) && $item->newsItem ? 1 : 0),
            $db->quote($item->menuItemId),
            $db->quote($item->menuItemTitle),
            $db->quote($item->menuItemType),
            $db->quote(isset($item->visibleForRobots) && !$item->visibleForRobots ? 0 : 1),
            $db->quote(isset($item->parentIsVisibleForRobots) && !$item->parentIsVisibleForRobots ? 0 : 1),
            $db->quote(isset($item->visibleForXML) && !$item->visibleForXML ? 0 : 1),
            $db->quote(isset($item->visibleForHTML) && !$item->visibleForHTML ? 0 : 1),
            $db->quote($item->level),
            $db->quote(count($item->images) > 0),
            $db->quote(isset($item->isInternal) && $item->isInternal ? 1 : 0),
            $db->quote(isset($item->isMenuItem) && $item->isMenuItem ? 1 : 0),
        );

        $query = $db->getQuery(true)
            ->insert('#__osmap_itemscache_tmp')
            ->columns($columns)
            ->values(implode(',', $values));
        $db->setQuery($query)->execute();

        // Images
        if (!empty($item->images)) {
            $i = 0;
            foreach ($item->images as $image) {
                $columns = array(
                    $db->quoteName('sitemap_id'),
                    $db->quoteName('ordering'),
                    $db->quoteName('index'),
                    $db->quoteName('src'),
                    $db->quoteName('title'),
                    $db->quoteName('license')
                );

                $values = array(
                    $db->quote($this->sitemap->id),
                    $db->quote($this->ordering),
                    $db->quote($i),
                    $db->quote($image->src),
                    $db->quote($image->title),
                    $db->quote(@$image->license),
                );

                $query = $db->getQuery(true)
                    ->insert('#__osmap_itemscacheimg_tmp')
                    ->columns($columns)
                    ->values(implode(',', $values));
                $db->setQuery($query)->execute();

                $i++;
            }
        }

        $this->ordering++;

        return true;
    }

    /**
     * Method to deploy the data cached in the temporary table to the live
     * table.
     *
     * @return void
     */
    protected function deployCacheData()
    {
        $db = OSMap\Factory::getDbo();

        try {
            $db->transactionStart();

            // Cleanup the sitemap data in the cache table
            $this->cleanupCacheTable(false);

            // Copy de data to the live table
            $columns = array(
                $db->quoteName('sitemap_id'),
                $db->quoteName('uid'),
                $db->quoteName('settings_hash'),
                $db->quoteName('ordering'),
                $db->quoteName('link'),
                $db->quoteName('fulllink'),
                $db->quoteName('changefreq'),
                $db->quoteName('priority'),
                $db->quoteName('title'),
                $db->quoteName('modified'),
                $db->quoteName('duplicate'),
                $db->quoteName('news_item'),
                $db->quoteName('menu_id'),
                $db->quoteName('menu_title'),
                $db->quoteName('menu_type'),
                $db->quoteName('visible_robots'),
                $db->quoteName('parent_visible_robots'),
                $db->quoteName('visible_xml'),
                $db->quoteName('visible_html'),
                $db->quoteName('level'),
                $db->quoteName('has_images'),
                $db->quoteName('is_internal'),
                $db->quoteName('is_menu_item')
            );

            $subQuery = $db->getQuery(true)
                ->select(
                    array(
                        $db->quoteName('sitemap_id'),
                        $db->quoteName('uid'),
                        $db->quoteName('settings_hash'),
                        $db->quoteName('ordering'),
                        $db->quoteName('link'),
                        $db->quoteName('fulllink'),
                        $db->quoteName('changefreq'),
                        $db->quoteName('priority'),
                        $db->quoteName('title'),
                        $db->quoteName('modified'),
                        $db->quoteName('duplicate'),
                        $db->quoteName('news_item'),
                        $db->quoteName('menu_id'),
                        $db->quoteName('menu_title'),
                        $db->quoteName('menu_type'),
                        $db->quoteName('visible_robots'),
                        $db->quoteName('parent_visible_robots'),
                        $db->quoteName('visible_xml'),
                        $db->quoteName('visible_html'),
                        $db->quoteName('level'),
                        $db->quoteName('has_images'),
                        $db->quoteName('is_internal'),
                        $db->quoteName('is_menu_item')
                    )
                )
                ->from('#__osmap_itemscache_tmp')
                ->where('sitemap_id = ' . $db->quote($this->sitemapId));

            $query = $db->getQuery(true)
                ->insert('#__osmap_itemscache')
                ->columns($columns)
                ->values($subQuery);
            $db->setQuery($query)->execute();

            // Images
            // Copy de data to the live table
            $columns = array(
                $db->quoteName('sitemap_id'),
                $db->quoteName('ordering'),
                $db->quoteName('index'),
                $db->quoteName('src'),
                $db->quoteName('title'),
                $db->quoteName('license')
            );

            $subQuery = $db->getQuery(true)
                ->select(
                    array(
                        $db->quoteName('sitemap_id'),
                        $db->quoteName('ordering'),
                        $db->quoteName('index'),
                        $db->quoteName('src'),
                        $db->quoteName('title'),
                        $db->quoteName('license')
                    )
                )
                ->from('#__osmap_itemscacheimg_tmp')
                ->where('sitemap_id = ' . $db->quote($this->sitemapId));

            $query = $db->getQuery(true)
                ->insert('#__osmap_itemscacheimg')
                ->columns($columns)
                ->values($subQuery);
            $db->setQuery($query)->execute();

            // Cleanup the temporary cache table
            $this->cleanupCacheTable(true);

            $db->transactionCommit();
        } catch (\Exception $e) {
            $db->transactionRollback();

            \JErrorPage::render($e);
        }
    }

    /**
     * Returns the total of cached items for this sitemap.
     *
     * @return int
     */
    protected function getCountItems()
    {
        $db = OSMap\Factory::getDbo();

        $query = $db->getQuery(true)
            ->select('COUNT(*)')
            ->from('#__osmap_itemscache')
            ->where('sitemap_id = ' . $db->quote((int)$this->sitemapId));

        return (int)$db->setQuery($query)->loadResult();
    }

    /**
     * Get the sitemap items cached in the database. If limit is null, all items
     * will be returned.
     *
     * @param int $limit
     * @param int $offset
     *
     * @return array
     */
    protected function getItems($limit = null, $offset = null)
    {
        $db = OSMap\Factory::getDbo();

        $query = $db->getQuery(true)
            ->select('*')
            ->from('#__osmap_itemscache')
            ->where('sitemap_id = ' . $db->quote((int)$this->sitemapId))
            ->order('ordering');

        if ($limit !== null) {
            $query->setLimit($limit, $offset);
        }

        return $db->setQuery($query)->loadAssocList();
    }

    /**
     * Get the images for a sitemap item.
     *
     * @param int $ordering
     *
     * @return array
     */
    protected function getImages($ordering)
    {
        $db = OSMap\Factory::getDbo();

        $query = $db->getQuery(true)
            ->select('*')
            ->from('#__osmap_itemscacheimg')
            ->where(
                array(
                    'sitemap_id = ' . $db->quote((int)$this->sitemapId),
                    'ordering = ' . $ordering
                )
            )
            ->order($db->quoteName('index'));

        return $db->setQuery($query)->loadObjectList();
    }

    /**
     * Method used to retrieve data from the cache and send to the callback.
     *
     * @param callable $callback
     * @param int      $chunkSize
     *
     * @return void
     */
    public function fetch(&$callback, $chunkSize = 0)
    {
        $total = $this->getCountItems();

        // We don't have items. Check if refreshing that is fixed
        if ($total === 0 && !$this->triggeredRefresh) {
            $this->refresh();
            // Makes sure to refresh only once
            $this->triggeredRefresh = true;
            // After refresh, try to fetch the items and continue
            $this->fetch($callback, $chunkSize);
            // Stop avoiding infinite loop just in case there is no items again
            return;
        }

        // Reset the refresh flag
        $this->triggeredRefresh = false;

        // If the chunkSize is empty we will run the query once
        if (empty($chunkSize)) {
            $chunkSize = $total;
        }

        // Set as negative, to became zero on the first iteration
        $offset = -$chunkSize;
        do {
            $offset += $chunkSize;

            $items = $this->getItems($chunkSize, $offset);
            foreach ($items as $item) {

                $item['menuItemId']    = $item['menu_id'];
                $item['menuItemTitle'] = $item['menu_title'];
                $item['menuItemType']  = $item['menu_type'];

                unset($item['menu_id'], $item['menu_title'], $item['menu_type']);

                if ($item['has_images']) {
                    $item['images'] = $this->getImages($item['ordering']);
                }

                $instance = new CachedItem($item, $item['menuItemId']);

                $instance->setModificationDate();

                call_user_func($callback, $instance);
            }
        } while ($total > ($chunkSize + $offset));
    }

    /**
     * Returns true if the given interval (in minutes) is lower than the interval from the
     * last cached update time.
     *
     * @param int $interval
     *
     * @return bool
     */
    public function checkUpdateIsRequired($interval)
    {
        $lastUpdate = $this->updateCache->get($this->lastTimeUpdateCacheKey);

        return empty($lastUpdate) || (time() - $lastUpdate) >= $interval;
    }
}
