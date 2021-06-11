<?php

namespace Tests\Unit;

use App\Game;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Database\Factories\GameFactory;

class GameTest extends TestCase
{
    use DatabaseTransactions;

    protected function addGames()
    {
        factory(Game::class,2)->create();
    }
  
    /** @test */
    public function there_are_2_games()
    {
        $this->addGames();

        $games = Game::all();
        
        $this->assertCount(2, $games);
    }
}
