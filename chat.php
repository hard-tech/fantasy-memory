<?php
    if(isset($_POST["sendMessage"]) && $_POST["sendMessage"] !== ""){
        $sendMessage = $_POST["sendMessage"];
        $pdo = connectToDbAndGetPdo();
        $pdoStatement = $pdo->prepare("
            INSERT INTO messages (game_id, player_id, message) VALUES (:gameId, :playerId, :messageContent);
        ");
        $result = $pdoStatement->execute([
            ":messageContent" => $sendMessage,
            ":playerId" => $_SESSION["user"]["id"],
            ":gameId" => 1,
        ]);
    }
?>

<div class="game-chat">
        <div id="group-arrow">
            <div id="arrow-down_up">
                <a id="close">
                    <i class="fa-regular fa-circle-xmark"></i>
                    <input type="checkbox" id="game-chat-checkbox">
                </a>
            </div>
        </div>
        <div id="header-chat">
            <div>
                <div class="d-flex">
                    <div class="icon-chat">
                        <!-- <img src="https://cdn-icons-png.flaticon.com/512/6785/6785675.png" width="50px" alt=""> -->
                        <?php
                            $url = 'https://api.thecatapi.com/v1/images/search?mime_types=gif';
                            $data = file_get_contents($url);

                            // Convertir les données JSON en tableau associatif
                            $catData = json_decode($data, true);
                        ?>
                        <img src=<?= $catData[0]["url"] ?> alt="Cat GIF" alt="CAT GIF">
                    </div>
                    <div class="circle-green">
                    </div>
                    <h2 id="chat-title">Chat Room</h2>
                </div>
            </div>
        </div>
        <div id="chat-main">
            <div id="content-message">

                <!-- message envoyer / Reçu -->
                <?php 
                    $pdoStatement = $pdo->prepare("
                        SELECT m.message, p.pseudo, m.message_timestamp,
                        CASE WHEN player_id = :MyId THEN TRUE ELSE FALSE END AS isSender
                        FROM messages AS m
                        LEFT JOIN players AS p ON m.player_id = p.id
                        LEFT JOIN games as g ON m.game_id = g.id;
                    ");

                    $pdoStatement->execute([
                        ":MyId" => $_SESSION["user"]["id"]
                    ]);
                    $messages = $pdoStatement->fetchAll();
                    foreach($messages as $m) {
                ?>
                        <div class="<?= $m->isSender == 1 ? 'chat-send-by-me' : 'chat-send-by-other' ?>">
                                <div class="chat-my_name"><?= $m->pseudo ?></div>
                                <div class="chat-message <?= $m->isSender == 1 ? 'chat-message-send-by-me' : 'chat-message-send-by-other' ?>">
                                    <?= $m->message ?>
                                </div>
                                <div class="DateChat">
                                    <?= $m->message_timestamp ?>
                                </div>
                        </div>
                <?php } ?>
            </div>
        </div>
        <form method="post" id="chat-footer">
            <input name="sendMessage" id="chat-input" type="text" placeholder="Your message">
            <button type="submit" id="chat-send-btn">Send</button>
        </form>
    </div>

<!-- <div class="collapse" tabindex="1">
    <a id="open"><i class="fa-regular fa-comment"></i></a>

</div> -->