<?php

namespace App;

class Game
{
	const FRAMES_PER_GAME = 10;
	private $rolls = [];
	
	/**
	 * store the rolls in the rolls array
	 * 
	 * @param int $pins
	 */
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
			if ($this->isStrike($rollIndex)) {
				$score += $this->strikeBonus($rollIndex);
				$rollIndex++;
			} else {
				$score += $this->sumOfBallsInFrame($rollIndex);
				$rollIndex += 2;
			}
		}
		return $score;
	}

	/**
	 * @param int $rollIndex
	 */
	private function sumOfBallsInFrame($rollIndex)
	{
		return $this->rolls[$rollIndex] + $this->rolls[$rollIndex + 1];
	}

	/**
	 * @param int $rollIndex
	 */
	private function isStrike($rollIndex)
	{
		return $this->rolls[$rollIndex] == 10;
	}

	/**
	 * A strike frame is scored by adding ten,
	 * plus the number of pins knocked down by the next two balls, 
	 * to the score of the previous frame.
	 * 
	 * @param int $rollIndex
	 */
	private function strikeBonus($rollIndex)
	{
		return 10 + $this->rolls[$rollIndex + 1] + $this->rolls[$rollIndex + 2];
	}
}