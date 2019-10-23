<?php

use App\Http\Middleware\Authenticate;
use App\Providers\ControllerServiceProvider;
use App\Providers\SessionServiceProvider;
use App\Providers\ViewServiceProvider;
use App\Services\Session;
use Dotenv\Dotenv;
use League\Container\Container;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory;

require __DIR__ . '/../vendor/autoload.php';

$dotEnv = new Dotenv(__DIR__ . '/../');
$dotEnv->load();

$container = new Container;

$container->share('response', Response::class);
$container->share('request', function () {
    return ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
});

// Providers
$container->addServiceProvider(SessionServiceProvider::class);
$container->addServiceProvider(ViewServiceProvider::class);
$container->addServiceProvider(ControllerServiceProvider::class);

// Middleware
$container->share(Authenticate::class)->withArgument($container->get(Session::class));

$route = require __DIR__ . '/../routes/web.php';

$container->share('emitter', Response\SapiEmitter::class);;

$response = $route->dispatch($container->get('request'), $container->get('response'));

$container->get('emitter')->emit($response);