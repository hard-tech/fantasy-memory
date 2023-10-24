SELECT m.message_content, p.pseudo, m.message_timestamp,
CASE
    WHEN player_id = 1 /* <- REPLACE CONNECTED USER ID */ THEN TRUE
    ELSE FALSE
END AS isSender

FROM message AS m
LEFT JOIN player AS p ON m.player_id = p.id
LEFT JOIN game as g ON m.game_id = g.id

WHERE m.message_timestamp >= NOW() - INTERVAL 1 DAY;