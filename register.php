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
    <title>Login</title>
    
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
                <li><a href="scoreboard.html">Scoreboard</a></li>
                <li><a href="shop.html">Shop</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                <!-- TODO: Account icon redirecting the right pages -->
            </ul>
        </nav>
    </header>

    <main>
        <section class="banner">
            <h1>SIGN UP</h1>
        </section>
        <section class="container justify-content-center">
            <form class="form-std">
                <input type="text" placeholder="Email" ></input>
                <input type="text" placeholder="Pseudo" ></input>
                <input type="text" placeholder="Password" ></input>
                <input type="text" placeholder="Confirm password" ></input>
                <div>
                    <button type="submit">Sign up</button>
                </div>
            </form>
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
                    <li> Play !</li>
                    <li> Scores</li>
                    <li> Contact us</li>
                </ul>
            </div>
            <div></div>
        </section>
        <p id="copyright">Copyright &copysr; 2023 All rights reserved</p>
    </footer>
</body>

</html>