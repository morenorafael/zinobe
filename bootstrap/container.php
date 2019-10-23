<?php

use App\Providers\SessionServiceProvider;
use App\Providers\ViewServiceProvider;
use Dotenv\Dotenv;
use League\Container\Container;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory;

require __DIR__ . '/../vendor/autoload.php';

$dotEnv = Dotenv::create(__DIR__ . '/../');
$dotEnv->load();

$container = new Container;

$container->share('response', Response::class);
$container->share('request', function () {
    return ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
});

$container->addServiceProvider(SessionServiceProvider::class);
$container->addServiceProvider(ViewServiceProvider::class);

$route = require __DIR__ . '/../routes/web.php';
