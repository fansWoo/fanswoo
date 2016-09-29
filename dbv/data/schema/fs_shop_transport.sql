CREATE TABLE `fs_shop_transport` (
  `transportid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) NOT NULL,
  `name` char(100) NOT NULL,
  `company` char(100) NOT NULL,
  `url` text NOT NULL,
  `base_price` mediumint(10) NOT NULL,
  `additional_price` mediumint(10) NOT NULL,
  `prioritynum` mediumint(8) NOT NULL,
  `updatetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `transportid` (`transportid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8