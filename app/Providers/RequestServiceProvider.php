<?php


namespace App\Providers;


use App\Http\Request\LoginRequest;
use App\Services\Request;
use League\Container\ServiceProvider\AbstractServiceProvider;
use Respect\Validation\Validator;

class RequestServiceProvider extends AbstractServiceProvider
{
    /**
     * @var array
     */
    protected $provides = [
        LoginRequest::class
    ];

    /**
     *
     */
    public function register()
    {
        $this->getContainer()->add(Validator::class);

        $this->getContainer()->add(LoginRequest::class)
            ->addArgument($this->getContainer()->get(Validator::class));
    }
}