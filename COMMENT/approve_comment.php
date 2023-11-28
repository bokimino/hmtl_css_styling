<?php
session_start();
require_once __DIR__ . '/../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentId = filter_input(INPUT_POST, 'comment_id', FILTER_VALIDATE_INT);

    $sql = "UPDATE comment SET is_approved = 1 WHERE id = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$commentId]);

    header('Location: comments.php');
    exit();
} else {
    echo 'Invalid request';
}
?>
