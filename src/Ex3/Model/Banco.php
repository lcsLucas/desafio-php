<?php

namespace Ex3\Model;

class Banco extends Log
{
    /**
     * constantes definida no config.php, carregado no inicio.
     */
    private $usuario;
    private $senha;
    private $dsn;
    private $con;

    public function __construct()
    {
        $this->usuario = $_ENV['DB_USERNAME'];
        $this->senha = $_ENV['DB_PASSWORD'];
        $this->dsn = $_ENV['DB_CONNECTION'] . ':host=' . $_ENV['DB_HOST'] . ';port=' . $_ENV['DB_PORT'] . ';dbname=' . $_ENV['DB_DATABASE'] . ';charset=utf8';
    }

    public function conectar($persist = false)
    {
        if (empty($this->getCon())):

            try {
                // verifica se a conexao deve ser persistente ou nao. Util quando deve ser feito varias operações
                // em uma mesma conexao aberta. Ex: varias transações de uma fez e uma entrelaçada na outra
                if ($persist):
                    $this->con = new \PDO($this->dsn, $this->usuario, $this->senha, array(\PDO::ATTR_PERSISTENT => TRUE));
                else:
                    $this->con = new \PDO($this->dsn, $this->usuario, $this->senha);
                endif;

                $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $this->con->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

                return true;
            } catch (\PDOException $e) {
                $this->setLog('DATABASE | ' . $e->getMessage(), false, false);
                return null;
            }

        else:
            return true;

        endif;
    }

    public function getCon(): ?\PDO
    {
        return $this->con;
    }

    public function beginTransaction()
    {
        $this->con->beginTransaction();
    }

    public function getLastInsertId()
    {
        return $this->con->lastInsertId();
    }

    public function commitar($resp)
    {
        if ($resp) {
            return $this->con->commit();
        } else {
            return $this->con->rollBack();
        }
    }

    public function desconectar()
    {
        return $this->con = null;
    }
}