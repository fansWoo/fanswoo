CREATE TABLE `fs_showpiece` (
  `showpieceid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) NOT NULL,
  `name` char(32) NOT NULL,
  `price` mediumint(10) NOT NULL,
  `classids` char(100) NOT NULL,
  `picids` char(100) NOT NULL,
  `synopsis` text NOT NULL,
  `content` text NOT NULL,
  `content_specification` text NOT NULL,
  `prioritynum` mediumint(8) NOT NULL,
  `updatetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `showpieceid` (`showpieceid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8