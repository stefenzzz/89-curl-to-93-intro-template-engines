<?php

declare(strict_types = 1);


require __DIR__ .'/../vendor/autoload.php';
define('VIEWS_PATH',__DIR__.'/../Views');
define('STORAGE_PATH',__DIR__.'/../Storage');





use App\{App,Router,View,Config};
use App\PHP_8_1_Examples\Enum\{PaymentStatus,Payment};
use App\Controllers\{HomeController,InvoiceController,GeneratorExample, GuzzleController, UserController};
use Illuminate\Container\Container;

$container = new Container();
$router = new Router($container);




$router->listRouteControllers(
    [
        HomeController::class,
        GeneratorExample::class,
        InvoiceController::class,
        UserController::class,
        GuzzleController::class,
    ]
);


(new App(
    $container,
    $router,
    ['requestUri' => $_SERVER['REQUEST_URI'], 'requestMethod' => $_SERVER['REQUEST_METHOD']],
))->boot()->run();

