CREATE TABLE `fs_faq_field` (
  `faqid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  UNIQUE KEY `qaid` (`faqid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC