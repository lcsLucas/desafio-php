<?php

namespace Ex3\Model;

class Banco
{
    /**
     * constantes definida no config.php, carregado no inicio.
     */
    private $usuario;
    private $senha;
    private $dsn;
    private $retorno;

    private $con;

    public function __construct()
    {
        $this->usuario = $_ENV['DB_USERNAME'];
        $this->senha = $_ENV['DB_PASSWORD'];
        $this->dsn = $_ENV['DB_CONNECTION'] . ':host=' . $_ENV['DB_HOST'] . ';port=' . $_ENV['DB_PORT'] . ';dbname=' . $_ENV['DB_DATABASE'] . ';charset=utf8';

        $this->retorno = new Retorno();
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
                $this->setRetorno('Erro Ao Conectar Com o Banco de Dados | ' . $e->getMessage(), false, false);
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

    /**
     * define o retorno da requisição
     * @param  string $mensagem = mensagem do retorno
     * @param  boolean $flag_exibir = flag que diz se é pra ser mostrado ao usuario a mensagem
     * @param  boolean $flag_status = flag que diz se o retono é um erro ou não
     * @return void
     */
    public function setRetorno($mensagem, $flag_exibir, $flag_status)
    {
        $this->retorno->setRetorno($mensagem, $flag_exibir, $flag_status);

        if (!$flag_exibir)
            error_log('[' . date('Y-m-d H:i:s') . '] ' . $mensagem . '\n', 3, __DIR__ . '/../' . 'error-etl.log');
    }

    public function getRetorno()
    {
        return $this->retorno->getRetorno();
    }

}