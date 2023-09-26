<?php

require 'vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\Migrations\Configuration\Connection\ExistingConnection;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

$config = new PhpFile('migrations.php'); // Or use one of the Doctrine\Migrations\Configuration\Configuration\* loaders


$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


$connectionParams =[
    'dbname' => $_ENV['MIGRATION_DATABASE'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'host' => $_ENV['DB_HOST'],
    'driver' => $_ENV['DB_DRIVER'] ?? 'pdo_mysql',
    
];

$connection = DriverManager::getConnection($connectionParams);
$entityManager = new EntityManager($connection,ORMSetup::createAttributeMetadataConfiguration([__DIR__.'/App/Entity']) );


return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));