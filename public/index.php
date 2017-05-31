<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Simples\Kernel\App;

$app = new App(['root' => dirname(__DIR__), 'strict' => true]);

$app->http();
