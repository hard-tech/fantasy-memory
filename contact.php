<?php
require "utils/common.php";
$page = "contact";

?>

<!DOCTYPE html>
<html lang="fr">

<?php include('partials/head.php'); ?>


<body>
    <?php include('partials/header.php'); ?>

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

    <?php include('partials/footer.php'); ?>
</body>

</html>