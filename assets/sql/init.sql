/* DATABASE AND TABLES */

DROP DATABASE IF EXISTS fantasy_memory;
CREATE DATABASE fantasy_memory;
USE fantasy_memory;

CREATE TABLE game (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(32)
)
CHARACTER SET 'utf8'
ENGINE=INNODB;

CREATE TABLE player (
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	pseudo VARCHAR(256),
    email VARCHAR(256) NOT NULL,
    pwd VARCHAR(256) NOT NULL,
    sign_up_timestamp DATETIME DEFAULT NOW(),
    latest_connection_timestamp DATETIME   
)
CHARACTER SET 'utf8'
ENGINE=INNODB;

CREATE TABLE score (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    player_id INT UNSIGNED NOT NULL,
    game_id INT UNSIGNED NOT NULL,
	game_difficulty ENUM('easy', 'medium', 'hard') NOT NULL,
    score INT UNSIGNED NOT NULL,
    score_timestamp DATETIME DEFAULT NOW()
)
CHARACTER SET 'utf8'
ENGINE=INNODB;

CREATE TABLE message (
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    game_id INT UNSIGNED NOT NULL,
    player_id INT UNSIGNED NOT NULL,
    message_content TEXT NOT NULL,
    message_timestamp DATETIME DEFAULT NOW()
)
CHARACTER SET 'utf8'
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


-- Data init --

/* Users */

INSERT INTO player(pseudo, email, pwd) VALUES ('firetech', 'firetech@email.com', 'PassWord');
INSERT INTO player(pseudo, email, pwd) VALUES ('new-tech', 'new-tech@email.com', 'PassWord');
INSERT INTO player(pseudo, email, pwd) VALUES ('Toma', 'Toma@email.com', 'PassWord');
INSERT INTO player(pseudo, email, pwd) VALUES ('Alexendra', 'Alexendra@email.com', 'PassWord');
INSERT INTO player(pseudo, email, pwd) VALUES ('Po', 'Po@email.com', 'PassWord');

/* Game */

INSERT INTO game(id, name) VALUES (1,'mincraftCard');

/* Scores */

INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (1, 1, "medium", 23);
INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (1, 1, "hard", 234);
INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (1, 1, "medium", 43);
INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (1, 1, "easy", 34);
INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (1, 1, "medium", 456);

INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (2, 1, "easy", 45);
INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (2, 1, "easy", 456);
INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (2, 1, "easy", 234);
INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (2, 1, "easy", 2345);
INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (2, 1, "hard", 6);

INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (3, 1, "medium", 45);
INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (3, 1, "hard", 74);
INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (3, 1, "hard", 65);
INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (3, 1, "easy", 4);
INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (3, 1, "hard", 475);

INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (4, 1, "easy", 753);
INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (4, 1, "hard", 457);
INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (4, 1, "medium", 63456);
INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (4, 1, "easy", 8643);
INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (4, 1, "hard", 34509);

INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (5, 1, "hard", 3);
INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (5, 1, "hard", 2);
INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (5, 1, "easy", 7);
INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (5, 1, "hard", 0);
INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (5, 1, "medium", 1);


/* Message */

INSERT INTO message(game_id, player_id, message_content) VALUES (1,1,"Hello word !");
INSERT INTO message(game_id, player_id, message_content) VALUES (1,2,"Hi");
INSERT INTO message(game_id, player_id, message_content) VALUES (1,5,"u good ?");
INSERT INTO message(game_id, player_id, message_content) VALUES (1,3,"Hello");
INSERT INTO message(game_id, player_id, message_content) VALUES (1,4,"UwU");

INSERT INTO message(game_id, player_id, message_content) VALUES (1,2,"u are ?");
INSERT INTO message(game_id, player_id, message_content) VALUES (1,3,"your dady");
INSERT INTO message(game_id, player_id, message_content) VALUES (1,5,"hate this game");
INSERT INTO message(game_id, player_id, message_content) VALUES (1,4,"LOL");
INSERT INTO message(game_id, player_id, message_content) VALUES (1,1,"XD");

INSERT INTO message(game_id, player_id, message_content) VALUES (1,5,"and ?");
INSERT INTO message(game_id, player_id, message_content) VALUES (1,3,"u are ?");
INSERT INTO message(game_id, player_id, message_content) VALUES (1,4,"your dady");
INSERT INTO message(game_id, player_id, message_content) VALUES (1,2,"why say it ?");
INSERT INTO message(game_id, player_id, message_content) VALUES (1,1,"Love tom");

INSERT INTO message(game_id, player_id, message_content) VALUES (1,1,"soooo beaty");
INSERT INTO message(game_id, player_id, message_content) VALUES (1,2,"ho u are gay ?");
INSERT INTO message(game_id, player_id, message_content) VALUES (1,5,"u are ?");
INSERT INTO message(game_id, player_id, message_content) VALUES (1,4,"your dady");
INSERT INTO message(game_id, player_id, message_content) VALUES (1,3,"crying");

INSERT INTO message(game_id, player_id, message_content) VALUES (1,1,"i dont no XD");
INSERT INTO message(game_id, player_id, message_content) VALUES (1,4,"i go eat pizza withe TOM butternut");
INSERT INTO message(game_id, player_id, message_content) VALUES (1,5,"i so crazy peaple");
INSERT INTO message(game_id, player_id, message_content) VALUES (1,3,"HMMMMMM");
INSERT INTO message(game_id, player_id, message_content) VALUES (1,2,"bey XD i leav this crazy word :(");

/* Save users scores */

INSERT INTO score(player_id, game_id, game_difficulty, score)
VALUES 1, 1, 'medium', 203
WHERE NOT EXISTS (
    VALUES (1, 1, "medium", 23)
);

INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (2, 1, "easy", 2345);
INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (3, 1, "easy", 4);
INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (4, 1, "medium", 63456);
INSERT INTO score(player_id, game_id, game_difficulty, score) VALUES (5, 1, "hard", 0);