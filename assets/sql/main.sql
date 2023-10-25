/* 
	Story 1: Create the databases and the tables
*/

DROP DATABASE IF EXISTS fantasy_memory;
CREATE DATABASE fantasy_memory CHARACTER set 'utf8';
USE fantasy_memory;

CREATE TABLE games (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(64)
) ENGINE=INNODB;

CREATE TABLE players (
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	pseudo VARCHAR(256) NOT NULL UNIQUE,
    email VARCHAR(256) NOT NULL UNIQUE,
    pwd VARCHAR(256) NOT NULL,
    sign_up_timestamp DATETIME DEFAULT NOW(),
    latest_connection_timestamp DATETIME
) ENGINE=INNODB;

CREATE TABLE scores (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    player_id INT UNSIGNED NOT NULL,
    game_id INT UNSIGNED NOT NULL,
	game_difficulty ENUM('easy', 'medium', 'hard') NOT NULL,
    score INT UNSIGNED NOT NULL,
    score_timestamp DATETIME DEFAULT NOW()
) ENGINE=INNODB;

CREATE TABLE messages (
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    game_id INT UNSIGNED NOT NULL,
    player_id INT UNSIGNED NOT NULL,
    message TEXT NOT NULL,
    message_timestamp DATETIME DEFAULT NOW()
) ENGINE=INNODB;

/*
	STORY : 13 
*/

CREATE TABLE private_messages (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_player_id INT UNSIGNED NOT NULL,
    second_player_id INT UNSIGNED NOT NULL,
	message VARCHAR(256),
    sent_timestamp DATETIME DEFAULT NOW(),
    read_timestamp DATETIME,
    isRead BOOLEAN DEFAULT false
) ENGINE=INNODB;

ALTER TABLE private_messages
ADD CONSTRAINT fk_privateMessage_Fplayer
FOREIGN KEY (first_player_id) REFERENCES players(id) ON DELETE CASCADE,
ADD CONSTRAINT fk_privateMessage_Splayer
FOREIGN KEY (second_player_id) REFERENCES players(id) ON DELETE CASCADE;


ALTER TABLE scores
ADD CONSTRAINT fk_score_player
FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
ADD CONSTRAINT fk_score_game
FOREIGN KEY (game_id) REFERENCES games(id) ON DELETE CASCADE;

ALTER TABLE messages
ADD CONSTRAINT fk_message_player
FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
ADD CONSTRAINT fk_message_game
FOREIGN KEY (game_id) REFERENCES games(id) ON DELETE CASCADE;

/*
	Story 2: Insert some datas
*/

INSERT INTO players(pseudo, email, pwd)
VALUES ('firetech', 'firetech@email.com', 'PassWord'),
       ('new-tech', 'new-tech@email.com', 'PassWord'),
       ('Tom', 'Tom@email.com', 'PassWord'),
       ('Alexendre', 'Alexendre@email.com', 'PassWord'),
       ('Po', 'Po@email.com', 'PassWord');

INSERT INTO games(name) VALUES ('mincraftCard');

INSERT INTO scores(player_id, game_id, game_difficulty, score)
VALUES (1, 1, 'medium', 23), (1, 1, 'hard', 234), (1, 1, 'medium', 43),
	   (1, 1, 'easy', 34), (1, 1, 'medium', 456), (2, 1, 'easy', 45),
	   (2, 1, 'easy', 456), (2, 1, 'easy', 234), (2, 1, 'easy', 2345),
	   (2, 1, 'hard', 6), (3, 1, 'medium', 45), (3, 1, 'hard', 74),
	   (3, 1, 'hard', 65), (3, 1, 'easy', 4), (3, 1, 'hard', 475),
	   (4, 1, 'easy', 753), (4, 1, 'hard', 457), (4, 1, 'medium', 63456),
	   (4, 1, 'easy', 8643), (4, 1, 'hard', 34509), (5, 1, 'hard', 3),
	   (5, 1, 'hard', 2), (5, 1, 'easy', 7), (5, 1, 'hard', 0),
	   (5, 1, 'medium', 1);

INSERT INTO messages(game_id, player_id, message)
VALUES (1,1,'Hello word !'), (1,2,'Hi'), (1,5,'Good morning ?'),
	   (1,3,'Well good night'), (1,4,'Where do u from'), (1,2,'how are u ?'),
	   (1,3,'nobody'), (1,5,'o k'), (1,4,'LOL'),
	   (1,1,'XD'), (1,5,'who wanna play valo'), (1,3,'no god plz no'),
	   (1,4,'I wanna play LoL'), (1,2,'do u take showers ?'), (1,1,'well no'),
	   (1,1,'nope unfortunatly'), (1,2,'I play OW2'), (1,5,'OW is dead isn\'t'),
	   (1,4,'yeah lmao'), (1,3,':sobs:'), (1,1,'jeez that man is cringe'),
	   (1,4,'so what do we do'), (1,5,'go play CS2'), (1,3,'nope'),
	   (1,2,'I did unistalled it yesterday');

/*
	'Story 3: Sign up request
*/

INSERT INTO players (pseudo, email, pwd)
VALUES ('test', 'test@test.com', '1234tkt');

/*
	Story 4: Update profile once connected
*/

UPDATE players SET email='newtest@update.com' WHERE id = 1;
UPDATE players SET pwd='saluté11' WHERE id = 1;

/*
	Story 5: Sign in request 
*/

UPDATE players AS p SET latest_connection_timestamp=NOW()
WHERE p.email = 'new-tech@email.com' AND p.pwd = 'PassWord';

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
WHERE p.pseudo = 'new-tech' OR g.name = ' ' OR s.game_difficulty = ' '
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
VALUES (1, 1, 'petit test des familles');

/*
	Story 11: Fetch global chat
*/

SELECT m.message, p.pseudo, m.message_timestamp,
CASE
    WHEN player_id = 1 THEN TRUE
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
VALUES ('vegasword', 'test@testostas.net', 'safe1234');
INSERT INTO scores (player_id, game_id, game_difficulty, score)
VALUES (6, 1, 'easy', 6969);

SELECT * FROM scores AS s JOIN players AS p ON s.player_id = p.id
WHERE p.pseudo LIKE '%sword';

/*
	Story 14
*/


-- Creat msg

INSERT INTO private_messages(first_player_id,second_player_id,message)	VALUES 
(1,2,'Hello you !'), (1,2,'You are ?'), (1,2,'Yes'), (1,2,'You dont no who i am ?'), (1,2,'Nop'), (1,2,'I am your nightmare ^_^'),
(1,3,'Hello you !'), (1,3,'You are ?'), (1,3,'Yes'), (1,3,'You dont no who i am ?'), (1,3,'Nop'), (1,3,'I am your Daydy ^_^'),
(2,4,'Hello you !'), (2,4,'You are ?'), (2,4,'Yes'), (2,4,'You dont no who i am ?'), (2,4,'Nop'), (2,4,'I am your Brother ^_^'),
(2,3,'Hello you !'), (2,3,'You are ?'), (2,3,'Yes'), (2,3,'You dont no who i am ?'), (2,3,'Nop'), (2,3,'I am your Mother ^_^'),
(4,1,'Hello you !'), (4,1,'You are ?'), (4,1,'Yes'), (4,1,'You dont no who i am ?'), (4,1,'Nop'), (4,1,'I am your Sister ^_^');

-- Delet msg 

DELETE FROM private_messages WHERE id = 6;

-- Update msg

UPDATE private_messages SET message = 'I am Anonymos :)' WHERE id = 12;


/* 
	Story 15: Display every conversations
*/

SELECT DISTINCT
    sender.pseudo,receiver.pseudo,pm.sent_timestamp,pm.read_timestamp,pm.isRead
FROM private_messages pm
LEFT JOIN players sender ON pm.first_player_id = sender.id
LEFT JOIN players receiver ON pm.second_player_id = receiver.id
WHERE sender.id = 1 OR receiver.id = 1
ORDER BY pm.sent_timestamp DESC;
