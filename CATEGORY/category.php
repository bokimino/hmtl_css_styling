<?php 
include __DIR__ . '/../connection.php';

function getCategories($pdo) {
    $sql = "SELECT * FROM category WHERE deleted_at IS NULL";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function categoryDisplay($categories)
{
    foreach ($categories as $category) {
        echo '<tr>';
        echo '<td>' . htmlentities($category->title) . '</td>';
        echo '<td>';
        echo '<button class="btn btn-secondary mx-2"><a class="text-light" href="CATEGORY/edit_category.php?id=' . $category->id . '">Edit</a></button>';
        echo '<button class="btn btn-danger mx-2"><a class="text-light" href="CATEGORY/delete_category.php?id=' . $category->id . '">Delete</a></button>';
        echo '</td>';
        echo '</tr>';
    }
}

$categories = getCategories($pdo);

function addCategory($pdo, $newCategory) {
    $sql = "INSERT INTO category (title) VALUES (?)";
    $query = $pdo->prepare($sql);
    return $query->execute([$newCategory]);
}

function handleAddCategory($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_category'])) {
       
        $newCategory = $_POST['new_category'];
       
        if (addCategory($pdo, $newCategory)) {
            header('Location: admin_dashboard.php');
            exit();
        } else {
            echo 'Error adding category.';
        }
    }
}
           
            
