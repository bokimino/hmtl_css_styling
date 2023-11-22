<?php
$host = 'localhost';
$dbname = 'book_library';
$username = 'root';
$password = '';

function connectToDatabase($host, $dbname, $username, $password) {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Connection failed. Please contact the administrator.");
    }
}

$pdo = connectToDatabase($host, $dbname, $username, $password);




