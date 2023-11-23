<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryId = $_POST['category_id'];
    $updatedTitle = $_POST['updated_title'];

    $sql = "UPDATE category SET title = :title WHERE id = :id";
    $query = $pdo->prepare($sql);

    $query->bindParam(':title', $updatedTitle, PDO::PARAM_STR);
    $query->bindParam(':id', $categoryId, PDO::PARAM_INT);

    $query->execute();

    header('Location: admin_dashboard.php');
    exit();
}

if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];

    $sql = "SELECT * FROM category WHERE id = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$categoryId]);
    $category = $query->fetch(PDO::FETCH_OBJ);
}
?>


