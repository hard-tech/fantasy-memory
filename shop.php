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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
    <header class="alt-navbar">
        <nav>
            <a href="<?= PROJECT_FOLDER ?>index.php"><h3>The Power Of Memory</h3></a>
            <ul>
                <li><a href="<?= PROJECT_FOLDER ?>index.php">Home</a></li>
                <li><a href="<?= PROJECT_FOLDER ?>games/index.php">Games</a></li>
                <li><a href="<?= PROJECT_FOLDER ?>games/memory/scores.php">Scoreboard</a></li>
                <li><a id="active">Shop</a></li>
                <li><a href="<?= PROJECT_FOLDER ?>contact.php">Contact Us</a></li>
                <!-- TODO: Account icon redirecting the right pages -->
            </ul>
        </nav>
    </header>

    <main>
        <section class="banner">
            <h1>Shop</h1>
        </section>

        <form action="" id="filter">
            <label for="itemType-select"></label>

            <select name="itemType" id="itemType-select">
              <option value="">--choose type item--</option>
              <option value="aura">Aura</option>
              <option value="power">Power</option>
              <option value="background">Background</option>
            </select>
                        
            <button>
                <span class="material-symbols-outlined">
                    search
                    </span>
            </button>
        </form>

        <section id="list-item-Shop">
            <section>
                <article>
                    <div class="aura-purple-items"></div>
                    <h3>aura purple</h3>
                    <p>100 coin</p> <button>Buy</button>
                </article>
                <article>
                    <div class="aura-purple-items"></div>
                    <h3>aura purple</h3>
                    <p>100 coin</p> <button>Buy</button>
                </article>
                <article>
                    <div class="aura-purple-items"></div>
                    <h3>aura purple</h3>
                    <p>100 coin</p> <button>Buy</button>
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
                    <li><a href="<?= PROJECT_FOLDER ?>games/index.php"> Play !</a></li>
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