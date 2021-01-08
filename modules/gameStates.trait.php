<?php

trait gameStates
{
    function stSetup()
    {
		$numberOfRows = self::getGameStateValue('numberOfRows');
		$widthOfRows = self::getGameStateValue('widthOfRows');

		for ($i = 0; $i < $numberOfRows; $i++)
		{
			for ($j = 0; $j < $widthOfRows; $j++)
			{
			$location = $i * $widthOfRows + $j + 1;
			if (!$this->space->isEmpty()) $id = $this->space->draw($location);
			}
		}
//	$this->gamestate->nextState('startGame');
    }
}
