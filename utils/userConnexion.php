<?php 

function register($email, $pseudo, $password, $confirmPassword) {
    // vérifié si l'e-mail est bien valide (filter_var($email, FILTER_VALIDATE_EMAIL))
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // retourné une Err
            throw new Exception("Le format de l'e-mail n'est pas valide");
        }

        // vérifié si le pseudo contien MIN 4 char (strlen(string $string): int)
        if(strlen($pseudo) < 4) {
            // retourné une Err
            throw new Exception("Le pseudo doit contenir au moins 4 caractères");
        }

        // vérifié si les deux mdp tapper correspond
        if ($password !== $confirmPassword) {
            // retourné une Err
            throw new Exception("Les mots de passe ne correspondent pas");
        }
            
        // Si tout vas bien, INSERT les info sur la table 'players';
        $pdo = connectToDbAndGetPdo();
            $pdoStatement = $pdo->prepare("
                INSERT INTO players (pseudo, email, pwd) 
                VALUES (:pseudo, :email, :hashedPassword);
            ");
            $pdoStatement->execute(
                [
                    ":pseudo"=> $pseudo,
                    ":email"=> $email,
                    ":hashedPassword"=> $hashedPassword = "GN45OP34N?FVDPE45?32OFP4?",
                ]
            );
            echo "Le formulaire à probablement été envoyer :)";
}

?>