/* TODO: Check quotes usage */

/* 
	Story 1: Create the databases and the tables
*/

DROP DATABASE IF EXISTS fantasy_memory;
CREATE DATABASE fantasy_memory;
USE fantasy_memory;

CREATE TABLE games (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(64)
)
CHARACTER SET 'utf8'
ENGINE=INNODB;

CREATE TABLE players (
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	pseudo VARCHAR(256) NOT NULL UNIQUE,
    email VARCHAR(256) NOT NULL UNIQUE,
    pwd VARCHAR(256) NOT NULL,
    sign_up_timestamp DATETIME DEFAULT NOW(),
    latest_connection_timestamp DATETIME
)
CHARACTER SET 'utf8'
ENGINE=INNODB;

CREATE TABLE scores (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    player_id INT UNSIGNED NOT NULL,
    game_id INT UNSIGNED NOT NULL,
	game_difficulty ENUM('easy', 'medium', 'hard') NOT NULL,
    score INT UNSIGNED NOT NULL,
    score_timestamp DATETIME DEFAULT NOW()
)
CHARACTER SET 'utf8'
ENGINE=INNODB;

CREATE TABLE messages (
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    game_id INT UNSIGNED NOT NULL,
    player_id INT UNSIGNED NOT NULL,
    message TEXT NOT NULL,
    message_timestamp DATETIME DEFAULT NOW()
)
CHARACTER SET 'utf8'
ENGINE=INNODB;

ALTER TABLE scores
ADD CONSTRAINT fk_score_player
FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE;

ALTER TABLE scores
ADD CONSTRAINT fk_score_game
FOREIGN KEY (game_id) REFERENCES games(id) ON DELETE CASCADE;

ALTER TABLE messages
ADD CONSTRAINT fk_message_player
FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE;

ALTER TABLE messages
ADD CONSTRAINT fk_message_game
FOREIGN KEY (game_id) REFERENCES games(id) ON DELETE CASCADE;

/*
	Story 2: Insert some datas
*/

INSERT INTO players(pseudo, email, pwd)
VALUES ('firetech', 'firetech@email.com', 'PassWord'),
       ('new-tech', 'new-tech@email.com', 'PassWord'),
       ('Toma', 'Toma@email.com', 'PassWord'),
       ('Alexendra', 'Alexendra@email.com', 'PassWord'),
       ('Po', 'Po@email.com', 'PassWord');

INSERT INTO games(name) VALUES ('mincraftCard');

INSERT INTO scores(player_id, game_id, game_difficulty, score)
VALUES (1, 1, "medium", 23), (1, 1, "hard", 234), (1, 1, "medium", 43),
	   (1, 1, "easy", 34), (1, 1, "medium", 456), (2, 1, "easy", 45),
	   (2, 1, "easy", 456), (2, 1, "easy", 234), (2, 1, "easy", 2345),
	   (2, 1, "hard", 6), (3, 1, "medium", 45), (3, 1, "hard", 74),
	   (3, 1, "hard", 65), (3, 1, "easy", 4), (3, 1, "hard", 475),
	   (4, 1, "easy", 753), (4, 1, "hard", 457), (4, 1, "medium", 63456),
	   (4, 1, "easy", 8643), (4, 1, "hard", 34509), (5, 1, "hard", 3),
	   (5, 1, "hard", 2), (5, 1, "easy", 7), (5, 1, "hard", 0),
	   (5, 1, "medium", 1);

INSERT INTO messages(game_id, player_id, message)
VALUES (1,1,"Hello word !"), (1,2,"Hi"), (1,5,"u good ?"),
	   (1,3,"Hello"), (1,4,"UwU"), (1,2,"u are ?"),
	   (1,3,"your dady"), (1,5,"hate this game"), (1,4,"LOL"),
	   (1,1,"XD"), (1,5,"and ?"), (1,3,"u are ?"),
	   (1,4,"your brother"), (1,2,"why say it ?"), (1,1,"Love tom"),
	   (1,1,"soooo beaty"), (1,2,"ho u are in my mind ?"), (1,5,"u are ?"),
	   (1,4,"your dady"), (1,3,"crying"), (1,1,"i dont no XD"),
	   (1,4,"i go eat pizza with TOM ;)"), (1,5,"i so crazy peaple"), (1,3,"is true"),
	   (1,2,"bey XD i leav this crazy word :(");

/*
	Story 3: Sign up request
*/

INSERT INTO players (pseudo, email, pwd)
VALUES ("test", "test@test.com", "1234tkt");

/*
	Story 4: Update profile once connected
*/

UPDATE players SET email='newtest@update.com' WHERE id = 1;
UPDATE players SET pwd='saluté11' WHERE id = 1;

/*
	Story 5: Sign in request 
*/

UPDATE players AS p SET latest_connection_timestamp=NOW()
WHERE p.email = "new-tech@email.com" AND p.pwd = "PassWord";

/*
	Story 6: Add game in the database
*/

INSERT INTO games(name) VALUES ('Roblox');

/*
	Story 7: Display users scores
*/

SELECT g.name, s.game_difficulty, p.pseudo, s.score
FROM scores AS s
LEFT JOIN players AS p ON s.player_id = p.id
LEFT JOIN games AS g ON s.game_id = g.id
ORDER BY g.name, s.game_difficulty, s.score DESC;

/*
	Story 8: Display users filtered scores
*/

SELECT g.name, p.pseudo, s.game_difficulty, s.score 
FROM scores AS s
LEFT JOIN games AS g ON s.game_id = g.id
LEFT JOIN players AS p ON s.player_id = p.id
WHERE p.pseudo = 'new-tech'
OR g.name = ' '
OR s.game_difficulty = ' '
ORDER BY g.name ASC, s.game_difficulty, s.score ASC; 

/*
	Story 9: Save user score
*/

INSERT INTO scores (player_id, game_id, game_difficulty, score)
VALUES (1, 1, 'medium', 255);

UPDATE scores SET score = 7769
WHERE player_id = 1 AND game_id = 1 AND game_difficulty = 'medium';

SELECT * FROM scores WHERE player_id = 1 AND game_id = 1 AND game_difficulty = 'medium';

/*
	Story 10: Send message global chat request
*/

INSERT INTO messages (game_id, player_id, message)
VALUES (1, 1, "petit test des familles");

/*
	Story 11: Fetch global chat
*/

SELECT m.message, p.pseudo, m.message_timestamp,
CASE
    WHEN player_id = 1 /* <- REPLACE CONNECTED USER ID */ THEN TRUE
    ELSE FALSE
END AS isSender

FROM messages AS m
LEFT JOIN players AS p ON m.player_id = p.id
LEFT JOIN games as g ON m.game_id = g.id

WHERE m.message_timestamp >= NOW() - INTERVAL 1 DAY;

/*
	Story 12: Search score from player pseudo
*/

INSERT INTO players (pseudo, email, pwd)
VALUES ("vegasword", "test@testostas.net", "safe1234");
INSERT INTO scores (player_id, game_id, game_difficulty, score)
VALUES (6, 1, "easy", 6969);

SELECT * FROM scores AS s JOIN players AS p ON s.player_id = p.id
WHERE p.pseudo LIKE "%sword";