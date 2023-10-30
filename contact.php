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
    <title>Contact Us</title>
    
    <link rel="stylesheet" href="assets/css/normalize.css">
    <script src="https://kit.fontawesome.com/6abcad6372.js" crossorigin="anonymous"></script>
    
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
                <li><a href="<?= PROJECT_FOLDER ?>games/memory/index.php">Games</a></li>
                <li><a href="<?= PROJECT_FOLDER ?>games/memory/scores.php">Scoreboard</a></li>
                <li><a href="<?= PROJECT_FOLDER ?>shop.php">Shop</a></li>
                <li><a id="active">Contact Us</a></li>
                <!-- TODO: Account icon redirecting the right pages -->
            </ul>
        </nav>
    </header>

    <main>
        <section class="banner">
            <h1>Contact us</h1>
        </section>
        <section class="container no-margin-bot">
            <div class="contact-container">
                <div class="contact-subcontainer">
                    <div class="contact-subcontainer-content">
                        <div class="contact-circle">
                            <i class="fa-solid fa-mobile"></i>
                        </div>
                        <p>06 05 04 03 02</p>
                    </div>
                </div>
                <div class="contact-subcontainer">
                    <div class="contact-subcontainer-content">
                        <div class="contact-circle">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <p>support@powerofmemory.com</p>
                    </div>
                </div>
                <div class="contact-subcontainer">
                    <div class="contact-subcontainer-content">
                        <div class="contact-circle">
                            <i class="fa-solid fa-location-pin"></i>
                        </div>
                        <p>Paris</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="container justify-content-flex-start">
            <form class="form-std">
                <div class="d-flex">
                    <input type="text" placeholder="Name" ></input>
                    <input type="text" placeholder="Email" ></input>
                </div>
                <input type="text" placeholder="Subject" ></input>
                
                <textarea placeholder="Message" ></textarea>
                
                <button type="submit">Submit</button>
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
                    <li><a href="<?= PROJECT_FOLDER ?>games/memory/index.php"> Play !</a></li>
                    <li><a href="<?= PROJECT_FOLDER ?>games/memory/scores.php"> Scores</a></li>
                    <li><a href="<?= PROJECT_FOLDER ?>contact.php"> Contact us</a></li>
                </ul>
            </div>
            <div></div>
        </section>
        <div style="display: flex; justify-content: flex-end; width: 100%; padding-right: 320px;">
        <a href="#">
            <button style="background-color: rgb(255,165,0); width: 70px; height: 70px;">
                <i class="fa-solid fa-arrow-right fa-rotate-270 fa-xl" style="color: #ffffff;"></i>
            </button>
        </a>
        </div>
        <p id="copyright">Copyright &copysr; 2023 All rights reserved</p>
    </footer>
</body>

</html>