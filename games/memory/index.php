<?php
require "../../utils/common.php";
$page = "game";

?>

<!DOCTYPE html>
<html lang="fr">

<?php include('../../partials/head2game.php'); ?>


<body>
<?php include('../../partials/header.php'); ?>

    <main id="game">
        <?php if (isset($_SESSION["user"])) : ?>
            <div >Timers : <span id="chrono">0</span> s</div>
            <table>
                <tbody>
                    <?php
                    $card = 0;
                    if($_SESSION["memoryInfo"]["difficulty"] == "hard"){
                        $card = 3;
                    }elseif($_SESSION["memoryInfo"]["difficulty"] == "medium"){
                        $card = 2;

                    }else{
                        $card = 1;

                    }     
                    for($i=0; $i < $card; $i++) {

                        ?>
                        <tr>
                            <td>♦</td>
                            <td>♦</td>
                            <td>♦</td>
                            <td>♦</td>
                        </tr>
                    <?php } ?>
                </tbody>
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

    <?php include('../../partials/footer.php'); ?>
    <?php if (isset($_SESSION["user"])) : ?>
        <?php include('../../chat.php'); ?>
    <?php endif; ?>
    <script src="../../assets/js/chrono.js"></script>
</body>
</html>