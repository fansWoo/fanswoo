CREATE TABLE `fs_shop_order_allpay_field` (
  `orderid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `tradeno` char(100) NOT NULL,
  `pay_type` char(32) NOT NULL,
  `credit_amount` mediumint(2) NOT NULL,
  `bank_code` char(3) NOT NULL,
  `virtual_account` char(16) NOT NULL,
  `pay_expire_date` char(10) NOT NULL,
  `paytime` datetime NOT NULL,
  `fail_code` mediumint(8) NOT NULL,
  `fail_msg` char(200) NOT NULL,
  UNIQUE KEY `orderid` (`orderid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8