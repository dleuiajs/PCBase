-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema pcbase
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema pcbase
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `pcbase` DEFAULT CHARACTER SET utf8 ;
USE `pcbase` ;

-- -----------------------------------------------------
-- Table `pcbase`.`rola`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pcbase`.`rola` (
  `idrola` INT NOT NULL AUTO_INCREMENT,
  `nazov` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idrola`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pcbase`.`pouzivatel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pcbase`.`pouzivatel` (
  `idpouzivatel` INT NOT NULL AUTO_INCREMENT,
  `meno` VARCHAR(45) NOT NULL,
  `priezvisko` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `heslo` VARCHAR(255) NOT NULL,
  `tel_cislo` VARCHAR(20) NULL,
  `krajina` VARCHAR(45) NULL,
  `mesto` VARCHAR(45) NULL,
  `PSC` VARCHAR(15) NULL,
  `ulica` VARCHAR(45) NULL,
  `cislo_domu` INT NULL,
  `rola_idrola` INT NOT NULL,
  PRIMARY KEY (`idpouzivatel`, `rola_idrola`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pcbase`.`zakladna_doska`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pcbase`.`zakladna_doska` (
  `idzakladna_doska` INT NOT NULL AUTO_INCREMENT,
  `nazov` VARCHAR(255) NOT NULL,
  `model` VARCHAR(45) NOT NULL,
  `socket` VARCHAR(45) NOT NULL,
  `chipset` VARCHAR(45) NOT NULL,
  `pocet_pameti_slots` INT NOT NULL,
  `form_factor` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`idzakladna_doska`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pcbase`.`procesor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pcbase`.`procesor` (
  `idprocesor` INT NOT NULL AUTO_INCREMENT,
  `nazov` VARCHAR(255) NOT NULL,
  `model` VARCHAR(45) NOT NULL,
  `jadra` INT NOT NULL,
  `vlaken` INT NOT NULL,
  `taktny_rychlost` FLOAT NOT NULL,
  `socket` VARCHAR(45) NOT NULL,
  `TDP` INT NOT NULL,
  PRIMARY KEY (`idprocesor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pcbase`.`napajaci_zdroj`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pcbase`.`napajaci_zdroj` (
  `idnapajaci_zdroj` INT NOT NULL AUTO_INCREMENT,
  `nazov` VARCHAR(255) NOT NULL,
  `model` VARCHAR(45) NOT NULL,
  `vystupny_vykon` INT NOT NULL,
  `efektivita` VARCHAR(45) NOT NULL,
  `typ_konektora` VARCHAR(255) NOT NULL,
  `ochrana` VARCHAR(255) NOT NULL,
  `format` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idnapajaci_zdroj`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pcbase`.`operacna_pamat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pcbase`.`operacna_pamat` (
  `idoperacna_pamat` INT NOT NULL AUTO_INCREMENT,
  `nazov` VARCHAR(255) NOT NULL,
  `model` VARCHAR(45) NOT NULL,
  `typ_pamati` VARCHAR(45) NOT NULL,
  `kapacita` FLOAT NOT NULL,
  `rychlost` INT NOT NULL,
  `napatie` FLOAT NOT NULL,
  PRIMARY KEY (`idoperacna_pamat`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pcbase`.`ulozisko`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pcbase`.`ulozisko` (
  `idulozisko` INT NOT NULL AUTO_INCREMENT,
  `nazov` VARCHAR(255) NOT NULL,
  `model` VARCHAR(45) NOT NULL,
  `typ` VARCHAR(45) NOT NULL,
  `kapacita` INT NOT NULL,
  `rychlost_prenosu` INT NOT NULL,
  `interface` VARCHAR(45) NOT NULL,
  `rotacia` INT NULL,
  `format` VARCHAR(45) NULL,
  `typ_pameti` VARCHAR(45) NULL,
  PRIMARY KEY (`idulozisko`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pcbase`.`chladenie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pcbase`.`chladenie` (
  `idchladenie` INT NOT NULL AUTO_INCREMENT,
  `nazov` VARCHAR(255) NOT NULL,
  `model` VARCHAR(45) NOT NULL,
  `typ` VARCHAR(45) NOT NULL,
  `velkost_fan` VARCHAR(45) NULL,
  `hlucnost` VARCHAR(45) NULL,
  `rozmery` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idchladenie`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pcbase`.`operacny_system`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pcbase`.`operacny_system` (
  `idoperacny_system` INT NOT NULL AUTO_INCREMENT,
  `nazov` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idoperacny_system`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pcbase`.`podrobnosti_tovara`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pcbase`.`podrobnosti_tovara` (
  `idpodrobnosti_tovara` INT NOT NULL,
  `rozmery` VARCHAR(45) NOT NULL,
  `hmotnost` VARCHAR(45) NOT NULL,
  `zaruka` VARCHAR(45) NOT NULL,
  `idzakladna_doska` INT NOT NULL,
  `idprocesor` INT NOT NULL,
  `idnapajaci_zdroj` INT NOT NULL,
  `idoperacna_pamat` INT NOT NULL,
  `idulozisko` INT NOT NULL,
  `idchladenie` INT NOT NULL,
  `idoperacny_system` INT NOT NULL,
  PRIMARY KEY (`idpodrobnosti_tovara`, `idzakladna_doska`, `idprocesor`, `idnapajaci_zdroj`, `idoperacna_pamat`, `idulozisko`, `idchladenie`, `idoperacny_system`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pcbase`.`kategoria_tovara`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pcbase`.`kategoria_tovara` (
  `idkategoria_tovara` INT NOT NULL AUTO_INCREMENT,
  `nazov` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idkategoria_tovara`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pcbase`.`tovar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pcbase`.`tovar` (
  `idtovar` INT NOT NULL AUTO_INCREMENT,
  `nazov` VARCHAR(45) NOT NULL,
  `popis` VARCHAR(255) NOT NULL,
  `dostupnost` TINYINT NOT NULL,
  `cena` FLOAT NOT NULL,
  `obrazok` BLOB NOT NULL,
  `idpodrobnosti_tovara` INT NOT NULL,
  `idkategoria_tovara` INT NOT NULL,
  PRIMARY KEY (`idtovar`, `idpodrobnosti_tovara`, `idkategoria_tovara`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pcbase`.`recenzia_tovara`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pcbase`.`recenzia_tovara` (
  `idrecenzia_tovara` INT NOT NULL AUTO_INCREMENT,
  `nazov` VARCHAR(45) NOT NULL,
  `popis` VARCHAR(255) NOT NULL,
  `hodnotenie` INT NOT NULL,
  `datum` DATE NOT NULL,
  `idtovar` INT NOT NULL,
  `idpouzivatel` INT NOT NULL,
  PRIMARY KEY (`idrecenzia_tovara`, `idtovar`, `idpouzivatel`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pcbase`.`graficka_karta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pcbase`.`graficka_karta` (
  `idgraficka_karta` INT NOT NULL AUTO_INCREMENT,
  `nazov` VARCHAR(255) NOT NULL,
  `model` VARCHAR(45) NOT NULL,
  `typ_pamati` VARCHAR(45) NOT NULL,
  `velkost_pamati` INT NOT NULL,
  `zbernica` INT NOT NULL,
  `taktny_rychlost` INT NOT NULL,
  `rozhranie` VARCHAR(45) NOT NULL,
  `napajanie` INT NOT NULL,
  PRIMARY KEY (`idgraficka_karta`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pcbase`.`podrobnosti_tovara_has_graficka_karta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pcbase`.`podrobnosti_tovara_has_graficka_karta` (
  `idpodrobnosti_tovara` INT NOT NULL,
  `idgraficka_karta` INT NOT NULL,
  PRIMARY KEY (`idpodrobnosti_tovara`, `idgraficka_karta`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pcbase`.`objednavka_zostavenie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pcbase`.`objednavka_zostavenie` (
  `idobjednavka` INT NOT NULL AUTO_INCREMENT,
  `dorucene` TINYINT NOT NULL,
  `datum` DATETIME NOT NULL,
  `rozpocet` FLOAT NOT NULL,
  `idpouzivatel` INT NOT NULL,
  `idzakladna_doska` INT NOT NULL,
  `idgraficka_karta` INT NOT NULL,
  `idprocesor` INT NOT NULL,
  `idnapajaci_zdroj` INT NOT NULL,
  `idulozisko` INT NOT NULL,
  `idoperacna_pamat` INT NOT NULL,
  `idchladenie` INT NOT NULL,
  `idoperacny_system` INT NOT NULL,
  PRIMARY KEY (`idobjednavka`, `idpouzivatel`, `idzakladna_doska`, `idgraficka_karta`, `idprocesor`, `idnapajaci_zdroj`, `idulozisko`, `idoperacna_pamat`, `idchladenie`, `idoperacny_system`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pcbase`.`objednavka_tovar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pcbase`.`objednavka_tovar` (
  `idobjednavka_tovar` INT NOT NULL AUTO_INCREMENT,
  `dorucene` TINYINT NOT NULL,
  `datum` DATETIME NOT NULL,
  `idpouzivatel` INT NOT NULL,
  `idtovar` INT NOT NULL,
  PRIMARY KEY (`idobjednavka_tovar`, `idpouzivatel`, `idtovar`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pcbase`.`objednavka_kontakt`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pcbase`.`objednavka_kontakt` (
  `idobjednavka_kontakt` INT NOT NULL AUTO_INCREMENT,
  `meno` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `tel_cislo` VARCHAR(20) NOT NULL,
  `sprava` VARCHAR(255) NOT NULL,
  `preskumane` TINYINT NOT NULL,
  PRIMARY KEY (`idobjednavka_kontakt`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
