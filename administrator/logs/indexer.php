#
#<?php die('Forbidden.'); ?>
#Date: 2017-05-15 18:17:45 UTC
#Software: Joomla Platform 13.1.0 Stable [ Curiosity ] 24-Apr-2013 00:00 GMT

#Fields: datetime	priority clientip	category	message
2017-05-15T18:17:45+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T18:17:45+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getContentCount
2017-05-15T18:17:45+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:17:45+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:17:45+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::onBuildIndex
2017-05-15T18:17:45+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getItems(0, 10)
2017-05-15T18:17:45+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:17:45+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:17:45+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:17:45+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:17:45+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type Error thrown. Stack trace: #0 /home/twivvbqs/public_html/plugins/finder/kunena/kunena.php(253): plgFinderKunena->index(Object(FinderIndexerResult))
#1 /home/twivvbqs/public_html/libraries/joomla/event/event.php(69): plgFinderKunena->onBuildIndex()
#2 /home/twivvbqs/public_html/libraries/joomla/event/dispatcher.php(159): JEvent->update(Array)
#3 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(176): JEventDispatcher->trigger('onbuildindex')
#4 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->batch()
#5 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('batch')
#6 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#7 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#8 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#9 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#10 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#11 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#12 {main}
2017-05-15T18:17:45+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T18:17:45+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T18:17:45+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T18:21:50+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T18:21:50+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getContentCount
2017-05-15T18:21:50+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:21:50+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:21:50+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::onBuildIndex
2017-05-15T18:21:50+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getItems(0, 10)
2017-05-15T18:21:50+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:21:50+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:21:50+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:21:50+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:21:50+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type Error thrown. Stack trace: #0 /home/twivvbqs/public_html/plugins/finder/kunena/kunena.php(253): plgFinderKunena->index(Object(FinderIndexerResult))
#1 /home/twivvbqs/public_html/libraries/joomla/event/event.php(69): plgFinderKunena->onBuildIndex()
#2 /home/twivvbqs/public_html/libraries/joomla/event/dispatcher.php(159): JEvent->update(Array)
#3 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(176): JEventDispatcher->trigger('onbuildindex')
#4 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->batch()
#5 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('batch')
#6 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#7 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#8 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#9 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#10 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#11 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#12 {main}
2017-05-15T18:21:50+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T18:21:50+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T18:21:50+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T18:22:32+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:22:32+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::onBuildIndex
2017-05-15T18:22:32+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getItems(0, 10)
2017-05-15T18:22:32+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:22:32+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:22:32+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:22:32+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:22:32+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type Error thrown. Stack trace: #0 /home/twivvbqs/public_html/plugins/finder/kunena/kunena.php(253): plgFinderKunena->index(Object(FinderIndexerResult))
#1 /home/twivvbqs/public_html/libraries/joomla/event/event.php(69): plgFinderKunena->onBuildIndex()
#2 /home/twivvbqs/public_html/libraries/joomla/event/dispatcher.php(159): JEvent->update(Array)
#3 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(176): JEventDispatcher->trigger('onbuildindex')
#4 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->batch()
#5 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('batch')
#6 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#7 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#8 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#9 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#10 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#11 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#12 {main}
2017-05-15T18:22:32+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T18:22:32+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T18:22:32+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T18:24:05+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:24:05+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::onBuildIndex
2017-05-15T18:24:05+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getItems(0, 10)
2017-05-15T18:24:05+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:24:05+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:24:05+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:24:05+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:24:05+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type Error thrown. Stack trace: #0 /home/twivvbqs/public_html/plugins/finder/kunena/kunena.php(253): plgFinderKunena->index(Object(FinderIndexerResult))
#1 /home/twivvbqs/public_html/libraries/joomla/event/event.php(69): plgFinderKunena->onBuildIndex()
#2 /home/twivvbqs/public_html/libraries/joomla/event/dispatcher.php(159): JEvent->update(Array)
#3 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(176): JEventDispatcher->trigger('onbuildindex')
#4 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->batch()
#5 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('batch')
#6 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#7 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#8 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#9 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#10 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#11 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#12 {main}
2017-05-15T18:24:05+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T18:24:05+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T18:24:05+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T18:24:18+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T18:24:18+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getContentCount
2017-05-15T18:24:18+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:24:19+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:24:19+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::onBuildIndex
2017-05-15T18:24:19+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getItems(0, 10)
2017-05-15T18:24:19+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:24:19+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:24:19+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:24:19+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:24:19+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type Error thrown. Stack trace: #0 /home/twivvbqs/public_html/plugins/finder/kunena/kunena.php(253): plgFinderKunena->index(Object(FinderIndexerResult))
#1 /home/twivvbqs/public_html/libraries/joomla/event/event.php(69): plgFinderKunena->onBuildIndex()
#2 /home/twivvbqs/public_html/libraries/joomla/event/dispatcher.php(159): JEvent->update(Array)
#3 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(176): JEventDispatcher->trigger('onbuildindex')
#4 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->batch()
#5 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('batch')
#6 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#7 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#8 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#9 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#10 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#11 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#12 {main}
2017-05-15T18:24:19+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T18:24:19+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T18:24:19+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T18:24:37+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:24:37+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::onBuildIndex
2017-05-15T18:24:37+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getItems(0, 10)
2017-05-15T18:24:37+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:24:37+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:24:37+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:24:37+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:24:37+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type Error thrown. Stack trace: #0 /home/twivvbqs/public_html/plugins/finder/kunena/kunena.php(253): plgFinderKunena->index(Object(FinderIndexerResult))
#1 /home/twivvbqs/public_html/libraries/joomla/event/event.php(69): plgFinderKunena->onBuildIndex()
#2 /home/twivvbqs/public_html/libraries/joomla/event/dispatcher.php(159): JEvent->update(Array)
#3 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(176): JEventDispatcher->trigger('onbuildindex')
#4 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->batch()
#5 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('batch')
#6 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#7 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#8 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#9 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#10 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#11 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#12 {main}
2017-05-15T18:24:37+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T18:24:37+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T18:24:37+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T18:28:59+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T18:28:59+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getContentCount
2017-05-15T18:28:59+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:29:00+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:29:00+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::onBuildIndex
2017-05-15T18:29:00+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getItems(0, 5)
2017-05-15T18:29:00+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:29:00+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:29:00+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:29:00+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:29:00+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type Error thrown. Stack trace: #0 /home/twivvbqs/public_html/plugins/finder/kunena/kunena.php(253): plgFinderKunena->index(Object(FinderIndexerResult))
#1 /home/twivvbqs/public_html/libraries/joomla/event/event.php(69): plgFinderKunena->onBuildIndex()
#2 /home/twivvbqs/public_html/libraries/joomla/event/dispatcher.php(159): JEvent->update(Array)
#3 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(176): JEventDispatcher->trigger('onbuildindex')
#4 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->batch()
#5 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('batch')
#6 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#7 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#8 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#9 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#10 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#11 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#12 {main}
2017-05-15T18:29:00+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T18:29:00+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T18:29:00+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T18:29:28+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:29:28+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::onBuildIndex
2017-05-15T18:29:28+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getItems(0, 5)
2017-05-15T18:29:28+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:29:28+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:29:28+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:29:28+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:29:28+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type Error thrown. Stack trace: #0 /home/twivvbqs/public_html/plugins/finder/kunena/kunena.php(253): plgFinderKunena->index(Object(FinderIndexerResult))
#1 /home/twivvbqs/public_html/libraries/joomla/event/event.php(69): plgFinderKunena->onBuildIndex()
#2 /home/twivvbqs/public_html/libraries/joomla/event/dispatcher.php(159): JEvent->update(Array)
#3 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(176): JEventDispatcher->trigger('onbuildindex')
#4 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->batch()
#5 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('batch')
#6 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#7 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#8 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#9 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#10 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#11 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#12 {main}
2017-05-15T18:29:28+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T18:29:28+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T18:29:28+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T18:31:45+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T18:31:45+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getContentCount
2017-05-15T18:31:45+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:31:46+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:31:46+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::onBuildIndex
2017-05-15T18:31:46+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getItems(0, 5)
2017-05-15T18:31:46+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:31:46+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:31:46+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:31:46+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:31:46+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type Error thrown. Stack trace: #0 /home/twivvbqs/public_html/plugins/finder/kunena/kunena.php(253): plgFinderKunena->index(Object(FinderIndexerResult))
#1 /home/twivvbqs/public_html/libraries/joomla/event/event.php(69): plgFinderKunena->onBuildIndex()
#2 /home/twivvbqs/public_html/libraries/joomla/event/dispatcher.php(159): JEvent->update(Array)
#3 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(176): JEventDispatcher->trigger('onbuildindex')
#4 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->batch()
#5 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('batch')
#6 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#7 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#8 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#9 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#10 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#11 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#12 {main}
2017-05-15T18:31:46+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T18:31:46+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T18:31:46+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T18:33:23+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T18:33:23+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getContentCount
2017-05-15T18:33:23+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:33:23+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:33:23+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::onBuildIndex
2017-05-15T18:33:23+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getItems(0, 5)
2017-05-15T18:33:23+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:33:23+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:33:23+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:33:23+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:33:23+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type Error thrown. Stack trace: #0 /home/twivvbqs/public_html/plugins/finder/kunena/kunena.php(253): plgFinderKunena->index(Object(FinderIndexerResult))
#1 /home/twivvbqs/public_html/libraries/joomla/event/event.php(69): plgFinderKunena->onBuildIndex()
#2 /home/twivvbqs/public_html/libraries/joomla/event/dispatcher.php(159): JEvent->update(Array)
#3 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(176): JEventDispatcher->trigger('onbuildindex')
#4 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->batch()
#5 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('batch')
#6 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#7 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#8 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#9 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#10 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#11 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#12 {main}
2017-05-15T18:33:23+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T18:33:23+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T18:33:23+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T18:38:23+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T18:38:23+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getContentCount
2017-05-15T18:38:23+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:38:23+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:38:23+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::onBuildIndex
2017-05-15T18:38:23+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getItems(0, 5)
2017-05-15T18:38:23+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:38:23+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:38:24+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:38:24+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:38:24+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type Error thrown. Stack trace: #0 /home/twivvbqs/public_html/plugins/finder/kunena/kunena.php(253): plgFinderKunena->index(Object(FinderIndexerResult))
#1 /home/twivvbqs/public_html/libraries/joomla/event/event.php(69): plgFinderKunena->onBuildIndex()
#2 /home/twivvbqs/public_html/libraries/joomla/event/dispatcher.php(159): JEvent->update(Array)
#3 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(176): JEventDispatcher->trigger('onbuildindex')
#4 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->batch()
#5 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('batch')
#6 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#7 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#8 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#9 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#10 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#11 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#12 {main}
2017-05-15T18:38:24+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T18:38:24+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T18:38:24+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T18:39:35+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T18:39:35+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getContentCount
2017-05-15T18:39:35+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:39:36+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:39:36+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::onBuildIndex
2017-05-15T18:39:36+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getItems(0, 5)
2017-05-15T18:39:36+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:39:36+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:39:36+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:39:36+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:39:36+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type Error thrown. Stack trace: #0 /home/twivvbqs/public_html/plugins/finder/kunena/kunena.php(253): plgFinderKunena->index(Object(FinderIndexerResult))
#1 /home/twivvbqs/public_html/libraries/joomla/event/event.php(69): plgFinderKunena->onBuildIndex()
#2 /home/twivvbqs/public_html/libraries/joomla/event/dispatcher.php(159): JEvent->update(Array)
#3 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(176): JEventDispatcher->trigger('onbuildindex')
#4 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->batch()
#5 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('batch')
#6 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#7 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#8 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#9 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#10 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#11 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#12 {main}
2017-05-15T18:39:36+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T18:39:36+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T18:39:36+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T18:42:11+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T18:42:11+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getContentCount
2017-05-15T18:42:11+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:42:11+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:42:11+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::onBuildIndex
2017-05-15T18:42:11+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getItems(0, 5)
2017-05-15T18:42:11+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:42:11+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:42:11+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:42:11+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:42:11+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type Error thrown. Stack trace: #0 /home/twivvbqs/public_html/plugins/finder/kunena/kunena.php(253): plgFinderKunena->index(Object(FinderIndexerResult))
#1 /home/twivvbqs/public_html/libraries/joomla/event/event.php(69): plgFinderKunena->onBuildIndex()
#2 /home/twivvbqs/public_html/libraries/joomla/event/dispatcher.php(159): JEvent->update(Array)
#3 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(176): JEventDispatcher->trigger('onbuildindex')
#4 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->batch()
#5 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('batch')
#6 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#7 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#8 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#9 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#10 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#11 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#12 {main}
2017-05-15T18:42:11+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T18:42:11+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T18:42:11+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T18:43:08+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T18:43:08+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getContentCount
2017-05-15T18:43:08+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:43:08+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:43:08+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::onBuildIndex
2017-05-15T18:43:08+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getItems(0, 5)
2017-05-15T18:43:08+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:43:08+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:43:08+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:43:08+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:43:08+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type Error thrown. Stack trace: #0 /home/twivvbqs/public_html/plugins/finder/kunena/kunena.php(253): plgFinderKunena->index(Object(FinderIndexerResult))
#1 /home/twivvbqs/public_html/libraries/joomla/event/event.php(69): plgFinderKunena->onBuildIndex()
#2 /home/twivvbqs/public_html/libraries/joomla/event/dispatcher.php(159): JEvent->update(Array)
#3 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(176): JEventDispatcher->trigger('onbuildindex')
#4 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->batch()
#5 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('batch')
#6 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#7 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#8 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#9 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#10 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#11 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#12 {main}
2017-05-15T18:43:08+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T18:43:08+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T18:43:08+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T18:45:22+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T18:45:32+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T18:46:58+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T18:46:58+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:46:59+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:47:21+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T18:47:21+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:47:22+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:47:22+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:47:23+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:47:46+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T18:47:46+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getContentCount
2017-05-15T18:47:46+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:47:47+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:47:47+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::onBuildIndex
2017-05-15T18:47:47+00:00	INFO 103.66.223.127	-	FinderIndexerAdapter::getItems(0, 5)
2017-05-15T18:47:47+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:47:47+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:47:47+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:47:47+00:00	WARNING 103.66.223.127	deprecated	JDatabase::getErrorNum() is deprecated, use exception handling instead.
2017-05-15T18:47:47+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type Error thrown. Stack trace: #0 /home/twivvbqs/public_html/plugins/finder/kunena/kunena.php(253): plgFinderKunena->index(Object(FinderIndexerResult))
#1 /home/twivvbqs/public_html/libraries/joomla/event/event.php(69): plgFinderKunena->onBuildIndex()
#2 /home/twivvbqs/public_html/libraries/joomla/event/dispatcher.php(159): JEvent->update(Array)
#3 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(176): JEventDispatcher->trigger('onbuildindex')
#4 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->batch()
#5 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('batch')
#6 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#7 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#8 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#9 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#10 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#11 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#12 {main}
2017-05-15T18:47:47+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T18:47:47+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T18:47:47+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T18:48:10+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T18:48:10+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:48:11+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:48:11+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:48:11+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:51:23+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T18:51:24+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:51:26+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:51:26+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:51:27+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:51:27+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:53:49+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T18:53:50+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:53:50+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:53:50+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:53:51+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:53:51+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:54:59+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T18:54:59+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:55:01+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T18:56:49+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T18:58:51+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T18:59:21+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:02:02+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:02:02+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:02:02+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:03:48+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:03:48+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:03:48+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:05:52+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:05:53+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:05:53+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:07:11+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:07:12+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:07:12+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:08:21+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:08:21+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:08:22+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:08:54+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:08:55+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:08:55+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:10:58+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:10:59+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:10:59+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:10:59+00:00	ERROR 103.66.223.127	database-error	Database query failed (error # 1054): Unknown column 'a.con_position' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, a.con_position AS position, a.address, a.created AS start_date,a.created_by_alias, a.modified, a.modified_by,a.metakey, a.metadesc, a.metadata, a.language,a.sortname1, a.sortname2, a.sortname3,a.publish_up AS publish_start_date, a.publish_down AS publish_end_date,a.suburb AS city, a.state AS region, a.country, a.postcode AS zip,a.telephone, a.fax, a.misc AS summary, a.email_to AS email, a.mobile,a.webpage, a.access, a.published AS state, a.ordering, a.params, a.catid,c.title AS category, c.published AS cat_state, c.access AS cat_access, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug, CASE WHEN CHAR_LENGTH(c.alias) != 0 THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as catslug,u.name
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:10:59+00:00	ERROR 103.66.223.127	-	Unknown column 'a.con_position' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, a.con_position AS position, a.address, a.created AS start_date,a.created_by_alias, a.modified, a.modified_by,a.metakey, a.metadesc, a.metadata, a.language,a.sortname1, a.sortname2, a.sortname3,a.publish_up AS publish_start_date, a.publish_down AS publish_end_date,a.suburb AS city, a.state AS region, a.country, a.postcode AS zip,a.telephone, a.fax, a.misc AS summary, a.email_to AS email, a.mobile,a.webpage, a.access, a.published AS state, a.ordering, a.params, a.catid,c.title AS category, c.published AS cat_state, c.access AS cat_access, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug, CASE WHEN CHAR_LENGTH(c.alias) != 0 THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as catslug,u.name
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:10:59+00:00	ERROR 103.66.223.127	-	Unknown column 'a.con_position' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, a.con_position AS position, a.address, a.created AS start_date,a.created_by_alias, a.modified, a.modified_by,a.metakey, a.metadesc, a.metadata, a.language,a.sortname1, a.sortname2, a.sortname3,a.publish_up AS publish_start_date, a.publish_down AS publish_end_date,a.suburb AS city, a.state AS region, a.country, a.postcode AS zip,a.telephone, a.fax, a.misc AS summary, a.email_to AS email, a.mobile,a.webpage, a.access, a.published AS state, a.ordering, a.params, a.catid,c.title AS category, c.published AS cat_state, c.access AS cat_access, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug, CASE WHEN CHAR_LENGTH(c.alias) != 0 THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as catslug,u.name
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:14:36+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:14:37+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:14:37+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:14:37+00:00	ERROR 103.66.223.127	database-error	Database query failed (error # 1054): Unknown column 'a.access' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, "" AS position, a.startpublish AS start_date,a.startpublish AS publish_start_date, a.endpublish AS publish_end_date,"" AS city, "" AS region, "" AS zip,a.description AS summary, "" AS email,a.access, a.published AS state, a.ordering, a.category, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug, CASE WHEN CHAR_LENGTH(c.alias) != 0 THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as catslug,u.name
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:14:37+00:00	ERROR 103.66.223.127	-	Unknown column 'a.access' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, "" AS position, a.startpublish AS start_date,a.startpublish AS publish_start_date, a.endpublish AS publish_end_date,"" AS city, "" AS region, "" AS zip,a.description AS summary, "" AS email,a.access, a.published AS state, a.ordering, a.category, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug, CASE WHEN CHAR_LENGTH(c.alias) != 0 THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as catslug,u.name
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:14:37+00:00	ERROR 103.66.223.127	-	Unknown column 'a.access' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, "" AS position, a.startpublish AS start_date,a.startpublish AS publish_start_date, a.endpublish AS publish_end_date,"" AS city, "" AS region, "" AS zip,a.description AS summary, "" AS email,a.access, a.published AS state, a.ordering, a.category, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug, CASE WHEN CHAR_LENGTH(c.alias) != 0 THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as catslug,u.name
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:15:16+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:15:16+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:15:16+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:15:16+00:00	ERROR 103.66.223.127	database-error	Database query failed (error # 1054): Unknown column 'c.alias' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, "" AS position, a.startpublish AS start_date,a.startpublish AS publish_start_date, a.endpublish AS publish_end_date,"" AS city, "" AS region, "" AS zip,a.description AS summary, "" AS email,a.published AS state, a.ordering, a.category, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug, CASE WHEN CHAR_LENGTH(c.alias) != 0 THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as catslug,u.name
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:15:16+00:00	ERROR 103.66.223.127	-	Unknown column 'c.alias' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, "" AS position, a.startpublish AS start_date,a.startpublish AS publish_start_date, a.endpublish AS publish_end_date,"" AS city, "" AS region, "" AS zip,a.description AS summary, "" AS email,a.published AS state, a.ordering, a.category, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug, CASE WHEN CHAR_LENGTH(c.alias) != 0 THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as catslug,u.name
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:15:16+00:00	ERROR 103.66.223.127	-	Unknown column 'c.alias' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, "" AS position, a.startpublish AS start_date,a.startpublish AS publish_start_date, a.endpublish AS publish_end_date,"" AS city, "" AS region, "" AS zip,a.description AS summary, "" AS email,a.published AS state, a.ordering, a.category, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug, CASE WHEN CHAR_LENGTH(c.alias) != 0 THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as catslug,u.name
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:15:55+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:15:55+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type ParseError thrown. Stack trace: #0 /home/twivvbqs/public_html/libraries/cms/plugin/helper.php(170): JPluginHelper::import(Object(stdClass), true, NULL)
#1 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(60): JPluginHelper::importPlugin('finder')
#2 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->start()
#3 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('start')
#4 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#5 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#6 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#7 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#8 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#9 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#10 {main}
2017-05-15T19:15:55+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T19:15:55+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T19:15:55+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T19:17:12+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:17:12+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type ParseError thrown. Stack trace: #0 /home/twivvbqs/public_html/libraries/cms/plugin/helper.php(170): JPluginHelper::import(Object(stdClass), true, NULL)
#1 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(60): JPluginHelper::importPlugin('finder')
#2 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->start()
#3 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('start')
#4 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#5 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#6 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#7 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#8 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#9 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#10 {main}
2017-05-15T19:17:12+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T19:17:12+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T19:17:12+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T19:18:29+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:18:29+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type ParseError thrown. Stack trace: #0 /home/twivvbqs/public_html/libraries/cms/plugin/helper.php(170): JPluginHelper::import(Object(stdClass), true, NULL)
#1 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(60): JPluginHelper::importPlugin('finder')
#2 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->start()
#3 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('start')
#4 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#5 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#6 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#7 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#8 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#9 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#10 {main}
2017-05-15T19:18:29+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T19:18:29+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T19:18:29+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T19:24:17+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:24:17+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type ParseError thrown. Stack trace: #0 /home/twivvbqs/public_html/libraries/cms/plugin/helper.php(170): JPluginHelper::import(Object(stdClass), true, NULL)
#1 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(60): JPluginHelper::importPlugin('finder')
#2 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->start()
#3 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('start')
#4 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#5 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#6 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#7 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#8 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#9 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#10 {main}
2017-05-15T19:24:17+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T19:24:17+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T19:24:17+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T19:24:53+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:24:53+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:24:53+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:24:53+00:00	ERROR 103.66.223.127	database-error	Database query failed (error # 1054): Unknown column 'a.categoryz' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, "" AS position, a.startpublish AS start_date,a.startpublish AS publish_start_date, a.endpublish AS publish_end_date,"" AS city, "" AS region, "" AS zip,a.description AS summary, "" AS email,a.published AS state, a.ordering, a.categoryz, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug, CASE WHEN CHAR_LENGTH(c.alias) != 0 THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as catslug,u.name
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:24:53+00:00	ERROR 103.66.223.127	-	Unknown column 'a.categoryz' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, "" AS position, a.startpublish AS start_date,a.startpublish AS publish_start_date, a.endpublish AS publish_end_date,"" AS city, "" AS region, "" AS zip,a.description AS summary, "" AS email,a.published AS state, a.ordering, a.categoryz, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug, CASE WHEN CHAR_LENGTH(c.alias) != 0 THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as catslug,u.name
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:24:53+00:00	ERROR 103.66.223.127	-	Unknown column 'a.categoryz' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, "" AS position, a.startpublish AS start_date,a.startpublish AS publish_start_date, a.endpublish AS publish_end_date,"" AS city, "" AS region, "" AS zip,a.description AS summary, "" AS email,a.published AS state, a.ordering, a.categoryz, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug, CASE WHEN CHAR_LENGTH(c.alias) != 0 THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as catslug,u.name
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:27:32+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:27:32+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type ParseError thrown. Stack trace: #0 /home/twivvbqs/public_html/libraries/cms/plugin/helper.php(170): JPluginHelper::import(Object(stdClass), true, NULL)
#1 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(60): JPluginHelper::importPlugin('finder')
#2 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->start()
#3 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('start')
#4 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#5 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#6 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#7 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#8 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#9 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#10 {main}
2017-05-15T19:27:32+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T19:27:32+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T19:27:32+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T19:29:15+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:29:15+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type ParseError thrown. Stack trace: #0 /home/twivvbqs/public_html/libraries/cms/plugin/helper.php(170): JPluginHelper::import(Object(stdClass), true, NULL)
#1 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(60): JPluginHelper::importPlugin('finder')
#2 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->start()
#3 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('start')
#4 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#5 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#6 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#7 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#8 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#9 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#10 {main}
2017-05-15T19:29:15+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T19:29:15+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T19:29:15+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T19:30:00+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:30:00+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:30:00+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:30:00+00:00	ERROR 103.66.223.127	database-error	Database query failed (error # 1054): Unknown column 'a.categoryz' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, "" AS position, a.startpublish AS start_date,a.startpublish AS publish_start_date, a.endpublish AS publish_end_date,a.published AS state, a.ordering, a.categoryz, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug, CASE WHEN CHAR_LENGTH(c.alias) != 0 THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as catslug,u.name
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:30:00+00:00	ERROR 103.66.223.127	-	Unknown column 'a.categoryz' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, "" AS position, a.startpublish AS start_date,a.startpublish AS publish_start_date, a.endpublish AS publish_end_date,a.published AS state, a.ordering, a.categoryz, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug, CASE WHEN CHAR_LENGTH(c.alias) != 0 THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as catslug,u.name
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:30:00+00:00	ERROR 103.66.223.127	-	Unknown column 'a.categoryz' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, "" AS position, a.startpublish AS start_date,a.startpublish AS publish_start_date, a.endpublish AS publish_end_date,a.published AS state, a.ordering, a.categoryz, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug, CASE WHEN CHAR_LENGTH(c.alias) != 0 THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as catslug,u.name
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:30:26+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:30:27+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type ParseError thrown. Stack trace: #0 /home/twivvbqs/public_html/libraries/cms/plugin/helper.php(170): JPluginHelper::import(Object(stdClass), true, NULL)
#1 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(60): JPluginHelper::importPlugin('finder')
#2 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->start()
#3 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('start')
#4 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#5 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#6 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#7 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#8 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#9 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#10 {main}
2017-05-15T19:30:27+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T19:30:27+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T19:30:27+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T19:30:53+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:30:53+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:30:53+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:30:53+00:00	ERROR 103.66.223.127	database-error	Database query failed (error # 1054): Unknown column 'a.categoryz' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, "" AS position, a.startpublish AS start_date,a.startpublish AS publish_start_date, a.endpublish AS publish_end_date,a.published AS state, a.ordering, a.categoryz, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug, CASE WHEN CHAR_LENGTH(c.alias) != 0 THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as catslug
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:30:53+00:00	ERROR 103.66.223.127	-	Unknown column 'a.categoryz' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, "" AS position, a.startpublish AS start_date,a.startpublish AS publish_start_date, a.endpublish AS publish_end_date,a.published AS state, a.ordering, a.categoryz, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug, CASE WHEN CHAR_LENGTH(c.alias) != 0 THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as catslug
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:30:53+00:00	ERROR 103.66.223.127	-	Unknown column 'a.categoryz' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, "" AS position, a.startpublish AS start_date,a.startpublish AS publish_start_date, a.endpublish AS publish_end_date,a.published AS state, a.ordering, a.categoryz, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug, CASE WHEN CHAR_LENGTH(c.alias) != 0 THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as catslug
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:31:27+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:31:27+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type ParseError thrown. Stack trace: #0 /home/twivvbqs/public_html/libraries/cms/plugin/helper.php(170): JPluginHelper::import(Object(stdClass), true, NULL)
#1 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(60): JPluginHelper::importPlugin('finder')
#2 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->start()
#3 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('start')
#4 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#5 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#6 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#7 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#8 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#9 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#10 {main}
2017-05-15T19:31:27+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T19:31:27+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T19:31:27+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T19:31:46+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:31:46+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:31:46+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:31:46+00:00	ERROR 103.66.223.127	database-error	Database query failed (error # 1054): Unknown column 'a.categoryz' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, "" AS position, a.startpublish AS start_date,a.startpublish AS publish_start_date, a.endpublish AS publish_end_date,a.published AS state, a.ordering, a.categoryz, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug, CASE WHEN CHAR_LENGTH(c.alias) != 0 THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as catslug
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:31:46+00:00	ERROR 103.66.223.127	-	Unknown column 'a.categoryz' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, "" AS position, a.startpublish AS start_date,a.startpublish AS publish_start_date, a.endpublish AS publish_end_date,a.published AS state, a.ordering, a.categoryz, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug, CASE WHEN CHAR_LENGTH(c.alias) != 0 THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as catslug
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:31:46+00:00	ERROR 103.66.223.127	-	Unknown column 'a.categoryz' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, "" AS position, a.startpublish AS start_date,a.startpublish AS publish_start_date, a.endpublish AS publish_end_date,a.published AS state, a.ordering, a.categoryz, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug, CASE WHEN CHAR_LENGTH(c.alias) != 0 THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as catslug
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:35:18+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:35:19+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:35:19+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:35:19+00:00	ERROR 103.66.223.127	database-error	Database query failed (error # 1054): Unknown column 'a.categoryz' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, "" AS position, a.startpublish AS start_date,a.startpublish AS publish_start_date, a.endpublish AS publish_end_date,a.published AS state, a.ordering, a.categoryz, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:35:19+00:00	ERROR 103.66.223.127	-	Unknown column 'a.categoryz' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, "" AS position, a.startpublish AS start_date,a.startpublish AS publish_start_date, a.endpublish AS publish_end_date,a.published AS state, a.ordering, a.categoryz, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:35:19+00:00	ERROR 103.66.223.127	-	Unknown column 'a.categoryz' in 'field list' SQL=SELECT a.id, a.name AS title, a.alias, "" AS position, a.startpublish AS start_date,a.startpublish AS publish_start_date, a.endpublish AS publish_end_date,a.published AS state, a.ordering, a.categoryz, CASE WHEN CHAR_LENGTH(a.alias) != 0 THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug
FROM #__guru_task AS a LIMIT 5
2017-05-15T19:35:50+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:35:51+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:35:51+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:35:51+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:35:51+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:35:52+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:35:52+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:44:30+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:44:30+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:44:30+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:44:31+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:44:31+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:44:31+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:44:31+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:46:00+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:46:01+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:46:01+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:46:02+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:46:02+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:46:03+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:46:03+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:46:03+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:46:03+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:46:03+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:46:03+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:50:22+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:50:22+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:50:22+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:50:23+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:50:23+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:50:23+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:50:23+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:50:24+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:50:24+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:50:24+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:50:24+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:52:32+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T19:52:33+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:52:33+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:52:34+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:52:34+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:52:35+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:52:35+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:52:35+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:52:35+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T19:52:36+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T19:52:36+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T20:02:53+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T20:02:53+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T20:02:53+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T20:02:55+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T20:02:55+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T20:02:55+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T20:02:55+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T20:02:56+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T20:02:56+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T20:02:56+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T20:02:56+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T20:04:15+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T20:04:15+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T20:04:15+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T20:04:15+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T20:04:15+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T20:04:16+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T20:04:16+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T20:04:16+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T20:04:16+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T20:04:17+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T20:04:17+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T20:05:27+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T20:05:27+00:00	CRITICAL 103.66.223.127	error	Uncaught Throwable of type ParseError thrown. Stack trace: #0 /home/twivvbqs/public_html/libraries/cms/plugin/helper.php(170): JPluginHelper::import(Object(stdClass), true, NULL)
#1 /home/twivvbqs/public_html/administrator/components/com_finder/controllers/indexer.json.php(60): JPluginHelper::importPlugin('finder')
#2 /home/twivvbqs/public_html/libraries/legacy/controller/legacy.php(702): FinderControllerIndexer->start()
#3 /home/twivvbqs/public_html/administrator/components/com_finder/finder.php(18): JControllerLegacy->execute('start')
#4 /home/twivvbqs/public_html/libraries/cms/component/helper.php(405): require_once('/home/twivvbqs/...')
#5 /home/twivvbqs/public_html/libraries/cms/component/helper.php(380): JComponentHelper::executeComponent('/home/twivvbqs/...')
#6 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(98): JComponentHelper::renderComponent('com_finder')
#7 /home/twivvbqs/public_html/libraries/cms/application/administrator.php(152): JApplicationAdministrator->dispatch()
#8 /home/twivvbqs/public_html/libraries/cms/application/cms.php(261): JApplicationAdministrator->doExecute()
#9 /home/twivvbqs/public_html/administrator/index.php(51): JApplicationCms->execute()
#10 {main}
2017-05-15T20:05:27+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getEntries() is deprecated. Use JHtmlSidebar::getEntries() instead.
2017-05-15T20:05:27+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getFilters() is deprecated. Use JHtmlSidebar::getFilters() instead.
2017-05-15T20:05:27+00:00	WARNING 103.66.223.127	deprecated	JSubMenuHelper::getAction() is deprecated. Use JHtmlSidebar::getAction() instead.
2017-05-15T20:06:07+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T20:06:07+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T20:06:08+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T20:06:08+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T20:06:08+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T20:06:08+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T20:06:08+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T20:06:09+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T20:06:09+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T20:06:09+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T20:06:09+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T20:07:13+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-15T20:07:13+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T20:07:13+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T20:07:15+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T20:07:15+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T20:07:16+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T20:07:16+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T20:07:16+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T20:07:16+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T20:07:17+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-15T20:07:17+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T21:37:55+00:00	INFO 75.137.237.200	-	Starting the indexer
2017-05-15T21:37:55+00:00	INFO 75.137.237.200	-	Starting the indexer batch process
2017-05-15T21:37:55+00:00	WARNING 75.137.237.200	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T21:37:55+00:00	INFO 75.137.237.200	-	Starting the indexer batch process
2017-05-15T21:37:55+00:00	WARNING 75.137.237.200	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T21:37:55+00:00	INFO 75.137.237.200	-	Starting the indexer batch process
2017-05-15T21:37:55+00:00	WARNING 75.137.237.200	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T21:37:55+00:00	INFO 75.137.237.200	-	Starting the indexer batch process
2017-05-15T21:37:55+00:00	WARNING 75.137.237.200	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-15T21:37:56+00:00	INFO 75.137.237.200	-	Starting the indexer batch process
2017-05-15T21:37:56+00:00	WARNING 75.137.237.200	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:49:15+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-23T14:49:15+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:49:15+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:49:15+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:49:15+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:49:16+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:49:16+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:49:16+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:49:16+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:49:17+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:49:17+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:49:17+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:49:17+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:49:18+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:49:18+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:49:18+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:49:18+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:58:07+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-23T14:58:07+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:58:07+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:58:08+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:58:08+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:58:08+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:58:08+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:58:08+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:58:08+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:58:09+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:58:09+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:58:09+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:58:09+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:58:10+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:58:10+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:58:10+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:58:10+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:59:05+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-23T14:59:05+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:59:05+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:59:06+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:59:06+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:59:06+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:59:06+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:59:07+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:59:07+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:59:07+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:59:07+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:59:08+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:59:08+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:59:08+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:59:08+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:59:09+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:59:09+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:59:58+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-23T14:59:58+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:59:58+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:59:59+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:59:59+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T14:59:59+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T14:59:59+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T15:00:00+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T15:00:00+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T15:00:00+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T15:00:00+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T15:00:01+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T15:00:01+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T15:00:01+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T15:00:01+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T15:00:02+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T15:00:02+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:26:09+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-23T17:26:10+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:26:10+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:26:12+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:26:12+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:26:13+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:26:13+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:26:15+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:26:15+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:26:18+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:26:18+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:26:19+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:26:19+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:26:21+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:26:21+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:26:22+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:26:22+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:27:19+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-23T17:27:21+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:27:21+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:27:24+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:27:24+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:27:25+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:27:25+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:27:27+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:27:27+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:27:29+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:27:29+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:27:31+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:27:31+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:27:33+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:27:33+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:27:35+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:27:35+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:30:23+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-23T17:30:25+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:30:25+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:30:27+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:30:27+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:30:30+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:30:30+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:30:31+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:30:31+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:30:32+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:30:32+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:30:34+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:30:34+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:30:36+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:30:36+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:30:38+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:30:38+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:31:59+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-23T17:32:01+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:32:01+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:32:02+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:32:02+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:32:04+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:32:04+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:32:05+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:32:05+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:32:08+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:32:08+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:32:09+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:32:09+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:32:11+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:32:11+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:32:14+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:32:14+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:34:05+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-23T17:34:07+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:34:07+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:34:09+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:34:09+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:34:10+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:34:10+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:34:10+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:34:10+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:34:11+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:34:11+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:34:11+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:34:11+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:34:11+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:34:11+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:34:12+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:34:12+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:35:02+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-23T17:35:02+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:35:02+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:35:03+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:35:03+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:35:03+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:35:03+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:35:04+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:35:04+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:35:04+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:35:04+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:35:05+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:35:05+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:35:05+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:35:05+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:35:06+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:35:06+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:36:28+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-23T17:36:29+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:36:29+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:36:30+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:36:30+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:36:31+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:36:31+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:36:32+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:36:32+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:36:34+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:36:34+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:36:35+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:36:35+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:36:37+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:36:37+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:36:39+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:36:39+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:37:58+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-23T17:37:59+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:37:59+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:38:01+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:38:01+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:38:04+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:38:04+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:38:07+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:38:07+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:38:09+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:38:09+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:38:11+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:38:11+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:38:14+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:38:14+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:38:15+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:38:15+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:41:15+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-23T17:41:15+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:41:15+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:41:16+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:41:16+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:41:17+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:41:17+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:41:17+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:41:17+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:41:18+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:41:18+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:41:18+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:41:18+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:41:19+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:41:19+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:41:19+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:41:19+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:43:21+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-23T17:43:22+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:43:22+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:43:24+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:43:24+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:43:25+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:43:25+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:43:26+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:43:26+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:43:27+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:43:27+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:43:29+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:43:29+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:43:30+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:43:30+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T17:43:31+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T17:43:31+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T19:27:47+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-23T19:27:48+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T19:27:48+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T19:27:51+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T19:27:51+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T19:27:53+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T19:27:53+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T19:27:55+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T19:27:55+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T19:27:57+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T19:27:57+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T19:27:57+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T19:27:57+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T19:27:58+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T19:27:58+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-23T19:27:58+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-23T19:27:58+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:55:17+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-24T13:55:18+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:55:18+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:55:18+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:55:18+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:55:19+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:55:19+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:55:19+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:55:19+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:55:20+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:55:20+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:55:20+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:55:20+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:55:21+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:55:21+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:55:21+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:55:21+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:57:39+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-24T13:57:39+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:57:39+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:57:40+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:57:40+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:57:40+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:57:40+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:57:41+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:57:41+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:57:41+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:57:41+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:57:42+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:57:42+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:57:42+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:57:42+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:57:43+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:57:43+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:58:55+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-24T13:58:56+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:58:56+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:58:56+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:58:56+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:58:57+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:58:57+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:58:58+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:58:58+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:59:01+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:59:01+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:59:02+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:59:02+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:59:03+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:59:03+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T13:59:03+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T13:59:03+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:02:03+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-24T14:02:03+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:02:03+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:02:05+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:02:05+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:02:06+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:02:06+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:02:06+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:02:06+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:02:07+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:02:07+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:02:07+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:02:07+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:02:08+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:02:08+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:02:08+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:02:08+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:06:06+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-24T14:06:07+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:06:07+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:06:07+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:06:07+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:06:08+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:06:08+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:06:08+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:06:08+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:06:09+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:06:09+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:06:09+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:06:09+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:06:10+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:06:10+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:06:10+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:06:10+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:07:04+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-24T14:07:04+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:07:04+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:07:05+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:07:05+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:07:05+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:07:05+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:07:05+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:07:05+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:07:06+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:07:06+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:07:06+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:07:06+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:07:07+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:07:07+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:07:07+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:07:07+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:08:46+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-24T14:08:47+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:08:47+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:08:47+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:08:47+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:08:47+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:08:47+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:08:48+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:08:48+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:08:48+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:08:48+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:08:49+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:08:49+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:08:49+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:08:49+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:08:50+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:08:50+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:10:57+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-24T14:10:57+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:10:57+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:10:58+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:10:58+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:10:58+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:10:58+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:10:59+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:10:59+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:10:59+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:10:59+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:11:00+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:11:00+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:11:00+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:11:00+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:11:01+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:11:01+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:13:34+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-24T14:13:34+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:13:34+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:13:35+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:13:35+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:13:35+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:13:35+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:13:36+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:13:36+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:13:37+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:13:37+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:13:37+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:13:37+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:13:38+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:13:38+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:13:38+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:13:38+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:15:21+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-24T14:15:23+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:15:23+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:15:23+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:15:23+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:15:24+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:15:24+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:15:24+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:15:24+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:15:25+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:15:25+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:15:25+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:15:25+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:15:26+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:15:26+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:15:26+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:15:26+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:52:17+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-24T14:52:18+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:52:18+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:52:18+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:52:18+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:52:18+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:52:18+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:52:19+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:52:19+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:52:19+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:52:19+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:52:20+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:52:20+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:52:20+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:52:20+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:52:21+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:52:21+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:54:08+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-24T14:54:08+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:54:08+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:54:09+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:54:09+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:54:09+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:54:09+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:54:10+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:54:10+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:54:11+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:54:11+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:54:11+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:54:11+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:54:12+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:54:12+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:54:12+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:54:12+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:56:12+00:00	INFO 103.66.223.127	-	Starting the indexer
2017-05-24T14:56:13+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:56:13+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:56:13+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:56:13+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:56:14+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:56:14+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:56:14+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:56:14+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:56:15+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:56:15+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:56:15+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:56:15+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:56:16+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:56:16+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-05-24T14:56:16+00:00	INFO 103.66.223.127	-	Starting the indexer batch process
2017-05-24T14:56:17+00:00	WARNING 103.66.223.127	deprecated	JDatabase::query() is deprecated, use JDatabaseDriver::execute() instead.
2017-11-08T21:15:55+00:00	INFO 100.0.42.241	-	Starting the indexer
2017-11-08T21:15:56+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:15:56+00:00	WARNING 100.0.42.241	deprecated	JFile::read is deprecated. Use native file_get_contents() syntax.
2017-11-08T21:15:57+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 10,485,760 bytes
2017-11-08T21:15:57+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:15:57+00:00	WARNING 100.0.42.241	deprecated	JFile::read is deprecated. Use native file_get_contents() syntax.
2017-11-08T21:15:58+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:15:58+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:15:58+00:00	WARNING 100.0.42.241	deprecated	JFile::read is deprecated. Use native file_get_contents() syntax.
2017-11-08T21:15:59+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:15:59+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:15:59+00:00	WARNING 100.0.42.241	deprecated	JFile::read is deprecated. Use native file_get_contents() syntax.
2017-11-08T21:15:59+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:15:59+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:15:59+00:00	WARNING 100.0.42.241	deprecated	JFile::read is deprecated. Use native file_get_contents() syntax.
2017-11-08T21:16:01+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:01+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:01+00:00	WARNING 100.0.42.241	deprecated	JFile::read is deprecated. Use native file_get_contents() syntax.
2017-11-08T21:16:02+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:02+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:02+00:00	WARNING 100.0.42.241	deprecated	JFile::read is deprecated. Use native file_get_contents() syntax.
2017-11-08T21:16:04+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:04+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:04+00:00	WARNING 100.0.42.241	deprecated	JFile::read is deprecated. Use native file_get_contents() syntax.
2017-11-08T21:16:05+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:05+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:05+00:00	WARNING 100.0.42.241	deprecated	JFile::read is deprecated. Use native file_get_contents() syntax.
2017-11-08T21:16:07+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:07+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:07+00:00	WARNING 100.0.42.241	deprecated	JFile::read is deprecated. Use native file_get_contents() syntax.
2017-11-08T21:16:09+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:09+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:09+00:00	WARNING 100.0.42.241	deprecated	JFile::read is deprecated. Use native file_get_contents() syntax.
2017-11-08T21:16:11+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:11+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:12+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:12+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:13+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:13+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:14+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:14+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:15+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:16+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:17+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:17+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:19+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:19+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:21+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:21+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:22+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:22+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:24+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:24+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:25+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:26+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:27+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:28+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:29+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:30+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:31+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:31+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:33+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:33+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:34+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:35+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:36+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:37+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:38+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:39+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:40+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:41+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:41+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:41+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:41+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:42+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:42+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:43+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:43+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:44+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:44+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:45+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:45+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:45+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:46+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:46+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:46+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:47+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:47+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:47+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:47+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:47+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:48+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:48+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:49+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:49+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:49+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:50+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:50+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:50+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:50+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:51+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:51+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:51+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:51+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:52+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:52+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:52+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:52+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:53+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:53+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:54+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:55+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:55+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:55+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:56+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:56+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:57+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:57+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:57+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:57+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:58+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:58+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:58+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:58+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:59+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:16:59+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:16:59+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:00+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:00+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:00+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:00+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:02+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:02+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:02+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:02+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:03+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:03+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:03+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:04+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:04+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:04+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:05+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:05+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:06+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:06+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:06+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:07+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:07+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:07+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:08+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:08+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:08+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:09+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:09+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:09+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:10+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:10+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:10+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:11+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:11+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:11+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:11+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:12+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:12+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:13+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:14+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:15+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:16+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:16+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:18+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:18+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:20+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:20+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:21+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:22+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:23+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:24+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:26+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:26+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:27+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:28+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:29+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:29+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:31+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:31+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:31+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:32+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:32+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:33+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:33+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:33+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:33+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:34+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:34+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:35+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:35+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:35+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:35+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:36+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:36+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:37+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:37+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:37+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:37+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:38+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:38+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:39+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:39+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:40+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:40+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:40+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:40+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:41+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:41+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:41+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:42+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:42+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:42+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:43+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:43+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:43+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:43+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:44+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:44+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:45+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:45+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:46+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:46+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:46+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:46+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:47+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:47+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:48+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:48+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:48+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:48+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:49+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:49+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:49+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:50+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:50+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:50+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:51+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:52+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:52+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:52+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:53+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:53+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:53+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:53+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:53+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:54+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:54+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:55+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:55+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:55+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:55+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:55+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:56+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:56+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:56+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:57+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:57+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:58+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:58+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:58+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:17:59+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:17:59+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:00+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:00+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:00+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:01+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:01+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:01+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:01+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:02+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:02+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:02+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:02+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:03+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:03+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:04+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:05+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:05+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:05+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:05+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:06+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:06+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:06+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:06+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:07+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:07+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:07+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:08+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:08+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:08+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:09+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:09+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:10+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:11+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:12+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:12+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:12+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:12+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:13+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:13+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:13+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:14+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:14+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:14+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:14+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:14+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:15+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:15+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:15+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:16+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:16+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:16+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:17+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:17+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:18+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:18+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:18+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:19+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:19+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:19+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:20+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:20+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:20+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:21+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:21+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:21+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:22+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:22+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:22+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:22+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:23+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:24+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:24+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:24+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:25+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:25+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:25+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:25+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:26+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:26+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:26+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:27+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:27+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:27+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:28+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:28+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:28+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:28+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:29+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:29+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:30+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:31+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:31+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:31+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:32+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:32+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:32+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:32+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:33+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:33+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:33+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:34+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:34+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:34+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:35+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:35+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:35+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:36+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:36+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:36+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:37+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:37+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:37+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:37+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:38+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:38+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:38+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:38+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:39+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:39+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:39+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:40+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:40+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:40+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:41+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:41+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:42+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:43+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:43+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:43+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:43+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:44+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:44+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:45+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:45+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:45+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:45+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:45+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:46+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:46+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:46+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:46+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:47+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:47+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:47+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:48+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:48+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:49+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:49+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:49+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:50+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:50+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:51+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:51+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:51+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:51+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:52+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:52+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:52+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:52+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:53+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:53+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:54+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:54+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:55+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:55+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:56+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:56+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:57+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:57+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:57+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:57+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:58+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:58+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:58+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:59+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:18:59+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:18:59+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:00+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:00+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:01+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:01+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:01+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:02+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:02+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:02+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:03+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:03+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:04+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:04+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:04+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:04+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:05+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:05+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:05+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:05+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:06+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:06+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:07+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:07+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:07+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:07+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:07+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:08+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:09+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:09+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:09+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:09+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:10+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:10+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:10+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:10+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:11+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:11+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:11+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:12+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:12+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:12+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:13+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:13+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:13+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:14+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:14+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:15+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:15+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:16+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:16+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:16+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:17+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:17+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:17+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:17+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:18+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:18+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:19+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:19+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:20+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:20+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:20+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:20+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:21+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:21+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:22+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:22+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:22+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:22+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:23+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:24+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:24+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:24+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:25+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:25+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:25+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:26+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:26+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:26+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:26+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:27+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:27+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:28+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:28+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:29+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:29+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:30+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:30+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:30+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:31+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:31+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:31+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:31+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:32+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:32+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:32+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:33+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:33+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:33+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:34+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:34+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:34+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:35+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:35+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:36+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:36+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:36+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:37+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:37+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:38+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:38+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:38+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:38+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:39+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:39+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:40+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:40+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:40+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:41+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:41+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:42+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:42+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:42+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:43+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:43+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:43+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:43+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:44+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:44+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:44+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:45+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:45+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:46+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:46+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:46+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:46+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:47+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:47+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:48+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:48+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:48+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:49+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:49+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:50+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:50+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:50+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:50+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:51+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:51+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:51+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:51+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:52+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:52+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:53+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:53+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:53+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:53+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:54+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:54+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:55+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:55+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:56+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:56+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:56+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:56+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:56+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:57+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:57+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:57+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:58+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:58+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:58+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:59+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:59+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:19:59+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:19:59+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:01+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:02+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:02+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:03+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:03+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:03+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:03+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:04+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:04+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:04+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:05+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:05+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:05+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:05+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:05+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:06+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:06+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:06+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:07+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:07+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:08+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:09+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:09+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:09+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:09+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:10+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:10+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:10+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:11+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:11+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:11+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:12+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:12+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:12+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:13+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:13+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:13+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:14+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:14+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:15+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:15+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:15+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:15+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:16+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:16+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:17+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:17+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:17+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:17+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:18+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:18+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:18+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:18+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:19+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:19+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:19+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:20+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:21+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:21+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:21+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:21+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:22+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:22+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:23+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:23+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:24+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:24+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:24+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:24+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:25+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:25+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:25+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:26+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:26+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:26+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:27+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:28+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:28+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:28+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:29+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:29+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:29+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:30+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:30+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:30+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:31+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:31+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:31+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:32+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:32+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:32+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:32+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:32+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:33+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:34+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:35+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:35+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:35+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:35+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:36+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:36+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:37+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:37+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:37+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:37+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:38+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:38+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:38+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:39+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:39+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:39+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:40+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:40+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:40+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:41+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:41+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:41+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:42+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:42+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:43+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:43+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:43+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:44+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:44+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:44+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:45+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:45+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:46+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:46+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:46+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:47+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:47+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:48+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:48+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:48+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:49+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:49+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:49+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:49+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:50+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:50+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:50+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:50+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:51+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:51+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:52+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:52+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:52+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:52+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:53+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:54+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:54+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:54+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:55+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:55+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:55+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:56+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:56+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:56+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:57+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:57+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:58+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:58+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:58+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:59+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:20:59+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:20:59+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:00+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:00+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:00+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:01+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:01+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:01+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:02+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:02+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:02+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:02+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:03+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:03+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:03+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:04+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:05+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:05+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:05+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:05+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:06+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:06+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:06+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:07+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:07+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:08+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:08+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:08+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:09+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:09+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:10+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:10+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:10+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:10+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:11+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:11+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:11+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:11+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:12+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:12+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:12+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:12+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:13+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:14+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:14+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:14+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:14+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:14+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:14+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:14+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:15+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:15+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:15+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:15+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:15+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:15+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:15+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:15+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:15+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:15+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:15+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:15+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:15+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:15+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:16+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:16+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:16+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:16+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:16+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:16+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:16+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:16+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:16+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:16+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:16+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:16+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:16+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:16+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:16+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:17+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:17+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:17+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:17+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:17+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:17+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:17+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:17+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:17+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:17+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:17+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:17+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:17+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:17+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:17+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:18+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:18+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:18+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:18+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:18+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:18+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:18+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:18+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:18+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:18+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:18+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:18+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:18+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:18+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:19+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:19+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:19+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:19+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:19+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:19+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:19+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:19+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:19+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:19+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:19+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:19+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:19+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:19+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:19+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:19+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:20+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:20+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:20+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:20+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:20+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:20+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:20+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:20+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:20+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:20+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:20+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:20+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:20+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:20+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:21+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:21+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:21+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:21+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:21+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:21+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:21+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:21+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:21+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:21+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:21+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:21+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:21+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:21+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 4,194,304 bytes
2017-11-08T21:21:21+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:22+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 4,194,304 bytes
2017-11-08T21:21:22+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:22+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 4,194,304 bytes
2017-11-08T21:21:22+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:22+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 4,194,304 bytes
2017-11-08T21:21:22+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:22+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:23+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:23+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:23+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:23+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:23+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:23+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:23+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:24+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:24+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:24+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:24+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:24+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:24+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:24+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:24+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:25+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:25+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:25+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:25+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:25+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:25+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:25+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
2017-11-08T21:21:25+00:00	INFO 100.0.42.241	-	Starting the indexer batch process
2017-11-08T21:21:26+00:00	INFO 100.0.42.241	-	Batch completed, peak memory usage: 2,097,152 bytes
