<?php
require "../../utils/common.php";
$page = "score";

?>

<!DOCTYPE html>
<html lang="fr">

<?php include('../../partials/head2game.php'); ?>


<body>
<?php include('../../partials/header.php'); ?>


    <main class="scoreboard">
        <section class="banner">
            <h1>Scoreboard</h1>
        </section>
        <section class="container justify-content-center">
            <table>
                <thead>
                    <tr>
                        <td>Pseudo</td>
                        <td>Game difficulty</td>
                        <td>Score</td>
                        <td>Date and time</td>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $pdoStatement = $pdo->prepare("SELECT p.pseudo, s.game_difficulty, s.score, s.score_timestamp FROM scores AS s LEFT JOIN players AS p ON s.player_id = p.id LEFT JOIN games AS g ON s.game_id = g.id ORDER BY g.name, s.game_difficulty, s.score DESC;");
                    $pdoStatement->execute();
                    $scores = $pdoStatement->fetchAll();
                    foreach($scores as $s) {
                ?>
                    <tr>
                        <td><?= $s->pseudo ?></td>
                        <td><?= ucfirst($s->game_difficulty) ?></td>
                        <td><?= $s->score ?></td>
                        <td><?= $s->score_timestamp ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </section>
    </main>
    
    <?php include('../../partials/footer.php'); ?>
</body>

</html>