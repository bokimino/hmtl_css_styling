<?php
require_once __DIR__ . '/../connection.php';

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
    $updatedFirstName = trim($_POST['updated_first_name']);
    $updatedLastName = trim($_POST['updated_last_name']);
    $updatedBiography = trim($_POST['updated_biography']);

    if (empty($updatedFirstName) || empty($updatedLastName) || empty($updatedBiography)) {
        $_SESSION['authorError'] = 'All fields are required.';
    } elseif (strlen($updatedBiography) < 20) {
        $_SESSION['authorError'] = 'Biography must have at least 20 characters.';
    } else {
        $authorId = $_POST['author_id'];

        if (editAuthor($pdo, $authorId, $updatedFirstName, $updatedLastName, $updatedBiography)) {
            header('Location: ../admin_dashboard.php');
            exit();
        } else {
            echo 'Error editing author.';
        }
    }
}

$authorError = isset($_SESSION['authorError']) ? $_SESSION['authorError'] : '';
unset($_SESSION['authorError']); 
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Author</title>
        <meta charset="utf-8" />
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />

        <!-- Latest compiled and minified Bootstrap 4.6 CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <!-- CSS script -->
        <link rel="stylesheet" href="style.css">
        <!-- Latest Font-Awesome CDN -->
        <script src="https://kit.fontawesome.com/3257d9ad29.js" crossorigin="anonymous"></script>
    </head>
    <body>
    <nav class="navbar navbar-light bg-light">
             <a class="navbar-brand" href="./../main.php">
				<img src="./../images/booklogo.png" width="50" height="50" alt="" />
			</a>
	</nav>
    
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6 text-center">
                <div class="bg-light p-5 rounded-circle">
                    <h2 class="h1">Edit Author</h2>

                   <form method="post" action="" class="">
                       <div class="form-group mb-2">
                            <input type="hidden" name="author_id" value="<?php echo $author->id; ?>">
                      </div>
                      <div class="form-group mb-2">
                              <label for="updated_first_name">Updated First Name:</label>
                              <input type="text" class="form-control" name="updated_first_name" value="<?php echo $author->first_name; ?>" required>

                     </div>
                     <div class="form-group mb-2">
                             <label for="updated_last_name">Updated Last Name:</label>
                             <input type="text" class="form-control" name="updated_last_name" value="<?php echo $author->last_name; ?>" required>
                     </div>
                     <div class="form-group mb-2">
                            <label for="updated_biography">Updated Biography:</label>
                            <textarea name="updated_biography" class="form-control" rows="3" required><?php echo $author->biography; ?></textarea>
                    </div>
            
                   <button type="submit" class="btn btn-primary mb-2" name="edit_author">Update Author</button>
                   </form>
                   <?php if (!empty($authorError)): ?>
                         <p style="color: red;"><?php echo $authorError; ?></p>
                   <?php endif; ?>
                 </div>
             </div>
         </div>
    </div>

        <!-- jQuery library -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="ha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        
        <!-- Latest Compiled Bootstrap 4.6 JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    </body>
</html>
