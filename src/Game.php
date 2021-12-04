<?php

namespace App;

class Game
{
	const FRAMES_PER_GAME = 10;
	private $rolls = [];
	
	// store the rolls in the rolls array
	public function roll($pins)
	{
		$this->rolls[] = $pins;
	}

	// counts the score of the game
	public function score()
	{
		$score = 0;
		$rollIndex = 0;
		for ($frame = 0; $frame < self::FRAMES_PER_GAME; $frame++) {
			$score += $this->sumOfBallsInFrame($rollIndex);
			$rollIndex += 2;
		}
		return $score;
	}

	private function sumOfBallsInFrame($rollIndex)
	{
		return $this->rolls[$rollIndex] + $this->rolls[$rollIndex + 1];
	}
}