CREATE TABLE IF NOT EXISTS `#__joomfuse_cron` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'typical primary key',
  `date` datetime NOT NULL COMMENT 'The time of the cron job execution',
  `handler` varchar(255) NOT NULL COMMENT 'the classname/id of the event handler',
  `params` text NOT NULL COMMENT 'The JRegistry with the execution params',
  PRIMARY KEY (`id`),
  KEY `date` (`date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
