<?php

namespace Tests\Feature;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class SearchUserTest extends TestCase
{
    /**
     * @test
     */
    public function an_authenticated_user_can_search_searches()
    {
        // TENIENDO un usuario autenticado
        $user = User::first();

        // CUANDO hace un get request a index

        // ENTONCES recupero un usuario existente
    }
}
