<?php
session_start();
include __DIR__ . '/../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentText = filter_input(INPUT_POST, 'comment_text', FILTER_SANITIZE_STRING);
    $bookId = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);

    if (isset($_SESSION['user_id']) && $bookId && $commentText) {
        $userId = $_SESSION['user_id'];

        $sql = "SELECT id, deleted_at FROM comment WHERE user_id = ? AND book_id = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$userId, $bookId]);
        $existingComment = $query->fetch(PDO::FETCH_ASSOC);

        if ($existingComment) {
            if ($existingComment['deleted_at'] !== null) {
                $commentId = $existingComment['id'];

                $sqlUpdate = "UPDATE comment SET comment_text = ?, is_approved = 0, deleted_at = null WHERE id = ?";
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $queryUpdate->execute([$commentText, $commentId]);

                header('Location: ../BOOKS_DISPLAY/book_details.php?id=' . $bookId . '&refresh=' . time());
                exit();
            } else {
                $_SESSION['commentError'] = 'You have already left a comment for this book.';
                header('Location: ../BOOKS_DISPLAY/book_details.php?id=' . $bookId);
                exit();
            }
        } else {
            $sqlInsert = "INSERT INTO comment (user_id, book_id, comment_text, is_approved, created_at) VALUES (?, ?, ?, 0, NOW())";
            $queryInsert = $pdo->prepare($sqlInsert);
            $queryInsert->execute([$userId, $bookId, $commentText]);

            header('Location: ../BOOKS_DISPLAY/book_details.php?id=' . $bookId . '&refresh=' . time());
            exit();
        }
    }
}

header('Location: ../BOOKS_DISPLAY/book_details.php?id=' . $bookId);
exit();
