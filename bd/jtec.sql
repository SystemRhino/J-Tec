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
CREATE SCHEMA IF NOT EXISTS `jtec` DEFAULT CHARACTER SET utf32 ;
USE `jtec` ;

-- -----------------------------------------------------
-- Table `jtec`.`tb_categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jtec`.`tb_categoria` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nm_categoria` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf32;


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
DEFAULT CHARACTER SET = utf32;


-- -----------------------------------------------------
-- Table `jtec`.`tb_cursos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jtec`.`tb_cursos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nm_curso` VARCHAR(45) NULL DEFAULT NULL,
  `ds_curso` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf32;


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
DEFAULT CHARACTER SET = utf32;


-- -----------------------------------------------------
-- Table `jtec`.`tb_nivel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jtec`.`tb_nivel` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nm_nivel` VARCHAR(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf32;


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
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf32;


-- -----------------------------------------------------
-- Table `jtec`.`tb_placar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jtec`.`tb_placar` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nm_time_1` VARCHAR(45) NULL DEFAULT NULL,
  `gols_1` VARCHAR(45) NULL DEFAULT NULL,
  `nm_time_2` VARCHAR(45) NULL DEFAULT NULL,
  `gols_2` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf32;


-- -----------------------------------------------------
-- Table `jtec`.`tb_seguidores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jtec`.`tb_seguidores` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_autor` INT(11) NULL DEFAULT NULL,
  `id_seguidor` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf32;


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
DEFAULT CHARACTER SET = utf32;


-- -----------------------------------------------------
-- Insert `jtec`.`tb_categoria`
-- -----------------------------------------------------
INSERT INTO `jtec`.`tb_categoria` (`id`,`nm_categoria`) VALUES ('1','Tecnologia');
INSERT INTO `jtec`.`tb_categoria` (`id`,`nm_categoria`) VALUES ('2','Jogos');
INSERT INTO `jtec`.`tb_categoria` (`id`,`nm_categoria`) VALUES ('3','Meio Ambiente');
INSERT INTO `jtec`.`tb_categoria` (`id`,`nm_categoria`) VALUES ('4','Saúde');
INSERT INTO `jtec`.`tb_categoria` (`id`,`nm_categoria`) VALUES ('5','Administração');


-- -----------------------------------------------------
-- Insert `jtec`.`tb_nivel`
-- -----------------------------------------------------
INSERT INTO `jtec`.`tb_nivel` (`id`, `nm_nivel`) VALUES ('1', 'Admin');
INSERT INTO `jtec`.`tb_nivel` (`id`, `nm_nivel`) VALUES ('2', 'User');


-- -----------------------------------------------------
-- Insert `jtec`.`tb_users`
-- -----------------------------------------------------
INSERT INTO `jtec`.`tb_users` (`id`, `ds_login`, `ds_senha`, `nm_user`, `ds_img`, `id_nivel`) VALUES ('1','webrain@gmail.com', '123', 'Webrain', 'webrain.jpg', '1');
INSERT INTO `jtec`.`tb_users` (`id`, `ds_login`, `ds_senha`, `nm_user`, `ds_img`, `id_nivel`) VALUES ('2','user@gmail.com', '123', 'Usuario', 'usuario.jpg', '2');

-- -----------------------------------------------------
-- Insert `jtec`.`tb_placar`
-- -----------------------------------------------------
INSERT INTO `jtec`.`tb_placar` (`nm_time_1`, `gols_1`, `nm_time_2`, `gols_2`) VALUES ('3MIN', '98', '3MAM', '2');

-- -----------------------------------------------------
-- Insert `jtec`.`tb_noticia`
-- -----------------------------------------------------
INSERT INTO `jtec`.`tb_noticia` (`id`, `nm_noticia`, `ds_noticia`, `img_1`, `img_2`, `nr_curtidas`, `data_post`, `id_categoria`, `id_autor`, `views`) VALUES ('1', 'Eleições para diretor começam', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'eleicao.png', 'eleicao.png', '0', '2023-11-11', '5', '1', '20');
INSERT INTO `jtec`.`tb_noticia` (`id`, `nm_noticia`, `ds_noticia`, `img_1`, `img_2`, `nr_curtidas`, `data_post`, `id_categoria`, `id_autor`, `views`) VALUES ('2', 'Alunos de Etec Expõem projetos sobre meio ambiente ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'projetomam.jpg', 'projetomam.jpg', '0', '2023-11-11', '3', '1', '0');
INSERT INTO `jtec`.`tb_noticia` (`id`, `nm_noticia`, `ds_noticia`, `img_1`, `img_2`, `nr_curtidas`, `data_post`, `id_categoria`, `id_autor`, `views`) VALUES ('3', 'Feira Tecnológica Reúne o Dobro do Esperado', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'feira.jpg', 'feira.jpg', '0', '2023-11-11', '1', '1', '150');

INSERT INTO `jtec`.`tb_cursos` (`id`, `nm_curso`, `ds_curso`) VALUES ('1', 'ETIM – ADMINISTRAÇÃO', 'O técnico em Administração pode trabalhar em vários departamentos. No setor de compras, por exemplo, pode elaborar pedidos de compra de produtos, cadastrar fornecedores assim como conferir a entrega das mercadorias adquiridas. Na área de produção, pode fazer planilhas de controle de processos e produtos, registrando quais já foram produzidos e em qual quantidade');
INSERT INTO `jtec`.`tb_cursos` (`id`, `nm_curso`, `ds_curso`) VALUES ('2', 'ETIM – INFORMÁTICA PARA INTERNET', 'Cria websites de acordo com as necessidades do cliente, identificando e sugerindo as melhores soluções; faz a manutenção de portais, sites e intranets; cuida da identidade visual das páginas de uma empresa; faz a customização de plataformas de conteúdo para web, como blogs e sites de comércio eletrônico; cria e realiza manutenção de bancos de dados para websites; adapta as páginas para abrigar vídeos, áudios e funções que facilitem a acessibilidade, como comandos de voz, por exemplo; trata e otimiza imagens para uso na internet; e prepara o layout de mensagens que são enviadas por e-mail (newsletter ou e-mail marketing), entre outras atividades.');
INSERT INTO `jtec`.`tb_cursos` (`id`, `nm_curso`, `ds_curso`) VALUES ('3', 'ETIM – MEIO AMBIENTE', 'Atua em diversas vertentes, seja na cidade ou no campo. É o responsável por realizar ações que protegem o meio ambiente. Pode trabalhar com inspeções, monitoria de educação ambiental, supervisão de plantios e controle de água, esgoto ou resíduos. Também pode atuar na área de saneamento e recursos hídricos.');
INSERT INTO `jtec`.`tb_cursos` (`id`, `nm_curso`, `ds_curso`) VALUES ('4', 'MODULAR – ADMINISTRAÇÃO', 'O aluno que cursar o MÓDULO I concluirá a Qualificação Profissional Técnica de Nível');
INSERT INTO `jtec`.`tb_cursos` (`id`, `nm_curso`, `ds_curso`) VALUES ('5', 'MODULAR – DESENVOLVIMENTO DE SISTEMAS', 'Empresas e departamentos de desenvolvimento de sistemas em organizações governamentais e não governamentais, podendo também atuar como profissional autônomo.');
INSERT INTO `jtec`.`tb_cursos` (`id`, `nm_curso`, `ds_curso`) VALUES ('6', 'MODULAR – FARMÁCIA', 'Manipula medicamentos, realiza testes de controle de qualidade, auxilia nas rotinas das farmácias, no armazenamento dos medicamentos e no controle do estoque. Orienta os pacientes sobre receitas medicas, conservação e uso correto de cada medicamento.');
  
SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
