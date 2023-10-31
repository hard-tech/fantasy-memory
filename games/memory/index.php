<?php
require "../../utils/common.php";
$page = "game";
?>

<!DOCTYPE html>
<html lang="fr">

<?php include('../../partials/head2game.php'); ?>


<body>
<?php include('../../partials/header.php'); ?>

    <main id="game">
        <table>
            <tbody>
                <?php for($i=0; $i < 3; $i++) {?>
                    <tr>
                        <td>♦</td>
                        <td>♦</td>
                        <td>♦</td>
                        <td>♦</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

    <?php include('../../partials/footer.php'); ?>
    <?php include('../../../chat.php'); ?>
</body>

</html>