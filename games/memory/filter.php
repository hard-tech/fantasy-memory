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
                    <option value="">Please choose an option</option>
                    <option value="easy">Easy</option>
                    <option value="medium">Medium</option>
                    <option value="hard">Hard</option>

                    </select>
                    <p id="difficulty-err" style="visibility: hidden; color: red">
                        The difficulty should be set.
                    </p>
                </div>
                <div>
                    <label for="theme-select">Choose a theme :</label>

                    <select name="theme" id="theme-select">
                    <option value="">Please select an option</option>
                    <option value="light">Medieval / Fantasty</option>
                    <option value="dark">Cyberpunk</option>
                    <option value="god">Mythology</option>
                    </select>
                    <p id="theme-err" style="visibility: hidden; color: red;">
                        The theme should be set.
                    </p>
                </div>


            </div>

            <button class="button" type="button" onclick="initMemory()">Start a game</input>
        </form>


    </main>

    <?php include('../../partials/footer.php'); ?>
<script src="../../assets/js/memory-init.js"></script>
</body>
</html>
