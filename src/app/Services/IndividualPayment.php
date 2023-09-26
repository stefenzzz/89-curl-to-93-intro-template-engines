<?php

declare(strict_types = 1);

namespace App\Services;

class IndividualPayment
{
    public function charge(array $customer, float $amount, float $tax): bool
    {
        // sleep(1);

        echo 'Process by Individual Payment <br>';

        return (bool) 1;
    }
}