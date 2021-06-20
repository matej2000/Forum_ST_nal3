-- MySQL Script generated by MySQL Workbench
-- pet 18 jun 2021 23:32:46 CEST
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema forum2.0
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `forum2.0` ;

-- -----------------------------------------------------
-- Schema forum2.0
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `forum2.0` ;
USE `forum2.0` ;

-- -----------------------------------------------------
-- Table `forum2.0`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forum2.0`.`user` ;

CREATE TABLE IF NOT EXISTS `forum2.0`.`user` (
  `username` VARCHAR(20) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `birthday` TIMESTAMP NOT NULL,
  `iduser` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`iduser`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `forum2.0`.`category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forum2.0`.`category` ;

CREATE TABLE IF NOT EXISTS `forum2.0`.`category` (
  `idcategory` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idcategory`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `forum2.0`.`post`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forum2.0`.`post` ;

CREATE TABLE IF NOT EXISTS `forum2.0`.`post` (
  `idpost` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `content` TEXT NOT NULL,
  `edited` TINYINT NOT NULL DEFAULT 0,
  `likes` INT NOT NULL DEFAULT 0,
  `user_iduser` INT NOT NULL,
  `category_idcategory` INT NOT NULL,
  `post_idpost` INT NULL,
  `time` TIMESTAMP NOT NULL,
  `removed` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`idpost`),
  INDEX `fk_post_user_idx` (`user_iduser` ASC) VISIBLE,
  INDEX `fk_post_category1_idx` (`category_idcategory` ASC) VISIBLE,
  INDEX `fk_post_post1_idx` (`post_idpost` ASC) VISIBLE,
  CONSTRAINT `fk_post_user`
    FOREIGN KEY (`user_iduser`)
    REFERENCES `forum2.0`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_post_category1`
    FOREIGN KEY (`category_idcategory`)
    REFERENCES `forum2.0`.`category` (`idcategory`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_post_post1`
    FOREIGN KEY (`post_idpost`)
    REFERENCES `forum2.0`.`post` (`idpost`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `forum2.0`.`likes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forum2.0`.`likes` ;

CREATE TABLE IF NOT EXISTS `forum2.0`.`likes` (
  `idlikes` INT NOT NULL AUTO_INCREMENT,
  `user_iduser` INT NOT NULL,
  `post_idpost` INT NOT NULL,
  PRIMARY KEY (`idlikes`),
  INDEX `fk_likes_user1_idx` (`user_iduser` ASC) VISIBLE,
  INDEX `fk_like_post1_idx` (`post_idpost` ASC) VISIBLE,
  CONSTRAINT `fk_likes_user1`
    FOREIGN KEY (`user_iduser`)
    REFERENCES `forum2.0`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_like_post1`
    FOREIGN KEY (`post_idpost`)
    REFERENCES `forum2.0`.`post` (`idpost`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


insert into user (username, email, password, create_time, birthday) VALUES ("admin", "admin@gmail.com", "$2y$10$Em7XqNJ1zIq/eKMLo6WdWO7ipPuu05YTd/zUNhHjHj/ucAep3uO9O", CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
insert into user (username, email, password, create_time, birthday)  VALUES ("admin2", "admin2@gmail.com", "$2y$10$Em7XqNJ1zIq/eKMLo6WdWO7ipPuu05YTd/zUNhHjHj/ucAep3uO9O", CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

insert into user (username, email, password, create_time, birthday) VALUES ("user1", "user1@gmail.com", "$2y$10$Em7XqNJ1zIq/eKMLo6WdWO7ipPuu05YTd/zUNhHjHj/ucAep3uO9O", CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
insert into user (username, email, password, create_time, birthday) VALUES ("user2", "user2@gmail.com", "$2y$10$Em7XqNJ1zIq/eKMLo6WdWO7ipPuu05YTd/zUNhHjHj/ucAep3uO9O", CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
insert into category (name, description) VALUES ("Test", "Test pb");
insert into category (name, description) VALUES ("General", "Genaral");
insert into category (name, description) VALUES ("PHP", "Ask questions about php.");
insert into category (name, description) VALUES ("Javascript", "Ask questions about Javascript.");
insert into category (name, description) VALUES ("Lorem ipsum", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. In id dui porttitor, placerat risus iaculis, finibus nisl. Donec posuere pharetra magna. Sed ut ex volutpat.");

insert into post (category_idcategory, user_iduser, title, content, time, edited, likes) values (1,1,"Prva objava", "Forum dela! Podajte vprešanja.", CURRENT_TIMESTAMP, 0, 0);
insert into post (category_idcategory, post_idpost, user_iduser, title, content, time, edited, likes) values (1,1,2,"Prvi komentar", "Dodan, komentar", CURRENT_TIMESTAMP, 0, 0);

insert into post (category_idcategory, user_iduser, title, content, time, edited, likes) values (5,2,"Lorem ipsum2", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed maximus dolor. Nullam id magna ut odio mattis congue id ac justo. Donec sit amet enim nec mauris commodo tincidunt. Cras erat risus, condimentum nec pretium quis, auctor vitae nisi. Nulla est dui, hendrerit ac tortor ut, finibus malesuada nisl. Etiam quis orci at ante sagittis lacinia vel dictum nunc. Phasellus nec sodales neque. Suspendisse quis scelerisque quam, vel tempor est. Duis justo lorem, iaculis eget massa id, dignissim fringilla elit. Nullam laoreet velit cursus consectetur porta. Nullam nec odio sed ex imperdiet semper sit amet vitae risus. Curabitur posuere viverra ultricies..", CURRENT_TIMESTAMP, 0, 0);
insert into post (category_idcategory, post_idpost, user_iduser, title, content, time, edited, likes) values (5,3,3,"Prvi komentar", "Dodan, komentar", CURRENT_TIMESTAMP, 0, 0);
insert into post (category_idcategory, post_idpost, user_iduser, title, content, time, edited, likes) values (5,3,4,"Drugi komentar", "Nullam id magna ut odio mattis congue id ac justo. Donec sit amet enim nec mauris commodo tincidunt.", CURRENT_TIMESTAMP, 0, 0);

insert into post (category_idcategory, user_iduser, title, content, time, edited, likes) values (5,2,"Lorem ipsum", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed maximus dolor. Nullam id magna ut odio mattis congue id ac justo. Donec sit amet enim nec mauris commodo tincidunt. Cras erat risus, condimentum nec pretium quis, auctor vitae nisi. Nulla est dui, hendrerit ac tortor ut, finibus malesuada nisl. Etiam quis orci at ante sagittis lacinia vel dictum nunc. Phasellus nec sodales neque. Suspendisse quis scelerisque quam, vel tempor est. Duis justo lorem, iaculis eget massa id, dignissim fringilla elit. Nullam laoreet velit cursus consectetur porta. Nullam nec odio sed ex imperdiet semper sit amet vitae risus. Curabitur posuere viverra ultricies..", CURRENT_TIMESTAMP, 0,0);
insert into post (category_idcategory, post_idpost, user_iduser, title, content, time, edited, likes) values (5,6,3,"Prvi komentar", "Dodan, komentar", CURRENT_TIMESTAMP, 0, 0);
insert into post (category_idcategory, post_idpost, user_iduser, title, content, time, edited, likes) values (5,6,4,"Drugi komentar", "Nullam id magna ut odio mattis congue id ac justo. Donec sit amet enim nec mauris commodo tincidunt.", CURRENT_TIMESTAMP, 0, 0);