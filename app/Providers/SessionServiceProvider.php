<?php

namespace App\Providers;

use App\Services\Session;
use League\Container\ServiceProvider\AbstractServiceProvider;

class SessionServiceProvider extends AbstractServiceProvider
{
    /**
     * @var array
     */
    protected $provides = [
        Session::class
    ];

    /**
     *
     */
    public function register()
    {
        $this->getContainer()->add(Session::class);
    }
}