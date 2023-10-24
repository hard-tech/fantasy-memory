/* Display highscores */

USE fantasy_memory;

SELECT g.name, s.game_difficulty, p.pseudo, s.score
FROM score AS s
LEFT JOIN player AS p ON s.player_id = p.id
LEFT JOIN game AS g ON s.game_id = g.id
ORDER BY g.name, s.game_difficulty, s.score DESC;