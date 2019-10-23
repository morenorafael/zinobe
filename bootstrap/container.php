<?php

use App\Providers\SessionServiceProvider;
use Dotenv\Dotenv;
use League\Container\Container;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory;

require __DIR__ . '/../vendor/autoload.php';

$dotEnv = new Dotenv(__DIR__ . '/../');

$concainer = new Container;

$concainer->share('response', Response::class);
$concainer->share('request', function () {
    return ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
});

$concainer->addServiceProvider(SessionServiceProvider::class);