<?php

declare(strict_types = 1);

use Doctrine\DBAL\ArrayParameterType;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Column;
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

$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);

//======= check date in between  =====

$stmt = $conn->prepare('
    SELECT * from invoices
    WHERE created_at BETWEEN :from AND :to
');

$from = new DateTime('2022-9-10');
$to = new DateTime('2023-9-10');
$stmt->bindValue(':from',$from, 'datetime');
$stmt->bindValue(':to',$to, 'datetime');

$result = $stmt->executeQuery();

var_dump($result->fetchAllAssociative());


//======= check array of ids ========


$ids = [1,2,3];
$result = $conn->executeQuery('SELECT * from invoices WHERE id IN (?)',[$ids],[ArrayParameterType::INTEGER]);
var_dump($result->fetchAllAssociative());

//======= Query Build ========   

$builder = $conn->createQueryBuilder();

$invoices = $builder->select('id','amount')
                    ->from('invoices')
                    ->where('id = ?')
                    ->setParameter(0,1)
                    ->fetchAllAssociative();
var_dump($invoices);


//======= Tables ========   


$schema = $conn->createSchemaManager();

var_dump($schema->listTableNames());

var_dump(array_map(fn(Column $column)=> $column->getname() ,$schema->listTableColumns('invoices')));
