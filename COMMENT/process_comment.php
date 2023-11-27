<?php
session_start();
include __DIR__ . '/../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentText = filter_input(INPUT_POST, 'comment_text', FILTER_SANITIZE_STRING);
    $bookId = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);

    if (isset($_SESSION['user_id']) && $bookId && $commentText) {
        $userId = $_SESSION['user_id'];

        $sql = "SELECT id FROM comment WHERE user_id = ? AND book_id = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$userId, $bookId]);
        $existingComment = $query->fetch(PDO::FETCH_ASSOC);

        if (!$existingComment) {
            $sql = "INSERT INTO comment (user_id, book_id, comment_text, is_approved, created_at) VALUES (?, ?, ?, 0, NOW())";
            $query = $pdo->prepare($sql);
            $query->execute([$userId, $bookId, $commentText]);
        
            header('Location: ../BOOKS_DISPLAY/book_details.php?id=' . $bookId . '&refresh=' . time());
            exit();
            
        } else {
            $_SESSION['commentError'] = 'You have already left a comment for this book.';
            header('Location: ../BOOKS_DISPLAY/book_details.php?id=' . $bookId);
            exit();
        }
    }
}

header('Location: ../BOOKS DISPLAY/book_details.php?id=' . $bookId);

exit();
?>
