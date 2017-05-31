<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Simples\Kernel\App;

$options = [
    'root' => dirname(__DIR__),
    'strict' => true,
    'lang' => [
        'default' => 'pt-br',
        'fallback' => 'en'
    ]
];

$app = new App($options);

$app->http();
