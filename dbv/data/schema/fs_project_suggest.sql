CREATE TABLE `fs_project_suggest` (
  `suggestid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `projectid` mediumint(8) NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `title` char(50) NOT NULL,
  `content` char(200) NOT NULL,
  `answer` char(200) NOT NULL,
  `suggest_time` datetime NOT NULL,
  `updatetime` datetime NOT NULL,
  `suggest_status` int(1) NOT NULL,
  `answer_status` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `suggestid` (`suggestid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8