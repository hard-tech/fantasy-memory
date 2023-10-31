<?php
require "../../utils/common.php";
require "../../partials/head.php";
require "../../partials/header.php";
require "../../partials/footer.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta name="description" content="Project Flash from Coding Factory">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game</title>

    <link rel="stylesheet" href="assets/css/normalize.css">
    <script src="https://kit.fontawesome.com/6abcad6372.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../../assets/css/header.css">
    <link rel="stylesheet" href="../../assets/css/footer.css">
    <link rel="stylesheet" href="../../assets/css/main.css">
</head>

<body>
    <header class="alt-navbar">
        <nav>
            <a href="<?= PROJECT_FOLDER ?>index.php"><h3>The Power Of Memory</h3></a>
            <ul>
                <li><a href="<?= PROJECT_FOLDER ?>index.php">Home</a></li>
                <li><a id="active" href="<?= PROJECT_FOLDER ?>games/memory/index.php">Games</a></li>
                <li><a href="<?= PROJECT_FOLDER ?>games/memory/scores.php">Scoreboard</a></li>
                <li><a href="<?= PROJECT_FOLDER ?>shop.php">Shop</a></li>
                <li><a href="<?= PROJECT_FOLDER ?>contact.php">Contact Us</a></li>
            </ul>
        </nav>
    </header>

    <main id="game">
        <table>
            <tbody>
                <?php for($i=0; $i < 3; $i++) {?>
                    <tr>
                        <td>♦</td>
                        <td>♦</td>
                        <td>♦</td>
                        <td>♦</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

    <footer>
        <section>
            <div>
                <h3>Information</h3>
                <p class="lorem-text">
                    Quisque commodo facilsis purus,
                    interdum volutpat arcu viverra sed.
                </p>
                <p class="lorem-text">
                    <span class="Fspan">Phone :</span>
                    06 05 04 03 02
                </p>
                <p class="lorem-text">
                    <span class="Fspan">Email :</span>
                    support@powerofmemory.com
                </p>
                <p class="lorem-text">
                    <span class="Fspan">Location :</span>
                    Paris
                </p>
                <div>
                    <i class="iconf fa-brands fa-facebook-f"></i>
                    <i class="iconf fa-brands fa-twitter"></i>
                    <i class="iconf fa-brands fa-google"></i>
                    <i class="iconf fa-brands fa-pinterest"></i>
                    <i class="iconf fa-brands fa-instagram"></i>
                </div>
            </div>
            <div class="footer-info">
                <h3>Power Of Memory</h3>
                <ul class="lorem-text">
                    <li><a href="<?= PROJECT_FOLDER ?>games/memory/index.php"> Play !</a></li>
                    <li><a href="<?= PROJECT_FOLDER ?>games/memory/scores.php"> Scores</a></li>
                    <li><a href="<?= PROJECT_FOLDER ?>contact.php"> Contact us</a></li>
                </ul>
            </div>
            <div></div>
        </section>

        <p class="Ltxt" id="copyright">Copyright &copysr; 2023 All rights reserved</p>
    </footer>

    <!-- Chat Popup -->
    <div class="collapse" tabindex="1">
        <a id="open">
            <i class="fa-regular fa-comment"></i>
        </a>

 
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
                        <img src="https://cdn-icons-png.flaticon.com/512/6785/6785675.png" width="50px" alt="">
                    </div>
                    <div class="circle-green"></div>
                    <h2 id="chat-title">Chat Room</h2>
                </div>
            </div>
        </div>
        <div id="chat-main">
            <div id="content-message">
                <div class="chat-send-by-me">
                    <div class="flex-chat">
                        <div class="chat-my_name">Me</div>
                        <div class="chat-message chat-message-send-by-me">
                            Hello Word
                        </div>
                        <div class="DateChat">
                            Today at 20:45
                        </div>
                    </div>
                </div>
                <div class="chat-send-by-other">
                    <div class="flex-chat">
                        <div class="chat-my_name">Lola</div>
                        <div class="chat-message chat-message-send-by-other">
                            UwU
                        </div>
                        <div class="DateChat">
                            Today at 20:45
                        </div>
                    </div>
                </div>
                <div class="chat-send-by-me">
                    <div class="flex-chat">
                        <div class="chat-my_name">Me</div>
                        <div class="chat-message chat-message-send-by-me">
                            Ho ...
                        </div>
                        <div class="DateChat">
                            Today at 20:45
                        </div>
                    </div>
                </div>
                <div class="chat-send-by-other">
                    <div class="flex-chat">
                        <div class="chat-my_name">Toma</div>
                        <div class="chat-message chat-message-send-by-other">
                            Grr XD
                        </div>
                        <div class="DateChat">
                            Today at 20:45
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <form id="chat-footer">
                <input id="chat-input" type="text" placeholder="Your message">
                <button id="chat-send-btn">Send</button>
            </form>
    </div>
</div>

</body>

</html>