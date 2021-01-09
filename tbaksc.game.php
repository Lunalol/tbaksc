<?php
require_once( APP_GAMEMODULE_PATH . 'module/table/table.game.php' );
require_once('modules/gameStates.trait.php');
require_once('modules/gameStateArguments.trait.php');
require_once('modules/gameStateActions.trait.php');

class TBAKSC extends Table
{
    function __construct()
    {
	parent::__construct();
//
	$this->gameStateLabels = ['turn' => 10, 'numberOfRows' => 15, 'widthOfRows' => 16,];
	self::initGameStateLabels($this->gameStateLabels);
//
	foreach (['mission', 'achievement', 'power', 'sensor', 'space'] as $deck)
	{
	    $this->$deck = self::getNew("module.common.deck");
	    $this->$deck->init($deck);
	}
//
	$this->board = new board();
//
    }
    protected function getGameName()
    {
	return "tbaksc";
    }
    protected function setupNewGame($players, $options = array())
    {
	$gameinfos = self::getGameinfos();
	$default_colors = $gameinfos['player_colors'];
	$values = [];
	foreach ($players as $player_id => $player)
	{
	    $color = array_shift($default_colors);
	    $values[] = "('" . $player_id . "','$color','" . $player['player_canal'] . "','" . addslashes($player['player_name']) . "','" . addslashes($player['player_avatar']) . "')";
	}
	self::DbQuery("INSERT INTO player (player_id, player_color, player_canal, player_name, player_avatar) VALUES " . implode($values, ','));
	self::reattributeColorsBasedOnPreferences($players, $gameinfos['player_colors']);
	self::reloadPlayersBasicInfos();
//
	self::setGameStateInitialValue('turn', 0);
	self::setGameStateInitialValue('numberOfRows', 5);
//
// PREPARATION FOR EACH DECK
//
	foreach (['mission' => 8, 'achievement' => 22, 'power' => 23, 'sensor' => 40] as $deck => $count)
	{
	    $this->$deck->createCards([['type' => $deck, 'type_arg' => NULL, 'nbr' => $count]]);
	    $this->$deck->shuffle('deck');
	}
//
// PREPARATION FOR SPACE CARDS
//
	switch (sizeof($players))
	{
	    case 1:
		$decks = ['SQUADRONS' => 12];
		$decks = ['SQUADRONS' => 16, 'ASTEROIDS' => 12, 'WORMHOLES' => 16, 'FLEET' => 12];
		self::setGameStateInitialValue('widthOfRows', 2);
		break;
	    case 2:
	    case 3:
		$decks = ['SQUADRONS' => 12, 'ASTEROIDS' => 9, 'WORMHOLES' => 12, 'FLEET' => 9];
		self::setGameStateInitialValue('widthOfRows', 3);
		break;
	    case 4:
	    case 5:
		$decks = ['SQUADRONS' => 16, 'ASTEROIDS' => 12, 'WORMHOLES' => 16, 'FLEET' => 12];
		self::setGameStateInitialValue('widthOfRows', 4);
		break;
	    default:
		throw new BgaVisibleSystemException('Invalid number of players: ' . sizeof($players));
	}
	foreach (array_reverse(array_keys($decks)) as $deck)
	{
	    $cards = [];
	    for ($i = 0; $i < $decks[$deck]; $i++) $cards[] = ['type' => $deck, 'type_arg' => $i, 'nbr' => 1];
	    $this->space->createCards($cards);
	    $this->space->shuffle($deck);
	    for ($i = 0; $i < $decks[$deck]; $i++) $this->space->insertCardOnExtremePosition($this->space->getCardOnTop($deck)['id'], 'deck', true);
	}
//
// PREPARATION FOR EACH PLAYER
//
	foreach ($players as $player_id => $player)
	{
	    // a. Each player receives one Ship and the corresponding Captain Board. You then...
	    // b. Place a big marker to indicate 0 Threat and another to indicate 5 Energy.
	    // c. Place a big marker next to the Score Board (Score Marker).
	    // d. Place your 10 small cubes next to your Captain Board (these will be used as Player and PvP Markers).
	    // e. Draw 2 Sensor Cards and 1 Power-up Card; keep these secret.
	    $this->sensor->pickCards(2, 'deck', $player_id);
	    $this->power->pickCard('deck', $player_id);
	    // f. Draw 1 Mission Card and place it face up where indicated on your Captain Board.
	    $this->mission->pickCard('deck', $player_id);
	    // g. Each player also receives the Level 1 Rotary Cage and places it on their Captain Board. Each player places 1 Player Marker on this card so that it points toward the first row/top of the game area (as per the illustration on page 10).
	}
//
	$this->achievement->pickCardsForLocation(4, 'deck', 'achievement');
    }
    protected function getAllDatas()
    {
	$player_id = self::getCurrentPlayerId();    // !! We must only return informations visible by this player !!
//
	$result = ['board' => $this->space->getCardsInLocation('board')];
//
	$result['mission'] = $this->mission->getCardsInLocation('mission');
//
	$gameStateLabels = array_keys($this->gameStateLabels);
	$result['gameStates'] = array_combine($gameStateLabels, array_map('self::getGameStateValue', $gameStateLabels));
//
	$result['players'] = self::getCollectionFromDb("SELECT player_id id, player_score score, VP, Threat, Energy FROM player");
//
	$result['achievement'] = $this->achievement->getPlayerHand($player_id);
	$result['power'] = $this->power->getPlayerHand($player_id);
	$result['sensor'] = $this->sensor->getPlayerHand($player_id);
//
	return $result;
    }
    function getGameProgression()
    {
	return 0;
    }
    use gameStates;
    use gameStateArguments;
    use gameStateActions;
}
