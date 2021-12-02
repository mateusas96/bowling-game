<?php

namespace App;

class Game
{
	const FRAMES_PER_GAME = 10;
	protected $rolls = [];
	
	// store the rolls in the rolls array
	public function roll($pins)
	{
		$this->rolls[] = $pins;
	}
}
