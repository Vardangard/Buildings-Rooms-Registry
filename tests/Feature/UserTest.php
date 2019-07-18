<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/pastatai');

        $this->assertTrue(true);

        $user = User::find(10);

        log($user);

        $this->assertAuthenticated($user, $guard = null);

    }
}
