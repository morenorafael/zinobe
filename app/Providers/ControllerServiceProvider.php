<?php

namespace App\Providers;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Request\LoginRequest;
use App\Services\Auth;
use App\Services\Session;
use App\Services\View;
use League\Container\ServiceProvider\AbstractServiceProvider;

class ControllerServiceProvider extends AbstractServiceProvider
{
    /**
     * @var array
     */
    protected $provides = [
        HomeController::class,
        LoginController::class,
    ];

    /**
     *
     */
    public function register()
    {
        $this->getContainer()->add(HomeController::class)->addArguments([
            $this->getContainer()->get(View::class)
        ]);

        $this->getContainer()->add(LoginController::class)->addArguments([
            $this->getContainer()->get(View::class),
            $this->getContainer()->get(LoginRequest::class),
            $this->getContainer()->get(Session::class),
            $this->getContainer()->get(Auth::class),
        ]);
    }
}