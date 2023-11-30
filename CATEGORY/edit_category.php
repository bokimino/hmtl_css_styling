<?php
include __DIR__ . '/../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryId = $_POST['category_id'];
    $updatedTitle = $_POST['updated_title'];

    $sql = "UPDATE category SET title = :title WHERE id = :id";
    $query = $pdo->prepare($sql);

    $query->bindParam(':title', $updatedTitle, PDO::PARAM_STR);
    $query->bindParam(':id', $categoryId, PDO::PARAM_INT);

    $query->execute();

    header('Location: ../admin_dashboard.php');
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
<html>
    <head>
        <title>Edit Category</title>
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
                    <h2 class="h1">Edit Category</h2>

                   <form method="post" action="" class="">
                       <div class="form-group mb-2">
                          <input type="hidden" name="category_id" value="<?php echo $category->id; ?>">
                          <label for="updated_title">Updated Category:</label>
                      </div>
                      <div class="form-group mb-2">
                          <input type="text" class="form-control" name="updated_title" value="<?php echo $category->title; ?>" required>
                     </div>
                   <button type="submit" class="btn btn-primary mb-2">Update Category</button>
                   </form>
                 </div>
             </div>
         </div>
    </div>
         <footer class="text-white-50 bg-dark mt-3">
           <div class="container text-center">
                <p class="blockquote font-italic" id="quote"></p>
           </div>
        </footer>
    
        <!-- jQuery library -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="ha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        
        <!-- Latest Compiled Bootstrap 4.6 JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
        <script src="../main.js"></script>
    </body>
</html>
