<?php

use App\Game;
use PHPUnit\Framework\TestCase;

class BowlingGameTest extends TestCase
{
	private $game;

	protected function setUp(): void
	{
		$this->game = new Game();
	}

	// all pins are missed 
	public function testGutterGame()
	{
		foreach (range(1, 20) as $roll) {
			$this->game->roll(0);
		}
		
		$this->assertEquals(0, $this->game->score());
	}

	// strike in all frames
	public function testPerfectGame()
	{
	
		foreach (range(1, 12) as $roll) {
			$this->game->roll(10);
		}
		
		$this->assertEquals(300, $this->game->score());
	}

	// single pin is hit in each frame
	public function testAllOnes()
	{
	
		foreach (range(1, 20) as $roll) {
			$this->game->roll(1);
		}
		
		$this->assertEquals(20, $this->game->score());
	}

	public function testAllSpareButAdditionalFrameIsStrike()
	{
	
		foreach (range(1, 18) as $roll) {
			$this->game->roll(5);
			$this->game->roll(5);
		}
		
		$this->game->roll(10);
		
		// TODO: need to count the score, so just added a random number
		$this->assertEquals(99999, $this->game->score());
	}

	public function testFiveFramesAreStrikesAndOtherFramesAreMisses()
	{
		foreach (range(1, 5) as $roll) {
			$this->game->roll(10);
		}

		foreach (range(1, 10) as $roll) {
			$this->game->roll(0);
		}

		// TODO: need to count the score, so just added a random number
		$this->assertEquals(99999, $this->game->score());
	}

	public function testFiveFramesAreMissesAndOtherFramesAreStrikes()
	{
		foreach (range(1, 10) as $roll) {
			$this->game->roll(0);
		}

		foreach (range(1, 5) as $roll) {
			$this->game->roll(10);
		}

		// TODO: need to count the score, so just added a random number
		$this->assertEquals(99999, $this->game->score());
	}

	public function testAllMissesButOneFrameIsStrike()
	{
		foreach (range(1, 9) as $roll) {
			$this->game->roll(0);
		}

		$this->game->roll(10);

		foreach (range(1, 9) as $roll) {
			$this->game->roll(0);
		}

		$this->assertEquals(10, $this->game->score());
	}

	public function testEverySecondFrameIsStrike()
	{
		foreach (range(1, 17) as $roll) {
			if ($roll % 2 == 0) {
				$this->game->roll(10);
			} else {
				$this->game->roll(0);
			}
		}

		// TODO: need to count the score, so just added a random number
		// 00 x 00 x 00 x 00 x 00 xxx
		$this->assertEquals(9999, $this->game->score());
	}
}

