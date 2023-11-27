<?php
require_once __DIR__ . '/../connection.php';
session_start();
if (isset($_SESSION['user_id'])) {

    $loggedInUserId=$_SESSION['user_id'];  
} else { 
    echo 'Not logged in';
}
$bookId = $_GET['id'];
$refresh = isset($_GET['refresh']) ? $_GET['refresh'] : null;
$bookDetails = getBookDetailsWithComments($pdo, $bookId, $refresh);

function getBookDetailsWithComments($pdo, $bookId, $refresh = null)
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

    $commentSql = "SELECT 
                        id,
                        user_id,
                        comment_text,
                        created_at,
                        is_approved,
                        deleted_at  
                    FROM                                   
                        comment
                    WHERE 
                        book_id = ? 
                        AND deleted_at IS NULL
                    ORDER BY 
                        created_at DESC";

    if ($refresh !== null) {
        $commentSql .= ' LIMIT ' . (int)$refresh;
    }

    $commentQuery = $pdo->prepare($commentSql);
    $commentQuery->execute([$bookId]);
    $comments = $commentQuery->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        $unapprovedUserComments = array_filter($comments, function ($comment) use ($userId) {
            return $comment['user_id'] === $userId && $comment['is_approved'] == 0;
        });

        $comments = array_merge($unapprovedUserComments, array_filter($comments, function ($comment) {
            return $comment['is_approved'] == 1;
        }));
    } else {
        $comments = array_filter($comments, function ($comment) {
            return $comment['is_approved'] == 1;
        });
    }

    $bookDetails['comments'] = $comments;

    return $bookDetails;
}

function printBookDetails($bookDetails, $loggedInUserId)


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

    
    echo '<h6>Comments:</h6>';
    echo '<ul>';
    echo '<ul class="list-group mt-3">';
            foreach ($bookDetails['comments'] as $comment) {
                echo '<li class="list-group-item">' . $comment['comment_text'] . ' - ' .  $comment['created_at'];
                echo '</li>';
            }
            echo '</ul>';
    leaveComment($bookDetails, $loggedInUserId); 
}function printingBook($pdo, $loggedInUserId) {
    if (isset($_GET['id'])) {
        $bookId = $_GET['id'];

        $bookDetails = getBookDetailsWithComments($pdo, $bookId);

        if ($bookDetails) {
            printBookDetails($bookDetails, $loggedInUserId);
        } else {
            echo 'Book not found.';
        }
    } else {
        echo 'No book selected.';
    }
}
