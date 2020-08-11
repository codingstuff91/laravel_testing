<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Database\Factories\UserFactory;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    
    protected function createUser()
    {
        factory(User::class,2)->create();
    }

    /** @test */
    public function there_are_2_users()
    {
        $this->createUser();

        $users = User::all();

        $this->assertEquals(2, $users->count());
    }
}
