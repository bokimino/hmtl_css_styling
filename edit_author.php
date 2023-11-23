<?php
require_once 'connection.php';

function getAuthorById($pdo, $authorId) {
    $sql = "SELECT * FROM author WHERE id = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$authorId]);
    return $query->fetch(PDO::FETCH_OBJ);
}

function editAuthor($pdo, $authorId, $updatedFirstName, $updatedLastName, $updatedBiography) {
    $sql = "UPDATE author SET first_name = ?, last_name = ?, biography = ? WHERE id = ?";
    $query = $pdo->prepare($sql);
    return $query->execute([$updatedFirstName, $updatedLastName, $updatedBiography, $authorId]);
}


