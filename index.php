<?php
require "utils/common.php";
require "partials/head.php";
require "partials/header.php";
require "partials/footer.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta name="description" content="Project Flash from Coding Factory">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    
    <link rel="stylesheet" href="assets/css/normalize.css">
    <script src="https://kit.fontawesome.com/6abcad6372.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
    <header>
        <nav>
            <a href="<?= PROJECT_FOLDER ?>index.php"><h3>The Power Of Memory</h3></a>
            <ul>
                <li><a id="active">Home</a></li>
                <li><a href="<?= PROJECT_FOLDER ?>games/memory/index.php">Games</a></li>
                <li><a href="<?= PROJECT_FOLDER ?>games/memory/scores.php">Scoreboard</a></li>
                <li><a href="<?= PROJECT_FOLDER ?>shop.php">Shop</a></li>
                <li><a href="<?= PROJECT_FOLDER ?>contact.php">Contact Us</a></li>
                <!-- TODO: Account icon redirecting the right pages -->
            </ul>
        </nav>
    </header>

    <main>
        <section  class="big-banner"> 
            <h1>WELCOME TO <br/> OUR STUDIO !</h1>
            <h3>Come and challenge the most agile minds !</h3>    
            <a class="button" href="games/memory/index.php">Play !</a>
        </section>

        <section class="container lorem-container no-margin-bot justify-content-space-between">
            <img class="img-fluid" id="lorem-img-1" src="assets/img/lorem3.jpeg" alt="">
            <img class="img-fluid" id="lorem-img-2" src="assets/img/lorem2.jpeg" alt="">
            <img class="img-fluid" id="lorem-img-3" src="assets/img/lorem1.jpeg" alt="">
        </section>

        <section class="container lorem-container nowrap">
            <div class="lorem-subcontainer d-flex">
                <h3>01</h3>
                <div>
                    <h4>Lorem Ipsum</h4>
                    <p>
                        Quisque commodo facilisis purus, interdum volutpat arcu
                        viverra sed. Etiam sodales convallis pretium. Aenean
                        pharetra laoreet loram. Nunc dapibus tincidunt sem a
                        pharetra. Duis vitae tristique leo, sed faucibus ipsum.
                    </p>
                </div>
            </div>
            <div class="lorem-subcontainer d-flex">
                <h3>02</h3>
                <div>
                    <h4>Lorem Ipsum</h4>
                    <p>
                        Quisque commodo facilisis purus, interdum volutpat arcu
                        viverra sed. Etiam sodales convallis pretium. Aenean
                        pharetra laoreet loram. Nunc dapibus tincidunt sem a
                        pharetra. Duis vitae tristique leo, sed faucibus ipsum.
                    </p>
                </div>
            </div>
            <div class="lorem-subcontainer d-flex">
                <h3>03</h3>
                <div>
                    <h4>Lorem Ipsum</h4>
                    <p>
                        Quisque commodo facilisis purus, interdum volutpat arcu
                        viverra sed. Etiam sodales convallis pretium. Aenean
                        pharetra laoreet loram. Nunc dapibus tincidunt sem a
                        pharetra. Duis vitae tristique leo, sed faucibus ipsum.
                    </p>
                </div>
            </div>
        </section>

        <section class="container" id="stats">
            <img src="assets/img/stats.jpg" alt="">
            <div>
                <div class="d-flex">
                    <div class="stats-box" id="stats-box-1">
                        <?php
                            $pdoStatement = $pdo->prepare("
                            SELECT COUNT(*) FROM scores;
                            ");
                            $pdoStatement->execute();
                            $gamePlayed = $pdoStatement-> fetchColumn(0);
                        ?>
                                <p><?= $gamePlayed ?></p>
                        <?php ?>
                        <span>Games Played</span>
                    </div>
                    <div class="stats-box" id="stats-box-2">
                        <?php
                            $pdoStatement = $pdo->prepare("
                            SELECT COUNT(*) FROM players;
                            ");
                            $pdoStatement->execute();
                            $playerConnected = $pdoStatement-> fetchColumn(0);
                        ?>
                                <p><?= $playerConnected - 4 ?></p>
                        <?php ?>
                        <span>Player Connected</span>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="stats-box" id="stats-box-3">
                        <?php
                            $pdoStatement = $pdo->prepare("
                            SELECT MIN(score) FROM scores;
                            ");
                            $pdoStatement->execute();
                            $bestScore = $pdoStatement-> fetchColumn(0);
                        ?>
                                <p><?= $bestScore * 60 . ' sec'?></p>
                        <?php ?>
                        <span>Record Time</span>
                    </div>
                    <div class="stats-box" id="stats-box-4">
                        <?php
                            $pdoStatement = $pdo->prepare("
                            SELECT COUNT(*) FROM players;
                            ");
                            $pdoStatement->execute();
                            $playerRegistred = $pdoStatement-> fetchColumn(0);
                        ?>
                                <p><?= $playerRegistred ?></p>
                        <?php ?>
                        <span>Player Registered</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="container flex-column" id="team-overview">
            <h3>The Dev Team</h3>
            <p class="lorem-text">
                Quisque commodo facilisis purus, interdum 
                volutpat arcu viverra sed.
            </p>
            <img id="img-hr" src="./assets/img/hr-site.png" alt="">
            <div class="nowrap" id="team-container">
                <article>
                    <img src="assets/img/pdp3.jpg" alt="">
                    <h4>Tom</h4>
                    <p class="lorem-text">Web Dev</p>
                    <div class="social-networks">
                        <i class=" fa-brands fa-facebook-f"></i>
                        <i class=" fa-brands fa-twitter"></i>
                        <i class=" fa-brands fa-pinterest"></i>
                    </div>
                </article>
                <article>
                    <img src="assets/img/pdp2.jpeg" alt="">
                    <h4>Alexandre</h4>
                    <p class="lorem-text">Web Dev</p>
                    <div class="social-networks">
                        <i class=" fa-brands fa-facebook-f"></i>
                        <i class=" fa-brands fa-twitter"></i>
                        <i class=" fa-brands fa-pinterest"></i>
                    </div>
                </article>
                <article>
                    <img src="assets/img/pdp1.jpeg" alt="">
                    <h4>Ahmad</h4>
                    <p class="lorem-text">Web Dev</p>
                    <div class="social-networks">
                        <i class=" fa-brands fa-facebook-f"></i>
                        <i class=" fa-brands fa-twitter"></i>
                        <i class=" fa-brands fa-pinterest"></i>
                    </div>
                </article>
            </div>
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