<?php
require_once __DIR__ . '/../connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('HTTP/1.1 401 Unauthorized');
    exit();
}

$user_id = $_SESSION['user_id'];

$book_id = isset($_GET['book_id']) ? $_GET['book_id'] : null;

if ($book_id === null) {
    header('HTTP/1.1 400 Bad Request');
    exit();
}

$sql = "SELECT id, note_text FROM note WHERE user_id = :user_id AND book_id = :book_id AND deleted_at IS NULL";
$query = $pdo->prepare($sql);
$query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$query->bindParam(':book_id', $book_id, PDO::PARAM_INT);
$query->execute();
$notes = $query->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($notes);