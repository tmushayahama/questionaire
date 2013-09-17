-- DROP USER 'questionnaire'@'localhost';
CREATE USER 'questionnaire'@'localhost' IDENTIFIED BY 'fun++';
Drop database if exists questionnaire;
CREATE DATABASE questionnaire DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
GRANT ALL PRIVILEGES ON questionnaire.* to 'questionnaire'@'localhost' WITH GRANT OPTION;
USE questionnaire;

CREATE TABLE `que_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
 `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
	`organization` varchar(100) NOT NULL DEFAULT '',
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE `que_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
`user_id`int not null,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
	`description` varchar(50) NOT NULL default "",
	`create_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

ALTER TABLE `que_project`
  ADD CONSTRAINT `project_user_id` FOREIGN KEY (`user_id`) REFERENCES `que_user` (`id`) ON DELETE CASCADE;

CREATE TABLE `que_questionnaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name`varchar(150) not null,
	`project_id` int not null,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;


ALTER TABLE `que_questionnaire`
  ADD CONSTRAINT `questionnaire_project_id` FOREIGN KEY (`project_id`) REFERENCES `que_project` (`id`) ON DELETE CASCADE;

CREATE TABLE `que_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(150) not null default "",
  `tool` varchar(150) not null default "",
  `author` varchar(150) not null default "",
  `year` datetime,
  `concept` varchar(150) not null default "",
  `content` varchar(150),
  `user_id`int not null default 0,
  `question_source_id` int not null default 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `que_questionnaire_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questionnaire_id` int not null,
  `question_id` int not null,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `que_questionnaire_question`
  ADD CONSTRAINT `questionnaire_project_questionnaire_id` FOREIGN KEY (`questionnaire_id`) REFERENCES `que_questionnaire` (`id`) ON DELETE CASCADE;

ALTER TABLE `que_questionnaire_question`
  ADD CONSTRAINT `questionnaire_question_question_id` FOREIGN KEY (`question_id`) REFERENCES `que_question` (`id`) ON DELETE CASCADE;

