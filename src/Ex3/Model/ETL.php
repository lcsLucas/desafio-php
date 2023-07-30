<?php

namespace Ex3\Model;

use Ex3\Dao\ETLDao;

class ETL extends ETLDao
{

    private $filename;
    private $lastError;
    public function __construct()
    {
        $this->filename = ABSPATH . '/.data/exercicio-3/organizations-100000.csv';
    }

    public function getLastError()
    {
        return $this->lastError;
    }

    private function setError($error, $flagLog = true)
    {
        $this->lastError = $error;

        if ($flagLog)
            $this->setLog($error, false, false);
    }

    private function migrateTable()
    {
        if (!$this->migrateCreateTable()) {

            $this->setError("Erro ao fazer a migração da tabela do ETL", false);

            return false;
        }

        return true;
    }

    private function importDataEfficiently()
    {
        /**
            // Caminho para o arquivo CSV contendo os dados a serem inseridos em lote
            $arquivo_csv = 'caminho/do/arquivo.csv';

            $sql = "LOAD DATA INFILE :arquivo_csv 
                    INTO TABLE tabela 
                    FIELDS TERMINATED BY ',' 
                    LINES TERMINATED BY '\n' 
                    (coluna1, coluna2, coluna3)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':arquivo_csv', $arquivo_csv);
            $stmt->execute();
         */
    }

    private function importDataInefficient()
    {
        if ($file = fopen($this->filename, "r")) {

            $i = 0;
            $num_columns = 0;
            $batch = [];

            while (($data = fgetcsv($file, 1024, ",")) !== false) {

                $data_values = array_filter($data);

                if (!empty($data_values)) {
                    if ($i === 0)
                        $num_columns = count($data);
                    else if (count($data_values) === $num_columns) {

                        $batch[] = $data_values;

                        if (count($batch) >= 300) {
                            $this->insertBatchDAO($batch);
                            $batch = [];
                        }

                    } else {
                        $this->setError("Não foi possível importar o registro da linha: " . $i . " (números de colunas difere da quantidade de coluna do cabeçalho)");
                    }

                }

                $i++;

            }

            if (!empty($batch))
                $this->insertBatchDAO($batch);

            return true;

        } else {
            $this->setError(error_get_last()['message']);
        }

        return false;
    }

    public function processETL()
    {
        if (file_exists($this->filename)) {
            if ($this->migrateTable()) {
                if ($this->importDataInefficient()) {
                    return true;
                }
            }
        } else {
            $this->setError("Arquivo Fonte dos dados não encontrado. Verifique se o arquivo está dentro da pasta do projeto: \"" . ABSPATH . "/.data/" . DIR . "/organizations-100000.csv\"");
        }

        return false;
    }

    public function totalLargeOrcsByName()
    {
        return $this->totalLargeOrcsByNameDAO();
    }
    public function paginateLargeOrcsByName($start, $offset)
    {
        return $this->getLargeOrcsByNameDAO($start, $offset);
    }
    public function totalOldOrcsByDate()
    {
        return $this->totalOldOrcsByDateDAO();
    }
    public function paginateOldOrcsByDate($start, $offset)
    {
        return $this->paginateOldOrcsByDateDAO($start, $offset);
    }
    public function totalEmpOrcsByEmp()
    {
        return $this->totalEmpOrcsByEmpDAO();
    }
    public function paginateEmpOrcsByEmp($start, $offset)
    {
        return $this->paginateEmpOrcsByEmpDAO($start, $offset);
    }

}