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
function authorDisplay($authors) {
    foreach ($authors as $author) {
        echo '<tr>';
        echo '<td>' . htmlentities($author->first_name . ' ' . $author->last_name) . '</td>';
        echo '<td>' . htmlentities($author->biography) . '</td>';
        echo '<td>';
        
        echo '<button><a href="edit_author.php?id=' . $author->id . '">Edit</a></button>';
        
        echo '<button><a href="delete_author.php?id=' . $author->id . '">Delete</a></button>';
        
        echo '</td>';
        echo '</tr>';
    }


}



