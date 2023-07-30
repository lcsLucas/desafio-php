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

                    if (!empty($_SESSION["etl"]) || $model->processETL()) {
                        $_SESSION["etl"] = true;
                        $success = "Importação realizada com sucesso.";
                    } else
                        $error = $model->getLastError();

                    break;
                case 'query1':

                    $current_page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
                    $current_page = empty($current_page) ? 1 : $current_page;

                    $qtde_registry = 15;

                    $range_pages = 2;

                    $start_registry = ($current_page - 1) * $qtde_registry;

                    $model = new ETL();

                    $data = $model->paginateLargeOrcsByName($start_registry, $qtde_registry);
                    $total_registry = $model->totalLargeOrcsByName();

                    break;
                case 'query2':

                    $current_page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
                    $current_page = empty($current_page) ? 1 : $current_page;

                    $qtde_registry = 15;

                    $range_pages = 2;

                    $start_registry = ($current_page - 1) * $qtde_registry;

                    $model = new ETL();

                    $data = $model->paginateOldOrcsByDate($start_registry, $qtde_registry);
                    $total_registry = $model->totalOldOrcsByDate();

                    break;
                case 'query3':

                    $current_page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
                    $current_page = empty($current_page) ? 1 : $current_page;

                    $qtde_registry = 15;

                    $range_pages = 2;

                    $start_registry = ($current_page - 1) * $qtde_registry;

                    $model = new ETL();

                    $data = $model->paginateEmpOrcsByEmp($start_registry, $qtde_registry);
                    $total_registry = $model->totalEmpOrcsByEmp();

                    break;
            }

        }

        require_once __DIR__ . '/../Views/index.php';
    }
}