CREATE TABLE `fs_project_customer` (
  `customerid` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT',
  `uid` mediumint(8) NOT NULL,
  `customer_name` char(100) NOT NULL,
  `company` char(100) NOT NULL,
  `phone` char(100) NOT NULL,
  `tel` char(100) NOT NULL,
  `email` char(100) NOT NULL,
  `address` char(100) NOT NULL,
  `budget_range` char(100) NOT NULL,
  `wish` char(5) NOT NULL,
  `content` text NOT NULL,
  `contact_time` datetime NOT NULL,
  `website` text NOT NULL,
  `status` int(1) NOT NULL,
  `prioritynum` mediumint(8) DEFAULT '0',
  `updatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`customerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8