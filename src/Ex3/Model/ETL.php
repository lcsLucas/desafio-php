<?php

namespace Ex3\Model;

use Ex3\Dao\ETLDao;

class ETL extends ETLDao
{

    private $filepath;

    private function migrateTable()
    {
        return $this->migrateCreateTable();
    }

    public function proccessETL()
    {
        if (file_exists(__DIR__ . '/../../../.data/exercicio-3/organizations-100000.csv')) {
            if ($this->migrateTable()) {

            }
            echo "achei o arquivo";
        } else {
            echo "não achei o arquivo";
        }
    }
    public function getLargeOrcsByName()
    {

    }
    public function getOldOrcsByDate()
    {

    }
    public function getEmpOrcsByEmp()
    {

    }

}