<?php
include __DIR__ . '/../connection.php';


if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];

    $sql = "UPDATE category SET deleted_at = NOW() WHERE id = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$categoryId]);

    header('Location: ../admin_dashboard.php');
    exit();
} else {
    header('Location: admin_dashboard.php');
    exit();
}

