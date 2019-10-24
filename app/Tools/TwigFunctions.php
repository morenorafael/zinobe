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
    static $session;
    /**
     * @var LoginRequest
     */
    private $request;

    public function __construct(Session $session, LoginRequest $request)
    {
        self::$session = $session;
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public static function userIsLogged()
    {
        return self::$session->get('user');
    }

    /**
     * @param array $params
     * @return mixed
     */
    public static function flash(array $params)
    {
        return self::$session->getFlash($params[0]);
    }
}