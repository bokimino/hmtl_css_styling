<?php 
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $title = $_POST['title'];
        $authorId = $_POST['author'];
        $categoryId = $_POST['category'];
        $year = $_POST['year'];
        $pages = $_POST['pages'];
        $image = $_POST['image'];

        $sql = "INSERT INTO book (title, author_id, category_id, year_of_publication, number_of_pages, image_url) VALUES (?, ?, ?, ?, ?, ?)";
        $query = $pdo->prepare($sql);
        $query->execute([$title, $authorId, $categoryId, $year, $pages, $image]);

        header('Location: admin_dashboard.php');
        exit();
    } catch (PDOException $e) {
        die("Error processing the book: " . $e->getMessage());
    }
} else {
    header('Location: admin.php');
    exit();
}