<?php

namespace Tests\Feature;

use App\Team;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_team_has_a_name()
    {
        $team = new Team(['name' => "Developpers"]);

        $this->assertEquals('Developpers', $team->name);
    }

    /** @test */
    public function a_team_can_add_members()
    {
        $team = Factory(Team::class)->create();

        $user = Factory(User::class)->create();

        $team->add($user);

        $this->assertEquals(5, $team->size);
    }
}
