<?php

namespace Ex4\Notifiers;

class EmailNotifier implements \SplObserver
{
    public function update(\SplSubject $subject)
    {
        $paymentStatus = $subject->getStatus();
        echo "* Enviando e-mail de notificação sobre o status do pagamento: " . ($paymentStatus ? 'Aprovado' : 'Reprovado') . "<br><br>";
    }
}