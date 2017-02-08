<?php

use Simples\Core\Route\Router;
use Simples\Core\Kernel\HttpHandler;
use Simples\Core\Message\Lang;

/**
 * @param Router $router
 */
return function (Router $router) {

    // welcome
    $router->get('/', function () {
        /** @var HttpHandler $this */
        return $this->view('index.php');
    });

    // whoops, not found
    $router->otherWise('*', function () {
        return 'Whoops!' . PHP_EOL;
    });
};
