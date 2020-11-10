<?php

class deck extends APP_GameClass
{
    public function __construct($name)
    {
	$this->name = $name;
    }
    public function addCard(array $card)
    {
	self::DbQuery("INSERT INTO `" . $this->name . "` VALUES (NULL, 0, " . implode($card, ',') . ")");
	return self::DbGetLastId();
    }
    public function getActiveCards()
    {
	return self::getCollectionFromDb("SELECT * FROM `" . $this->name . "` WHERE status = " . CARDISACTIVE);
    }
    public function draw($player_id)
    {
	self::DbQuery("UPDATE `" . $this->name . "` SET status = " . CARDISACTIVE . ", player_id = $player_id WHERE id = (SELECT id FROM (SELECT * FROM `" . $this->name . "` WHERE status = 0 ORDER BY RAND() LIMIT 1) AS card)");
    }
}
