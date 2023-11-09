<?php
require "../../utils/common.php";
$page = "Memory Game";

?>

<!DOCTYPE html>
<html lang="fr">

<?php include('../../partials/head2game.php'); ?>


<body>
<?php include('../../partials/header.php'); ?>

    <main id="game">
        <?php if (isset($_SESSION["user"])) : ?>
            <div id="contentInfo">
            <div >Timer: <span id="timer">00:00:00</span></div>
            <div >Pairs Trouvées : <span id="score">0</span></div>
            </div>            
            <table>
                <tbody id="game-board"></tbody>
            </table>
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
    <script src="../../assets/js/memory.js"></script>
</body>
</html>