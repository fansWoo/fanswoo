CREATE TABLE `fs_setting` (
  `settingid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `keyword` char(200) NOT NULL,
  `value` text NOT NULL,
  `modelname` char(32) NOT NULL DEFAULT '',
  `locale` char(5) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `settingid` (`settingid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8