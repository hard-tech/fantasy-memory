    <?php
    require "utils/common.php";
    $page = "register";

    function tryToRegister($email, $pseudo, $password, $confirmpassword)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Le format de l'e-mail n'est pas valide");
        }

        if (strlen($pseudo) <= 4) {
            throw new Exception("Le pseudo doit contenir au moins 4 caractères");
        }

        if ($password !== $confirmpassword) {
            throw new Exception("Les mots de passe ne correspondent pas");
        }

        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*]).{8,}$/';
        if (!preg_match($pattern, $password)) {
            throw new Exception('Le password ne respect pas les critère min requis (Minuscules / Majuscule / Caractère spéciaux / Chiffre)');
        }

        try {
            $pdo = connectToDbAndGetPdo();
            $pdoStatement = $pdo->prepare("
                INSERT INTO players (pseudo, email, pwd) 
                VALUES (:pseudo, :email, :hashedpassword);
            ");
            $pdoStatement->execute([
                ":pseudo" => $pseudo,
                ":hashedpassword" => hash("sha256", $password),
                ":email" => $email,
            ]);
            echo '<meta http-equiv="refresh" content="5;url=' . PROJECT_FOLDER . 'index.php" />';
            echo "Merci pour votre inscription, le formulaire a bien été envoyé. Redirection dans 5 secondes...";
        } catch (Exception $e) {
            throw new Exception("Utilisateur probablement existant.");
        }
        // } catch (Exception $e) {
        //     echo "Erreur lors de l'inscription : " . $e->getMessage();
        // }
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
            <section class="container justify-content-center" id="register">
                <form class="form-std" method="post" id="register-form">
                    <input name="email" type="text" placeholder="e-mail" value="<?= isset($_POST["email"]) ? $_POST["email"] : "" ?>"></input>
                    <input name="pseudo" type="text" placeholder="Pseudo" value="<?= isset($_POST["pseudo"]) ? $_POST["pseudo"] : "" ?>"></input>
                    <input name="password" type="password" placeholder="Password" value="<?= isset($_POST["password"]) ? $_POST["password"] : "" ?>"></input>
                    <input name="confirmpassword" type="password" placeholder="Confirm password" value="<?= isset($_POST["confirmpassword"]) ? $_POST["confirmpassword"] : "" ?>"></input>
                    <div>
                        <button type="submit">Sign up</button>
                    </div>
                </form>
                <?php

                if (
                    !empty($_POST["email"]) &&
                    !empty($_POST["pseudo"]) &&
                    !empty($_POST["password"]) &&
                    !empty($_POST["confirmpassword"])
                ) {
                    try {
                        $email = $_POST["email"];
                        $pseudo = $_POST["pseudo"];
                        $password = $_POST["password"];
                        $confirmpassword = $_POST["confirmpassword"];

                        tryToRegister($email, $pseudo, $password, $confirmpassword);
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