<?php
require "utils/common.php";
$page = "register";

?>

<!DOCTYPE html>
<html lang="fr">

<?php include('partials/head.php'); ?>

<body>
    <?php include('partials/header.php'); ?>

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

    <?php include('partials/footer.php'); ?>
</body>

</html>