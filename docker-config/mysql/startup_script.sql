ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'root';
ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'root';
ALTER USER 'default'@'%' IDENTIFIED WITH mysql_native_password BY 'secret';

CREATE TABLE IF NOT EXISTS `organizations` 
    (
        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
        `identifier` VARCHAR(30) NOT NULL,
        `name` VARCHAR(150) NOT NULL,
        `website` VARCHAR(255) NULL,
        `country` VARCHAR(255) NULL,
        `description` TEXT NULL,
        `founded` CHAR(4) NULL,
        `industry` VARCHAR(255) NULL,
        `employees` INT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB;