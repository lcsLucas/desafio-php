<?php

namespace Ex4\Controller;

use Ex4\Patterns\GatewayFactory;
use Ex4\Patterns\PaymentObserver;
use Ex4\Notifiers\EmailNotifier;
use Ex4\Notifiers\SmsNotifier;

class GatewayController
{
    public function index()
    {
        require_once __DIR__ . '/../Views/index.php';
    }

    public function processPayment()
    {
        $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);

        try {
            $paymentStatus = new PaymentObserver();

            $paymentStatus->attach(new SmsNotifier());
            $paymentStatus->attach(new EmailNotifier());

            $payment = GatewayFactory::createGateway($type);
            $paymentStatus->processPayment($payment, 100);

        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

    }

}