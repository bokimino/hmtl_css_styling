<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_author'])) {
    $newCategoryTitle = $_POST['new_category'];

    $sql = "INSERT INTO author (title) VALUES (:title)";
    $query = $pdo->prepare($sql);
    $query->bindParam(':title', $newCategoryTitle, PDO::PARAM_STR);
    $query->execute();

    header('Location: admin_dashboard.php');
    exit();
}
?>