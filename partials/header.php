<header <?php if($page != "home") { echo "class= alt-navbar";}?>>
        <nav>
            <a href="<?= PROJECT_FOLDER ?>index.php"><h3>The Power Of Memory</h3></a>
            <ul>
                <?php if($page == "home"){
                    ?> 
                <li><a id="active" href="<?= PROJECT_FOLDER ?>index.php">Home</a></li>
                    <?php
                }else{
                    ?>
                <li><a href="<?= PROJECT_FOLDER ?>index.php">Home</a></li>
                    <?php
                } ?>

                <?php if($page == "game"){
                    ?> 
                <li><a id="active" href="<?= PROJECT_FOLDER ?>games/memory/index.php">Games</a></li>
                    <?php
                }else{
                    ?>
                <li><a href="<?= PROJECT_FOLDER ?>games/memory/index.php">Games</a></li>
                    <?php
                } ?>

                <?php if($page == "score"){
                    ?> 
                <li><a id="active" href="<?= PROJECT_FOLDER ?>games/memory/scores.php">Scoreboard</a></li>
                    <?php
                }else{
                    ?>
                <li><a href="<?= PROJECT_FOLDER ?>games/memory/scores.php">Scoreboard</a></li>
                    <?php
                } ?>
                <?php if($page == "shop"){
                    ?> 
                <li><a id="active" href="<?= PROJECT_FOLDER ?>shop.php">Shop</a></li>
                    <?php
                }else{
                    ?>
                <li><a href="<?= PROJECT_FOLDER ?>shop.php">Shop</a></li>
                    <?php
                } ?>
                 <?php if($page == "contact"){
                    ?> 
                <li><a id="active" href="<?= PROJECT_FOLDER ?>contact.php">Contact Us</a></li>
                    <?php
                }else{
                    ?>
                <li><a href="<?= PROJECT_FOLDER ?>contact.php">Contact Us</a></li>
                    <?php
                } ?>
  
                <!-- TODO: Account icon redirecting the right pages -->
            </ul>
        </nav>
    </header>