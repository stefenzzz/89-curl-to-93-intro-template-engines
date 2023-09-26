<?php

declare(strict_types = 1);

use App\Entity\{Invoice,InvoiceItem};
use App\Enums\InvoiceStatus;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;
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

$queryBuilder = $entityManager->createQueryBuilder();

// DQL:
// WHERE amount > :amount AND (status = :status OR created_at >= :date)

//======== Copy Manual Expression and Echo Doctrine Query Language ==============

// $query = $queryBuilder
//     ->select('i')
//     ->from(Invoice::class, 'i')
//     ->where(
//         $queryBuilder->expr()->andX(
//             $queryBuilder->expr()->gt('i.amount',':amount'),
//             $queryBuilder->expr()->orX(
//                 $queryBuilder->expr()->eq('i.status',':status'),
//                 $queryBuilder->expr()->gte('i.createdAt',':date')
//             )
//         )
//     )
//     ->setParameter('amount',100)
//     ->setParameter('status',InvoiceStatus::Paid->value)
//     ->setParameter('date','2023-09-10')
//     ->orderBy('i.createdAt','desc')
//     ->getQuery();



// echo $query->getDQL(). PHP_EOL;

// ============ Regular Query Builder ================

// $query = $queryBuilder
//     ->select('i')
//     ->from(Invoice::class, 'i')
//     ->where('i.amount > :amount')
//     ->setParameter('amount',100)
//     ->orderBy('i.createdAt','desc')
//     ->getQuery();

// $invoices = $query->getResult();



// /**
//  * @var Invoice #invoice
//  */
// foreach($invoices as $invoice){
  

//     echo $invoice->getCreatedAt()->format('m/d/y g:ia')
//     .', '. $invoice->getAmount()
//     .', '. $invoice->getStatus()->toString(). PHP_EOL;

// }



// ============ Inner Join ================

$query = $queryBuilder
    ->select('i','it')
    ->from(Invoice::class, 'i')
    ->join('i.items','it')
    ->where(
        $queryBuilder->expr()->andX(
            $queryBuilder->expr()->gt('i.amount',':amount'),
            $queryBuilder->expr()->orX(
                $queryBuilder->expr()->eq('i.status',':status'),
                $queryBuilder->expr()->gte('i.createdAt',':date')
            )
        )
    )
    ->setParameter('amount',100)
    ->setParameter('status',InvoiceStatus::Paid->value)
    ->setParameter('date','2023-09-10')
    ->orderBy('i.createdAt','desc')
    ->getQuery();

$invoices = $query->getResult();
/**
 * @var Invoice #invoice
 */
foreach($invoices as $invoice){
  

    echo $invoice->getCreatedAt()->format('m/d/y g:ia')
    .', '. $invoice->getAmount()
    .', '. $invoice->getStatus()->toString(). PHP_EOL;

    foreach($invoice->getItems() as $item){
        echo ' - '. $item->getDescription()
            .', '. $item->getQuantity()
            .', '. $item->getUnitPrice(). PHP_EOL;
    }

}
