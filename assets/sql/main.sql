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
	STORY 13: Create a private messaging
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

INSERT INTO games(name) VALUES ('Power Of Memory');

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

INSERT INTO messages(game_id, player_id, message, message_timestamp)
VALUES
(1, 1, 'Hello word !', '2023-10-26 21:40:00'),
(1, 2, 'Hi', '2023-10-26 21:41:24'),
(1, 5, 'Good morning ?', '2023-10-26 21:42:24'),
(1, 3, 'Well good night', '2023-10-26 21:43:24'),
(1, 4, 'Where do u from', '2023-10-26 21:44:24'),
(1, 2, 'how are u ?', '2023-10-26 21:45:24'),
(1, 3, 'nobody', '2023-10-26 21:46:24'),
(1, 5, 'o k', '2023-10-26 21:47:24'),
(1, 4, 'LOL', '2023-10-26 21:48:24'),
(1, 1, 'XD', '2023-10-26 21:49:24'),
(1, 5, 'who wanna play valo', '2023-10-26 21:50:19'),
(1, 3, 'no god plz no', '2023-10-26 21:51:24'),
(1, 4, 'I wanna play LoL', '2023-10-26 21:52:24'),
(1, 2, 'do u take showers ?', '2023-10-26 21:53:24'),
(1, 1, 'well no', '2023-10-26 21:54:24'),
(1, 1, 'nope unfortunatly', '2023-10-26 21:55:24'),
(1, 2, 'I play OW2', '2023-10-26 21:56:24'),
(1, 5, 'OW is dead is not', '2023-10-26 21:57:24'),
(1, 4, 'yeah lmao', '2023-10-26 21:58:24'),
(1, 3, ':sobs:', '2023-10-26 21:59:24'),
(1, 1, 'jeez that man is cringe', '2023-10-26 22:00:24'),
(1, 4, 'so what do we do', '2023-10-26 22:01:24'),
(1, 5, 'go play CS2', '2023-10-26 22:02:24'),
(1, 3, 'nope', '2023-10-26 22:03:24'),
(1, 2, 'I did unistalled it yesterday', '2023-10-26 22:04:24'),
(1, 1, 'petit test des familles', '2023-10-26 21:41:24');
/*
	Story 3: Sign up request
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
CASE WHEN player_id = 1 THEN TRUE ELSE FALSE END AS isSender
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
VALUES (7, 1, 'easy', 6969);

SELECT * FROM scores AS s JOIN players AS p ON s.player_id = p.id
WHERE p.pseudo LIKE '%sword';

/*
	Story 14: Add test data and manage message creation and deletion
*/

INSERT INTO private_messages(first_player_id, second_player_id, message, sent_timestamp)
VALUES 
(1, 2, 'A', '2023-10-10 03:41:25'),
(1, 2, 'B', '2023-10-26 05:41:25'),
(1, 2, 'C', '2023-10-26 06:41:25'),
(1, 2, 'D', '2023-10-26 07:41:25'),
(1, 2, 'E', '2023-10-26 08:41:25'),
(1, 3, 'G', '2023-10-26 09:41:25'),
(1, 3, 'H', '2023-10-26 10:41:25'),
(1, 3, 'I', '2023-10-26 11:41:25'),
(1, 3, 'J ?', '2023-10-26 12:41:25'),
(1, 3, 'K', '2023-10-26 13:41:25'),
(1, 3, 'I am Blue', '2023-10-10 04:00:00'),
(2, 4, 'M', '2023-10-26 14:41:25'),
(2, 4, 'N', '2023-10-10 02:42:25'),
(2, 4, 'O', '2023-10-26 15:41:25'),
(2, 4, 'P', '2023-10-26 16:41:25'),
(2, 4, 'Q', '2023-10-26 17:41:25'),
(2, 4, 'R', '2023-10-26 18:41:25'),
(2, 3, 'S', '2023-10-26 19:41:25'),
(2, 3, 'T', '2023-10-26 20:41:25'),
(2, 3, 'U', '2023-10-26 21:41:25'),
(2, 3, 'V', '2023-10-26 22:41:25'),
(2, 3, 'W', '2023-10-26 21:41:25'),
(2, 3, 'Y', '2023-10-27 01:41:25'),
(4, 1, 'Z', '2023-10-27 02:41:25'),
(4, 1, 'A1', '2023-10-26 21:41:25'),
(4, 1, 'B1', '2023-10-26 21:41:25'),
(4, 1, 'C1', '2023-10-26 21:41:25'),
(4, 1, 'D1', '2023-10-26 01:41:25'),
(4, 1, 'F1', '2023-10-26 23:41:25');

UPDATE private_messages SET message = 'I am Blue' WHERE id = 7;

DELETE FROM private_messages WHERE id = 6;


/* 
	Story 15: Display every conversations
*/

SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));

SELECT sender.pseudo, receiver.pseudo, pm.message,
	   MAX(pm.sent_timestamp) as sent_datetime, pm.read_timestamp, pm.isRead
FROM private_messages pm
LEFT JOIN players sender ON pm.first_player_id = sender.id
LEFT JOIN players receiver ON pm.second_player_id = receiver.id
WHERE sender.id = 1 OR receiver.id = 1
GROUP BY sender.id + receiver.id HAVING MAX(pm.sent_timestamp);


/*
    Story 16: Display a conversation between 2 users
*/

SELECT
    pm.message,
    pm.sent_timestamp,
    pm.read_timestamp,
    pm.isRead,
    p.pseudo as pseudo_envoyeur,
    p2.pseudo as pseudo_receveur,
    (
        SELECT COUNT(*) FROM scores WHERE player_id = pm.first_player_id
    ) as nbr_partie_jouer_envoyeur,
    (
        SELECT COUNT(*) FROM scores WHERE player_id = pm.second_player_id
    ) as nbr_partie_jouer_receveur,
    (
            SELECT COUNT(s2.game_id) AS game_count
            FROM scores AS s2
            LEFT JOIN games AS g2 ON s2.game_id = g2.id
            WHERE s2.player_id = pm.first_player_id
            GROUP BY s2.game_id
            ORDER BY game_count DESC
            LIMIT 1
    ) as jeux_le_plus_jouer_envoyeur,
    (
            SELECT COUNT(s2.game_id) AS game_count
            FROM scores AS s2
            LEFT JOIN games AS g2 ON s2.game_id = g2.id
            WHERE s2.player_id = pm.second_player_id
            GROUP BY s2.game_id
            ORDER BY game_count DESC
            LIMIT 1
    ) as jeux_le_plus_jouer_receveur
FROM private_messages as pm
LEFT JOIN players as p
    ON p.id = pm.first_player_id
LEFT JOIN players as p2
    ON p2.id = pm.second_player_id
WHERE (pm.first_player_id = 1 AND pm.second_player_id = 2) OR (pm.first_player_id = 2 AND pm.second_player_id = 1) 
ORDER BY pm.sent_timestamp DESC;