/* Search score by pseudo */

INSERT INTO player (pseudo, email, pwd) VALUES ("vegasword", "test@testostas.net", "safe1234");
INSERT INTO score (player_id, game_id, game_difficulty, score) 
SELECT p.id, g.id, "easy", 6969
FROM player AS p
CROSS JOIN game AS g
WHERE p.pseudo = "vegasword" AND g.name = "mincraftCard";

-- Below the search request --
SELECT s.score FROM score AS s JOIN player AS p ON s.player_id = p.id
WHERE p.pseudo = "vegasword";