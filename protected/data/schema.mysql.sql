-- DROP USER 'questionnaire'@'localhost';
-- CREATE USER 'questionnaire'@'localhost' IDENTIFIED BY 'fun++';
Drop database if exists uniter_test;
CREATE DATABASE uniter_test DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
GRANT ALL PRIVILEGES ON uniter_test.* to 'tu_admin' WITH GRANT OPTION;
USE uniter_test;

CREATE TABLE `que_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
`username` varchar(255) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `que_profile` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

ALTER TABLE `que_profile`
  ADD CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `que_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE `que_profile_field` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` varchar(15) NOT NULL DEFAULT '0',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `que_question_sort` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_code` varchar(255) not null,
  `child_code` varchar(255) not null,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `que_question_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort_code` varchar(150) not null default "", 
  -- `sort_name` varchar(150) not null default "", 
 `tool` varchar(1000) not null default "",
  `author` varchar(150) not null default "",
  `year` int(5),
  `concept` varchar(150) not null default "",
  `content` varchar(528),
  `scale` int not null default 1,
  `answer`  varchar(500) not null default "",
  `times_added` int not null default 0,
  `times_modified` int not null default 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


CREATE TABLE `que_questionnaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name`varchar(150) not null,
  `status` int not null default 0,
  `parent_id` int,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;
ALTER TABLE `que_questionnaire`
  ADD CONSTRAINT `questionnaire_parent_id` FOREIGN KEY (`parent_id`) REFERENCES `que_questionnaire` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE `que_user_question` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `parent_id` int,
    `questionnaire_id` int not null,
    `content` varchar(528),
    `scale` int,
    `answer`  varchar(500),
    `order` int not null default 1,
    `status` int not null default 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
ALTER TABLE `que_user_question`
  ADD CONSTRAINT `user_question_parent_id` FOREIGN KEY (`parent_id`) REFERENCES `que_question_bank` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `que_user_question`
  ADD CONSTRAINT `user_question_questionnaire_id` FOREIGN KEY (`questionnaire_id`) REFERENCES `que_questionnaire` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE `que_questionnaire_question_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
    `bank_questionnaire_id` int not null,
    `question_id` int not null,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;
ALTER TABLE `que_questionnaire_question_bank`
  ADD CONSTRAINT `questionnaire_question_bank_questionnaire_id` FOREIGN KEY (`bank_questionnaire_id`) REFERENCES `que_questionnaire` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `que_questionnaire_question_bank`
  ADD CONSTRAINT `questionnaire_question_bank_question_id` FOREIGN KEY (`question_id`) REFERENCES `que_question_bank` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE `que_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) not null,
  `description` varchar(500) not null default '',
  `status` int not null default 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  ;


CREATE TABLE `que_project_questionnaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int NOT NULL,
  `user_questionnaire_id` int not null,
  `order` int not null default 1,
  `status` int not null default 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  ;

ALTER TABLE `que_project_questionnaire`
  ADD CONSTRAINT `project_questionnaire_project_id` FOREIGN KEY (`project_id`) REFERENCES `que_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `que_project_questionnaire`
  ADD CONSTRAINT `project_questionnaire_user_questionnaire_id` FOREIGN KEY (`user_questionnaire_id`) REFERENCES `que_questionnaire` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


CREATE TABLE `que_user_project` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`user_id`int not null,
	`project_id`int not null,
        `privilege_type` int not null default 0,
        `order` int not null default 1,
        `status` int not null default 0,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `que_user_project`
  ADD CONSTRAINT `user_project_user_id` FOREIGN KEY (`user_id`) REFERENCES `que_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `que_user_project`
  ADD CONSTRAINT `user_project_project_id` FOREIGN KEY (`project_id`) REFERENCES `que_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;



INSERT INTO `que_user` (`id`, `username`, `password`, `email`, `activkey`, `superuser`, `status`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'admin@example.com', '9a24eff8c15a6a141ece27eb6947da0f', 1, 1);

INSERT INTO `que_profile` (`user_id`) VALUES
(1);

load data local infile 'sftp://mush02@Uniter-bp01.bmi.osumc.edu/home/mush02/questionnaire/protected/data/QueLoad.csv' 
into table questionnaire.que_question_bank 
    fields terminated by ','
    enclosed by '"' 
    escaped by '\\' 
    lines terminated by '\r\n';

load data local infile 'sftp://mush02@Uniter-bp01.bmi.osumc.edu/home/mush02/questionnaire/protected/data/SortCode.txt' 
    into table questionnaire.que_question_sort 
    fields terminated by '\t' 
    enclosed by '"'
    escaped by '\\' 
    lines terminated by '\r\n'
    ignore 1 LINES
   (`id`, `parent_code`, `child_code`);
