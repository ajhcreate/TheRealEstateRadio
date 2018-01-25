SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `#__joomfuse_users`
--

CREATE TABLE IF NOT EXISTS `#__joomfuse_users` (
  `id` int(11) NOT NULL COMMENT 'The Joomla user id',
  `ifs_id` int(11) NOT NULL COMMENT 'The Infusionsoft contact id',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'The last time this record was updated',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ifs_id` (`ifs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Holds data related to the IFSUser object';

--
-- Constraints for table `#__joomfuse_users`
--
ALTER IGNORE TABLE `#__joomfuse_users`
  ADD CONSTRAINT  `#__joomfuse_users_ibfk_1` FOREIGN KEY (`id`) REFERENCES `#__users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE IF NOT EXISTS `#__joomfuse_cron` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'typical primary key',
  `date` datetime NOT NULL COMMENT 'The time of the cron job execution',
  `handler` varchar(255) NOT NULL COMMENT 'the classname/id of the event handler',
  `params` text NOT NULL COMMENT 'The JRegistry with the execution params',
  PRIMARY KEY (`id`),
  KEY `date` (`date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
