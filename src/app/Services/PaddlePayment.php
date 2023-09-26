<?php

declare(strict_types = 1);

namespace App\Services;

class PaddlePayment implements PaymentGatewayServiceInterface
{
    public function charge(array $customer, float $amount, float $tax): bool
    {
        // sleep(1);

        echo 'Process by Paddle Payment <br>';

        return (bool) 1;
    }
}