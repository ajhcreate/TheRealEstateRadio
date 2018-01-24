ALTER TABLE `#__osmap_itemscache` ADD `visible_xml` TINYINT(1)  NOT NULL  DEFAULT '1'  AFTER `visible_robots`;
ALTER TABLE `#__osmap_itemscache` ADD `visible_html` TINYINT(1)  NOT NULL  DEFAULT '1'  AFTER `visible_xml`;
ALTER TABLE `#__osmap_itemscache_tmp` ADD `visible_xml` TINYINT(1)  NOT NULL  DEFAULT '1'  AFTER `visible_robots`;
ALTER TABLE `#__osmap_itemscache_tmp` ADD `visible_html` TINYINT(1)  NOT NULL  DEFAULT '1'  AFTER `visible_xml`;
