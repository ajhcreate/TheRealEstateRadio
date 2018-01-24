<?php
/**
 * @package   OSMap
 * @copyright 2007-2014 XMap - Joomla! Vargas - Guillermo Vargas. All rights reserved.
 * @copyright 2016 Open Source Training, LLC. All rights reserved.
 * @contact   www.joomlashack.com, help@joomlashack.com
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
 */

use Alledia\OSMap;
use Alledia\OSMapPluginCache;
use Alledia\Framework;
use Joomla\Registry\Registry;

defined('_JEXEC') or die();

require_once __DIR__ . '/include.php';

class PlgOSMapCache extends OSMap\Plugin\Base
{
    /**
     * Method executed before a task is executed. It will check if should
     * trigger a refresh in the cache for a sitemap.
     *
     * @param string $controllerName
     * @param string $task
     *
     * @return mixed
     */
    public function osmapOnBeforeExecuteTask($controllerName, $task)
    {
        $controllerName = strtolower($controllerName);
        $task           = strtolower($task);
        $container      = OSMap\Factory::getContainer();

        if ($controllerName === 'sitemap' && $task === 'refreshcache') {
            $app = OSMap\Factory::getApplication();

            if ($app->isSite()) {
                // Runs the sitemap refresh directly
                $this->executeSitemapRefresh();
            } else {
                // Call the frontend with a request simulating a cronjob, since to the update work correctly it
                // needs to be triggered from the frontend, due to issues with the routing and JApplication
                $options  = new Registry();
                $http     = \JHttpFactory::getHttp($options);
                $cid      = $app->input->get('cid', array(), 'array');
                $cid      = $cid[0];
                $plugin   = Framework\Factory::getExtension('cache', 'plugin', 'osmap');
                $token    = $plugin->params->get('cronjob_token');
                $url      = 'index.php?option=com_osmap&task=sitemap.refreshcache&id=' . $cid . '&token=' . $token;
                $response = $http->get($container->router->forceFrontendURL($url));

                if ($response->code === 200) {
                    $result = @json_decode($response->body);

                    if ($result->success) {
                        $app->enqueueMessage($result->message);
                    } else {
                        $app->enqueueMessage($result->message, 'error');
                    }
                } else {
                    $app->enqueueMessage(JText::_('PLG_OSMAP_CACHE_SITEMAP_REFRESH_ERROR'), 'error');
                }
            }
        }

        return true;
    }

    /**
     * Method to add additional buttons to the toolbar in the admin view.
     *
     * @param string $viewName
     *
     * @return bool
     */
    public function osmapOnAfterSetToolBar($viewName)
    {
        if ($viewName === 'sitemaps') {
            \JToolBarHelper::custom(
                'sitemap.refreshCache',
                'refresh.png',
                'refresh_f2.png',
                'COM_OSMAP_TOOLBAR_REFRESH_CACHE',
                true
            );
        }
    }

    /**
     * Method triggered before collect items. This method allow to override the
     * items collector. On this case, we return false to stop the collector
     * fetch method, since we already populated the callback with the cached
     * data.
     *
     * @param Alledia\OSMap\Sitemap\Standard $sitemap
     * @param callable      $callback
     *
     * @return bool
     */
    public function osmapOnBeforeCollectItems($sitemap, $callback)
    {
        // Only use cache in the frontend
        if (!OSMap\Factory::getApplication()->isAdmin()) {
            // Instantiate the sitemap cache
            $sitemapCache = new OSMapPluginCache\Cache($sitemap->id);
            $sitemap      = null;

            // Check if we should refresh the cache automatically, in minutes
            $cacheTime = $this->params->get('cache_time', 60) * 60;

            if (!empty($cacheTime) && $sitemapCache->checkUpdateIsRequired($cacheTime)) {
                // Triggers a refresh
                $sitemapCache->refresh();
            }

            // Fetch the sitemap
            $cacheChunkSize = (int)$this->params->get('cache_chunk_size', 100);
            $sitemapCache->fetch($callback, $cacheChunkSize);
            $callback = null;

            return true;
        }

        return false;
    }

    /**
     * Method to run the sitemap cache refresh from admin or cronjob.
     * If called from the admin, will refresh and enqueue a message. If from
     * the site, it means it is a cronjob. So we return JSON value.
     *
     * @return void
     */
    protected function executeSitemapRefresh()
    {
        header('Content-Type: application/json');
        $id = (int)OSMap\Factory::getApplication()->input->get('id');

        OSMap\Factory::getApplication()->input->set('tmpl', 'component');

        try {
            $token  = OSMap\Factory::getApplication()->input->get('token');
            $plugin = Framework\Factory::getExtension('cache', 'plugin', 'osmap');

            // Check the token to authenticate the request
            if (empty($token) || $token !== $plugin->params->get('cronjob_token')) {
                throw new Exception(JText::_("PLG_OSMAP_CACHE_INVALID_TOKEN"));
            }

            // Check the sitemap id
            if (empty($id)) {
                throw new Exception(JText::_('PLG_OSMAP_CACHE_INVALID_ID'));
            }

            // Refresh the cache
            $cache = new OSMapPluginCache\Cache($id);
            $count = $cache->refresh();

            $result = array(
                'count' => $count
            );

            echo new JResponseJson($result, JText::sprintf("PLG_OSMAP_CACHE_REFRESH_SUCCESS", $count));
        } catch (Exception $e) {
            echo new JResponseJson($e);
        }

        jexit();
    }
}
