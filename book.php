<?php 
require_once 'connection.php';


function getBooks($pdo) {
    $sql = "SELECT b.*, a.first_name AS author_first_name, a.last_name AS author_last_name, c.title AS category_title
            FROM book b
            LEFT JOIN author a ON b.author_id = a.id
            LEFT JOIN category c ON b.category_id = c.id
            WHERE b.deleted_at IS NULL";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
}
function addBook($pdo, $title, $authorId, $year, $pages, $image, $categoryId) {

    $sql = "INSERT INTO book (title, author_id, year, pages, image, category_id) VALUES (?, ?, ?, ?, ?, ?)";
    $query = $pdo->prepare($sql);
    $query->execute([$title, $authorId, $year, $pages, $image, $categoryId]);

    return $query->rowCount() > 0;
}

function handleAddBook($pdo) {
    if (isset($_POST['add_book'])) {
        $newBookTitle = $_POST['new_book_title'];
    
        $newAuthorId = $_POST['new_author_id'];
        $newYear = $_POST['new_year'];
        $newPages = $_POST['new_pages'];
        $newImage = $_POST['new_image'];
        $newCategoryId = $_POST['new_category_id'];

        if (addBook($pdo, $newBookTitle, $newAuthorId, $newYear, $newPages, $newImage, $newCategoryId)) {
            header('Location: admin_dashboard.php');
            exit();
        } else {
            echo 'Error adding book.';
        }
    }
}
$books = getBooks($pdo);


function bookDisplay($books) {
    foreach ($books as $book) {
        echo '<tr>';
        echo '<td>' . htmlentities($book->title) . '</td>';
        
        echo '<td>';
        echo (!empty($book->author_first_name) ? htmlentities($book->author_first_name . ' ' . $book->author_last_name) : 'No Author');
        echo '</td>';
        

        echo '<td>';
        echo (!empty($book->category_title) ? htmlentities($book->category_title) : 'No Category');
        echo '</td>';

        echo '<td>' . htmlentities($book->year_of_publication) . '</td>';
        echo '<td>' . htmlentities($book->number_of_pages) . '</td>';
        echo '<td>' . htmlentities($book->image_url) . '</td>';
        
        echo '<td>';
        echo '<button><a class="btn btn-primary" href="edit_book.php?id=' . $book->id . '">Edit</a></button>';
        echo '<button class="delete-btn" data-id="' . $book->id . '">Delete</button>';
        echo '</td>';
        
        echo '</tr>';
    }
}

