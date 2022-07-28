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
-- Table `reciclo_db`.`calculadora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reciclo_db`.`calculadora` (
  `idcalculadora` INT NOT NULL AUTO_INCREMENT,
  `qnt_papel` INT NULL DEFAULT NULL,
  `qnt_vidro` INT NULL DEFAULT NULL,
  `qnt_aluminio` INT NULL DEFAULT NULL,
  `qnt_plastico` INT NULL DEFAULT NULL,
  PRIMARY KEY (`idcalculadora`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `reciclo_db`.`endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reciclo_db`.`endereco` (
  `idendereco` INT NOT NULL AUTO_INCREMENT,
  `CEP` VARCHAR(45) NULL DEFAULT NULL,
  `cidade` VARCHAR(45) NULL DEFAULT NULL,
  `estado` VARCHAR(45) NULL DEFAULT NULL,
  `bairro` VARCHAR(45) NULL DEFAULT NULL,
  `numero` INT NULL DEFAULT NULL,
  `logradouro` VARCHAR(45) NULL DEFAULT NULL,
  `complemento` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idendereco`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `reciclo_db`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reciclo_db`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `CPF` VARCHAR(11) NULL DEFAULT NULL,
  `CNPJ` VARCHAR(14) NULL DEFAULT NULL,
  `data_nascimento` DATE NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `telefone` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `endereco_idendereco` INT NOT NULL,
  `calculadora_idcalculadora` INT NOT NULL,
  PRIMARY KEY (`idusuario`, `endereco_idendereco`, `calculadora_idcalculadora`),
  INDEX `fk_usuario_endereco1_idx` (`endereco_idendereco` ASC) VISIBLE,
  INDEX `fk_usuario_calculadora1_idx` (`calculadora_idcalculadora` ASC) VISIBLE,
  CONSTRAINT `fk_usuario_calculadora1`
    FOREIGN KEY (`calculadora_idcalculadora`)
    REFERENCES `reciclo_db`.`calculadora` (`idcalculadora`),
  CONSTRAINT `fk_usuario_endereco1`
    FOREIGN KEY (`endereco_idendereco`)
    REFERENCES `reciclo_db`.`endereco` (`idendereco`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `reciclo_db`.`administrador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reciclo_db`.`administrador` (
  `idAdministrador` INT NOT NULL AUTO_INCREMENT,
  `usuario_idusuario` INT NOT NULL,
  `usuario_endereco_idendereco` INT NOT NULL,
  `usuario_calculadora_idcalculadora` INT NOT NULL,
  PRIMARY KEY (`idAdministrador`, `usuario_idusuario`, `usuario_endereco_idendereco`, `usuario_calculadora_idcalculadora`),
  INDEX `fk_administrador_usuario1_idx` (`usuario_idusuario` ASC, `usuario_endereco_idendereco` ASC, `usuario_calculadora_idcalculadora` ASC) VISIBLE,
  CONSTRAINT `fk_administrador_usuario1`
    FOREIGN KEY (`usuario_idusuario` , `usuario_endereco_idendereco` , `usuario_calculadora_idcalculadora`)
    REFERENCES `reciclo_db`.`usuario` (`idusuario` , `endereco_idendereco` , `calculadora_idcalculadora`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `reciclo_db`.`pedido_coleta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reciclo_db`.`pedido_coleta` (
  `idpedido_coleta` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `tipo_material` VARCHAR(200) NOT NULL,
  `quantidade` VARCHAR(200) NOT NULL,
  `midia` VARCHAR(45) NOT NULL,
  `info_contato` VARCHAR(100) NOT NULL,
  `endereco_idendereco` INT NOT NULL,
  PRIMARY KEY (`idpedido_coleta`, `endereco_idendereco`),
  INDEX `fk_pedido_coleta_endereco1_idx` (`endereco_idendereco` ASC) VISIBLE,
  CONSTRAINT `fk_pedido_coleta_endereco1`
    FOREIGN KEY (`endereco_idendereco`)
    REFERENCES `reciclo_db`.`endereco` (`idendereco`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `reciclo_db`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reciclo_db`.`cliente` (
  `idcliente` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(500) NULL DEFAULT NULL,
  `usuario_idusuario` INT NOT NULL,
  `usuario_endereco_idendereco` INT NOT NULL,
  `usuario_calculadora_idcalculadora` INT NOT NULL,
  `pedido_coleta_idpedido_coleta` INT NOT NULL,
  `pedido_coleta_endereco_idendereco` INT NOT NULL,
  PRIMARY KEY (`idcliente`, `usuario_endereco_idendereco`, `usuario_calculadora_idcalculadora`, `usuario_idusuario`, `pedido_coleta_idpedido_coleta`, `pedido_coleta_endereco_idendereco`),
  INDEX `fk_cliente_usuario1_idx` (`usuario_idusuario` ASC, `usuario_endereco_idendereco` ASC, `usuario_calculadora_idcalculadora` ASC) VISIBLE,
  INDEX `fk_cliente_pedido_coleta1_idx` (`pedido_coleta_idpedido_coleta` ASC, `pedido_coleta_endereco_idendereco` ASC) VISIBLE,
  CONSTRAINT `fk_cliente_pedido_coleta1`
    FOREIGN KEY (`pedido_coleta_idpedido_coleta` , `pedido_coleta_endereco_idendereco`)
    REFERENCES `reciclo_db`.`pedido_coleta` (`idpedido_coleta` , `endereco_idendereco`),
  CONSTRAINT `fk_cliente_usuario1`
    FOREIGN KEY (`usuario_idusuario` , `usuario_endereco_idendereco` , `usuario_calculadora_idcalculadora`)
    REFERENCES `reciclo_db`.`usuario` (`idusuario` , `endereco_idendereco` , `calculadora_idcalculadora`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `reciclo_db`.`ponto_coleta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reciclo_db`.`ponto_coleta` (
  `idponto_coleta` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  `descricao` VARCHAR(200) NOT NULL,
  `horario_funcionamento` VARCHAR(100) NOT NULL,
  `info_contato` VARCHAR(100) NOT NULL,
  `endereco_idendereco` INT NOT NULL,
  PRIMARY KEY (`idponto_coleta`, `endereco_idendereco`),
  INDEX `fk_ponto_coleta_endereco1_idx` (`endereco_idendereco` ASC) VISIBLE,
  CONSTRAINT `fk_ponto_coleta_endereco1`
    FOREIGN KEY (`endereco_idendereco`)
    REFERENCES `reciclo_db`.`endereco` (`idendereco`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `reciclo_db`.`cliente_has_ponto_coleta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reciclo_db`.`cliente_has_ponto_coleta` (
  `cliente_idcliente` INT NOT NULL,
  `ponto_coleta_idponto_coleta` INT NOT NULL,
  PRIMARY KEY (`cliente_idcliente`, `ponto_coleta_idponto_coleta`),
  INDEX `fk_cliente_has_ponto_coleta_ponto_coleta1_idx` (`ponto_coleta_idponto_coleta` ASC) VISIBLE,
  INDEX `fk_cliente_has_ponto_coleta_cliente1_idx` (`cliente_idcliente` ASC) VISIBLE,
  CONSTRAINT `fk_cliente_has_ponto_coleta_cliente1`
    FOREIGN KEY (`cliente_idcliente`)
    REFERENCES `reciclo_db`.`cliente` (`idcliente`),
  CONSTRAINT `fk_cliente_has_ponto_coleta_ponto_coleta1`
    FOREIGN KEY (`ponto_coleta_idponto_coleta`)
    REFERENCES `reciclo_db`.`ponto_coleta` (`idponto_coleta`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `reciclo_db`.`coletor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reciclo_db`.`coletor` (
  `idcoletor` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(500) NULL DEFAULT NULL,
  `usuario_idusuario` INT NOT NULL,
  `usuario_endereco_idendereco` INT NOT NULL,
  `usuario_calculadora_idcalculadora` INT NOT NULL,
  PRIMARY KEY (`idcoletor`, `usuario_idusuario`, `usuario_endereco_idendereco`, `usuario_calculadora_idcalculadora`),
  INDEX `fk_coletor_usuario1_idx` (`usuario_idusuario` ASC, `usuario_endereco_idendereco` ASC, `usuario_calculadora_idcalculadora` ASC) VISIBLE,
  CONSTRAINT `fk_coletor_usuario1`
    FOREIGN KEY (`usuario_idusuario` , `usuario_endereco_idendereco` , `usuario_calculadora_idcalculadora`)
    REFERENCES `reciclo_db`.`usuario` (`idusuario` , `endereco_idendereco` , `calculadora_idcalculadora`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `reciclo_db`.`coletor_has_pedido_coleta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reciclo_db`.`coletor_has_pedido_coleta` (
  `coletor_idcoletor` INT NOT NULL,
  `pedido_coleta_idpedido_coleta` INT NOT NULL,
  PRIMARY KEY (`coletor_idcoletor`, `pedido_coleta_idpedido_coleta`),
  INDEX `fk_coletor_has_pedido_coleta_pedido_coleta1_idx` (`pedido_coleta_idpedido_coleta` ASC) VISIBLE,
  INDEX `fk_coletor_has_pedido_coleta_coletor1_idx` (`coletor_idcoletor` ASC) VISIBLE,
  CONSTRAINT `fk_coletor_has_pedido_coleta_coletor1`
    FOREIGN KEY (`coletor_idcoletor`)
    REFERENCES `reciclo_db`.`coletor` (`idcoletor`),
  CONSTRAINT `fk_coletor_has_pedido_coleta_pedido_coleta1`
    FOREIGN KEY (`pedido_coleta_idpedido_coleta`)
    REFERENCES `reciclo_db`.`pedido_coleta` (`idpedido_coleta`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `reciclo_db`.`coletor_has_ponto_coleta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reciclo_db`.`coletor_has_ponto_coleta` (
  `coletor_idcoletor` INT NOT NULL,
  `ponto_coleta_idponto_coleta` INT NOT NULL,
  PRIMARY KEY (`coletor_idcoletor`, `ponto_coleta_idponto_coleta`),
  INDEX `fk_coletor_has_ponto_coleta_ponto_coleta1_idx` (`ponto_coleta_idponto_coleta` ASC) VISIBLE,
  INDEX `fk_coletor_has_ponto_coleta_coletor1_idx` (`coletor_idcoletor` ASC) VISIBLE,
  CONSTRAINT `fk_coletor_has_ponto_coleta_coletor1`
    FOREIGN KEY (`coletor_idcoletor`)
    REFERENCES `reciclo_db`.`coletor` (`idcoletor`),
  CONSTRAINT `fk_coletor_has_ponto_coleta_ponto_coleta1`
    FOREIGN KEY (`ponto_coleta_idponto_coleta`)
    REFERENCES `reciclo_db`.`ponto_coleta` (`idponto_coleta`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `reciclo_db`.`ponto_coleta_has_administrador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reciclo_db`.`ponto_coleta_has_administrador` (
  `ponto_coleta_idponto_coleta` INT NOT NULL,
  `administrador_idAdministrador` INT NOT NULL,
  PRIMARY KEY (`ponto_coleta_idponto_coleta`, `administrador_idAdministrador`),
  INDEX `fk_ponto_coleta_has_administrador_administrador1_idx` (`administrador_idAdministrador` ASC) VISIBLE,
  INDEX `fk_ponto_coleta_has_administrador_ponto_coleta1_idx` (`ponto_coleta_idponto_coleta` ASC) VISIBLE,
  CONSTRAINT `fk_ponto_coleta_has_administrador_administrador1`
    FOREIGN KEY (`administrador_idAdministrador`)
    REFERENCES `reciclo_db`.`administrador` (`idAdministrador`),
  CONSTRAINT `fk_ponto_coleta_has_administrador_ponto_coleta1`
    FOREIGN KEY (`ponto_coleta_idponto_coleta`)
    REFERENCES `reciclo_db`.`ponto_coleta` (`idponto_coleta`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
