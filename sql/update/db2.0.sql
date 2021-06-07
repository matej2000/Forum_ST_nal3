-- MySQL Script generated by MySQL Workbench
-- pon 07 jun 2021 13:28:41 CEST
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
  `username` VARCHAR(16) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(32) NOT NULL,
  `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `birthday` VARCHAR(45) NOT NULL,
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
  `description` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idcategory`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `forum2.0`.`post`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forum2.0`.`post` ;

CREATE TABLE IF NOT EXISTS `forum2.0`.`post` (
  `idpost` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `content` TEXT NOT NULL,
  `editd` TINYINT NOT NULL,
  `likes` INT NOT NULL DEFAULT 0,
  `user_iduser` INT NOT NULL,
  `category_idcategory` INT NOT NULL,
  `post_idpost` INT NOT NULL,
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
ENGINE = ndbcluster;


-- -----------------------------------------------------
-- Table `forum2.0`.`like`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forum2.0`.`like` ;

CREATE TABLE IF NOT EXISTS `forum2.0`.`like` (
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
