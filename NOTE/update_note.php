<?php
require_once __DIR__ . '/../connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('HTTP/1.1 401 Unauthorized');
    exit();
}

$user_id = $_SESSION['user_id'];

$note_id = isset($_POST['note_id']) ? $_POST['note_id'] : null;
$updated_text = isset($_POST['updated_text']) ? $_POST['updated_text'] : null;

if ($note_id === null || $updated_text === null) {
    header('HTTP/1.1 400 Bad Request');
    exit();
}

$sql = "UPDATE note SET note_text = :updated_text WHERE id = :note_id AND user_id = :user_id AND deleted_at IS NULL";
$query = $pdo->prepare($sql);
$query->bindParam(':updated_text', $updated_text, PDO::PARAM_STR);
$query->bindParam(':note_id', $note_id, PDO::PARAM_INT);
$query->bindParam(':user_id', $user_id, PDO::PARAM_INT);

if ($query->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['status' => 'error']);
}