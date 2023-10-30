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
    <title>Scoreboard</title>
    
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
                <li><a href="<?= PROJECT_FOLDER ?>games/memory/index.php">Games</a></li>
                <li><a id="active">Scoreboard</a></li>
                <li><a href="<?= PROJECT_FOLDER ?>shop.php">Shop</a></li>
                <li><a href="<?= PROJECT_FOLDER ?>contact.php">Contact Us</a></li>
                <!-- TODO: Account icon redirecting the right pages -->
            </ul>
        </nav>
    </header>

    <main class="scoreboard">
        <section class="banner">
            <h1>Scoreboard</h1>
        </section>
        <section class="container justify-content-center">
            <table>
                <thead>
                    <tr>
                        <td>Pseudo</td>
                        <td>Game difficulty</td>
                        <td>Score</td>
                        <td>Date and time</td>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $pdoStatement = $pdo->prepare("SELECT p.pseudo, s.game_difficulty, s.score, s.score_timestamp FROM scores AS s LEFT JOIN players AS p ON s.player_id = p.id LEFT JOIN games AS g ON s.game_id = g.id ORDER BY g.name, s.game_difficulty, s.score DESC;");
                    $pdoStatement->execute();
                    $scores = $pdoStatement->fetchAll();
                    foreach($scores as $s) {
                ?>
                    <tr>
                        <td><?= $s->pseudo ?></td>
                        <td><?= ucfirst($s->game_difficulty) ?></td>
                        <td><?= $s->score ?></td>
                        <td><?= $s->score_timestamp ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </section>
    </main>
    
    <footer>
        <section>
            <div class="footer-info">
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

        <p id="copyright">Copyright &copysr; 2023 All rights reserved</p>
    </footer>    
</body>

</html>