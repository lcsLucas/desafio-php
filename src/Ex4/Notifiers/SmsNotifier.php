<?php

namespace Ex4\Notifiers;

class SmsNotifier implements \SplObserver
{
    public function update(\SplSubject $subject)
    {
        $paymentStatus = $subject->getStatus();
        echo "* Enviando SMS de notificação sobre o status do pagamento: " . ($paymentStatus ? 'Aprovado' : 'Reprovado') . "<br><br>";
    }
}