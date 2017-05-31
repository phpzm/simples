<?php

use Simples\Persistence\Drivers\MySQL;

return [
    'default' => [
        'driver' => MySQL::class,
        'host' => env('MYSQL_DEFAULT_HOST'),
        'database' => env('MYSQL_DEFAULT_DATABASE'),
        'port' => env('MYSQL_DEFAULT_PORT'),
        'user' => env('MYSQL_DEFAULT_USER'),
        'password' => env('MYSQL_DEFAULT_PASSWORD'),
        'options' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ]
    ]
];
