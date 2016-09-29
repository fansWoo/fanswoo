CREATE TABLE `fs_user_verification` (
  `uid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `email` char(32) NOT NULL,
  `password` char(32) NOT NULL,
  `password_salt` char(6) NOT NULL,
  `password_key` char(32) NOT NULL,
  `change_email_key` char(6) NOT NULL,
  `change_email_updatetime` datetime NOT NULL,
  `facebookid` mediumint(12) NOT NULL,
  `googleid` mediumint(12) NOT NULL,
  UNIQUE KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8