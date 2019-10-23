<?php

use League\Route\RouteCollection;
use League\Route\RouteGroup;

$route = new RouteCollection($container);

$route->group('/', function (RouteGroup $route) use ($container) {
    $route->map('GET', '/', 'App\Http\Controllers\HomeController::index');
});

return $route;