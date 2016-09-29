CREATE TABLE `fs_class` (
  `classid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `classname` char(40) NOT NULL,
  `slug` char(40) NOT NULL DEFAULT '',
  `content` char(200) NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `amountnum` mediumint(4) NOT NULL DEFAULT '0',
  `modelname` char(32) NOT NULL DEFAULT '',
  `classids` char(100) NOT NULL,
  `prioritynum` mediumint(8) NOT NULL,
  `updatetime` datetime NOT NULL,
  `locale` char(5) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `classid` (`classid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8