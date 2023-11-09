<?php
require_once('utils/database.php');
require_once('utils/common.php');
$data = $_POST['sendMessage'];
$id_joueur = $_POST['iduser'];

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
                        SELECT m.message, p.pseudo, m.message_timestamp, p.profilePictureUrl,
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

                        if (strpos($m->profilePictureUrl, 'http') === 0) {
                            $correctSrc = 'src="'.$m->profilePictureUrl.'"';
                        }else{
                            $UrlOrFiles = "https://img.freepik.com/vecteurs-premium/icone-profil-style-glitch-homme-vecteur_549897-2126.jpg";
                            $correctSrc = 'src="'. $UrlOrFiles .'"';
                        }
        
                        // if (!empty($m->profilePictureUrl)) {
                        //     if($UrlOrFiles !== ""){
                        //         $correctSrc = 'src="'. $UrlOrFiles .$result->profilePictureUrl.'"';
                        //     }else{
                        //         $correctSrc = 'src="'.$m->profilePictureUrl.'"';
                        //     }
                        // }
                        // else {
                        //     $correctSrc = 'src="'.PROJECT_FOLDER.'"assets/img/default-pp-fantasy-memory.webp"';
                        // }
                ?>
                        <div class="<?= $m->isSender == 1 ? 'chat-send-by-me' : 'chat-send-by-other' ?>">
                            <div class="infos-message <?= $m->isSender == 1 ? 'flex-row-reverse' : 'flex-row' ?>">
                                <img <?= $correctSrc ?> class="pp-players" alt="">
                                <div class="<?= $m->isSender == 1 ? 'stack-message-me' : 'stack-message-other' ?>">
                                    <div class="chat-my_name"><?= $m->pseudo ?></div>
                                    <div class="chat-message <?= $m->isSender == 1 ? 'chat-message-send-by-me' : 'chat-message-send-by-other' ?>">
                                        <?= $m->message ?>
                                    </div>
                                    <div class="chat-time">
                                        <?php
                                            $DateSend = new DateTime($m->message_timestamp);
                                            echo $DateSend -> format('l jS \of F Y h:i:s A');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php } ?>
            </div>
        </div>
        <div  id="chat-footer">
            <input name="sendMessage" id="chat-input" type="text" placeholder="Your message">
            <input type="button" name="btnEnvoie" id="chat-send-btn" value="Send" onclick="ajaxEnvoie('<?= $m->pseudo ?>')">
        </div>
    </div>
   
        
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> 
    <script src="../../assets/js/sendMSG.js"></script>
