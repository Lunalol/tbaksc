<?php
$machinestates = array(
    1 => array(
	'name' => 'gameSetup',
	'description' => '',
	'type' => 'manager',
	'action' => 'stGameSetup',
	'transitions' => array('' => 2)
    ),
    2 => array(
	'name' => 'setup',
	'type' => 'game',
	'description' => clienttranslate('🌠🌠🌠 setup 🌠🌠🌠'),
	'action' => 'stSetup',
	'transitions' => array('startGame' => 10)
    ),
    10 => array(
	'name' => 'determinePlayerOrder',
	'type' => 'multipleactiveplayer',
	'args' => 'argDeterminePlayerOrder',
	'description' => clienttranslate('📡📡📡 The players determine the turn order by playing one <b>Sensor Card</b> each 📡📡📡'),
	'descriptionmyturn' => clienttranslate('📡📡📡 ${you} must play one <b>Sensor Card</b> 📡📡📡'),
	'possibleactions' => array('playSensorCard'),
	'transitions' => array('nextPhase' => 15)
    ),
    15 => array(
	'name' => 'drawNewSensorCard',
	'type' => 'game',
	'description' => clienttranslate('📡📡📡 Each player gets a new <b>Sensor Card</b> 📡📡📡'),
	'action' => 'stDrawNewSensorCard',
	'transitions' => array('nextPhase' => 20)
    ),
    20 => array(
	'name' => 'playerTurn',
	'type' => 'activeplayer',
	'args' => 'argPlayerTurn',
	'description' => clienttranslate('👨‍🚀 $(actplayer} can choose between 2 different actions: <b>Battle</b> or <b>Power Down</b> 👩‍🚀'),
	'descriptionmyturn' => clienttranslate('👨‍🚀 ${you} can choose between 2 different actions: <b>Battle</b> or <b>Power Down</b> 👩‍🚀'),
	'possibleactions' => array('battle', 'power down'),
	'transitions' => array('battle' => 100, 'power down' => 150)
    ),
    100 => array(
	'name' => 'battle',
	'type' => 'activeplayer',
	'args' => 'argBattle',
	'description' => clienttranslate('🚀🚀🚀 $(actplayer} can <b>MOVE</b> or <b>FIRE</b> 🚀🚀🚀'),
	'descriptionmyturn' => clienttranslate('🚀🚀🚀 ${you} can <b>MOVE</b> or <b>FIRE</b> 🚀🚀🚀'),
	'possibleactions' => array('move', 'fire', 'overcharge'),
	'transitions' => array('continue' => 100, 'nextPhase' => 110)
    ),
    110 => array(
	'name' => 'resolveThreat',
	'type' => 'game',
	'description' => clienttranslate('The player takes damage from the <b>Threat</b> (enemy shots) he couldn’t avoid'),
	'action' => 'stResolveThreat',
	'transitions' => array('nextPhase' => 120)
    ),
    120 => array(
	'name' => 'addNewThreat',
	'type' => 'game',
	'description' => clienttranslate('This represents the Threat Level the player will have to face on his next turn'),
	'action' => 'addNewThreat',
	'transitions' => array('nextPhase' => 200)
    ),
    150 => array(
	'name' => 'recharge',
	'type' => 'game',
	'description' => clienttranslate('The player raises his Energy Level 2 steps to the right'),
	'action' => 'stRecharge',
	'transitions' => array('nextPhase' => 160)
    ),
    160 => array(
	'name' => 'resolveThreat',
	'type' => 'game',
	'description' => clienttranslate('This represents the Threat Level the player will have to face on his next turn'),
	'action' => 'stResolveThreat',
	'transitions' => array('nextPhase' => 170)
    ),
    170 => array(
	'name' => 'returnPVPmarkers',
	'type' => 'game',
	'description' => clienttranslate('The player give back all the PvP Markers to their owners with no other effects'),
	'action' => 'stReturnPVPmarkers',
	'transitions' => array('nextPhase' => 180)
    ),
    180 => array(
	'name' => 'shop',
	'type' => 'activeplayer',
	'args' => 'argShop',
	'description' => clienttranslate('$$$ $(actplayer} can spend his hard-earned Bellonium to buy <b>Upgrades</b> and <b>Power-ups</b> for his ship $$$'),
	'descriptionmyturn' => clienttranslate('$$$ ${you} can spend his hard-earned Bellonium to buy <b>Upgrades</b> and <b>Power-ups</b> for his ship $$$'),
	'possibleactions' => array('buy', 'done'),
	'transitions' => array('continue' => 180, 'nextPhase' => 190)
    ),
    190 => array(
	'name' => 'addNewThreat',
	'type' => 'game',
	'description' => clienttranslate('The player takes damage from the <b>Threat</b> (enemy shots) he couldn’t avoid'),
	'action' => 'addNewThreat',
	'transitions' => array('nextPhase' => 200)
    ),
    200 => array(
	'name' => 'endOfPlayerTurn',
	'type' => 'game',
	'description' => clienttranslate('This represents the Threat Level the player will have to face on his next turn'),
	'action' => 'stEndOfPlayerTurn',
	'transitions' => array('nextPlayer' => 100, 'nextTurn' => 10)
    ),
    99 => array(
	'name' => 'gameEnd',
	'description' => clienttranslate('End of game'),
	'type' => 'manager',
	'action' => 'stGameEnd',
	'args' => 'argGameEnd'
    )
);



