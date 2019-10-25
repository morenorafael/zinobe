<?php

namespace App\Providers;

use App\Services\Session;
use App\Services\View;
use League\Container\ServiceProvider\AbstractServiceProvider;

class ViewServiceProvider extends AbstractServiceProvider
{
    /**
     * @var array
     */
    protected $provides = [
        View::class,
    ];

    /**
     *
     */
    public function register()
    {
        $this->getContainer()->add(View::class)
            ->addArguments([
                $this->getContainer()->get('response'),
                $this->getContainer()->get(Session::class),
            ]);
    }
}