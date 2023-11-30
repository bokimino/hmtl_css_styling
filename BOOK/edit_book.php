<?php
require_once __DIR__ . '/../CATEGORY/category.php';
require_once __DIR__ . '/../AUTHOR/author.php';
require_once 'book.php';

$bookId = $_GET['id']; 
$book = getBookById($pdo, $bookId);
$authors = getAuthors($pdo);
$categories = getCategories($pdo);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Book</title>
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
                <div class="bg-light p-5 rounded">
                    <h2 class="h1">Edit Book</h2>

                   <form method="post" action="process_edit_book.php" class="">
                               <input type="hidden" name="book_id" value="<?= $book->id ?>">
                               <div class="form-group mb-2">
                                     <label for="edit_book_title">Title:</label>
                                     <input type="text" class="form-control" id="edit_book_title" name="edit_book_title" value="<?= $book->title ?>" required>
                               </div>
                               <div class="form-group mb-2">
                               <label for="edit_author_id">Author:</label>
                                     <select class="form-control" id="edit_author_id" name="edit_author_id" required>
                                        <?php 
                                           foreach ($authors as $author) {
                                         echo '<option value="' . htmlentities($author->id) . '">' . htmlentities($author->first_name . ' ' . $author->last_name) . '</option>';
                                        }  ?>  
                                     </select>
                              </div>
                    
                     
                               <div class="form-group mb-2">
                                    <label for="edit_year">Year:</label>
                                    <input type="number" class="form-control" id="edit_year" name="edit_year" value="<?= $book->year_of_publication ?>" required>

                               </div>
                               <div class="form-group mb-2">
                                    <label for="edit_pages">Number of Pages:</label>
                                    <input type="number" class="form-control" id="edit_pages" name="edit_pages" value="<?= $book->number_of_pages ?>" required>
                              </div>
                      
                      
                               <div class="form-group mb-2">
                                    <label for="edit_image">Image URL:</label>
                                    <input type="text"  class="form-control" id="edit_image" name="edit_image" value="<?= $book->image_url ?>" required>

                               </div>
                               <div class="form-group mb-2">
                                    <label for="edit_category_id">Category:</label>
                                    <select class="form-control" id="edit_category_id" name="edit_category_id" required>
                                        <?php
                                        foreach ($categories as $category) {
                                     echo '<option value="' . htmlentities($category->id) . '">' . htmlentities($category->title) . '</option>';
                                        }?>
                                    </select>
                              </div>
                      
                   
                   <button type="submit" class="btn btn-primary mb-2" name="edit_book">Save Changes</button>
                   
                   </form>
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

