-- DROP USER 'questionaire'@'localhost';
-- CREATE USER 'questionaire'@'localhost' IDENTIFIED BY '';
CREATE DATABASE questionaire DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
-- GRANT ALL PRIVILEGES ON questionaire.* to 'questionaire'@'localhost' WITH GRANT OPTION;
USE questionaire;

CREATE TABLE `que_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
	`lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
	`organisation` varchar(100) NOT NULL DEFAULT '',
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `create_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

CREATE TABLE `que_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
	`description` varchar(50) NOT NULL default "",
	`create_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;
