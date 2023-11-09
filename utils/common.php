<?php

function checkFields(...$fields) {
    foreach($fields as $f) if (empty($f)) return false;
    return true;
}

function formatTimer($ms) {
    $s = (floor($ms / 100)) % 60;
    $m = floor($s / 60) % 60;
    $h = floor($m / 60);
    return sprintf("%02d:%02d:%02d:%03d", $h, $m, $s, $ms % 1000);
}

require_once "database.php";

define('PROJECT_FOLDER', '/fantasy-memory/'); 
define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'] . PROJECT_FOLDER); 
$pdo = connectToDbAndGetPdo();

session_start();