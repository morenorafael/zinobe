<?php

namespace App\Services;

use App\Models\User;

class Auth
{
    /**
     * @var Session
     */
    protected $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param User $user
     */
    public function generateUserSession(User $user)
    {
        $this->session->set('user', $user);
    }

    /**
     * @return bool
     */
    public function destroyUserSession(): bool
    {
        return $this->session->destroy();
    }
}