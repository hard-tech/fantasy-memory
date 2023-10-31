<?php
require "utils/common.php";
$page = "home";
?>

<!DOCTYPE html>
<html lang="fr">
<?php include('partials/head.php'); ?>
<body>
    <?php include('partials/header.php'); ?>
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
    <?php include('partials/footer.php'); ?>

</body>

</html>