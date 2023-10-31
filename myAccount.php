<?php
require "utils/common.php";
$page = "myaccount";

?>

<!DOCTYPE html>
<html lang="fr">

<?php include('partials/head.php'); ?>


<body>

<?php include('partials/header.php'); ?>

    <main>
        <section class="banner">
            <h1>MY ACCOUNT</h1>
        </section>
        <section class="container justify-content-center">
            <div class="d-flex forms-my-account">
                <form class="form-std">
                    <h3>Change my mail</h3>
                    <input type="text" placeholder="Old e-mail">
                    <input type="text" placeholder="New e-mail">
                    <input type="text" placeholder="Password">
                    <button type="submit">Send</button>
                </form>

                <form class="form-std">
                    <h3>Change my password</h3>
                    <input type="text" placeholder="Old password">
                    <input type="text" placeholder="New password">
                    <input type="text" placeholder="Confirm new password">
                    <button type="submit">Send</button>
                </form>
            </div>
        </section>
    </main>

    <?php include('partials/footer.php'); ?>
</body>

</html>