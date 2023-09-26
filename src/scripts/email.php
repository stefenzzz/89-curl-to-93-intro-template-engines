<?php

declare(strict_types = 1);

use App\App;
use App\Container;
use App\Router;
use App\Services\EmailService;

require __DIR__ .'/../vendor/autoload.php';

$container = new Container();
$router = new Router($container);

(new App($container))->boot();

$container->get(EmailService::class)->sendQueuedEmails();

