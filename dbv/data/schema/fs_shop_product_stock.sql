CREATE TABLE `fs_shop_product_stock` (
  `stockid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `stocknum` mediumint(8) NOT NULL,
  `color_rgb` char(6) NOT NULL,
  `status` int(1) NOT NULL,
  `productid` mediumint(8) NOT NULL,
  `classname1` char(100) NOT NULL,
  `classname2` char(100) NOT NULL,
  `prioritynum` mediumint(8) NOT NULL,
  UNIQUE KEY `stockid` (`stockid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8