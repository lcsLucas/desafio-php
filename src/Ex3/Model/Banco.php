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

    private static $instance;

    private function __construct($persist = false)
    {
        $this->usuario = $_ENV['DB_USERNAME'];
        $this->senha = $_ENV['DB_PASSWORD'];
        $this->dsn = $_ENV['DB_CONNECTION'] . ':host=' . $_ENV['DB_HOST'] . ';port=' . $_ENV['DB_PORT'] . ';dbname=' . $_ENV['DB_DATABASE'] . ';charset=utf8';

        try {
            if ($persist):
                $this->con = new \PDO($this->dsn, $this->usuario, $this->senha, array(\PDO::ATTR_PERSISTENT => TRUE));
            else:
                $this->con = new \PDO($this->dsn, $this->usuario, $this->senha);
            endif;

            $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->con->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            $this->setLog('DATABASE | ' . $e->getFile() . ":" . $e->getLine() . ' | ' . $e->getMessage(), false, false);
        }

    }

    public function conectar($persist = false)
    {
        if (!self::$instance)
            self::$instance = new Banco();

        return !empty(self::$instance->getCon());
    }

    public static function getCon(): ?\PDO
    {
        return self::$instance->con;
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