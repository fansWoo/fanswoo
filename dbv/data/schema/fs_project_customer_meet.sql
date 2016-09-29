CREATE TABLE `fs_project_customer_meet` (
  `visitid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `customerids` mediumint(8) NOT NULL,
  `visit_class` char(100) NOT NULL,
  `visit_time` datetime NOT NULL,
  `content` text NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`visitid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8