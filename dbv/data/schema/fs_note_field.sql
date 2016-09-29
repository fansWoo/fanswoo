CREATE TABLE `fs_note_field` (
  `noteid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  UNIQUE KEY `noteid` (`noteid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8