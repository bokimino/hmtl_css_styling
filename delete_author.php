<?php
require_once 'connection.php';

function deleteAuthor($pdo, $authorId) {
    $sql = "UPDATE author SET deleted_at = NOW() WHERE id = ?";
    $query = $pdo->prepare($sql);
    return $query->execute([$authorId]);
}

if (isset($_GET['id'])) {
    $authorId = $_GET['id'];

    if (deleteAuthor($pdo, $authorId)) {
        header('Location: admin_dashboard.php');
        exit();
    } else {
        echo 'Error deleting author.';
    }
} else {
    header('Location: admin_dashboard.php');
    exit();
}

