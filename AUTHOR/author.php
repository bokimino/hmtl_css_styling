<?php 
require_once __DIR__ . '/../connection.php';

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
        
        echo '<button><a href="AUTHOR/edit_author.php?id=' . $author->id . '">Edit</a></button>';
        
        echo '<button><a href="AUTHOR/delete_author.php?id=' . $author->id . '">Delete</a></button>';
        
        echo '</td>';
        echo '</tr>';
    }


}
function addAuthor($pdo, $firstName, $lastName, $biography) {
    $sql = "INSERT INTO author (first_name, last_name, biography) VALUES (:first_name, :last_name, :biography)";
    $query = $pdo->prepare($sql);
    
    $query->bindParam(':first_name', $firstName, PDO::PARAM_STR);
    $query->bindParam(':last_name', $lastName, PDO::PARAM_STR);
    $query->bindParam(':biography', $biography, PDO::PARAM_STR);

    return $query->execute();
}

function handleAddAuthor($pdo) {
    if (isset($_POST['add_author'])) {
        $newFirstName = $_POST['new_first_name'];
        $newLastName = $_POST['new_last_name'];
        $newBiography = $_POST['new_biography'];

        if (addAuthor($pdo, $newFirstName, $newLastName, $newBiography)) {
           
            header('Location: admin_dashboard.php');
            exit();
        } else {
           
            echo 'Error adding author.';
        }
    }
}


