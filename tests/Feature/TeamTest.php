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

    /** @test */
    public function a_team_has_a_maximum_size()
    {
        $team = Factory(Team::class)->create(['size' => 2]);

        $user = Factory(User::class)->create();
        $user2 = Factory(User::class)->create();
        
        $team->add($user);
        $team->add($user2);
        
        $this->expectException('exception');
        
        $user3 = Factory(User::class)->create();
        $team->add($user3);

        $this->assertEquals(3, $team->countMembers());
    }
}
