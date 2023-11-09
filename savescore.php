<?php
require "utils/common.php";

$pdoStatement = $pdo->prepare(
   "SELECT s.score FROM scores AS s 
    WHERE s.player_id = :player_id  AND s.game_id = :game_id 
    AND s.game_difficulty = :game_difficulty"
);
$pdoStatement->execute([
    ":player_id" => $_SESSION["user"]["id"], 
    ":game_id" => $_POST["gameId"],
    ":game_difficulty" => $_POST["gameDifficulty"]
]);
$result = $pdoStatement->fetch();
if (!$result) {
    $pdoStatement = $pdo->prepare(
       "INSERT INTO scores (player_id, game_id, game_difficulty, score) 
        VALUES (:player_id, :game_id, :game_difficulty, :score)"
    );
    $pdoStatement->execute([
        ":player_id" => $_SESSION["user"]["id"],
        ":game_id" => $_POST["gameId"],
        ":game_difficulty" => $_POST["gameDifficulty"],
        ":score" => $_POST["score"]
    ]);
}
else if ($_POST["score"] < $result->score) {
    $pdoStatement = $pdo->prepare(
       "UPDATE scores SET score = :score
        WHERE player_id = :player_id  AND game_id = :game_id 
        AND game_difficulty = :game_difficulty"
    );
    $pdoStatement->execute([
        ":player_id" => $_SESSION["user"]["id"],
        ":game_id" => $_POST["gameId"],
        ":game_difficulty" => $_POST["gameDifficulty"],
        ":score" => $_POST["score"]
    ]);
}
