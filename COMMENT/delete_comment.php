<?php
session_start();

require_once __DIR__ . '/../BOOKS_DISPLAY/printBookDetails.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $commentId = filter_input(INPUT_GET, 'comment_id', FILTER_VALIDATE_INT);

    $bookId = isset($_GET['book_id']) ? $_GET['book_id'] : null;

    if (isset($_SESSION['user_id']) && $commentId) {
        $userId = $_SESSION['user_id'];

        $sql = "UPDATE comment SET deleted_at = NOW() WHERE id = ? AND user_id = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$commentId, $userId]);
    }
    header('Location: ../BOOKS_DISPLAY/book_details.php?id=' . $bookId);
    exit();
}

header('Location: ../BOOKS_DISPLAY/book_details.php?id=' . $bookId);
exit();



