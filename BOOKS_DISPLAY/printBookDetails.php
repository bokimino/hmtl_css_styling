<?php
require_once __DIR__ . '/../connection.php';

function getBookDetails($pdo, $bookId)
{
    $sql = "SELECT 
                b.id AS book_id,
                b.title AS book_title,
                b.year_of_publication,
                b.number_of_pages,
                b.image_url,
                a.first_name AS author_first_name,
                a.last_name AS author_last_name,
                c.title AS category_title
            FROM 
                book b
            JOIN 
                author a ON b.author_id = a.id
            JOIN 
                category c ON b.category_id = c.id
            WHERE 
                b.id = ? 
                AND b.deleted_at IS NULL
                AND a.deleted_at IS NULL
                AND c.deleted_at IS NULL";

    $query = $pdo->prepare($sql);
    $query->execute([$bookId]);
    $bookDetails = $query->fetch(PDO::FETCH_ASSOC);

    if (!$bookDetails) {
        return null;
    }

    $sql = "SELECT 
    comment_text,
    created_at
FROM 
    comment
WHERE 
    book_id = ? 
    AND is_approved = 1
ORDER BY 
    created_at DESC";


    $query = $pdo->prepare($sql);
    $query->execute([$bookId]);
    $comments = $query->fetchAll(PDO::FETCH_ASSOC);

    $bookDetails['comments'] = $comments;

    return $bookDetails;
}

if (isset($_GET['id'])) {
    $bookId = $_GET['id'];

    $bookDetails = getBookDetails($pdo, $bookId);

    if ($bookDetails) {
    } else {
        echo 'Book not found.';
    }
} else {
    echo 'No book selected.';
}
function printBookDetails($bookDetails)
{
    echo '<div class="card text-center style="width: 300">';
    echo '<div class="w-25 m-auto">';
    echo '<img class="card-img-top" src="' . $bookDetails['image_url'] . '" alt="Card image cap">';
    echo '</div>';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $bookDetails['book_title'] . '</h5>';
    echo '<p class="card-text">' . $bookDetails['author_first_name'] . ' ' . $bookDetails['author_last_name'] . '</p>';
    echo '</div>';
    echo '<ul class="list-group list-group-flush">';
    echo '<li class="list-group-item">Category: ' . $bookDetails['category_title'] . '</li>';
    echo '<li class="list-group-item">Year of Publication: ' . $bookDetails['year_of_publication'] . '</li>';
    echo '<li class="list-group-item">Number of Pages: ' . $bookDetails['number_of_pages'] . '</li>';
    echo '</ul>';
    echo '<div class="card-body">';
    
    if (!empty($bookDetails['comments'])) {
        echo '<h6>Comments:</h6>';
        echo '<ul>';
        foreach ($bookDetails['comments'] as $comment) {
            echo '<li class="text-left">' . $comment['comment_text'] . '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No comments available.</p>';
    }
    echo '</div>';
    echo '</div>';
}