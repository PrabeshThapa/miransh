<?php

$host = '127.0.0.1';
$db   = "v8p51_miransh_2026";
$user = 'v8p51_33247841';
$pass = 'manju.2221';

try {
    $pdo = new PDO(
        "mysql:host=$host;port=3306;dbname=$db",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]
    );

    echo "DATABASE CONNECTION SUCCESS";
} catch (PDOException $e) {
    echo "DATABASE CONNECTION FAILED<br>";
    echo htmlspecialchars($e->getMessage());
}