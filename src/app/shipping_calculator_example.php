<?php

declare(strict_types = 1);

use App\Services\Shipping\BillableWeightCalculationService;
use App\Services\Shipping\DimDivisor;
use App\Services\Shipping\PackageDimension;
use App\Services\Shipping\Weight;

require __DIR__ .'/../vendor/autoload.php';

$package = [
    'weight' => 6,
    'dimension' => [
        'width' => 9,
        'length' => 15,
        'height' => 7,
    ]
];

$packageDimensions = new PackageDimension(
    $package['dimension']['width'],
    $package['dimension']['height'],
    $package['dimension']['length'],);

$widerPackageDimension = $packageDimensions->increaseWidth(10);

$weight = new Weight($package['weight']);

$billableWeightService = new BillableWeightCalculationService();

$billableWeight = $billableWeightService->calculate(
    $packageDimensions,
    $weight,
    DimDivisor::FEDEX
);

$widerBillableWeight = $billableWeightService->calculate(
    $widerPackageDimension,
    $weight,
    DimDivisor::FEDEX
);



echo $billableWeight . ' lb' . PHP_EOL;
echo $widerBillableWeight . ' lb' . PHP_EOL;


