<header <?php if($page != "home"):?>class="alt-navbar"<?php endif; ?>>
    <nav>
        <a href="<?= PROJECT_FOLDER ?>index.php"><h3>The Power Of Memory</h3></a>
        <ul>
            <li><a <?php if($page == "home"):?>id="active"<?php endif; ?>href="<?= PROJECT_FOLDER ?>index.php">Home</a></li>
            <li><a <?php if($page == "game"):?>id="active"<?php endif; ?>href="<?= PROJECT_FOLDER ?>games/memory/filter.php">Games</a></li>
            <li><a <?php if($page == "score"):?>id="active"<?php endif; ?>href="<?= PROJECT_FOLDER ?>games/memory/scores.php">Scoreboard</a></li>
            <li><a <?php if($page == "shop"):?>id="active"<?php endif; ?>href="<?= PROJECT_FOLDER ?>shop.php">Shop</a></li>
            <li><a <?php if($page == "contact"):?>id="active"<?php endif; ?>href="<?= PROJECT_FOLDER ?>contact.php">Contact Us</a></li>  
        </ul>
        <div style="display: flex; justify-content: space-around;align-items: center;">
        <?php
            if (isset($_SESSION["user"])) {
                $pdoStatement = $pdo->prepare("SELECT p.profilePictureUrl
                    FROM players AS p WHERE p.id = :id;");
                $pdoStatement->execute([":id" => $_SESSION["user"]["id"]]);
                $result = $pdoStatement->fetch();

                if (strpos($result->profilePictureUrl, 'http') === 0) {
                    $UrlOrFiles = '';
                }else{
                    $UrlOrFiles = PROJECT_FOLDER;
                }

                if (!empty($result->profilePictureUrl)) {
                    echo "<a href=\"".PROJECT_FOLDER."myAccount.php\"><img class=\"small-profile-picture\" src=". $UrlOrFiles .$result->profilePictureUrl." /></a>";
                }
                else {
                    echo "<a style='padding-right:10%;' href=\"".PROJECT_FOLDER."myAccount.php\"><img class=\"small-profile-picture\" src=\"".PROJECT_FOLDER."assets/img/default-pp-fantasy-memory.webp\"/></a>";
                }
                echo "<a href=\"".PROJECT_FOLDER."disconnect.php\">Logout</a>";
            }
            else {
                echo "<a class=\"button small-button\" href=\"".PROJECT_FOLDER."login.php\">Log in</a>";
                echo "<a class=\"button small-button\" href=\"".PROJECT_FOLDER."register.php\">Sign up</a>";
            }
        ?>
        </div>
    </nav>
</header>