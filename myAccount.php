<?php
require "utils/common.php";
$page = "myAccount";

function tryToUploadProfilePicture($pdo, $old, $profilePicture)
{
    if (empty($profilePicture["name"])) {
        throw new Exception("No file specified !");
    }

    $imageFileType = strtolower(pathinfo($profilePicture["name"], PATHINFO_EXTENSION));
    $targetDirectory = "data/" . hash("sha256", $_SESSION["user"]["pseudo"]);
    $path = $targetDirectory . '/' .
        hash("sha256", basename($profilePicture["name"])) . "." . $imageFileType;

    if (isset($profilePicture)) {
        if ($profilePicture["size"] > 500000) {
            throw new Exception("Sorry, your file is too large.");
        }
        if (
            $imageFileType != "jpg" && $imageFileType != "png" &&
            $imageFileType != "jpeg" && $imageFileType != "gif"
        ) {
            throw new Exception("Sorry, only JPG, JPEG, PNG, and GIF files are allowed.");
        }

        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }
        elseif ($old != null && file_exists($old)) {
            unlink($old);
        }

        if (!move_uploaded_file($profilePicture["tmp_name"], $path)) {
            throw new Exception("Failed to upload the file.");
        }

        $pdoStatement = $pdo->prepare("UPDATE players AS p
            SET profilePictureUrl = :path WHERE p.id = :id");
        $pdoStatement->execute([
            ":id" => $_SESSION["user"]["id"],
            ":path" => $path
        ]);
    }
    return $path;
}

function tryToUpdateEmail($pdo, $new, $old, $pwd)
{
    if (!checkFields($new, $old, $pwd)) throw new Exception("Missing fileds !");

    $pdoStatement = $pdo->prepare("SELECT p.email FROM players AS p
        WHERE p.id = :id");
    $pdoStatement->execute([":id" => $_SESSION["user"]["id"]]);
    $result = $pdoStatement->fetch();
    if (empty($result) && !filter_var($old, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Old e-mail field is invalid.");
    }
    if (!filter_var($new, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("New e-mail field is invalid.");
    }

    $pdoStatement = $pdo->prepare("UPDATE players AS p
        SET p.email = :new WHERE p.email = :old AND p.pwd = :pwd");
    $result = $pdoStatement->execute([
        ":new" => $new,
        ":old" => $old,
        ":pwd" => hash("sha256", $pwd)
    ]);
    if (empty($result)) {
        throw new Exception("Failed to update your email.");
    }
}

function tryToUpdatePwd($pdo, $old, $new, $confirm)
{
    if (!checkFields($new, $old, $confirm)) throw new Exception("Missing field !");

    $pdoStatement = $pdo->prepare("SELECT p.pwd FROM players AS p
        WHERE p.id = :id");
    $pdoStatement->execute([":id" => $_SESSION["user"]["id"]]);
    $query = $pdoStatement->fetch();
    if (strcmp($query->pwd, hash("sha256", $old))) {
        throw new Exception("Old password field is invalid.");
    }
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*]).{8,}$/';
    if (!preg_match($pattern, $new)) {
        throw new Exception("The password must be 8 characters and must have at
            least a number, a capital letter and a special character !");
    }
    if (strcmp($new, $confirm) != 0) {
        throw new Exception("The new password and confirm password field 
            should be the same. Please try again.");
    }

    $pdoStatement = $pdo->prepare("UPDATE players AS p
        SET p.pwd = :new WHERE p.id = :id");
    $result = $pdoStatement->execute([
        ":id" => $_SESSION["user"]["id"],
        ":new" => hash("sha256", $new)
    ]);
    if (empty($result)) {
        throw new Exception("Failed to update your password.");
    }
}

if (isset($_SESSION["user"])) {
    $pdoStatement = $pdo->prepare("SELECT p.profilePictureUrl FROM players AS p
        WHERE p.id = :id");
    $pdoStatement->execute([":id" => $_SESSION["user"]["id"]]);
    $result = $pdoStatement->fetch();
    $profilePicturePath = $result->profilePictureUrl;
    if (empty($profilePicturePath)) {
        $profilePicturePath = null;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_GET["action"];
    if (isset($action)) {
        try {
            switch ($action) {
                case "upload-profile-picture":
                    $profilePicturePath = 
                        tryToUploadProfilePicture($pdo, $profilePicturePath, $_FILES["profile-picture"]);
                    break;
                case "update-email":
                    tryToUpdateEmail(
                        $pdo,
                        $_POST["new-email"],
                        $_POST["old-email"],
                        $_POST["pwd"]
                    );
                    break;
                case "update-pwd":
                    tryToUpdatePwd(
                        $pdo,
                        $_POST["old-pwd"],
                        $_POST["new-pwd"],
                        $_POST["confirm-pwd"]
                    );
                    break;
                default:
                    break;
            }
            $successMessage = "Your account have been successfully updated !";
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<?php include('partials/head.php'); ?>

<body>
    <script src="<?php PROJECT_FOLDER ?>assets/js/password_check.js"></script>
    <?php include('partials/header.php'); ?>
    <main>
        <section class="banner">
            <h1>MY ACCOUNT</h1>
        </section>
        <?php if (isset($errorMessage)) : ?>
            <p class="form-error"><?= $errorMessage ?></p>
            <br />
        <?php elseif (isset($successMessage)) : ?>
            <p class="form-success"><?= $successMessage ?></p>
            <br />
        <?php endif; ?>
        <?php if (isset($_SESSION["user"])) : ?>
            <section class="container flex-column justify-content-center no-margin-bot">
                <div class="profile-picture">
                    <?php if (isset($profilePicturePath)) : ?>
                        <img src=<?= $profilePicturePath ?> />
                    <?php else : ?>
                        <img src="assets/img/default-pp-fantasy-memory.webp" />
                    <?php endif; ?>
                </div>
                <h1><?= $_SESSION["user"]["pseudo"] ?></h1>
                <form action="myAccount.php?action=upload-profile-picture" method="post" enctype="multipart/form-data">
                    <input type="file" name="profile-picture">
                    <input type="submit" value="Update" name="submit">
                </form>
            </section>
            <section class="container justify-content-center">
                <div class="d-flex forms-my-account">
                    <form action="myAccount.php?action=update-email" method="post" class="form-std">
                        <h3>Change my mail</h3>
                        <input type="text" placeholder="Old e-mail" name="old-email">
                        <input type="text" placeholder="New e-mail" name="new-email">
                        <input type="password" placeholder="Password" name="pwd">
                        <button type="submit">Send</button>
                    </form>

                    <form action="myAccount.php?action=update-pwd" method="post" class="form-std">
                        <h3>Change my password</h3>
                        <input type="password" placeholder="Old password" name="old-pwd">
                        <input type="password" id="password" oninput="checkPassword()" placeholder="New password" name="new-pwd">
                        <div id="password-indicator"></div>
                        <input type="password" placeholder="Confirm new password" name="confirm-pwd">
                        <button type="submit">Send</button>
                    </form>
                </div>
            </section>
        <?php else : ?>
            <section class="container justify-content-center no-margin-bot">
                <h1>You must be logged in to access to your account settings !</h1>
            </section>
            <section class="container justify-content-center">
                <a class="button" href=<?= PROJECT_FOLDER."login.php"?>>Sign in</a>
            </section>
        <?php endif; ?>
    </main>
    <?php include('partials/footer.php'); ?>
</body>

</html>