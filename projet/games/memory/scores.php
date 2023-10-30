<?php
require "projet/utils/common.php";
require "projet/partials/head.php";
require "projet/partials/header.php";
require "projet/partials/footer.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta name="description" content="Project Flash from Coding Factory">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scoreboard</title>
    
    <link rel="stylesheet" href="assets/css/normalize.css">
    <script src="https://kit.fontawesome.com/6abcad6372.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
    <header class="alt-navbar">
        <nav>
            <a href="index.html"><h3>The Power Of Memory</h3></a>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="games.html">Games</a></li>
                <li><a id="active">Scoreboard</a></li>
                <li><a href="shop.html">Shop</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                <!-- TODO: Account icon redirecting the right pages -->
            </ul>
        </nav>
    </header>

    <main class="scoreboard">
        <section class="banner">
            <h1>Scoreboard</h1>
        </section>
        <section class="container justify-content-center">
            <table>
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Pseudo</td>
                        <td>Game difficulty</td>
                        <td>Score</td>
                        <td>Date and time</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ali Baba</td>
                        <td>aliXpress</td>
                        <td>Nightmare</td>
                        <td>783217</td>
                        <td>28/10/2023 13:01</td>
                    </tr>
                    <tr>
                        <td>Tom</td>
                        <td>Kira</td>
                        <td>Hardcore</td>
                        <td>696969</td>
                        <td>29/10/2023 10:15</td>
                    </tr>
                    <tr>
                        <td>Alex</td>
                        <td>vegasword</td>
                        <td>Medium</td>
                        <td>7589</td>
                        <td>28/10/2023 14:17</td>
                    </tr>
                </tbody>
            </table>
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
                    <li><a href="game.html"> Play !</a></li>
                    <li><a href="scoreboard.html"> Scores</a></li>
                    <li><a href="contact.html"> Contact us</a></li>
                </ul>
            </div>
            <div></div>
        </section>

        <p id="copyright">Copyright &copysr; 2023 All rights reserved</p>
    </footer>    
</body>

</html>