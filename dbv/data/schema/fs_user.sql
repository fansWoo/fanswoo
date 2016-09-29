CREATE TABLE `fs_user` (
  `uid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `emailabc` int(10) unsigned NOT NULL,
  `username` char(32) NOT NULL,
  `picids` char(100) NOT NULL,
  `groupids` char(100) NOT NULL,
  `updatetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8