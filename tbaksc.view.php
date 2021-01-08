<?php

require_once( APP_BASE_PATH . "view/common/game.view.php" );

class view_tbaksc_tbaksc extends game_view
{

    function getGameName()
    {
	return "tbaksc";
    }

    function build_page($viewArgs)
    {
	$numberOfRows = $this->game->getGameStateValue('numberOfRows');
	$widthOfRows = $this->game->getGameStateValue('widthOfRows');
	//
	$this->tpl['NUMBEROFROWS'] = $numberOfRows;
	$this->tpl['WIDTHOFROWS'] = $widthOfRows;
	//
	$this->page->begin_block("tbaksc_tbaksc", "tbaksc_space");
	//
	for ($i = 0; $i < $numberOfRows; $i++)
	{
	    for ($j = 0; $j < $widthOfRows; $j++)
	    {
		$id = $i * $widthOfRows + $j + 1;
		$this->page->insert_block("tbaksc_space", ['ID' => $id]);
	    }
	}
    }

}
