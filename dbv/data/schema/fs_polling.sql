CREATE TABLE `fs_polling` (
  `pollingid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `obj_class` char(100) NOT NULL,
  `watching_ids` char(200) NOT NULL,
  `change_ids` char(200) DEFAULT '',
  `updatetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `pollingid` (`pollingid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8