<?php

declare(strict_types = 1);

namespace App;

class Config
{
    protected array $config = [];

    public function __construct(array $env)
    {
        $this->config = [
            'db' =>[
                'host' => $_ENV['DB_HOST'],
                'username' => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASS'],
                'database' => $_ENV['DB_DATABASE'],
                'driver' => $_ENV['DB_DRIVER'] ?? 'mysql',
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
            ],
            'mailer' =>[
                'dsn' => $env['MAILER_DSN']
            ],
            'apiKeys' =>[
                'emailable' => $env['EMAILABLE_API_KEY'],
                'abstract_api' => $env['ABSTRACT_API_KEY']
            ]
        ];
    }

    public function __get($name)
    {
        return $this->config[$name] ?? null;
    }
}