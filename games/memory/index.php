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
    <title>Home</title>
    
    <link rel="stylesheet" href="assets/css/normalize.css">
    <script src="https://kit.fontawesome.com/6abcad6372.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
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
                <!-- TODO: Account icon redirecting the right pages -->
            </ul>
        </nav>
    </header>

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