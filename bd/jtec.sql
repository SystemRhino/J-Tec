-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema jtec
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema jtec
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `jtec` DEFAULT CHARACTER SET latin1 ;
USE `jtec` ;

-- -----------------------------------------------------
-- Table `jtec`.`tb_categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jtec`.`tb_categoria` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nm_categoria` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `jtec`.`tb_comentario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jtec`.`tb_comentario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `comentario` VARCHAR(250) NOT NULL,
  `id_user` INT(11) NULL DEFAULT NULL,
  `id_noticia` INT(11) NULL DEFAULT NULL,
  `data` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `jtec`.`tb_like`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jtec`.`tb_like` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_user` INT(11) NULL DEFAULT NULL,
  `id_noticia` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `jtec`.`tb_nivel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jtec`.`tb_nivel` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nm_nivel` VARCHAR(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `jtec`.`tb_noticia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jtec`.`tb_noticia` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nm_noticia` VARCHAR(100) NULL DEFAULT NULL,
  `ds_noticia` TEXT NULL DEFAULT NULL,
  `img_1` VARCHAR(50) NULL DEFAULT NULL,
  `img_2` VARCHAR(50) NULL DEFAULT NULL,
  `nr_curtidas` INT(11) NULL DEFAULT NULL,
  `data_post` DATE NULL DEFAULT NULL,
  `hora_post` TIME NULL DEFAULT NULL,
  `id_categoria` INT(11) NULL DEFAULT NULL,
  `id_autor` INT(11) NULL DEFAULT NULL,
  `views` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `jtec`.`tb_seguidores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jtec`.`tb_seguidores` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_autor` INT(11) NULL DEFAULT NULL,
  `id_seguidor` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `jtec`.`tb_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jtec`.`tb_users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `ds_login` VARCHAR(80) NULL DEFAULT NULL,
  `ds_senha` VARCHAR(20) NULL DEFAULT NULL,
  `nm_user` VARCHAR(80) NULL DEFAULT NULL,
  `ds_img` VARCHAR(50) NULL DEFAULT NULL,
  `id_nivel` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;

CREATE TABLE `jtec`.`tb_placar` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nm_time_1` VARCHAR(45) NULL,
  `gols_1` VARCHAR(45) NULL,
  `nm_time_2` VARCHAR(45) NULL,
  `gols_2` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf32;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


INSERT INTO `jtec`.`tb_users` (`id`, `ds_login`, `ds_senha`, `nm_user`, `ds_img`, `id_nivel`) VALUES ('1', 'teste@gmail.com', 'teste', 'teset', 'user.png', '1');

INSERT INTO `jtec`.`tb_categoria` (`id`, `nm_categoria`) VALUES ('1', 'Categoria 1');
INSERT INTO `jtec`.`tb_categoria` (`id`, `nm_categoria`) VALUES ('2', 'Categoria 2');

INSERT INTO `jtec`.`tb_nivel` (`id`, `nm_nivel`) VALUES ('1', 'Admin');

INSERT INTO `jtec`.`tb_noticia` (`id`, `nm_noticia`, `ds_noticia`, `img_1`, `nr_curtidas`, `id_categoria`, `id_autor`, `views`) VALUES ('1', 'Titulo 1', 'Descircao', 'etec.jpg', '0', '1', '1', '0');


