<?php 
require_once __DIR__ . '/../connection.php';


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
            header('Location: ../admin_dashboard.php');
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
        
        echo '<td class="d-flex">';
        echo '<button class="btn btn-secondary mx-2"><a class="text-light" href="BOOK/edit_book.php?id=' . $book->id . '">Edit</a></button>';
        echo '<form action="./BOOK/process_delete_book.php" method="POST" class="delete-form">';
        echo '<input type="hidden" name="book_id" value="' . $book->id . '">';
        echo '<button type="button" class="btn btn-danger delete-btn text-light mx-2" onclick="confirmDelete(' . $book->id . ')">Delete</button>';
        echo '</form>';
        echo '</td>';
        
        echo '</tr>';
    }
}
function getBookById($pdo, $bookId) {
    $sql = "SELECT * FROM book WHERE id = ? AND deleted_at IS NULL";
    $query = $pdo->prepare($sql);
    $query->execute([$bookId]);
    return $query->fetch(PDO::FETCH_OBJ);
}
function updateBook($pdo, $bookId, $editedTitle, $editedAuthorId, $editedYear, $editedPages, $editedImage, $editedCategoryId) {
    $sql = "UPDATE book SET title = ?, author_id = ?, year_of_publication = ?, number_of_pages = ?, image_url = ?, category_id = ? WHERE id = ?";
    $query = $pdo->prepare($sql);
    return $query->execute([$editedTitle, $editedAuthorId, $editedYear, $editedPages, $editedImage, $editedCategoryId, $bookId]);
}

