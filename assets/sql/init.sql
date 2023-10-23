/* DATABASE AND TABLES */

DROP DATABASE IF EXISTS fantasy_memory;
CREATE DATABASE fantasy_memory;
USE fantasy_memory;

CREATE TABLE game (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(32)
)
CHARACTER SET "utf8"
ENGINE=INNODB;

CREATE TABLE player (
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	pseudo VARCHAR(256),
    email VARCHAR(256) NOT NULL,
    pwd VARCHAR(256) NOT NULL,
    sign_up_timestamp DATETIME DEFAULT NOW(),
    latest_connection_timestamp DATETIME   
)
CHARACTER SET "utf8"
ENGINE=INNODB;

CREATE TABLE score (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    player_id INT UNSIGNED NOT NULL,
    game_id INT UNSIGNED NOT NULL,
	game_difficulty ENUM("easy", "medium", "hard") NOT NULL,
    score INT UNSIGNED NOT NULL,
    score_timestamp DATETIME DEFAULT NOW()
)
CHARACTER SET "utf8"
ENGINE=INNODB;

CREATE TABLE message (
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    game_id INT UNSIGNED NOT NULL,
    player_id INT UNSIGNED NOT NULL,
    message TEXT NOT NULL,
    message_timestamp DATE NOT NULL
)
CHARACTER SET "utf8"
ENGINE=INNODB;

/* FOREIGN KEYS */

ALTER TABLE score
ADD CONSTRAINT fk_score_player FOREIGN KEY (player_id) REFERENCES player(id) ON DELETE CASCADE;

ALTER TABLE score
ADD CONSTRAINT fk_score_game FOREIGN KEY (game_id) REFERENCES game(id) ON DELETE CASCADE;

ALTER TABLE message
ADD CONSTRAINT fk_message_player FOREIGN KEY (player_id) REFERENCES player(id) ON DELETE CASCADE;

ALTER TABLE message
ADD CONSTRAINT fk_message_game FOREIGN KEY (game_id) REFERENCES game(id) ON DELETE CASCADE;
