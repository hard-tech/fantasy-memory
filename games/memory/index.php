<?php
require "../../utils/common.php";
$page = "game";
?>

<!DOCTYPE html>
<html lang="fr">

<?php include('../../partials/head2game.php'); ?>


<body>
<?php include('../../partials/header.php'); ?>


    <main>
        <section class="banner">
            <h1>Game Library</h1>
        </section>
            <form action="" id="SearchBar">
                <label for="searchBarGame"></label>

                <input type="search" placeholder="Search Games ..." id="searchBarGame">
                            
                <button>
                    <span class="material-symbols-outlined">
                        search
                        </span>
                </button>
            </form>
        <section id="list-item-Game">
            <section>
                <article>
                    <div class="game-logo"></div>
                    <h3>Memory Game</h3>
                    <a href="games/memory/index.php"><button>Jouer</button></a>
                </article>
                <article>
                    <div class="game-logo"></div>
                    <h3>Morpion Game</h3>
                    <button>Jouer</button>
                </article>
                <article>
                    <div class="game-logo"></div>
                    <h3>Dino Game</h3>
                    <button>Jouer</button>
                </article>
            </section>
        </section>

    </main>
    
    <?php include('../../partials/footer.php'); ?>

</body>

</html>