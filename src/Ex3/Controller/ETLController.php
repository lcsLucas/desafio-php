<?php

namespace Ex3\Controller;

use Ex3\Model\ETL;

class ETLController
{
    public function index()
    {
        $option = "";

        if (filter_has_var(INPUT_GET, "option")) {

            $option = filter_input(INPUT_GET, "option", FILTER_SANITIZE_STRING);

            switch ($option) {
                case 'etl':
                    $model = new ETL();
                    $model->proccessETL();
                    break;
                case 'query1':
                    $model = new ETL();
                    $model->getLargeOrcsByName();
                    break;
                case 'query2':
                    $model = new ETL();
                    $model->getOldOrcsByDate();
                    break;
                case 'query3':
                    $model = new ETL();
                    $model->getEmpOrcsByEmp();
                    break;
            }

        }

        require_once __DIR__ . '/../Views/index.php';
    }
}