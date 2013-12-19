
INSERT INTO `que_user` (`id`, `username`, `password`, `email`, `activkey`, `superuser`, `status`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'admin@example.com', '9a24eff8c15a6a141ece27eb6947da0f', 1, 1);

INSERT INTO `que_profile` (`user_id`) VALUES
(1);

load data local infile 'C:/xampp/htdocs/questionnaire/protected/data/QueLoad.csv' into table questionnaire.que_question_bank fields terminated by ',' enclosed by '"' lines terminated by '\n';
