<?php 
session_start();
require_once __DIR__ . '/../connection.php';

$title = $authorId = $categoryId = $year = $pages = $image = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    $title = trim($_POST['title']);
    $authorId = $_POST['author'];
    $categoryId = $_POST['category'];
    $year = $_POST['year'];
    $pages = $_POST['pages'];
    $image = $_POST['image'];

    if (empty($title)) {
        $errors['title'] = 'Title is required.';
    }

    $authorId = $_POST['author'];

    if (empty($authorId) || !is_numeric($authorId)) {
        $errors['author'] = 'Invalid author selection.';
    } else {
      
        $_SESSION['validInputs']['author'] = $authorId;
    }
    $category = $_POST['category'];
    if (empty($category) || !is_numeric($category)) {
        $errors['category'] = 'Invalid category selection.';
    }

    $year = $_POST['year'];
    if (!is_numeric($year) || $year < 0) {
        $errors['year'] = 'Invalid year of publication.';
    }

    $pages = $_POST['pages'];
    if (!is_numeric($pages) || $pages < 1) {
        $errors['pages'] = 'Invalid number of pages.';
    }

    $image = $_POST['image'];
    if (empty($image) || !filter_var($image, FILTER_VALIDATE_URL)) {
        $errors['image'] = 'Invalid image URL.';
    }

    $_SESSION['validInputs'] = [
        'title' => $title,
        'author' => $authorId,
        'category' => $categoryId,
        'year' => $year,
        'pages' => $pages,
        'image' => $image,
    ];

    if (!empty($errors)) {
        $_SESSION['bookErrors'] = $errors;

        header('Location: ../admin_dashboard.php');
        exit();
    }

    try {
       
        $sql = "INSERT INTO book (title, author_id, category_id, year_of_publication, number_of_pages, image_url) VALUES (?, ?, ?, ?, ?, ?)";
        $query = $pdo->prepare($sql);
        $query->execute([$title, $authorId, $categoryId, $year, $pages, $image]);

        unset($_SESSION['bookErrors']);
        unset($_SESSION['validInputs']);

        header('Location: ../admin_dashboard.php');
        exit();
    } catch (PDOException $e) {
        die("Error processing the book: " . $e->getMessage());
    }
} else {
    header('Location: ../admin_dashboard.php');
    exit();
}