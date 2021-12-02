<?php

use App\Game;
use PHPUnit\Framework\TestCase;

class BowlingGameTest extends TestCase
{
	// all pins are missed 
	public function testGutterGame()
	{
		$game = new Game();
		
		foreach (range(1, 20) as $roll) {
			$game->roll(0);
		}
		
		$this->assertEquals(0, $game->score());
	}
}

