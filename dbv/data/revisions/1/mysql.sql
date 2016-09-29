ALTER TABLE `fs_user`
	ADD `emailabc` int(10) unsigned NOT NULL AFTER `uid`,
	DROP `email`;	
