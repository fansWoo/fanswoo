CREATE TABLE `fs_user_group` (
  `groupid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `groupname` char(40) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `groupid` (`groupid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8