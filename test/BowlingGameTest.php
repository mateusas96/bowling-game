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

	// strike in all frames
	public function testPerfectGame()
	{
		$game = new Game();
		
		foreach (range(1, 12) as $roll) {
			$game->roll(10);
		}
		
		$this->assertEquals(300, $game->score());
	}

	// single pin is hit in each frame
	public function testAllOnes()
	{
		$game = new Game();
		
		foreach (range(1, 20) as $roll) {
			$game->roll(1);
		}
		
		$this->assertEquals(20, $game->score());
	}

	public function testAllSpareButAdditionalFrameIsStrike()
	{
		$game = new Game();
		
		foreach (range(1, 18) as $roll) {
			$game->roll(5);
			$game->roll(5);
		}
		
		$game->roll(10);
		
		// TODO: need to count the score, so just added a random number
		$this->assertEquals(99999, $game->score());
	}

	public function testFiveFramesAreStrikesAndOtherFramesAreMisses()
	{
		$game = new Game();

		foreach (range(1, 5) as $roll) {
			$game->roll(10);
		}

		foreach (range(1, 10) as $roll) {
			$game->roll(0);
		}

		// TODO: need to count the score, so just added a random number
		$this->assertEquals(99999, $game->score());
	}

	public function testFiveFramesAreMissesAndOtherFramesAreStrikes()
	{
		$game = new Game();

		foreach (range(1, 10) as $roll) {
			$game->roll(0);
		}

		foreach (range(1, 5) as $roll) {
			$game->roll(10);
		}

		// TODO: need to count the score, so just added a random number
		$this->assertEquals(99999, $game->score());
	}

	public function testAllMissesButOneFrameIsStrike()
	{
		$game = new Game();

		foreach (range(1, 9) as $roll) {
			$game->roll(0);
		}

		$game->roll(10);

		foreach (range(1, 9) as $roll) {
			$game->roll(0);
		}

		$this->assertEquals(10, $game->score());
	}

	public function testEverySecondFrameIsStrike()
	{
		$game = new Game();

		foreach (range(1, 17) as $roll) {
			if ($roll % 2 == 0) {
				$game->roll(10);
			} else {
				$game->roll(0);
			}
		}

		// TODO: need to count the score, so just added a random number
		// 00 x 00 x 00 x 00 x 00 xxx
		$this->assertEquals(9999, $game->score());
	}
}

