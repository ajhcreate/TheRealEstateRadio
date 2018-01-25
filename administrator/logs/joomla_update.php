#
#<?php die('Forbidden.'); ?>
#Date: 2017-09-12 15:39:37 UTC
#Software: Joomla Platform 13.1.0 Stable [ Curiosity ] 24-Apr-2013 00:00 GMT

#Fields: datetime	priority clientip	category	message
2017-09-12T15:39:37+00:00	INFO 71.174.216.3	update	Update started by user Dom Cassone (262). Old version is 3.6.5.
2017-09-12T15:39:38+00:00	INFO 71.174.216.3	update	Downloading update file from http://s3-us-west-2.amazonaws.com/joomla-official-downloads/joomladownloads/joomla3/Joomla_3.7.5-Stable-Update_Package.zip?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIZ6S3Q3YQHG57ZRA%2F20170912%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20170912T154002Z&X-Amz-Expires=60&X-Amz-SignedHeaders=host&X-Amz-Signature=202e179a8cbc940e59b3cecb52fe3847bbeb50139fd1e7e8787f69ae306155a9.
2017-09-12T15:39:39+00:00	INFO 71.174.216.3	update	File Joomla_3.7.5-Stable-Update_Package.zip successfully downloaded.
2017-09-12T15:39:39+00:00	INFO 71.174.216.3	update	Starting installation of new version.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Finalising installation.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2016-08-06. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2016-08-22. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2016-08-29. Query text: CREATE TABLE IF NOT EXISTS `#__fields` (   `id` int(10) unsigned NOT NULL AUTO_I.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2016-08-29. Query text: CREATE TABLE IF NOT EXISTS `#__fields_categories` (   `field_id` int(11) NOT NUL.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2016-08-29. Query text: CREATE TABLE IF NOT EXISTS `#__fields_groups` (   `id` int(10) unsigned NOT NULL.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2016-08-29. Query text: CREATE TABLE IF NOT EXISTS `#__fields_values` (   `field_id` int(10) unsigned NO.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2016-08-29. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2016-08-29. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2016-09-29. Query text: INSERT INTO `#__postinstall_messages` (`extension_id`, `title_key`, `description.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2016-10-01. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2016-10-02. Query text: ALTER TABLE `#__session` MODIFY `client_id` tinyint(3) unsigned DEFAULT NULL;.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2016-11-04. Query text: ALTER TABLE `#__extensions` CHANGE `enabled` `enabled` TINYINT(3) NOT NULL DEFAU.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2016-11-19. Query text: ALTER TABLE `#__menu_types` ADD COLUMN `client_id` int(11) NOT NULL DEFAULT 0;.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2016-11-19. Query text: UPDATE `#__menu` SET `published` = 1 WHERE `menutype` = 'main' OR `menutype` = '.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2016-11-21. Query text: ALTER TABLE `#__languages` DROP INDEX `idx_image`;.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2016-11-24. Query text: ALTER TABLE `#__extensions` ADD COLUMN `package_id` int(11) NOT NULL DEFAULT 0 C.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2016-11-24. Query text: UPDATE `#__extensions` AS `e1` INNER JOIN (SELECT `extension_id` FROM `#__extens.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2016-11-27. Query text: ALTER TABLE `#__modules` MODIFY `content` text NOT NULL DEFAULT '';.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_title` varchar(400) NOT NULL DEFAULT '.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_alias` varchar(400) CHARACTER SET utf8.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_body` mediumtext NOT NULL DEFAULT '';.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_checked_out_time` varchar(255) NOT NUL.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_params` text NOT NULL DEFAULT '';.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_metadata` varchar(2048) NOT NULL DEFAU.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_language` char(7) NOT NULL DEFAULT '';.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_publish_up` datetime NOT NULL DEFAULT .
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_publish_down` datetime NOT NULL DEFAUL.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_content_item_id` int(10) unsigned NOT .
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `asset_id` int(10) unsigned NOT NULL DEFAULT.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_images` text NOT NULL DEFAULT '';.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_urls` text NOT NULL DEFAULT '';.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_metakey` text NOT NULL DEFAULT '';.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_metadesc` text NOT NULL DEFAULT '';.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_xreference` varchar(50) NOT NULL DEFAU.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_type_id` int(10) unsigned NOT NULL DEF.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-09. Query text: ALTER TABLE `#__categories` MODIFY `title` varchar(255) NOT NULL DEFAULT '';.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-09. Query text: ALTER TABLE `#__categories` MODIFY `description` mediumtext NOT NULL DEFAULT '';.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-09. Query text: ALTER TABLE `#__categories` MODIFY `params` text NOT NULL DEFAULT '';.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-09. Query text: ALTER TABLE `#__categories` MODIFY `metadesc` varchar(1024) NOT NULL DEFAULT '' .
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-09. Query text: ALTER TABLE `#__categories` MODIFY `metakey` varchar(1024) NOT NULL DEFAULT '' C.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-09. Query text: ALTER TABLE `#__categories` MODIFY `metadata` varchar(2048) NOT NULL DEFAULT '' .
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-09. Query text: ALTER TABLE `#__categories` MODIFY `language` char(7) NOT NULL DEFAULT '';.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-15. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-17. Query text: UPDATE `#__menu`    SET `menutype` = 'main_is_reserved_133C585'  WHERE `client_i.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-17. Query text: UPDATE `#__modules`    SET `params` = REPLACE(`params`,'"menutype":"main"','"men.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-17. Query text: UPDATE `#__menu_types`    SET `menutype` = 'main_is_reserved_133C585'  WHERE `cl.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-17. Query text: UPDATE `#__menu`    SET `client_id` = 1  WHERE `menutype` = 'main';.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-17. Query text: UPDATE `#__menu`    SET `menutype` = 'main'  WHERE `client_id` = 1     AND `menu.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-17. Query text: UPDATE `#__menu`    SET `menutype` = 'main',        `client_id` = 1  WHERE `menu.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-17. Query text: DELETE FROM `#__menu_types`  WHERE `client_id` = 1    AND `menutype` IN ('main',.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-01-31. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-02-02. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-02-15. Query text: ALTER TABLE `#__redirect_links` MODIFY `comment` varchar(255) NOT NULL DEFAULT '.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-02-17. Query text: ALTER TABLE `#__contact_details` MODIFY `name` varchar(255) NOT NULL;.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-02-17. Query text: ALTER TABLE `#__contact_details` MODIFY `alias` varchar(400) CHARACTER SET utf8m.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-02-17. Query text: ALTER TABLE `#__contact_details` MODIFY `sortname1` varchar(255) NOT NULL DEFAUL.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-02-17. Query text: ALTER TABLE `#__contact_details` MODIFY `sortname2` varchar(255) NOT NULL DEFAUL.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-02-17. Query text: ALTER TABLE `#__contact_details` MODIFY `sortname3` varchar(255) NOT NULL DEFAUL.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-02-17. Query text: ALTER TABLE `#__contact_details` MODIFY `language` varchar(7) NOT NULL;.
2017-09-12T15:39:43+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-02-17. Query text: ALTER TABLE `#__contact_details` MODIFY `xreference` varchar(50) NOT NULL DEFAUL.
2017-09-12T15:39:44+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-03-03. Query text: ALTER TABLE `#__languages` MODIFY `asset_id` int(10) unsigned NOT NULL DEFAULT 0.
2017-09-12T15:39:44+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-03-03. Query text: ALTER TABLE `#__menu_types` MODIFY `asset_id` int(10) unsigned NOT NULL DEFAULT .
2017-09-12T15:39:44+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-03-03. Query text: ALTER TABLE  `#__content` MODIFY `xreference` varchar(50) NOT NULL DEFAULT '';.
2017-09-12T15:39:44+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-03-03. Query text: ALTER TABLE  `#__newsfeeds` MODIFY `xreference` varchar(50) NOT NULL DEFAULT '';.
2017-09-12T15:39:44+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-03-09. Query text: UPDATE `#__categories` SET `published` = 1 WHERE `alias` = 'root';.
2017-09-12T15:39:44+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-03-09. Query text: UPDATE `#__categories` AS `c` INNER JOIN ( 	SELECT c2.id, CASE WHEN MIN(p.publis.
2017-09-12T15:39:44+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-03-09. Query text: UPDATE `#__menu` SET `published` = 1 WHERE `alias` = 'root';.
2017-09-12T15:39:44+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-03-09. Query text: UPDATE `#__menu` AS `c` INNER JOIN ( 	SELECT c2.id, CASE WHEN MIN(p.published) >.
2017-09-12T15:39:44+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-03-19. Query text: ALTER TABLE `#__finder_links` MODIFY `description` text;.
2017-09-12T15:39:44+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-04-10. Query text: INSERT INTO `#__postinstall_messages` (`extension_id`, `title_key`, `description.
2017-09-12T15:39:44+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.0-2017-04-19. Query text: UPDATE `#__extensions` SET `params` = '{"multiple":"0","first":"1","last":"100",.
2017-09-12T15:39:44+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.3-2017-06-03. Query text: ALTER TABLE `#__menu` MODIFY `checked_out_time` datetime NOT NULL DEFAULT '0000-.
2017-09-12T15:39:44+00:00	INFO 71.174.216.3	update	Ran query from file 3.7.4-2017-07-05. Query text: DELETE FROM `#__postinstall_messages` WHERE `title_key` = 'COM_CPANEL_MSG_PHPVER.
2017-09-12T15:39:44+00:00	INFO 71.174.216.3	update	Deleting removed files and folders.
2017-09-12T15:39:46+00:00	INFO 71.174.216.3	update	Cleaning up after installation.
2017-09-12T15:39:46+00:00	INFO 71.174.216.3	update	Update to version 3.7.5 is complete.
2017-09-22T22:10:33+00:00	INFO 100.0.42.14	update	Update started by user Dom Cassone (262). Old version is 3.7.5.
2017-09-22T22:10:34+00:00	INFO 100.0.42.14	update	Downloading update file from https://s3-us-west-2.amazonaws.com/joomla-official-downloads/joomladownloads/joomla3/Joomla_3.8.0-Stable-Update_Package.zip?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIZ6S3Q3YQHG57ZRA%2F20170922%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20170922T221101Z&X-Amz-Expires=60&X-Amz-SignedHeaders=host&X-Amz-Signature=32368c3c31f5b7bafeea269acdd6aaab9c98b3e5258e5c6b58632f4ebf894011.
2017-09-22T22:10:36+00:00	INFO 100.0.42.14	update	File Joomla_3.8.0-Stable-Update_Package.zip downloaded.
2017-09-22T22:10:36+00:00	INFO 100.0.42.14	update	Starting installation of new version.
2017-09-22T22:10:38+00:00	INFO 100.0.42.14	update	Finalising installation.
2017-09-22T22:10:38+00:00	INFO 100.0.42.14	update	Ran query from file 3.8.0-2017-07-28. Query text: ALTER TABLE `#__fields_groups` ADD COLUMN `params` TEXT  NOT NULL  AFTER `orderi.
2017-09-22T22:10:38+00:00	INFO 100.0.42.14	update	Ran query from file 3.8.0-2017-07-31. Query text: INSERT INTO `#__extensions` (`extension_id`, `package_id`, `name`, `type`, `elem.
2017-09-22T22:10:38+00:00	INFO 100.0.42.14	update	Deleting removed files and folders.
2017-09-22T22:10:39+00:00	INFO 100.0.42.14	update	Cleaning up after installation.
2017-09-22T22:10:39+00:00	INFO 100.0.42.14	update	Update to version 3.8.0 is complete.
2017-10-06T14:35:00+00:00	INFO 100.0.42.14	update	Update started by user Dom Cassone (262). Old version is 3.8.0.
2017-10-06T14:35:01+00:00	INFO 100.0.42.14	update	Downloading update file from https://s3-us-west-2.amazonaws.com/joomla-official-downloads/joomladownloads/joomla3/Joomla_3.8.1-Stable-Update_Package.zip?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIZ6S3Q3YQHG57ZRA%2F20171006%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20171006T143531Z&X-Amz-Expires=60&X-Amz-SignedHeaders=host&X-Amz-Signature=7948ef2918f1b2f42c67151988aea4b521d515f6f353841aceb02260b1c2e10b.
2017-10-06T14:35:02+00:00	INFO 100.0.42.14	update	File Joomla_3.8.1-Stable-Update_Package.zip downloaded.
2017-10-06T14:35:02+00:00	INFO 100.0.42.14	update	Starting installation of new version.
2017-10-06T14:35:08+00:00	INFO 100.0.42.14	update	Finalising installation.
2017-10-06T14:35:08+00:00	INFO 100.0.42.14	update	Deleting removed files and folders.
2017-10-06T14:35:09+00:00	INFO 100.0.42.14	update	Cleaning up after installation.
2017-10-06T14:35:09+00:00	INFO 100.0.42.14	update	Update to version 3.8.1 is complete.
2017-11-08T19:33:22+00:00	INFO 100.0.42.241	update	Update started by user Dom Cassone (262). Old version is 3.8.1.
2017-11-08T19:33:23+00:00	INFO 100.0.42.241	update	Downloading update file from https://s3-us-west-2.amazonaws.com/joomla-official-downloads/joomladownloads/joomla3/Joomla_3.8.2-Stable-Update_Package.zip?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIZ6S3Q3YQHG57ZRA%2F20171108%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20171108T193351Z&X-Amz-Expires=60&X-Amz-SignedHeaders=host&X-Amz-Signature=7e23b56f8b0e18beb3a11e30895084698998cfdd0f8789ac55110dc0831739fd.
2017-11-08T19:33:25+00:00	INFO 100.0.42.241	update	File Joomla_3.8.2-Stable-Update_Package.zip downloaded.
2017-11-08T19:35:15+00:00	INFO 100.0.42.241	update	Starting installation of new version.
2017-11-08T19:35:28+00:00	INFO 100.0.42.241	update	Finalising installation.
2017-11-08T19:35:28+00:00	INFO 100.0.42.241	update	Ran query from file 3.8.2-2017-10-14. Query text: ALTER TABLE `#__content` ADD INDEX `idx_alias` (`alias`(191));.
2017-11-08T19:35:28+00:00	INFO 100.0.42.241	update	Deleting removed files and folders.
2017-11-08T19:35:31+00:00	INFO 100.0.42.241	update	Cleaning up after installation.
2017-11-08T19:35:31+00:00	INFO 100.0.42.241	update	Update to version 3.8.2 is complete.
2017-12-27T21:18:59+00:00	INFO 100.0.42.241	update	Update started by user Dom Cassone (262). Old version is 3.8.2.
2017-12-27T21:19:00+00:00	INFO 100.0.42.241	update	Downloading update file from https://s3-us-west-2.amazonaws.com/joomla-official-downloads/joomladownloads/joomla3/Joomla_3.8.3-Stable-Update_Package.zip?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIZ6S3Q3YQHG57ZRA%2F20171227%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20171227T211914Z&X-Amz-Expires=60&X-Amz-SignedHeaders=host&X-Amz-Signature=1409287448674e95e5f3da384f0adb7b7a2a86718e68a3654ed4ad6e746423b9.
2017-12-27T21:19:01+00:00	INFO 100.0.42.241	update	File Joomla_3.8.3-Stable-Update_Package.zip downloaded.
2017-12-27T21:21:12+00:00	INFO 100.0.42.241	update	Starting installation of new version.
2017-12-27T21:21:16+00:00	INFO 100.0.42.241	update	Finalising installation.
2017-12-27T21:21:16+00:00	INFO 100.0.42.241	update	Deleting removed files and folders.
2017-12-27T21:21:18+00:00	INFO 100.0.42.241	update	Cleaning up after installation.
2017-12-27T21:21:18+00:00	INFO 100.0.42.241	update	Update to version 3.8.3 is complete.
