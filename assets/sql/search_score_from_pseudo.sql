/* Search score by pseudo */

INSERT INTO player (pseudo, email, pwd) VALUES ("vegasword", "test@testostas.net", "safe1234");
INSERT INTO score (player_id, game_id, game_difficulty, score) VALUES(6, 1, "easy", 6969);

-- Below the search request with pattern matching --
SELECT s.score FROM score AS s JOIN player AS p ON s.player_id = p.id WHERE p.pseudo LIKE "%tech%";