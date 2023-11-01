<header <?php if($page != "home"):?>class="alt-navbar"<?php endif; ?>>
    <nav>
        <a href="<?= PROJECT_FOLDER ?>index.php"><h3>The Power Of Memory</h3></a>
        <ul>
            <li><a <?php if($page == "home"):?>id="active"<?php endif; ?>href="<?= PROJECT_FOLDER ?>index.php">Home</a></li>
            <li><a <?php if($page == "game"):?>id="active"<?php endif; ?>href="<?= PROJECT_FOLDER ?>games/memory/index.php">Games</a></li>
            <li><a <?php if($page == "score"):?>id="active"<?php endif; ?>href="<?= PROJECT_FOLDER ?>games/memory/scores.php">Scoreboard</a></li>
            <li><a <?php if($page == "shop"):?>id="active"<?php endif; ?>href="<?= PROJECT_FOLDER ?>shop.php">Shop</a></li>
            <li><a <?php if($page == "contact"):?>id="active"<?php endif; ?>href="<?= PROJECT_FOLDER ?>contact.php">Contact Us</a></li>  
            <!-- TODO: Account icon redirecting the right pages -->
        </ul>
    </nav>
</header>