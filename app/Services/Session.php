<?php

namespace App\Services;

use Aura\Session\Segment;
use Aura\Session\SessionFactory;

/**
 * Class Session
 * @package App\Services
 */
class Session
{
    /**
     * @var \Aura\Session\Session
     */
    protected $session;

    /**
     * @var string
     */
    protected $segment = 'Customer';

    public function __construct()
    {
        $this->session = (new SessionFactory())->newInstance($_COOKIE);
    }

    /**
     * @param string $segment
     */
    public function setSegment(string $segment)
    {
        $this->segment = $segment;
    }


    /**
     * @return \Aura\Session\Segment
     */
    public function getSegment(): Segment
    {
        return $this->session->getSegment($this->segment);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->getSegment()->get($key);
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function set(string $key, string $value)
    {
        $this->getSegment()->set($key, $value);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getFlash(string $key)
    {
        return $this->getSegment()->getFlash($key);
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setFlash(string $key, string $value)
    {
        $this->getSegment()->setFlash($key, $value);
    }
}