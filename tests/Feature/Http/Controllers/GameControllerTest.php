<?php

namespace Tests\Feature\Http\Controllers;

use App\Game;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GameControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_all_games_can_be_displayed()
    {
        $response = $this->get(route('games.index'));

        $response->assertStatus(200);
    }

    public function test_create_a_new_game()
    {
        $this->withoutExceptionHandling();

        $user = Factory(User::class)->create();

        $this->actingAs($user);
        
        $response = $this->post(route('games.store'),[
            'title' => "Secret of Mana",
            'type' => "RPG"
        ]);

        $response->assertStatus(201);

        $game = Game::first();
        $this->assertEquals("Secret of Mana", $game->title);
    }
}
