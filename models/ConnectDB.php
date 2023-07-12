<?php
function connectToDatabase()
{
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "ramsa";

    try {
        $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $pdo = new PDO($dsn, $username, $password, $options);
        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}
