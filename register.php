<?php
require "utils/common.php";
$page = "register";

if (isset($_SESSION["user"])) header("location: ".PROJECT_FOLDER."index.php");

function tryToRegister($email, $pseudo, $pwd, $confirm)
{
    if (!checkFields($email, $pseudo, $pwd, $confirm)) {
        throw new Exception("Missing fields !");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email !");
    }
    if (strlen($pseudo) <= 3) {
        throw new Exception("The pseudo should contains at least 4 characters");
    }
    if ($pwd !== $confirm) {
        throw new Exception("The corfirm password field should be the same !");
    }
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*]).{8,}$/';
    if (!preg_match($pattern, $pwd)) {
        throw new Exception("The password must be 8 characters and must have at
            least a number, a capital letter and a special character !");
    }

    $pdo = connectToDbAndGetPdo();  
    $pdoStatement = $pdo->prepare("SELECT p.pseudo, p.email FROM players AS p 
        WHERE p.pseudo = :pseudo OR p.email = :email;");
    $pdoStatement->execute([":pseudo" => $pseudo, ":email" => $email]);
    if ($pdoStatement->rowCount() > 0) {
        throw new Exception("The pseudo or the email alreaady exists !");
    }


    $pdoStatement = $pdo->prepare("INSERT INTO players (pseudo, email, pwd) 
        VALUES (:pseudo, :email, :hashpwd);");
    $result = $pdoStatement->execute([
        ":pseudo" => $pseudo,
        ":email" => $email,
        ":hashpwd" => hash("sha256", $pwd)
    ]);

    if ($result === false) {
        throw new Exception("Failed to register the account !");
    }
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        tryToRegister($_POST["email"], $_POST["pseudo"], $_POST["pwd"], 
            $_POST["confirm"]);
        echo '<meta http-equiv="refresh" content="5;url=' . PROJECT_FOLDER . 'index.php" />';
        $successMessage = "Merci pour votre inscription, le formulaire a bien été envoyé. Redirection dans 5 secondes...";
    } catch (Exception $e) {
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
            <h1>SIGN UP</h1>
        </section>
        <?php if(isset($errorMessage)): ?>
            <p class="form-error"><?= $errorMessage ?></p>
            <br/>
        <?php elseif(isset($successMessage)): ?>
            <p class="form-success"><?= $successMessage ?></p>
            <br/>
        <?php endif; ?>
        <section class="container justify-content-center" id="register">
            <form class="form-std" method="post" id="register-form">
                <input name="email" type="text" placeholder="E-mail" value="<?= isset($_POST["email"]) ? $_POST["email"] : "" ?>"></input>
                <input name="pseudo" type="text" placeholder="Pseudo" value="<?= isset($_POST["pseudo"]) ? $_POST["pseudo"] : "" ?>"></input>
                <input name="pwd" type="password" placeholder="Password" value="<?= isset($_POST["pwd"]) ? $_POST["pwd"] : "" ?>"></input>
                <input name="confirm" type="password" placeholder="Confirm password" value="<?= isset($_POST["confirm"]) ? $_POST["confirm"] : "" ?>"></input>
                <div>
                    <button type="submit">Sign up</button>
                </div>
            </form>
            <?php
            ?>
        </section>
    </main>
    <?php include('partials/footer.php'); ?>
</body>

</html>