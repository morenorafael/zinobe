<?php

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Request\LoginRequest;
use App\Providers\AuthServiceProvier;
use App\Providers\ControllerServiceProvider;
use App\Providers\DatabaseServiceProvider;
use App\Providers\RequestServiceProvider;
use App\Providers\SessionServiceProvider;
use App\Providers\ViewServiceProvider;
use App\Services\Session;
use App\Tools\TwigFunctions;
use Aura\Session\SessionFactory;
use Dotenv\Dotenv;
use League\Container\Container;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

require __DIR__ . '/../vendor/autoload.php';

$dotEnv = Dotenv::create(__DIR__ . '/../');
$dotEnv->load();

$container = new Container;

$container->share('response', Response::class);
$container->share('request', function () {
    return ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
});

$container->share('session', function () {
    return (new SessionFactory())->newInstance($_COOKIE);
});

// Providers
$container->addServiceProvider(RequestServiceProvider::class);
$container->addServiceProvider(SessionServiceProvider::class);
$container->addServiceProvider(AuthServiceProvier::class);
$container->addServiceProvider(ViewServiceProvider::class);
$container->addServiceProvider(ControllerServiceProvider::class);
$container->addServiceProvider(DatabaseServiceProvider::class);

$container->share('SharedContainerTwig', TwigFunctions::class)
    ->addArguments([
        $container->get(Session::class),
        $container->get(LoginRequest::class),
    ]);

// Middleware
$container->share(Authenticate::class)->addArgument($container->get(Session::class));
$container->share(RedirectIfAuthenticated::class)->addArgument($container->get(Session::class));

$route = require __DIR__ . '/../routes/web.php';

$container->share('emitter', SapiEmitter::class);

$response = $route->dispatch($container->get('request'));

$container->get('emitter')->emit($response);
