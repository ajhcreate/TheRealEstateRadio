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

defined('_JEXEC') or die();

require_once JPATH_PLUGINS . '/osmap/cache/include.php';


class OSMapControllerSitemap extends JControllerLegacy
{
    /**
     * Execute a task by triggering a method in the derived class.
     *
     * @param string $task The task to perform. If no matching task is found, the '__default' task is executed, if
     *                     defined.
     *
     * @return void
     *
     * @since   12.2
     * @throws  Exception
     */
    public function execute($task)
    {
        if (strpos($task, '.') !== false) {
            list($type, $task) = explode('.', $task);
        } else {
            $type = '';
        }

        // Call plugins to execute extended tasks
        \JPluginHelper::importPlugin('osmap');

        $eventParams = array($type, $task);
        $results     = \JEventDispatcher::getInstance()->trigger('osmapOnBeforeExecuteTask', $eventParams);

        // Check if any of the plugins returned the exit signal
        if (is_array($results) && in_array('exit', $results, true)) {
            OSMap\Factory::getApplication()->enqueueMessage(
                JText::_('COM_OSMAP_MSG_TASK_STOPPED_BY_PLUGIN'),
                'warning'
            );

            return;
        }

        $result = parent::execute($task);

        // Runs the event after the task was executed
        $eventParams[] = &$result;
        \JEventDispatcher::getInstance()->trigger('osmapOnAfterExecuteTask', $eventParams);
    }
}
