CREATE TABLE IF NOT EXISTS `mission` (`card_id` INT(3) AUTO_INCREMENT PRIMARY KEY, `card_type` VARCHAR(16) NOT NULL,  `card_type_arg` INT(3), `card_location` VARCHAR(16) NOT NULL,  `card_location_arg` INT(3))
CREATE TABLE IF NOT EXISTS `achievement` (`card_id` INT(3) AUTO_INCREMENT PRIMARY KEY, `card_type` VARCHAR(16) NOT NULL,  `card_type_arg` INT(3), `card_location` VARCHAR(16) NOT NULL,  `card_location_arg` INT(3))
CREATE TABLE IF NOT EXISTS `power` (`card_id` INT(3) AUTO_INCREMENT PRIMARY KEY, `card_type` VARCHAR(16) NOT NULL,  `card_type_arg` INT(3), `card_location` VARCHAR(16) NOT NULL,  `card_location_arg` INT(3))
CREATE TABLE IF NOT EXISTS `sensor` (`card_id` INT(3) AUTO_INCREMENT PRIMARY KEY, `card_type` VARCHAR(16) NOT NULL,  `card_type_arg` INT(3), `card_location` VARCHAR(16) NOT NULL,  `card_location_arg` INT(3))
CREATE TABLE IF NOT EXISTS `space` (`card_id` INT(3) AUTO_INCREMENT PRIMARY KEY, `card_type` VARCHAR(16) NOT NULL,  `card_type_arg` INT(3), `card_location` VARCHAR(16) NOT NULL,  `card_location_arg` INT(3))

CREATE TABLE IF NOT EXISTS `board` (`id` INT(3) AUTO_INCREMENT PRIMARY KEY , `space` INT(3));

ALTER TABLE `player` ADD `VP` INT UNSIGNED DEFAULT '0';
ALTER TABLE `player` ADD `Threat` INT UNSIGNED DEFAULT '0';
ALTER TABLE `player` ADD `Energy` INT UNSIGNED DEFAULT '5';
