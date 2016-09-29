CREATE TABLE `fs_contact` (
  `contactid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `username` char(100) NOT NULL,
  `email` char(100) NOT NULL,
  `phone` char(100) NOT NULL,
  `company` char(100) NOT NULL,
  `content` text NOT NULL,
  `status_process` int(11) NOT NULL,
  `classtype` char(100) NOT NULL,
  `classtype2` char(100) NOT NULL,
  `address` char(100) NOT NULL,
  `budget_range` char(100) NOT NULL,
  `updatetime` datetime NOT NULL,
  `locale` char(5) NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `contactid` (`contactid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8