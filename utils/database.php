<?php
function connectToDbAndGetPdo() : PDO {
    $dbname = 'fantasy_memory';
    $host = '127.0.0.1:3306';

    $dsn = "mysql:dbname=$dbname;host=$host;charset=utf8";
    $user = 'dev';
    $pass = '@Fantasy.Memory.06.01/';

    $driver_options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $driver_options);
        return $pdo;
    } catch (PDOException $e) {
        echo "Failed to connect to $dbname@$host: $e";
    }
}