-- MySQL Script generated by MySQL Workbench
-- Tue Nov 15 17:32:25 2016
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema cinema
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema cinema
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `cinema` DEFAULT CHARACTER SET utf8 ;
USE `cinema` ;

-- -----------------------------------------------------
-- Table `cinema`.`CINE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`CINE` (
  `id_cine` INT NOT NULL AUTO_INCREMENT,
  `comuna` VARCHAR(45) NULL,
  PRIMARY KEY (`id_cine`),
  UNIQUE INDEX `id_cine_UNIQUE` (`id_cine` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`SALA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`SALA` (
  `n_sala` INT NOT NULL AUTO_INCREMENT,
  `n_asientos` INT NULL,
  `CINE_id_cine` INT NOT NULL,
  PRIMARY KEY (`n_sala`),
  UNIQUE INDEX `n_sala_UNIQUE` (`n_sala` ASC),
  INDEX `fk_SALA_CINE_idx` (`CINE_id_cine` ASC),
  CONSTRAINT `fk_SALA_CINE`
    FOREIGN KEY (`CINE_id_cine`)
    REFERENCES `cinema`.`CINE` (`id_cine`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`FUNCION`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`FUNCION` (
  `SALA_n_sala` INT NOT NULL,
  `PELICULA_id_pelicula` INT NOT NULL,
  `fecha-hora` DATETIME NOT NULL,
  `PROYECTADOR_id_proyectador` INT NULL,
  PRIMARY KEY (`SALA_n_sala`, `PELICULA_id_pelicula`, `fecha-hora`),
  INDEX `fk_FUNCION_PELICULA1_idx` (`PELICULA_id_pelicula` ASC),
  INDEX `fk_FUNCION_PROYECTADOR1_idx` (`PROYECTADOR_id_proyectador` ASC),
  CONSTRAINT `fk_FUNCION_SALA1`
    FOREIGN KEY (`SALA_n_sala`)
    REFERENCES `cinema`.`SALA` (`n_sala`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_FUNCION_PELICULA1`
    FOREIGN KEY (`PELICULA_id_pelicula`)
    REFERENCES `cinema`.`PELICULA` (`id_pelicula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_FUNCION_PROYECTADOR1`
    FOREIGN KEY (`PROYECTADOR_id_proyectador`)
    REFERENCES `cinema`.`PROYECTADOR` (`id_proyectador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`USUARIO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`USUARIO` (
  `user` VARCHAR(15) NOT NULL,
  `rut` VARCHAR(12) NULL,
  `password` VARCHAR(45) NULL,
  PRIMARY KEY (`user`),
  UNIQUE INDEX `user_UNIQUE` (`user` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`EMPLEADO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`EMPLEADO` (
  `USUARIO_user` VARCHAR(15) NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `sueldo` INT NULL,
  `CINE_id_cine` INT NOT NULL,
  PRIMARY KEY (`USUARIO_user`),
  INDEX `fk_EMPLEADO_CINE1_idx` (`CINE_id_cine` ASC),
  CONSTRAINT `fk_EMPLEADO_USUARIO1`
    FOREIGN KEY (`USUARIO_user`)
    REFERENCES `cinema`.`USUARIO` (`user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_EMPLEADO_CINE1`
    FOREIGN KEY (`CINE_id_cine`)
    REFERENCES `cinema`.`CINE` (`id_cine`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`CLIENTE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`CLIENTE` (
  `id_cliente` INT NOT NULL AUTO_INCREMENT,
  `USUARIO_user` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE INDEX `id_cliente_UNIQUE` (`id_cliente` ASC),
  INDEX `fk_CLIENTE_USUARIO1_idx` (`USUARIO_user` ASC),
  CONSTRAINT `fk_CLIENTE_USUARIO1`
    FOREIGN KEY (`USUARIO_user`)
    REFERENCES `cinema`.`USUARIO` (`user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`PROYECTADOR`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`PROYECTADOR` (
  `id_proyectador` INT NOT NULL AUTO_INCREMENT,
  `EMPLEADO_USUARIO_user` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id_proyectador`),
  UNIQUE INDEX `id_proyectador_UNIQUE` (`id_proyectador` ASC),
  INDEX `fk_PROYECTADOR_EMPLEADO1_idx` (`EMPLEADO_USUARIO_user` ASC),
  CONSTRAINT `fk_PROYECTADOR_EMPLEADO1`
    FOREIGN KEY (`EMPLEADO_USUARIO_user`)
    REFERENCES `cinema`.`EMPLEADO` (`USUARIO_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`VENDEDOR`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`VENDEDOR` (
  `id_vendedor` INT NOT NULL AUTO_INCREMENT,
  `EMPLEADO_USUARIO_user` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id_vendedor`),
  UNIQUE INDEX `id_vendedor_UNIQUE` (`id_vendedor` ASC),
  INDEX `fk_VENDEDOR_EMPLEADO1_idx` (`EMPLEADO_USUARIO_user` ASC),
  CONSTRAINT `fk_VENDEDOR_EMPLEADO1`
    FOREIGN KEY (`EMPLEADO_USUARIO_user`)
    REFERENCES `cinema`.`EMPLEADO` (`USUARIO_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`TRANSACCION`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`TRANSACCION` (
  `id_transaccion` INT NOT NULL AUTO_INCREMENT,
  `VENDEDOR_id_vendedor` INT NULL,
  `CLIENTE_id_cliente` INT NOT NULL,
  PRIMARY KEY (`id_transaccion`),
  UNIQUE INDEX `id_transaccion_UNIQUE` (`id_transaccion` ASC),
  INDEX `fk_TRANSACCION_VENDEDOR1_idx` (`VENDEDOR_id_vendedor` ASC),
  INDEX `fk_TRANSACCION_CLIENTE1_idx` (`CLIENTE_id_cliente` ASC),
  CONSTRAINT `fk_TRANSACCION_VENDEDOR1`
    FOREIGN KEY (`VENDEDOR_id_vendedor`)
    REFERENCES `cinema`.`VENDEDOR` (`id_vendedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TRANSACCION_CLIENTE1`
    FOREIGN KEY (`CLIENTE_id_cliente`)
    REFERENCES `cinema`.`CLIENTE` (`id_cliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`PELICULA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`PELICULA` (
  `id_pelicula` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NOT NULL,
  `genero` VARCHAR(15) NULL,
  `clasificacion` VARCHAR(5) NULL,
  `precio` INT NULL,
  PRIMARY KEY (`id_pelicula`),
  UNIQUE INDEX `id_pelicula_UNIQUE` (`id_pelicula` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`FUNCION`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`FUNCION` (
  `SALA_n_sala` INT NOT NULL,
  `PELICULA_id_pelicula` INT NOT NULL,
  `fecha-hora` DATETIME NOT NULL,
  `PROYECTADOR_id_proyectador` INT NULL,
  PRIMARY KEY (`SALA_n_sala`, `PELICULA_id_pelicula`, `fecha-hora`),
  INDEX `fk_FUNCION_PELICULA1_idx` (`PELICULA_id_pelicula` ASC),
  INDEX `fk_FUNCION_PROYECTADOR1_idx` (`PROYECTADOR_id_proyectador` ASC),
  CONSTRAINT `fk_FUNCION_SALA1`
    FOREIGN KEY (`SALA_n_sala`)
    REFERENCES `cinema`.`SALA` (`n_sala`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_FUNCION_PELICULA1`
    FOREIGN KEY (`PELICULA_id_pelicula`)
    REFERENCES `cinema`.`PELICULA` (`id_pelicula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_FUNCION_PROYECTADOR1`
    FOREIGN KEY (`PROYECTADOR_id_proyectador`)
    REFERENCES `cinema`.`PROYECTADOR` (`id_proyectador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`TICKET`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`TICKET` (
  `n_ticket` INT NOT NULL AUTO_INCREMENT,
  `asiento` VARCHAR(5) NULL,
  `FUNCION_SALA_n_sala` INT NOT NULL,
  `FUNCION_PELICULA_id_pelicula` INT NOT NULL,
  `FUNCION_fecha-hora` DATETIME NOT NULL,
  `TRANSACCION_id_transaccion` INT NOT NULL,
  PRIMARY KEY (`n_ticket`),
  UNIQUE INDEX `n_ticket_UNIQUE` (`n_ticket` ASC),
  INDEX `fk_TICKET_FUNCION1_idx` (`FUNCION_SALA_n_sala` ASC, `FUNCION_PELICULA_id_pelicula` ASC, `FUNCION_fecha-hora` ASC),
  INDEX `fk_TICKET_TRANSACCION1_idx` (`TRANSACCION_id_transaccion` ASC),
  CONSTRAINT `fk_TICKET_FUNCION1`
    FOREIGN KEY (`FUNCION_SALA_n_sala` , `FUNCION_PELICULA_id_pelicula` , `FUNCION_fecha-hora`)
    REFERENCES `cinema`.`FUNCION` (`SALA_n_sala` , `PELICULA_id_pelicula` , `fecha-hora`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TICKET_TRANSACCION1`
    FOREIGN KEY (`TRANSACCION_id_transaccion`)
    REFERENCES `cinema`.`TRANSACCION` (`id_transaccion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`COMENTARIO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`COMENTARIO` (
  `USUARIO_user` VARCHAR(15) NOT NULL,
  `PELICULA_id_pelicula` INT NOT NULL,
  PRIMARY KEY (`USUARIO_user`, `PELICULA_id_pelicula`),
  INDEX `fk_COMENTARIO_PELICULA1_idx` (`PELICULA_id_pelicula` ASC),
  CONSTRAINT `fk_COMENTARIO_USUARIO1`
    FOREIGN KEY (`USUARIO_user`)
    REFERENCES `cinema`.`USUARIO` (`user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_COMENTARIO_PELICULA1`
    FOREIGN KEY (`PELICULA_id_pelicula`)
    REFERENCES `cinema`.`PELICULA` (`id_pelicula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`DIRECTOR`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`DIRECTOR` (
  `id_director` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_director`),
  UNIQUE INDEX `id_director_UNIQUE` (`id_director` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`ACTOR`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`ACTOR` (
  `id_actor` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_actor`),
  UNIQUE INDEX `id_actor_UNIQUE` (`id_actor` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`DIRIGE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`DIRIGE` (
  `DIRECTOR_id_director` INT NOT NULL,
  `PELICULA_id_pelicula` INT NOT NULL,
  PRIMARY KEY (`DIRECTOR_id_director`, `PELICULA_id_pelicula`),
  INDEX `fk_DIRIGE_PELICULA1_idx` (`PELICULA_id_pelicula` ASC),
  CONSTRAINT `fk_DIRIGE_DIRECTOR1`
    FOREIGN KEY (`DIRECTOR_id_director`)
    REFERENCES `cinema`.`DIRECTOR` (`id_director`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DIRIGE_PELICULA1`
    FOREIGN KEY (`PELICULA_id_pelicula`)
    REFERENCES `cinema`.`PELICULA` (`id_pelicula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cinema`.`ACTUA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cinema`.`ACTUA` (
  `ACTOR_id_actor` INT NOT NULL,
  `PELICULA_id_pelicula` INT NOT NULL,
  PRIMARY KEY (`ACTOR_id_actor`, `PELICULA_id_pelicula`),
  INDEX `fk_ACTUA_PELICULA1_idx` (`PELICULA_id_pelicula` ASC),
  CONSTRAINT `fk_ACTUA_ACTOR1`
    FOREIGN KEY (`ACTOR_id_actor`)
    REFERENCES `cinema`.`ACTOR` (`id_actor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ACTUA_PELICULA1`
    FOREIGN KEY (`PELICULA_id_pelicula`)
    REFERENCES `cinema`.`PELICULA` (`id_pelicula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;