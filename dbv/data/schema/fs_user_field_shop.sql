CREATE TABLE `fs_user_field_shop` (
  `uid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `receive_name` char(100) DEFAULT '',
  `receive_phone` char(100) NOT NULL DEFAULT '',
  `receive_address` char(100) NOT NULL DEFAULT '',
  `coupon_count` mediumint(8) NOT NULL,
  UNIQUE KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8