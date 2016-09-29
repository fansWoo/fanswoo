CREATE TABLE `fs_project_worktask` (
  `worktaskid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `projectid` mediumint(8) NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `title` char(100) NOT NULL,
  `content` text NOT NULL,
  `classids` char(100) NOT NULL,
  `current_percent` mediumint(4) NOT NULL,
  `estimate_hour` mediumint(4) NOT NULL,
  `use_hour` mediumint(4) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `prioritynum` mediumint(8) NOT NULL,
  `work_status` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `worktaskid` (`worktaskid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8