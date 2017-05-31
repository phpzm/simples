<?php

use App\Controller\View;
use Simples\Route\Router;

/**
 * @param Router $router
 */
return function (Router $router) {

    // home
    $router->get('/',[View::class, 'home']);

    // whoops, not found
    $router->otherWise('*', View::class);
};
