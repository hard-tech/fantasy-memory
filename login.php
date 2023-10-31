<?php
require "utils/common.php";
$page = "login";

function tryToLogin($email, $pwd) {
    $pdo = connectToDbAndGetPdo();

    $pdoStatement = $pdo->prepare("SELECT p.id, p.pseudo FROM players AS p
        WHERE p.email = :email AND p.pwd = :pwd");
    $pdoStatement->execute([':email' => $email, ':pwd' => $pwd]);
    $player = $pdoStatement->fetch();

    if (empty($player)) {
        throw new Exception("The mail or the password is invalid.");
    }

    $pdoStatement = $pdo->prepare("UPDATE players AS p 
        SET latest_connection_timestamp=NOW()
        WHERE p.email = :email");
    $pdoStatement->execute([':email' => $email]);

    $_SESSION["user"] = [ "id" => $player->id, "pseudo" => $player->pseudo ];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        tryToLogin($_POST["email"], $_POST["pwd"]);
        header("location: /fantasy-memory/index.php");
    } catch(Exception $e) {
        $errorMessage = $e->getMessage();
    }
}
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
        <section class="container justify-content-center no-margin-bot">
            <form method="post" class="form-std">
                <input type="text" placeholder="Email" name="email"></input>
                <input type="text" placeholder="Password" name="pwd"></input>
                <div>
                    <button type="submit">Log in</button>
                </div>
            </form>
        </section>
            <?php if(isset($errorMessage)): ?>
                <br/><p style="text-align: center"><?= $errorMessage ?></p>
            <?php endif; ?>
    </main>
    <?php include('partials/footer.php'); ?>
</body>
</html>