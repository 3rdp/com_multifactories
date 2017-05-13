CREATE TABLE IF NOT EXISTS `#__multifactories_crudfactories` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(250) NOT NULL DEFAULT '',
	`alias` varchar(255) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__multifactories_city` (
  `subdomain_name` varchar(255) NOT NULL DEFAULT '',
  `factory_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`subdomain_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
