<?php
require_once __DIR__ . '/../CATEGORY/category.php';
require_once __DIR__ . '/../AUTHOR/author.php';
require_once 'book.php';

$bookId = $_GET['id']; 
$book = getBookById($pdo, $bookId);
$authors = getAuthors($pdo);
$categories = getCategories($pdo);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
</head>
<body>

    <h2>Edit Book</h2>
    
    <form action="process_edit_book.php" method="POST">
        <input type="hidden" name="book_id" value="<?= $book->id ?>">
        
        <label for="edit_book_title">Title:</label>
        <input type="text" id="edit_book_title" name="edit_book_title" value="<?= $book->title ?>" required>

        <label for="edit_author_id">Author:</label>
        <select id="edit_author_id" name="edit_author_id" required>
            <?php 
            foreach ($authors as $author) {
                echo '<option value="' . htmlentities($author->id) . '">' . htmlentities($author->first_name . ' ' . $author->last_name) . '</option>';
            }
            ?>
        </select>

        <label for="edit_year">Year:</label>
        <input type="number" id="edit_year" name="edit_year" value="<?= $book->year_of_publication ?>" required>

        <label for="edit_pages">Number of Pages:</label>
        <input type="number" id="edit_pages" name="edit_pages" value="<?= $book->number_of_pages ?>" required>

        <label for="edit_image">Image URL:</label>
        <input type="text" id="edit_image" name="edit_image" value="<?= $book->image_url ?>" required>

        <label for="edit_category_id">Category:</label>
        <select id="edit_category_id" name="edit_category_id" required>
            <?php
            foreach ($categories as $category) {
                echo '<option value="' . htmlentities($category->id) . '">' . htmlentities($category->title) . '</option>';
            }
            ?>
        </select>

        <button type="submit" name="edit_book">Save Changes</button>
    </form>
</body>
</html>

