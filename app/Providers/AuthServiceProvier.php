<?php

namespace App\Providers;

use App\Services\Auth;
use App\Services\Session;
use League\Container\ServiceProvider\AbstractServiceProvider;

class AuthServiceProvier extends AbstractServiceProvider
{
    /**
     * @var array
     */
    protected $provides = [
        Auth::class
    ];

    /**
     *
     */
    public function register()
    {
        $this->getContainer()->add(Auth::class)
            ->addArgument($this->getContainer()->get(Session::class));
    }
}