SELECT
    g.name AS GameName,
    p.pseudo AS PlayerName,
    s.game_difficulty AS GameDifficulty,
    s.score AS Score
FROM
    score s
JOIN game g ON s.game_id = g.id
JOIN player p ON s.player_id = p.id
WHERE
    g.name = 'Name Game' -- search by name game
    -- p.pseudo = 'Player' -- for search by pseudo
    -- s.game_difficulty = 'diffuclty of game' -- for search by difficulty game
ORDER BY
    g.name ASC, -- orded by alphabetical 
    -- s.game_difficulty, -- orded by diffuculty 
    -- s.score; -- orded by score 