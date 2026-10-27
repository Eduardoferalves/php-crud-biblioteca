<?php

class Database
{
    public static function getConnection(): PDO
    {
        $host = 'localhost';
        $dbname = 'biblioteca';
        $user = 'root';
        $pass = 'ceub123456'; 
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

        return new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
}
