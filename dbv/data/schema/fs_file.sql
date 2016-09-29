CREATE TABLE `fs_file` (
  `fileid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) NOT NULL,
  `title` char(100) CHARACTER SET utf8 NOT NULL,
  `filename` char(100) CHARACTER SET utf8 NOT NULL,
  `size` mediumint(8) NOT NULL,
  `type` char(32) CHARACTER SET utf8 NOT NULL,
  `md5` char(16) CHARACTER SET utf8 NOT NULL,
  `classids` char(100) CHARACTER SET utf8 NOT NULL,
  `permission_uids` char(100) NOT NULL,
  `thumb` char(100) CHARACTER SET utf8 NOT NULL,
  `prioritynum` mediumint(8) NOT NULL,
  `updatetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`fileid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1