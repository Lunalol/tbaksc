<?php

trait gameStates
{
    function stSetup()
    {
	$numberOfRows = self::getGameStateValue('numberOfRows');
	$widthOfRows = self::getGameStateValue('widthOfRows');

	$location = 0;
	for ($i = 0; $i < $numberOfRows; $i++)
	{
	    for ($j = 0; $j < $widthOfRows; $j++)
	    {
		$location += 1;
		$this->space->pickCardForLocation('deck', 'board', $location);
	    }
	}
	$this->gamestate->nextState('startGame');
    }
}
