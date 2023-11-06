<?php

function checkFields(...$fields) {
    foreach($fields as $f) if (empty($f)) return false;
    return true;
}

require_once "database.php";

define('PROJECT_FOLDER', '/fantasy-memory/'); 
define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'] . PROJECT_FOLDER); 
$pdo = connectToDbAndGetPdo();

session_start();