<?php

class board extends APP_GameClass
{
    public function getBoard()
    {
	return self::getCollectionFromDB("SELECT * FROM `board`");
    }
}
