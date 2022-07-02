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
    public function it_fetch_all_users()
    {
        $users = $this->get('/users');

        $users->assertOk();
    }

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

    protected function validFields($overrides)
    {
        return array_merge([
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'password' => 'secret'
        ], $overrides);
    }

    /** @test */
    public function it_requires_a_name()
    {
        $this->withExceptionHandling();

        $user = $this->post('/users', $this->validFields(['name' => '']));

        $user->assertSessionHasErrors('name');
    }

    /** @test */
    public function it_requires_an_email()
    {
        $this->withExceptionHandling();

        $user = $this->post('/users', $this->validFields(['email' => '']));

        $user->assertSessionHasErrors('email');
    }

    /** @test */
    public function it_requires_a_password()
    {
        $this->withExceptionHandling();

        $user = $this->post('/users', $this->validFields(['password' => '']));

        $user->assertSessionHasErrors('password');
    }

    /** @test */
    public function it_can_update_the_user_name()
    {
        $user = factory(User::class)->create();

        $response = $this->put(route('users.update', $user->id), [
            'name' => 'John'
        ]);

        $user = User::first();
        $this->assertEquals('John', $user->name);
    }
}
