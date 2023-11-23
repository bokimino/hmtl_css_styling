<?php 
require_once 'connection.php';

function getAuthors($pdo) {
    $sql = "SELECT * FROM author WHERE deleted_at IS NULL";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
}
$authors = getAuthors($pdo);

function authorOption($authors){
    foreach ($authors as $author) {
        echo '<option value="' . htmlentities($author->id) . '">' . htmlentities($author->first_name . ' ' . $author->last_name) . '</option>';
    }
    
}

