<?php

namespace Ex3\Model;

class Log
{
    private $mensagem;
    private $exibir;
    private $status;
    private $extra;

    /**
     * Retorno constructor.
     * @param $mensagem
     * @param $exibir
     * @param $status
     * @param $extra
     */
    public function __construct($mensagem = '', $exibir = false, $status = false, $extra = array())
    {
        $this->mensagem = $mensagem;
        $this->exibir = $exibir;
        $this->status = $status;
        $this->extra = $extra;
    }


    public function setLog($mensagem, $exibir, $status, $extra = array())
    {
        $this->mensagem = $mensagem;
        $this->exibir = $exibir;
        $this->status = $status;
        $this->extra = $extra;

        error_log('[' . date('Y-m-d H:i:s') . '] ' . $mensagem . PHP_EOL, 3, ABSPATH . '/.data/exercicio-3/' . 'error-etl.log');

    }

    public function setExtra($extra)
    {
        $this->extra = $extra;
    }

    public function getLog()
    {
        return array(
            'status' => $this->status,
            'mensagem' => $this->mensagem,
            'exibir' => $this->exibir,
            'extra' => json_encode($this->extra)
        );
    }

}