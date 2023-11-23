<?php
require_once 'connection.php';

function getAuthorById($pdo, $authorId) {
    $sql = "SELECT * FROM author WHERE id = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$authorId]);
    return $query->fetch(PDO::FETCH_OBJ);
}

function editAuthor($pdo, $authorId, $updatedFirstName, $updatedLastName, $updatedBiography) {
    $sql = "UPDATE author SET first_name = ?, last_name = ?, biography = ? WHERE id = ?";
    $query = $pdo->prepare($sql);
    return $query->execute([$updatedFirstName, $updatedLastName, $updatedBiography, $authorId]);
}
if (isset($_GET['id'])) {
    $authorId = $_GET['id'];
    $author = getAuthorById($pdo, $authorId);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_author'])) {
    // Assuming you have proper validation and sanitization
    $authorId = $_POST['author_id'];
    $updatedFirstName = $_POST['updated_first_name'];
    $updatedLastName = $_POST['updated_last_name'];
    $updatedBiography = $_POST['updated_biography'];

    // Call the function to edit the author
    if (editAuthor($pdo, $authorId, $updatedFirstName, $updatedLastName, $updatedBiography)) {
        // Redirect to prevent form resubmission
        header('Location: admin_dashboard.php');
        exit();
    } else {
        // Handle the case where the update fails
        echo 'Error editing author.';
    }
}
?>



