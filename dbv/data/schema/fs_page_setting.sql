CREATE TABLE `fs_page_setting` (
  `page_settingid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) NOT NULL,
  `title` char(100) NOT NULL,
  `tag` char(100) NOT NULL,
  `href` char(200) NOT NULL,
  `global_status` int(1) NOT NULL,
  `metatag` text NOT NULL,
  `script_plugin` text NOT NULL,
  `synopsis` char(200) NOT NULL,
  `view` mediumint(8) NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `adtagid` (`page_settingid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8