<?php
require_once 'connection.php';
require_once 'book.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_book'])) {
    $bookId = $_POST['book_id'];
    $editedBookTitle = $_POST['edit_book_title'];
    $editedAuthorId = $_POST['edit_author_id'];
    $editedYear = $_POST['edit_year'];
    $editedPages = $_POST['edit_pages'];
    $editedImage = $_POST['edit_image'];
    $editedCategoryId = $_POST['edit_category_id'];

    if (updateBook($pdo, $bookId, $editedBookTitle, $editedAuthorId, $editedYear, $editedPages, $editedImage, $editedCategoryId)) {     
        header('Location: admin_dashboard.php');
        exit();
    } else {
        echo 'Error updating book.';
    }
} else {
    header('Location: admin_dashboard.php');
    exit();
}
?>
