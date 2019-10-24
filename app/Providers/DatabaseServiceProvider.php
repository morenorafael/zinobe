<?php

namespace App\Providers;

use Illuminate\Database\Capsule\Manager;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class DatabaseServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    public function boot()
    {
        $manager = new Manager();
        $manager->addConnection([
            'driver' => 'mysql',
            'host' => getenv('DB_HOST'),
            'database' => getenv('DB_DATABASE'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix' => '',
        ]);

        $manager->bootEloquent();
    }

    public function register()
    {
        // TODO: Implement register() method.
    }
}