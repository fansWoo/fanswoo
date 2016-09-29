CREATE TABLE `fs_note` (
  `noteid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) NOT NULL DEFAULT '0',
  `title` char(50) NOT NULL DEFAULT '',
  `username` char(30) DEFAULT '',
  `slug` char(100) DEFAULT NULL,
  `href` char(100) DEFAULT NULL,
  `picids` char(100) DEFAULT '',
  `classids` char(100) DEFAULT '',
  `modelname` char(100) DEFAULT '',
  `viewnum` mediumint(8) DEFAULT '0',
  `replynum` mediumint(8) DEFAULT '0',
  `prioritynum` mediumint(8) DEFAULT '0',
  `updatetime` datetime DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  `shelves_status` int(1) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `noteid` (`noteid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8