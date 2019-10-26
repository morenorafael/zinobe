<?php

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;
use League\Route\RouteGroup;
use League\Route\Router;
use League\Route\Strategy\ApplicationStrategy;

$strategy = (new ApplicationStrategy())->setContainer($container);
$route = (new Router)->setStrategy($strategy);

$route->group('/', function (RouteGroup $route) use ($container) {
    $route->map('GET', '/', 'App\Http\Controllers\HomeController::index')
    ->middleware($container->get(Authenticate::class));

    $route->map('GET', '/login', 'App\Http\Controllers\Auth\LoginController::showFormLogin')
        ->middleware($container->get(RedirectIfAuthenticated::class));
    $route->map('POST', '/login', 'App\Http\Controllers\Auth\LoginController::login')
        ->middleware($container->get(RedirectIfAuthenticated::class));

    $route->map('POST', '/logout', 'App\Http\Controllers\Auth\LoginController::logout')
        ->middleware($container->get(RedirectIfAuthenticated::class));

    $route->map('GET', '/register', 'App\Http\Controllers\Auth\RegisterController::showFormRegister')
        ->middleware($container->get(RedirectIfAuthenticated::class));
    $route->map('POST', '/register', 'App\Http\Controllers\Auth\RegisterController::register')
        ->middleware($container->get(RedirectIfAuthenticated::class));
});

return $route;
