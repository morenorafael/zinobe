<?php

use App\Http\Middleware\Authenticate;
use League\Route\RouteGroup;
use League\Route\Router;
use League\Route\Strategy\ApplicationStrategy;

$strategy = (new ApplicationStrategy())->setContainer($container);
$route = (new Router)->setStrategy($strategy);

$route->group('/', function (RouteGroup $route) use ($container) {
    $route->map('GET', '/', 'App\Http\Controllers\HomeController::index');

    $route->map('GET', '/login', 'App\Http\Controllers\Auth\LoginController::showFormLogin');
    $route->map('POST', '/login', 'App\Http\Controllers\Auth\LoginController::login');
    $route->map('POST', '/logout', 'App\Http\Controllers\Auth\LoginController::logout');
});

return $route;
