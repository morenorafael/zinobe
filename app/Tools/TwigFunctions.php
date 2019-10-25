<?php

namespace App\Tools;

use App\Http\Request\LoginRequest;
use App\Services\Session;

/**
 * Class TwigFunctions
 * @package App\Tools
 */
class TwigFunctions
{
    /**
     * @var Session
     */
    protected $session;
    /**
     * @var LoginRequest
     */
    private $request;

    public function __construct(Session $session)
    {
        $this->session = $session;
        // $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function userIsLogged()
    {
        return $this->session->get('user');
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function flash(array $params)
    {
        return $this->session-->getFlash($params[0]);
    }
}