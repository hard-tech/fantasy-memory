<?php
require('utils/common.php');

$messsage = $_POST['sendMessage'];
$pdoStatement = $pdo->prepare("
    INSERT INTO messages (game_id, player_id, message) VALUES (:gameId, :playerId, :messageContent);
"); 
$result = $pdoStatement->execute([
    ":messageContent" => $messsage,
    ":playerId" => $_SESSION['user']['id'],
    ":gameId" => 1
]);

