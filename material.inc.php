<?php

require_once('modules/gameConstants.inc.php' );
require_once('modules/board.class.php' );

$this->MISSIONS = [['type' => 1, 'nbr' => 8]];
$this->ACHIEVEMENT = [['type' => 1, 'nbr' => 22]];
$this->POWER = [['type' => 1, 'nbr' => 23]];

$this->SPACE['SQUADRONS'] = [
    1 => ['bellonium' => 1,
	['type' => FIGHTER, 'bellonium' => 1, 'energy' => 1, 'threat' => 1],
	['type' => FIGHTER, 'bellonium' => 1, 'energy' => 1, 'threat' => 1],
    ],
    2 => [
	['type' => FIGHTER, 'bellonium' => 1, 'energy' => 1, 'threat' => 1],
	['type' => FIGHTER, 'bellonium' => 1, 'energy' => 1, 'threat' => 1],
    ],
    3 => [
	['type' => FIGHTER, 'bellonium' => 1, 'energy' => 1, 'threat' => 1],
	['type' => 0],
    ],
    4 => [
	['type' => 0],
	['type' => FIGHTER, 'bellonium' => 1, 'energy' => 1, 'threat' => 1],
    ],
    5 => ['bellonium' => 1,
	['type' => 0],
	['type' => FIGHTER, 'bellonium' => 1, 'energy' => 1, 'threat' => 1],
    ],
    6 => [
	['type' => FIGHTER, 'bellonium' => 1, 'energy' => 1, 'threat' => 1],
	['type' => DRONE, 'energie' => 1],
    ],
    7 => [
	['type' => 0],
	['type' => FIGHTER, 'bellonium' => 1, 'energy' => 1, 'threat' => 1],
    ],
    8 => [
	['type' => FIGHTER, 'bellonium' => 1, 'energy' => 1, 'threat' => 1],
	['type' => 0],
    ],
    9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23
];
