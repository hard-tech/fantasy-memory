/* Filter for HighScore 
    filter : Game , Player , game difficulty  
 */

SELECT `id`, `player_id`, `game_id`, `game_difficulty`, `score`, `score_timestamp` FROM `score` WHERE
  `player_id` LIKE '%Player ID%'
  AND `game_id` LIKE '%Game ID%'
  AND `game_difficulty` LIKE '%Game Difficulty%'
ORDER BY `score` DESC;