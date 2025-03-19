<?php

function connectDB(): PDO
{
    //
    $host = 'localhost';
    $dbName = 'assu';
    $user = 'root';
    $password = '';

    try {
        // Renvoie d'un objet PDO ( connexion à la BDD )
        return new PDO(
            "mysql:host=$host;dbname=$dbName;charset=utf8",
            $user,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}