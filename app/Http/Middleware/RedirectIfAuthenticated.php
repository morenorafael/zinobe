<?php

namespace App\Http\Middleware;

use App\Services\Session;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Class RedirectIfAuthenticated
 * @package App\Http\Middleware
 */
class RedirectIfAuthenticated implements MiddlewareInterface
{
    /**
     * @var Session
     */
    private $session;

    /**
     * RedirectIfAuthenticated constructor.
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        print_r($this->session->get('user'));

        if ($this->session->get('user')) {
            redirect('/');
        }

        return $handler->handle($request);
    }
}