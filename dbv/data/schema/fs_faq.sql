CREATE TABLE `fs_faq` (
  `faqid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) NOT NULL DEFAULT '0',
  `title` char(100) NOT NULL DEFAULT '',
  `username` char(30) NOT NULL DEFAULT '',
  `picids` char(100) NOT NULL DEFAULT '',
  `classids` char(100) NOT NULL DEFAULT '',
  `modelname` char(100) NOT NULL DEFAULT '',
  `prioritynum` mediumint(8) NOT NULL DEFAULT '0',
  `updatetime` datetime NOT NULL,
  `locale` char(5) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `qaid` (`faqid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED