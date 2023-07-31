<?php

namespace Ex4\Patterns;

use Ex4\Model\BoletoPayment;
use Ex4\Model\CreditCardPayment;
use Ex4\Model\DebitCardPayment;

class GatewayFactory
{
    public static function createGateway($option)
    {
        switch ($option) {
            case 'credit':
                return new CreditCardPayment();
            case 'debit':
                return new DebitCardPayment();
            case 'boleto':
                return new BoletoPayment();
            default:
                throw new \Exception("Nenhum Gateway de Pagamento selecionado");
        }
    }
}