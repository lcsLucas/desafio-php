<?php

namespace Ex3\Dao;

use Ex3\Model\Banco;

class ETLDao extends Banco
{

    protected function migrateCreateTable()
    {
        $sqlCreate =
            "CREATE TABLE IF NOT EXISTS `organizations` (
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
              ENGINE = InnoDB;";

        if ($this->conectar()) {
            $st = $this->getCon()->prepare($sqlCreate);
            return $st->execute();
        }

        return false;

    }

    protected function insertBatchDAO($batch)
    {

        $prepare_values = [];
        $update_fields = [];

        foreach ($batch as $value) {
            $prepare_values[] = array(
                'id' => $value[0],
                'identifier' => $value[1],
                'name' => $value[2],
                'website' => $value[3],
                'country' => $value[4],
                'description' => $value[5],
                'founded' => $value[6],
                'industry' => $value[7],
                'employees' => $value[8]
            );
            $update_fields[] = 'name = VALUES(name), website = VALUES(website), country = VALUES(country), description = VALUES(description), founded = VALUES(founded), industry = VALUES(industry), employees = VALUES(employees)';
        }

        $fields = array_keys($prepare_values[0]);
        $treated_values = '(' . implode(', ', array_fill(0, count($fields), '?')) . ')';

        $sqlImport = "INSERT INTO organizations (" . implode(', ', $fields) . ") VALUES " . implode(', ', array_fill(0, count($prepare_values), $treated_values)) . " ON DUPLICATE KEY UPDATE " . implode(', ', $update_fields);

        if ($this->conectar()) {
            $st = $this->getCon()->prepare($sqlImport);

            $registry_values = array();

            foreach ($prepare_values as $record) {
                $registry_values = array_merge($registry_values, array_values($record));
            }

            return $st->execute($registry_values);
        }

        return false;
    }

    protected function totalLargeOrcsByNameDAO()
    {
        if ($this->conectar()) {
            try {

                $stms = $this->getCon()->prepare(
                    'SELECT 
                        COUNT(*) AS total 
                    FROM 
                        `organizations`
                    WHERE
                        `employees` > 5000
                    '
                );

                $stms->execute();
                $result = $stms->fetch(\PDO::FETCH_ASSOC);

                if (!empty($result))
                    return $result['total'];


            } catch (\PDOException $e) {
                $this->setLog("DATABASE | " . $e->getMessage(), false, false);
            }
        }

        return 0;
    }

    protected function getLargeOrcsByNameDAO($start, $offset)
    {
        $sql =
            "SELECT 
                * 
            FROM 
                `organizations` 
            WHERE
                `employees` > 5000
            ORDER BY name
            LIMIT :start, :offset;";

        if ($this->conectar()) {
            $st = $this->getCon()->prepare($sql);
            $st->bindValue(':start', $start, \PDO::PARAM_INT);
            $st->bindValue(':offset', $offset, \PDO::PARAM_INT);

            $st->execute();

            return $st->fetchAll(\PDO::FETCH_ASSOC);
        }

        return false;

    }

    protected function totalOldOrcsByDateDAO()
    {
        if ($this->conectar()) {
            try {

                $stms = $this->getCon()->prepare(
                    'SELECT 
                        COUNT(*) AS total 
                    FROM 
                        `organizations` 
                    WHERE
                        founded < 2000
                            AND
                        employees < 1000
                    ORDER BY founded;
                    '
                );

                $stms->execute();
                $result = $stms->fetch(\PDO::FETCH_ASSOC);

                if (!empty($result))
                    return $result['total'];


            } catch (\PDOException $e) {
                $this->setLog("DATABASE | " . $e->getMessage(), false, false);
            }
        }

        return 0;
    }
    protected function paginateOldOrcsByDateDAO($start, $offset)
    {
        $sql =
            "SELECT 
                * 
            FROM 
                `organizations` 
            WHERE
                founded < 2000
                    AND
                employees < 1000
            ORDER BY founded
            LIMIT :start, :offset;";

        if ($this->conectar()) {
            $st = $this->getCon()->prepare($sql);
            $st->bindValue(':start', $start, \PDO::PARAM_INT);
            $st->bindValue(':offset', $offset, \PDO::PARAM_INT);

            $st->execute();

            return $st->fetchAll(\PDO::FETCH_ASSOC);
        }

        return false;
    }

    protected function totalEmpOrcsByEmpDAO()
    {
        if ($this->conectar()) {
            try {

                $stms = $this->getCon()->prepare(
                    'SELECT 
                        COUNT(*) AS total
                    FROM 
                        `organizations` 
                    GROUP BY industry, country
                    ORDER BY industry;
                    '
                );

                $stms->execute();
                return $stms->rowCount();

            } catch (\PDOException $e) {
                $this->setLog("DATABASE | " . $e->getMessage(), false, false);
            }
        }

        return 0;
    }
    protected function paginateEmpOrcsByEmpDAO($start, $offset)
    {
        $sql =
            "SELECT 
                industry, country,
                COUNT(*) AS total_organizations, sum(employees) as employees
            FROM 
                `organizations` 
            GROUP BY industry, country
            ORDER BY industry
        LIMIT :start, :offset;";

        if ($this->conectar()) {
            $st = $this->getCon()->prepare($sql);
            $st->bindValue(':start', $start, \PDO::PARAM_INT);
            $st->bindValue(':offset', $offset, \PDO::PARAM_INT);

            $st->execute();

            return $st->fetchAll(\PDO::FETCH_ASSOC);
        }

        return false;
    }

}