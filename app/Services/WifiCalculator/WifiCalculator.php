<?php

namespace App\Services\WifiCalculator;

use App\Services\InternetServiceProvider\InternetServiceProviderInterface;

class WifiCalculator
{
    private $serviceProvider;

    public function __construct(InternetServiceProviderInterface $serviceProvider)
    {
        $this->serviceProvider = $serviceProvider;
    }

    public function calculateInvoiceAmount($month = 1)
    {
        $this->serviceProvider->setMonth($month);
        return $this->serviceProvider->calculateTotalAmount();
    }
}
