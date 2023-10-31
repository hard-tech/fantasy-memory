<?php
require "utils/common.php";
$page = "register";

function tryToRegister($email, $pseudo, $password, $confirmPassword)
{
    // vérifié si l'e-mail est bien valide (filter_var($email, FILTER_VALIDATE_EMAIL))
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // retourné une Err
        throw new Exception("Le format de l'e-mail n'est pas valide");
    }

    // vérifié si le pseudo contien MIN 4 char (strlen(string $string): int)
    if (strlen($pseudo) < 4) {
        // retourné une Err
        throw new Exception("Le pseudo doit contenir au moins 4 caractères");
    }

    // vérifié si les deux mdp tapper correspond
    if ($password !== $confirmPassword) {
        // retourné une Err
        throw new Exception("Les mots de passe ne correspondent pas");
    }

    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*]).{8,}$/'; 
    if( !preg_match($pattern, $password) ) {
        throw new Exception('Le password ne respect pas les critère min requis (/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*]).{8,}$/)');
    }

    // Si tout vas bien, INSERT les info sur la table 'players';
    try {
        $pdo = connectToDbAndGetPdo();
        $pdoStatement = $pdo->prepare("
            INSERT INTO players (pseudo, email, pwd) 
            VALUES (:pseudo, :email, :hashedPassword);
        ");
        $pdoStatement->execute([
            ":pseudo" => $pseudo,
            ":email" => $email,
            ":hashedPassword" => hash("sha256", $password),
        ]);
        echo "Le formulaire à bien été été envoyer :)";
    } catch (Exception $e) {
        throw new Exception("Utilisateur probablement existant.");
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
        <section class="container justify-content-center">
            <form class="form-std" method="post">
                <input name="Email" type="text" placeholder="Email"></input>
                <input name="Pseudo" type="text" placeholder="Pseudo"></input>
                <input name="Password" type="password" placeholder="Password"></input>
                <input name="ConfirmPassword" type="password" placeholder="Confirm password"></input>
                <div>
                    <button type="submit">Sign up</button>
                </div>
            </form>
            <?php
            // Lors ce que (l'email pseudo ...) ne sont pas vide {
            if (
                !empty($_POST["Email"]) &&
                !empty($_POST["Pseudo"]) &&
                !empty($_POST["Password"]) &&
                !empty($_POST["ConfirmPassword"])
            ) {
                try {
                    $email = $_POST["Email"];
                    $pseudo = $_POST["Pseudo"];
                    $password = $_POST["Password"];
                    $confirmPassword = $_POST["ConfirmPassword"];

                    tryToRegister($email, $pseudo, $password, $confirmPassword);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
            ?>
        </section>
    </main>

    <?php include('partials/footer.php'); ?>
</body>

</html>