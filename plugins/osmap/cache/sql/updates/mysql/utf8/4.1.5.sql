ALTER TABLE `#__osmap_itemscache_tmp` CHANGE `url_hash` `settings_hash` CHAR(32)  CHARACTER SET utf8  COLLATE utf8_general_ci  NOT NULL  DEFAULT '';
ALTER TABLE `#__osmap_itemscache` CHANGE `url_hash` `settings_hash` CHAR(32)  CHARACTER SET utf8  COLLATE utf8_general_ci  NOT NULL  DEFAULT '';
