<?php
require_once('../connection.php'); 

function softDeleteNoteById($pdo, $noteId) {
    try {
        $sql = "UPDATE note SET deleted_at = CURRENT_TIMESTAMP WHERE id = :note_id";
        $query = $pdo->prepare($sql);
        $query->bindParam(':note_id', $noteId, PDO::PARAM_INT);
        $query->execute();

        if ($query->rowCount() > 0) {
            return true; 
        } else {
            return false; 
        }
    } catch (PDOException $e) {
        error_log("Error performing soft delete: " . $e->getMessage());
        return false; 
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $noteId = $_POST['note_id'];

    if (softDeleteNoteById($pdo, $noteId)) {
        echo json_encode(['status' => 'success', 'message' => 'Note soft deleted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error performing soft delete']);
    }
} else {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['status' => 'error', 'message' => 'Bad Request']);
}