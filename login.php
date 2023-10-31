<?php
require "utils/common.php";
$page = "login";

?>

<!DOCTYPE html>
<html lang="fr">

<?php include('partials/head.php'); ?>

<body>
    <?php include('partials/header.php'); ?>

    <main>
        <section class="banner">
            <h1>SIGN IN</h1>
        </section>
        <section class="container justify-content-center">
            <form class="form-std">
                <input type="text" placeholder="Email" name="email"></input>
                <input type="text" placeholder="Password" name="pwd"></input>
                <div>
                    <button type="submit">Log in</button>
                </div>
            </form>
            <?php 
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $name = $_POST["email"];
                    $pwd = $_POST["pwd"];
                    $pdoStatement = $pdo->prepare("
                        SELECT p.id, p.pseudo FROM players AS p
                        WHERE p.pseudo = $name AND p.pwd = $pwd;
                    ");
                    $pdoStatement->execute();
                    $user = $pdoStatement->fetch();
                    var_dump($user);
                    if ($user) {
                        $logInStatus = $pdo->prepare("
                            UPDATE players AS p
                            SET latest_connection_timestamp=NOW();
                        ");
                        if ($logInStatus->execute()) {
                            $_SESSION["user"] = [
                                "id" => $user->id,
                                "pseudo" => $user->pseudo
                            ];
                            header("Location: localhost:8888/fantasy-memory/index.html");
                        }
                    }
                }
            ?>
        </section>
    </main>

    <?php include('partials/footer.php'); ?>
</body>

</html>