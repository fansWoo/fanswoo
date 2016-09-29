CREATE TABLE `fs_shop_gift` (
  `giftid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) NOT NULL,
  `name` char(100) NOT NULL,
  `synopsis` char(200) NOT NULL,
  `picids` char(100) NOT NULL,
  `prioritynum` mediumint(8) NOT NULL,
  `updatetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `giftid` (`giftid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8