<?php

use League\Route\RouteGroup;
use League\Route\Router;

$route = new Router;

$route->group('/', function (RouteGroup $route) use ($container) {
    $route->map('GET', '/', 'App\Http\Controllers\HomeController::index');
});

return $route;