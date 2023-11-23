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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Author</title>
</head>
<body>

    <h2>Edit Author</h2>

    <form method="post" action="">
        <input type="hidden" name="author_id" value="<?php echo $author->id; ?>">

        <label for="updated_first_name">Updated First Name:</label>
        <input type="text" name="updated_first_name" value="<?php echo $author->first_name; ?>" required>

        <label for="updated_last_name">Updated Last Name:</label>
        <input type="text" name="updated_last_name" value="<?php echo $author->last_name; ?>" required>

        <label for="updated_biography">Updated Biography:</label>
        <textarea name="updated_biography" required><?php echo $author->biography; ?></textarea>

        <button type="submit" name="edit_author">Update Author</button>
    </form>

</body>
</html>


