-- Exported from QuickDBD: https://www.quickdatabasediagrams.com/
-- Link to schema: https://app.quickdatabasediagrams.com/#/d/sEhIFP
-- NOTE! If you have used non-SQL datatypes in your design, you will have to change these here.


CREATE TABLE `student` (
    `id` INT AUTO_INCREMENT NOT NULL ,
    `session_id` INT  NOT NULL ,
    `firstname` varchar(50)  NOT NULL ,
    `lastname` varchar(50)  NOT NULL ,
    `gender_id` INT  NOT NULL ,
    `age` INT  NOT NULL ,
    PRIMARY KEY (
        `id`
    )
);

CREATE TABLE `skill` (
    `id` INT AUTO_INCREMENT NOT NULL ,
    `name` varchar(50)  NOT NULL ,
    PRIMARY KEY (
        `id`
    )
);

CREATE TABLE `has_skill` (
    `student_id` INT  NOT NULL ,
    `skill_id` INT  NOT NULL 
);

CREATE TABLE `gender` (
    `id` INT AUTO_INCREMENT NOT NULL ,
    `name` varchar(10)  NOT NULL ,
    PRIMARY KEY (
        `id`
    )
);

CREATE TABLE `session` (
    `id` INT AUTO_INCREMENT NOT NULL ,
    `name` varchar(25)  NOT NULL ,
    PRIMARY KEY (
        `id`
    )
);

ALTER TABLE `student` ADD CONSTRAINT `fk_student_session_id` FOREIGN KEY(`session_id`)
REFERENCES `session` (`id`);

ALTER TABLE `student` ADD CONSTRAINT `fk_student_gender_id` FOREIGN KEY(`gender_id`)
REFERENCES `gender` (`id`);

ALTER TABLE `has_skill` ADD CONSTRAINT `fk_has_skill_student_id` FOREIGN KEY(`student_id`)
REFERENCES `student` (`id`);

ALTER TABLE `has_skill` ADD CONSTRAINT `fk_has_skill_skill_id` FOREIGN KEY(`skill_id`)
REFERENCES `skill` (`id`);

INSERT INTO gender (name)
VALUES ('Masculin'), ('Féminin'), ('Autre');

INSERT INTO session (name) VALUES ('2022-04-PHP');

INSERT INTO skill (name)
VALUES ('C'), ('C++'), ('PHP'), ('Java'), ('Javascript'), ('MySQL');

INSERT INTO student (session_id, firstname, lastname, gender_id, age)
VALUES (1, 'Jean-Paul', 'Dubonnet', 1, 16),
(1, 'Nathanaël', 'Joguet', 1, 44),
(1, 'Georges', 'Battier', 1, 16),
(1, 'Benoît', 'Allaire', 1, 22),
(1, 'Fabien', 'Gouin', 1, 28),
(1, 'Arnaud', 'Robiquet', 1, 75),
(1, 'Élisée', 'Haillet', 1, 16),
(1, 'Hugues', 'Brosseau', 1, 50),
(1, 'Augustin', 'Bureau', 1, 30),
(1, 'Théo', 'Barbeau', 1, 28),
(1, 'Jacques', 'Duclos', 1, 35),
(1, 'Danièle', 'Longchambon', 2, 32),
(1, 'Marlène', 'Lahaye', 2, 46),
(1, 'Godeliève', 'Dufyon', 2, 24),
(1, 'Suzanne', 'Sharpe', 2, 52),
(1, 'Adélie', 'Cuvillier', 2, 26),
(1, 'Aline', 'Bardin', 2, 23),
(1, 'Gilberte', 'Bullion', 2, 16),
(1, 'Lorraine', 'Bourgeois', 2, 25),
(1, 'Karine', 'Houdin', 2, 40),
(1, 'Dominique', 'Blaise', 2, 18),
(1, 'Bruno', 'Arceneaux', 3, 54),
(1, 'Guillaume', 'Lemoine', 1, 45),
(1, 'Denis', 'Grandis', 1, 28),
(1, 'Davy', 'Duval', 1, 32);

INSERT INTO has_skill (student_id, skill_id)
VALUES (1, 1),(1, 2),(1, 3),(2, 1),(2, 2),(3, 1),(3, 2),(4, 1),(5, 1),(5, 2),(5, 3),(6, 1),(7, 1),(7, 2),(7, 3),(7, 4),(7, 5),(8, 1),(8, 2),(8, 3),(9, 1),(9, 2),(10, 1),(10, 2),(10, 3),(11, 1),(11, 2),(12, 1),(12, 2),(12, 3),(12, 4),(13, 1),(13, 2),(13, 3),(14, 1),(14, 2),(14, 3),(15, 1),(15, 2),(15, 3),(15, 4),(15, 5),(16, 1),(16, 2),(17, 1),(18, 1),(18, 2),(18, 3),(19, 1),(19, 2),(19, 3),(19, 4),(20, 1),(20, 2),(21, 1),(21, 2),(21, 3),(21, 4),(22, 1),(23, 1),(23, 2),(23, 3),(23, 4),(24, 1),(25, 1),(25, 2),(25, 3);

