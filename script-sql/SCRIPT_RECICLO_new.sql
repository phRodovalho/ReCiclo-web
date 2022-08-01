-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema reciclo_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema reciclo_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `reciclo_db` DEFAULT CHARACTER SET utf8mb3 ;
USE `reciclo_db` ;

-- -----------------------------------------------------
-- Table `reciclo_db`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reciclo_db`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NULL DEFAULT NULL,
  `CPF` VARCHAR(11) NULL DEFAULT NULL,
  `CNPJ` VARCHAR(14) NULL DEFAULT NULL,
  `data_nascimento` DATE NULL DEFAULT NULL,
  `email` VARCHAR(45) NOT NULL,
  `telefone` VARCHAR(45) NOT NULL,
  `senha` LONGTEXT NOT NULL,
  `usertype` VARCHAR(45) NOT NULL,
  `descricao` VARCHAR(500) NULL,
  PRIMARY KEY (`idusuario`))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `reciclo_db`.`endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reciclo_db`.`endereco` (
  `idendereco` INT NOT NULL AUTO_INCREMENT,
  `CEP` VARCHAR(45) NOT NULL,
  `cidade` VARCHAR(70) NULL DEFAULT NULL,
  `estado` VARCHAR(70) NULL DEFAULT NULL,
  `bairro` VARCHAR(70) NULL DEFAULT NULL,
  `numero` INT NULL DEFAULT NULL,
  `logradouro` VARCHAR(100) NULL DEFAULT NULL,
  `complemento` VARCHAR(70) NULL DEFAULT NULL,
  `usuario_idusuario` INT NOT NULL,
  PRIMARY KEY (`idendereco`),
  INDEX `fk_endereco_usuario1_idx` (`usuario_idusuario` ASC) VISIBLE,
  CONSTRAINT `fk_endereco_usuario1`
    FOREIGN KEY (`usuario_idusuario`)
    REFERENCES `reciclo_db`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `reciclo_db`.`pedido_coleta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reciclo_db`.`pedido_coleta` (
  `idpedido_coleta` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `tipo_material` VARCHAR(200) NOT NULL,
  `quantidade` VARCHAR(200) NOT NULL,
  `midia` LONGBLOB NULL DEFAULT NULL,
  `info_contato` VARCHAR(100) NOT NULL,
  `info_coleta` VARCHAR(100) NULL DEFAULT NULL,
  `descricao` VARCHAR(200) NULL DEFAULT NULL,
  `usuario_idusuario` INT NOT NULL,
  PRIMARY KEY (`idpedido_coleta`),
  INDEX `fk_pedido_coleta_usuario1_idx` (`usuario_idusuario` ASC) VISIBLE,
  CONSTRAINT `fk_pedido_coleta_usuario1`
    FOREIGN KEY (`usuario_idusuario`)
    REFERENCES `reciclo_db`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `reciclo_db`.`ponto_coleta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reciclo_db`.`ponto_coleta` (
  `idponto_coleta` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(70) NOT NULL,
  `tipo` VARCHAR(70) NOT NULL,
  `descricao` VARCHAR(200) NOT NULL,
  `horario_funcionamento` VARCHAR(100) NOT NULL,
  `info_contato` VARCHAR(100) NOT NULL,
  `endereco_idendereco` INT NOT NULL,
  `usuario_idusuario` INT NOT NULL,
  PRIMARY KEY (`idponto_coleta`),
  INDEX `fk_ponto_coleta_endereco1_idx` (`endereco_idendereco` ASC) VISIBLE,
  INDEX `fk_ponto_coleta_usuario1_idx` (`usuario_idusuario` ASC) VISIBLE,
  CONSTRAINT `fk_ponto_coleta_endereco1`
    FOREIGN KEY (`endereco_idendereco`)
    REFERENCES `reciclo_db`.`endereco` (`idendereco`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ponto_coleta_usuario1`
    FOREIGN KEY (`usuario_idusuario`)
    REFERENCES `reciclo_db`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
