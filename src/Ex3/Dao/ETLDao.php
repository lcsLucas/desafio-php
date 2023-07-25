<?php

namespace Ex3\Dao;

use Ex3\Model\Banco;

class ETLDao extends Banco
{

    protected function migrateCreateTable()
    {
        $sqlCreate =
            "CREATE TABLE IF NOT EXISTS `organizations` (
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
            ) ENGINE = InnoDB";

        if ($this->conectar()) {
            $st = $this->getCon()->prepare($sqlCreate);
            return $st->execute();
        }

        return false;

    }

}