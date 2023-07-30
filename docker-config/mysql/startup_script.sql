ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'root';
ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'root';
/* ALTER USER 'usu_desafio'@'%' IDENTIFIED WITH mysql_native_password BY 'secret'; */

USE db_desafio;

CREATE TABLE IF NOT EXISTS `organizations` (
  `id` INT UNSIGNED NOT NULL,
  `identifier` VARCHAR(30) NOT NULL,
  `name` VARCHAR(150) NOT NULL,
  `website` VARCHAR(255) NULL,
  `country` VARCHAR(255) NULL,
  `description` TEXT NULL,
  `founded` CHAR(4) NULL,
  `industry` VARCHAR(255) NULL,
  `employees` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;