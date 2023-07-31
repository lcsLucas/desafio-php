<?php

namespace Ex4\Patterns;

interface GatewayStrategy
{
    public function process($amount);
}