<?php
require "../../utils/common.php";
$page = "Dino Game";

?>

<!DOCTYPE html>
<html lang="fr">

<?php include('../../partials/head2game.php'); ?>


<body id="dinoGame">
<?php include('../../partials/header.php');


if (isset($_SESSION["user"])) : ?>

  <div id="game-area">
    <div id="start">
        <p>START GAME</p>
    </div>
    <div id="reload">
        <p>RESTART GAME</p>
    </div>
    <div id="info">
        <div id="score">Score: 0</div>
        <div id="gold">Gold: 0</div>
    </div>
    <div id="moyen-cube"></div>
    <div id="petit-cube"></div>
    <div id="petit-rond"></div>
  </div>
  <h1 id="game-over">Game Over</h1>


  <script src="../../assets/js/dino.js"></script>


  <?php else : ?>
            <section class="container justify-content-center no-margin-bot">
                <h1>You must be logged in to play the game !</h1>
            </section>
            <section class="container justify-content-center">
                <a class="button" href=<?= PROJECT_FOLDER."login.php"?>>Sign in</a>
            </section>
        <?php endif; ?>
    </main>
    <div id="group-up">
        <i class="fa-solid fa-comment-dots"></i>
    </div>
    <?php 
            include('../../partials/footer.php');
            if (isset($_SESSION["user"])) : 
                include('../../chat.php'); 
            endif; ?>

</body>
</html>
