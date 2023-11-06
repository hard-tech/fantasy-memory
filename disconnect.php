<?php
require "utils/common.php";
    unset($_SESSION['user']);
    echo '<meta http-equiv="refresh" content="0;url='.PROJECT_FOLDER.'index.php" />';
?>