<?php

namespace App\Providers;

use App\Http\Controllers\HomeController;
use App\Services\View;
use League\Container\ServiceProvider\AbstractServiceProvider;

class ControllerServiceProvider extends AbstractServiceProvider
{
    /**
     * @var array
     */
    protected $provides = [
        HomeController::class,
    ];

    /**
     *
     */
    public function register()
    {
        $this->getContainer()->add(HomeController::class)->withArguments([
            $this->getContainer()->get(View::class)
        ]);
    }
}