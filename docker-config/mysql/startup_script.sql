ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'root';
ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'root';
/* ALTER USER 'usu_desafio'@'%' IDENTIFIED WITH mysql_native_password BY 'secret'; */

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

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE)
ENGINE = InnoDB;