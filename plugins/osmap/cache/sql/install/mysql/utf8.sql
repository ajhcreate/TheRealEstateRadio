-- -----------------------------------------------------
-- Table `#__osmap_itemscache_tmp`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `#__osmap_itemscache_tmp` (
  `sitemap_id` int(11) unsigned NOT NULL,
  `ordering` int(11) unsigned NOT NULL DEFAULT '0',
  `uid` varchar(100) NOT NULL DEFAULT '',
  `settings_hash` char(32) NOT NULL DEFAULT '',
  `link` varchar(2000) NOT NULL DEFAULT '',
  `fulllink` varchar(2000) NOT NULL DEFAULT '',
  `changefreq` enum('always','hourly','daily','weekly','monthly','yearly','never') NOT NULL DEFAULT 'weekly',
  `priority` float NOT NULL DEFAULT '0.5',
  `title` varchar(255) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `duplicate` tinyint(1) NOT NULL DEFAULT '0',
  `news_item` tinyint(1) NOT NULL DEFAULT '0',
  `has_images` tinyint(1) NOT NULL DEFAULT '0',
  `menu_id` tinyint(1) NOT NULL DEFAULT '0',
  `menu_title` varchar(255) NULL DEFAULT NULL,
  `menu_type` varchar(255) NULL DEFAULT NULL,
  `level` int(5) NULL DEFAULT NULL,
  `visible_robots` tinyint(1) NOT NULL DEFAULT '1',
  `parent_visible_robots` tinyint(1) NOT NULL DEFAULT '1',
  `visible_xml` tinyint(1) NOT NULL DEFAULT '1',
  `visible_html` tinyint(1) NOT NULL DEFAULT '1',
  `is_internal` tinyint(1) NOT NULL DEFAULT '1',
  `is_menu_item` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sitemap_id`,`ordering`),
  KEY `sitemap_id_2` (`sitemap_id`,`duplicate`,`news_item`,`has_images`)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- Table `#__osmap_itemscache`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `#__osmap_itemscache` (
  `sitemap_id` int(11) unsigned NOT NULL,
  `ordering` int(11) unsigned NOT NULL DEFAULT '0',
  `uid` varchar(100) NOT NULL DEFAULT '',
  `settings_hash` char(32) NOT NULL DEFAULT '',
  `link` varchar(2000) NOT NULL DEFAULT '',
  `fulllink` varchar(2000) NOT NULL DEFAULT '',
  `changefreq` enum('always','hourly','daily','weekly','monthly','yearly','never') NOT NULL DEFAULT 'weekly',
  `priority` float NOT NULL DEFAULT '0.5',
  `title` varchar(255) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `duplicate` tinyint(1) NOT NULL DEFAULT '0',
  `news_item` tinyint(1) NOT NULL DEFAULT '0',
  `has_images` tinyint(1) NOT NULL DEFAULT '0',
  `menu_id` tinyint(1) NOT NULL DEFAULT '0',
  `menu_title` varchar(255) NULL DEFAULT NULL,
  `menu_type` varchar(255) NULL DEFAULT NULL,
  `level` int(5) NULL DEFAULT NULL,
  `visible_robots` tinyint(1) NOT NULL DEFAULT '1',
  `parent_visible_robots` tinyint(1) NOT NULL DEFAULT '1',
  `visible_xml` tinyint(1) NOT NULL DEFAULT '1',
  `visible_html` tinyint(1) NOT NULL DEFAULT '1',
  `is_internal` tinyint(1) NOT NULL DEFAULT '1',
  `is_menu_item` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sitemap_id`,`ordering`),
  KEY `sitemap_id_2` (`sitemap_id`,`duplicate`,`news_item`,`has_images`)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- Table `#__osmap_itemscacheimg_tmp`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `#__osmap_itemscacheimg_tmp` (
  `sitemap_id` int(11) unsigned NOT NULL,
  `ordering` int(11) unsigned NOT NULL DEFAULT '0',
  `index` int(11) unsigned NOT NULL DEFAULT '0',
  `src` varchar(512) NOT NULL DEFAULT '',
  `title` varchar(512) NOT NULL DEFAULT '',
  `license` varchar(512) NULL DEFAULT NULL,
  PRIMARY KEY (`sitemap_id`,`ordering`,`index`)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- Table `#__osmap_itemscacheimg`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `#__osmap_itemscacheimg` (
  `sitemap_id` int(11) unsigned NOT NULL,
  `ordering` int(11) unsigned NOT NULL DEFAULT '0',
  `index` int(11) unsigned NOT NULL DEFAULT '0',
  `src` varchar(512) NOT NULL DEFAULT '',
  `title` varchar(512) NOT NULL DEFAULT '',
  `license` varchar(512) NULL DEFAULT NULL,
  PRIMARY KEY (`sitemap_id`,`ordering`,`index`)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8;
