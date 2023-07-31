<?php

namespace Ex4\Model;

use Ex4\Patterns\GatewayStrategy;

class CreditCardPayment implements GatewayStrategy
{
    public function process($amount)
    {
        // processo de pagamento fictício
        sleep(rand(2, 4));

        $paymentStatus = [true, true, true, true, false];

        return $paymentStatus[array_rand($paymentStatus)];
    }
}