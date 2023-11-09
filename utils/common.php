<?php

function checkFields(...$fields) {
    foreach($fields as $f) if (empty($f)) return false;
    return true;
}

function formatTimer($milliseconds) {
    $hours = floor($milliseconds / (60 * 60 * 1000));
    $remainingMilliseconds = $milliseconds % (60 * 60 * 1000);
    $minutes = floor($remainingMilliseconds / (60 * 1000));
    $remainingMilliseconds %= (60 * 1000);
    $seconds = floor($remainingMilliseconds / 1000);
    $ms = $remainingMilliseconds % 1000;    $formattedHours   = ($hours)   == 0 ? "" : sprintf("%02dh : ", $hours);
    $formattedMinutes = ($minutes) == 0 ? "" : sprintf("%02dm : ", $minutes);
    $formattedSeconds = ($seconds) == 0 ? "" : sprintf("%02ds : ", $seconds);
    return sprintf('%s%s%s%03dms', $formattedHours, $formattedMinutes, $formattedSeconds, $ms);
}

require_once "database.php";

define('PROJECT_FOLDER', '/fantasy-memory/'); 
define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'] . PROJECT_FOLDER); 
$pdo = connectToDbAndGetPdo();

session_start();