CREATE TABLE `fs_comment` (
  `commentid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) NOT NULL,
  `typename` char(100) NOT NULL,
  `id` mediumint(8) NOT NULL,
  `title` char(100) DEFAULT NULL,
  `content` text,
  `updatetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `commentid` (`commentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8