<?php
require "../../utils/common.php";
$page = "game";
?>

<!DOCTYPE html>
<html lang="fr">

<?php include('../../partials/head2game.php'); ?>


<body>
<?php include('../../partials/header.php'); ?>

    <main id="filtreGame">

        <form method="post" onsubmit="initMemory()" id="formFilterSelectDT">

            <div id="contentSelectFG">
                <div>           
                    <label for="difficulty-select">Choose a difficulty :</label>

                    <select name="difficulty" id="difficulty-select">
                    <option value="">--Please choose an option--</option>
                    <option value="easy">Easy</option>
                    <option value="medium">Medium</option>
                    <option value="hard">Hard</option>

                    </select>
                </div>
                <div>
                    <label for="theme-select">Choose a theme :</label>

                    <select name="theme" id="theme-select">
                    <option value="">--Please choose an option--</option>
                    <option value="light">Medieval Fantaisie Theme</option>
                    <option value="dark">Cyber Punk Theme</option>
                    <option value="god">Dieu Grec Theme</option>
                    </select>
                </div>


            </div>

            <input type="submit" value="Jouer !">
        </form>


    </main>

    <?php include('../../partials/footer.php'); ?>
<script src="../../assets/js/memory-init.js"></script>
</body>
</html>

<?php 
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        if(isset($_SESSION["memoryInfo"])){
            unset($_SESSION["memoryInfo"]);
        }
        $theme = $_POST["difficulty"];
        $difficulty = $_POST["theme"];

        $_SESSION["memoryInfo"] = [ "difficulty" => $_POST["difficulty"], "theme" => $_POST["theme"] ];
        echo '<meta http-equiv="refresh" content="0;url='.PROJECT_FOLDER.'games/memory/index.php" />';
    }

