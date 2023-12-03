<?php
require_once __DIR__ . '/../connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('HTTP/1.1 401 Unauthorized');
    exit();
}

$user_id = $_SESSION['user_id'];

$book_id = isset($_POST['book_id']) ? $_POST['book_id'] : null;
$note_text = isset($_POST['note_text']) ? $_POST['note_text'] : null;

if ($book_id === null || $note_text === null) {
    header('HTTP/1.1 400 Bad Request');
    exit();
}

$sql = "INSERT INTO note (user_id, book_id, note_text) VALUES (:user_id, :book_id, :note_text)";
$query = $pdo->prepare($sql);
$query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$query->bindParam(':book_id', $book_id, PDO::PARAM_INT);
$query->bindParam(':note_text', $note_text, PDO::PARAM_STR);

if ($query->execute()) {
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
} else {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => 'Error adding note']);
}