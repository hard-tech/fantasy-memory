<?php
require "utils/common.php";
$page = "myAccount";

function updateEmail($pdo, $new, $old, $pwd) {
    if (checkFields($new, $old, $pwd)) throw new Exception("Missing fileds !");
    
    $pdoStatement = $pdo->prepare("SELECT p.email FROM players AS p
        WHERE p.id = :id");
    $pdoStatement->execute([":id" => $_SESSION["user"]->id]);
    $email = $pdoStatement->fetch();
    if (empty($email) && !filter_var($old, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Old e-mail field is invalid.");
    }
    if (!filter_var($new, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("New e-mail field is invalid.");
    }
    
    $pdoStatement = $pdo->prepare("UPDATE players AS p
        SET p.email = :new WHERE p.email = :old AND p.pwd = :pwd");
    $result = $pdoStatement->execute([":new" => $new, ":old" => $old, ":pwd" => $pwd]);
    if (empty($result)) {
        throw new Exception("Failed to update your email.");
    }
}

function updatePwd($pdo, $old, $new, $confirm) {
    if (checkFields($new, $old, $confirm)) throw new Exception("Missing field !");
    
    $pdoStatement = $pdo->prepare("SELECT p.pwd FROM players AS p
        WHERE p.id = :id");
    $pdoStatement->execute([":id" => $_SESSION["user"]->id]);
    $pwd = $pdoStatement->fetch();
    if (strcmp($pwd, $old)) {
        throw new Exception("Old password field is invalid.");
    }
    if (strcmp($new, $confirm) != 0) {
        throw new Exception("The new password and confirm password field 
            should be the same. Please try again.");
    }
    
    $pdoStatement = $pdo->prepare("UPDATE players AS p
        SET p.pwd = :new WHERE p.pwd = :old");
    $queryStatus = $pdoStatement->execute([":new" => $new, ":old" => $old]);
    if (empty($queryStatus)) {
        throw new Exception("Failed to update your password.");
    }
}

var_dump($_SESSION["user"]->id);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_GET["action"];
    if (isset($action)) {
        switch($action) {
            case "update-email": {
                try {
                    updateEmail($pdo, $_POST["new-email"], $_POST["old-email"], $_POST["pwd"]);
                } catch (Exception $e) {
                    $errorMessage = $e->getMessage();
                }
            } break;
            
            case "update-pwd": {
                try {
                    updatePwd($pdo, $_POST["old-pwd"], $_POST["new-pwd"], $_POST["confirm-pwd"]);
                } catch (Exception $e) {
                    $errorMessage = $e->getMessage();
                }
            } break;
        }
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
            <h1>MY ACCOUNT</h1>
        </section>
<?php if(isset($_SESSION["user"])) :?>
        <section class="container justify-content-center">
            <div class="d-flex forms-my-account">
                <form action="myAccount.php?action=update-email" method="post" class="form-std">
                    <h3>Change my mail</h3>
                    <input type="text" placeholder="Old e-mail" name="old-email">
                    <input type="text" placeholder="New e-mail" name="new-email">
                    <input type="text" placeholder="Password" name="pwd">
                    <button type="submit">Send</button>
                </form>

                <form action="myAccount.php?action=update-pwd" method="post" class="form-std">
                    <h3>Change my password</h3>
                    <input type="password" placeholder="Old password" name="old-pwd">
                    <input type="password" placeholder="New password" name="new-pwd">
                    <input type="password" placeholder="Confirm new password" name="confirm-pwd">
                    <button type="submit">Send</button>
                </form>
            </div>
        </section>
        <?php if(isset($errorMessage)): ?>
            <br/>
            <div class="form-error"><p><?= $errorMessage ?></p></div>
        <?php endif; ?>
<?php else: ?>
    <section class="container justify-content-center no-margin-bot">
        <h1>You must be logged in to access to your account settings !</h1>
    </section>
    <section class="container justify-content-center">
        <a class="button" href="login.php">Sign in</a>
    </section>
<?php endif; ?>
    </main>
    <?php include('partials/footer.php'); ?>
</body>
</html>