CREATE DATABASE IF NOT EXISTS volk_lenders; # Main database
CREATE DATABASE IF NOT EXISTS volk_lenders_test; # Testing database

USE volk_lenders;


/*
* Contains all football players registered.
*/
CREATE TABLE IF NOT EXISTS `volk_lenders`.`footballer`
(
    `id`         INT(11)      NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name`  VARCHAR(255) NOT NULL,
    `age`        INT(11)      NOT NULL,
    PRIMARY KEY (`id`)
);
CREATE TABLE IF NOT EXISTS `volk_lenders_test`.`footballer`
(
    `id`         INT(11)      NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name`  VARCHAR(255) NOT NULL,
    `age`        INT(11)      NOT NULL,
    PRIMARY KEY (`id`)
);


/*
* Contains all football teams registered.
*/
CREATE TABLE IF NOT EXISTS `volk_lenders`.`team`
(
    `id`   INT(11)      NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `city` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
);
CREATE TABLE IF NOT EXISTS `volk_lenders_test`.`team`
(
    `id`   INT(11)      NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `city` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
);


/*
* Stores a relation between football players and the teams where they have been.
*/
CREATE TABLE IF NOT EXISTS `volk_lenders`.`team_footballer`
(
    `id`            INT(11) NOT NULL AUTO_INCREMENT,
    `team_id`       INT(11) NOT NULL,
    `footballer_id` INT(11) NOT NULL,
    `date`          INT(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`team_id`) REFERENCES team (`id`),
    FOREIGN KEY (`footballer_id`) REFERENCES footballer (`id`)
);
CREATE TABLE IF NOT EXISTS `volk_lenders_test`.`team_footballer`
(
    `id`            INT(11) NOT NULL AUTO_INCREMENT,
    `team_id`       INT(11) NOT NULL,
    `footballer_id` INT(11) NOT NULL,
    `date`          INT(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`team_id`) REFERENCES team (`id`),
    FOREIGN KEY (`footballer_id`) REFERENCES footballer (`id`)
);


/*
* Stores all matches and football teams that had played on them.
*/
CREATE TABLE IF NOT EXISTS `volk_lenders`.`match`
(
    `id`              INT(11) NOT NULL AUTO_INCREMENT,
    `local_team_id`   INT(11) NOT NULL,
    `foreign_team_id` INT(11) NOT NULL,
    `date`            INT(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`local_team_id`) REFERENCES team (`id`),
    FOREIGN KEY (`foreign_team_id`) REFERENCES team (`id`)
);
CREATE TABLE IF NOT EXISTS `volk_lenders_test`.`match`
(
    `id`              INT(11) NOT NULL AUTO_INCREMENT,
    `local_team_id`   INT(11) NOT NULL,
    `foreign_team_id` INT(11) NOT NULL,
    `date`            INT(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`local_team_id`) REFERENCES team (`id`),
    FOREIGN KEY (`foreign_team_id`) REFERENCES team (`id`)
);


/*
* Stores all scored goals by footballer, team and match.
*/
CREATE TABLE IF NOT EXISTS `volk_lenders`.`goal`
(
    `id`            INT(11) NOT NULL AUTO_INCREMENT,
    `match_id`      INT(11) NOT NULL,
    `team_id`       INT(11) NOT NULL,
    `footballer_id` INT(11) NOT NULL,
    `date`          INT(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`match_id`) REFERENCES `match` (`id`),
    FOREIGN KEY (`team_id`) REFERENCES team (`id`),
    FOREIGN KEY (`footballer_id`) REFERENCES footballer (`id`)
);
CREATE TABLE IF NOT EXISTS `volk_lenders_test`.`goal`
(
    `id`            INT(11) NOT NULL AUTO_INCREMENT,
    `match_id`      INT(11) NOT NULL,
    `team_id`       INT(11) NOT NULL,
    `footballer_id` INT(11) NOT NULL,
    `date`          INT(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`match_id`) REFERENCES `match` (`id`),
    FOREIGN KEY (`team_id`) REFERENCES team (`id`),
    FOREIGN KEY (`footballer_id`) REFERENCES footballer (`id`)
);