<?php

namespace Ex4\Patterns;

class PaymentObserver implements \SplSubject
{
    /**
     * Apenas para Exemplo (melhor abordagem seria utilizar banco de dados)
     */
    private $observers = [];
    private $status;

    public function attach(\SplObserver $observer)
    {
        $this->observers[] = $observer;
    }
    public function detach(\SplObserver $observer)
    {
        $index = array_search($observer, $this->observers);

        if ($index !== false) {
            unset($this->observers[$index]);
        }
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function processPayment(GatewayStrategy $paymentMethod, $amount)
    {
        echo "* Iniciando processamento do pagamento...<br><br>";

        $this->status = $paymentMethod->process($amount);

        echo "* Processamento do pagamento concluído. Status: " . ($this->status ? 'Aprovado' : 'Reprovado') . "<br><br>";

        // Notifica os observadores sobre o status do pagamento
        if ($this->status)
            $this->notify();
    }

    public function getStatus()
    {
        return $this->status;
    }

}