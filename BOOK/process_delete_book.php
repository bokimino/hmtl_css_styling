<?php
require_once __DIR__ . '/../connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'])) {
    $bookId = $_POST['book_id'];

    try {
        $pdo->beginTransaction();

        $softDeleteBookSQL = "UPDATE book SET deleted_at = NOW() WHERE id = ?";
        $softDeleteBookQuery = $pdo->prepare($softDeleteBookSQL);
        $softDeleteBookQuery->execute([$bookId]);

        $softDeleteCommentsSQL = "UPDATE comment SET deleted_at = NOW() WHERE book_id = ?";
        $softDeleteCommentsQuery = $pdo->prepare($softDeleteCommentsSQL);
        $softDeleteCommentsQuery->execute([$bookId]);

        $softDeleteNotesSQL = "UPDATE note SET deleted_at = NOW() WHERE book_id = ?";
        $softDeleteNotesQuery = $pdo->prepare($softDeleteNotesSQL);
        $softDeleteNotesQuery->execute([$bookId]);

        $pdo->commit();

        header('Location: ../admin_dashboard.php');
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();

        echo 'Error soft deleting book, comments, and notes: ' . $e->getMessage();
    }
} else {
    echo 'Invalid request';
}