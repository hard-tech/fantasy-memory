<?php
require "utils/common.php";
$page = "login";

if (isset($_SESSION["user"])) header("location: ".PROJECT_FOLDER."index.php");

function tryToLogin($pdo, $email, $pwd) {
    if (!checkFields($email, $pwd)) throw new Exception("Missing fields !");
    
    $pdoStatement = $pdo->prepare("SELECT p.id, p.pseudo FROM players AS p
        WHERE p.email = :email AND p.pwd = :pwd");
    $pdoStatement->execute([":email" => $email, ":pwd" => hash("sha256", $pwd)]);
    $player = $pdoStatement->fetch();

    if (empty($player)) {
        throw new Exception("The mail or the password is invalid.");
    }

    $pdoStatement = $pdo->prepare("UPDATE players AS p 
        SET p.latest_connection_timestamp=NOW() WHERE p.email = :email");
    $pdoStatement->execute([':email' => $email]);

    $_SESSION["user"] = [ "id" => $player->id, "pseudo" => $player->pseudo ];

}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        tryToLogin($pdo, $_POST["email"], $_POST["pwd"]);
        $successMessage = "You've been successfully loged in. You will be redirected in 3 seconds.";
        echo '<meta http-equiv="refresh" content="3;url='.PROJECT_FOLDER.'index.php" />';
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
        <?php if(isset($errorMessage)): ?>
            <p class="form-error"><?= $errorMessage ?></p>
            <br/>
        <?php elseif(isset($successMessage)): ?>
            <p class="form-success"><?= $successMessage ?></p>
            <br/>
        <?php endif; ?>
        <section class="container justify-content-center">
            <form method="post" class="form-std">
                <input type="text" placeholder="Email" name="email"></input>
                <input type="password" placeholder="Password" name="pwd"></input>
                <div>
                    <button type="submit">Log in</button>
                </div>
            </form>
        </section>
    </main>
    <?php include('partials/footer.php'); ?>
</body>
</html>