<?php

namespace App\Services;

use Aura\Session\Segment;
use Aura\Session\Session as AuraSession;

/**
 * Class Session
 * @package App\Services
 */
class Session
{
    /**
     * @var AuraSession
     */
    protected $session;

    /**
     * @var string
     */
    protected $segment = 'Customer';

    public function __construct(AuraSession $session)
    {
        $this->session = $session;
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

    /**
     * @return bool
     */
    public function destroy(): bool
    {
        return $this->session->destroy();
    }
}