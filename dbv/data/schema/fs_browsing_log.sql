CREATE TABLE `fs_browsing_log` (
  `browsing_logid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) DEFAULT NULL,
  `real_ip` char(15) DEFAULT NULL,
  `proxy_ip` char(15) DEFAULT NULL,
  `mac_addr` char(20) DEFAULT NULL,
  `url` char(100) DEFAULT NULL,
  `get_message` char(200) DEFAULT NULL,
  `post_message` char(200) DEFAULT NULL,
  `header_message` char(200) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `browsing_logid` (`browsing_logid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4