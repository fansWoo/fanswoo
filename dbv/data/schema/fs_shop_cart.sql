CREATE TABLE `fs_shop_cart` (
  `cartid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `orderid` mediumint(8) NOT NULL,
  `productid` mediumint(8) NOT NULL,
  `stockid` mediumint(8) NOT NULL,
  `price` mediumint(8) NOT NULL,
  `amount` mediumint(8) NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `sessionid` text NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `cartid` (`cartid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8