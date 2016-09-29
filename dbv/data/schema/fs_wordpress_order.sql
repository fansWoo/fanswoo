CREATE TABLE `fs_wordpress_order` (
  `wordpress_orderid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `orderid` mediumint(8) NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `username` char(100) NOT NULL,
  `email` char(100) NOT NULL,
  `phone` char(100) NOT NULL,
  `company` char(100) NOT NULL,
  `content` text NOT NULL,
  `classtype` char(100) NOT NULL,
  `address` char(100) NOT NULL,
  `years` mediumint(2) NOT NULL,
  `price` mediumint(8) NOT NULL,
  `updatetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `orderid` (`wordpress_orderid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8