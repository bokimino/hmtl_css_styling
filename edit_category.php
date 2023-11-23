<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryId = $_POST['category_id'];
    $updatedTitle = $_POST['updated_title'];

    $sql = "UPDATE category SET title = :title WHERE id = :id";
    $query = $pdo->prepare($sql);

    $query->bindParam(':title', $updatedTitle, PDO::PARAM_STR);
    $query->bindParam(':id', $categoryId, PDO::PARAM_INT);

    $query->execute();

    header('Location: admin_dashboard.php');
    exit();
}

if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];

    $sql = "SELECT * FROM category WHERE id = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$categoryId]);
    $category = $query->fetch(PDO::FETCH_OBJ);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
</head>
<body>

    <h2>Edit Category</h2>

    <form method="post" action="">
        <input type="hidden" name="category_id" value="<?php echo $category->id; ?>">

        <label for="updated_title">Updated Title:</label>
        <input type="text" name="updated_title" value="<?php echo $category->title; ?>" required>

        <button type="submit">Update Category</button>
    </form>

</body>
</html>
