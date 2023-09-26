<?php

declare(strict_types = 1);

use App\Entity\{Invoice,InvoiceItem};
use App\Enums\InvoiceStatus;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\Setup;
use Dotenv\Dotenv;


require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


$connectionParams =[
    'dbname' => $_ENV['DB_DATABASE'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'host' => $_ENV['DB_HOST'],
    'driver' => $_ENV['DB_DRIVER'] ?? 'pdo_mysql',
    
];

$connection = DriverManager::getConnection($connectionParams);
$entityManager = new EntityManager($connection,ORMSetup::createAttributeMetadataConfiguration([__DIR__.'/Entity']) );



// $items =[['item 1', 1 ,15], ['item 2', 2, 7.5], ['item 3', 4, 3.75]];

// $invoice = (new Invoice)
//             ->setAmount(45)
//             ->setInvoiceNumber('1')
//             ->setStatus(InvoiceStatus::Pending)
//             ->setCreatedAt(new DateTime());



// foreach($items as [$description, $quantity, $unitPrice]){
//     $item = (new InvoiceItem())
//             ->setDescription($description)
//             ->setQuantity($quantity)
//             ->setUnitPrice($unitPrice);

//     $invoice->addItem($item);

// }


// $entityManager->persist($invoice);

$invoice = $entityManager->find(Invoice::class,6);
// $invoice->setStatus(InvoiceStatus::Paid);

// $invoice->getItems()->get(0)->setDescription('foo bar');

var_dump($invoice->getId());

echo $entityManager->getUnitOfWork()->size().PHP_EOL;

// $entityManager->flush();


