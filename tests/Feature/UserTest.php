<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;

class UserTest extends TestCase
{
    /** @test */
    public function it_has_an_email()
    {
        $user = new User(['email' => 'mattou2812@gmail.com']);

        $this->assertEquals('mattou2812@gmail.com', $user->email);
    }

    /** @test */
    public function store_a_new_user()
    {
        // $this->withoutExceptionHandling();

        $user = $this->post('/users', [
            'name' => 'matt',
            'email' => 'mattou2812@gmail.com',
            'password' => 'secret'
        ]);

        $user->assertStatus(201);
    }
}
