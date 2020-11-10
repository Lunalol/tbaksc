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
	$this->mission = new mission();
	$this->achievement = new achievement();
	$this->power = new power();
	$this->sensor = new sensor();
	$this->space = new space();
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
	$sql = "INSERT INTO player (player_id, player_color, player_canal, player_name, player_avatar) VALUES ";
	$values = [];
	foreach ($players as $player_id => $player)
	{
	    $color = array_shift($default_colors);
	    $values[] = "('" . $player_id . "','$color','" . $player['player_canal'] . "','" . addslashes($player['player_name']) . "','" . addslashes($player['player_avatar']) . "')";
	}
	$sql .= implode($values, ',');
	self::DbQuery($sql);
	self::reattributeColorsBasedOnPreferences($players, $gameinfos['player_colors']);
	self::reloadPlayersBasicInfos();
//
	self::setGameStateInitialValue('turn', 0);
	self::setGameStateInitialValue('numberOfRows', 5);
//
// PREPARATION FOR EACH DECK
//
	for ($i = 1; $i <= 8; $i++) $this->mission->addCard([0]);  // 8 mission cards
	for ($i = 1; $i <= 22; $i++) $this->achievement->addCard([0]); // 22 achievement cards
	for ($i = 1; $i <= 23; $i++) $this->power->addCard([0]); // 23 power-up cards
	for ($i = 10; $i <= 400; $i += 10) $this->sensor->addCard([0]); // 40 sensor cards
//
	for ($i = 1; $i <= 23; $i++) $this->space->addCard(["'SQUADRONS'"]);  // 23 squadrons cards
	for ($i = 1; $i <= 22; $i++) $this->space->addCard(["'ASTEROIDS'"]);  // 22 squadrons cards
	for ($i = 1; $i <= 16; $i++) $this->space->addCard(["'WORMHOLES'"]);  // 16 squadrons cards
	for ($i = 1; $i <= 16; $i++) $this->space->addCard(["'FLEET'"]);  // 16 squadrons cards
	for ($i = 1; $i <= 11; $i++) $this->space->addCard(["'TUNNELS'"]);  // 11 squadrons cards
//
	for ($i = 0; $i < 4; $i++) $this->achievement->draw(0);
//
// PREPARATION FOR SPACE CARDS
//
	switch (sizeof($players))
	{
	    case 1:
		$desks = ['SQUADRONS' => 12];
		self::setGameStateInitialValue('widthOfRows', 2);
		break;
	    case 2:
	    case 3:
		$desks = ['SQUADRONS' => 12, 'ASTEROIDS' => 9, 'WORMHOLES' => 12, 'FLEET' => 9];
		self::setGameStateInitialValue('widthOfRows', 3);
		break;
	    case 4:
	    case 5:
		$desks = ['SQUADRONS' => 16, 'ASTEROIDS' => 12, 'WORMHOLES' => 16, 'FLEET' => 12];
		self::setGameStateInitialValue('widthOfRows', 4);
		break;
	    default:
		throw new BgaVisibleSystemException('Invalid number of players: ' . sizeof($players));
	}
	foreach ($desks as $desk => $count)
		for ($i = 0; $i < $count; $i++)
		    self::DbQuery("INSERT INTO `board` SET space = (SELECT id FROM (SELECT * FROM `space` WHERE pack = '$desk' AND id NOT IN (SELECT space FROM `board`) ORDER BY RAND() LIMIT 1) AS card)");
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
	    $this->sensor->draw($player_id);
	    $this->sensor->draw($player_id);
	    $this->power->draw($player_id);
	    // f. Draw 1 Mission Card and place it face up where indicated on your Captain Board.
	    $this->mission->draw($player_id);
	    // g. Each player also receives the Level 1 Rotary Cage and places it on their Captain Board. Each player places 1 Player Marker on this card so that it points toward the first row/top of the game area (as per the illustration on page 10).
	}
    }
    protected function getAllDatas()
    {
	$result = [];
	$gameStateLabels = array_keys($this->gameStateLabels);
	$result['gameStates'] = array_combine($gameStateLabels, array_map('self::getGameStateValue', $gameStateLabels));
	$result['players'] = self::getCollectionFromDb("SELECT player_id id, player_score score FROM player");
	foreach (['mission', 'achievement', 'power', 'sensor'] as $deck) $result['decks'][$deck] = $this->$deck->getActiveCards();
	$result['board'] = $this->board->getBoard();
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
