<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Administrator</title>
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
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	</head>
	<body>
	    <?php
         require_once __DIR__ . '/CATEGORY/category.php';
         require_once __DIR__ . '/AUTHOR/author.php';
		 require_once __DIR__ . '/BOOK/book.php';

         ?>
		
		<nav class="navbar navbar-light bg-light">
			<a class="navbar-brand" href="#">
				<img src="./images/booklogo.png" width="50" height="50" alt="" />
			</a>
            
			<p>Welcome </p>
		</nav>
        <table>
		      <thead>
		      	<tr>
		      		<th>Categories</th>
		      		<th>
					    <button
		      				type="button"
		      				class="btn btn-primary"
						    id="addCategoryButton"
		      				onclick="showAddCategoryForm()"
		      			>
		      				Add New
		      			</button>
		      		</th>
		      	</tr>
		      </thead>  
			<tbody>
			   <?php categoryDisplay($categories); ?>
			   <?php handleAddCategory($pdo)?>
			</tbody>
		</table>

		<form
			id="addCategoryForm"
			style="display: none"
			method="post"
			action="admin_dashboard.php"
		>
			<td><input type="text" name="new_category" required /></td>
			<td>
				<button type="submit" class="btn btn-success" name="add_category">
					Save
				</button>
				<button type="button" class="btn btn-secondary" onclick="hideAddCategoryForm()">
            Cancel
        </button>
			</td>
		</form>
		<table>
		    <thead>
		    	<tr>
		    		<th>Author</th>
		    		<th>Biography</th>
		    		<th>
		    			<button
		    				type="button"
		    				class="btn btn-primary"
		    				id="addAuthorButton"
		    				onclick="showAddAuthorForm()"
		    			>
		    				Add New Author
		    			</button>
		    		</th>
		    	</tr>
		    </thead>
             <tbody>
				 <?php handleAddAuthor($pdo); ?> 
				 
				 <?php authorDisplay($authors); ?>
             </tbody>
         </table>
		 <?php if (isset($_SESSION['authorError'])) : ?>
                   <p class="text-danger textareaMSG"><?php echo $_SESSION['authorError']; ?></p>
              <?php unset($_SESSION['authorError']); ?>
        <?php endif; ?>
		 <form
			id="addAuthorForm"
			style="display: none"
			method="post"
			action="admin_dashboard.php"
		>
			<td>
				<input
					type="text"
					name="new_first_name"
					placeholder="First Name"
					required
				/>
			</td>
			<td>
				<input
					type="text"
					name="new_last_name"
					placeholder="Last Name"
					required
				/>
			</td>
			<td>
				<textarea
					name="new_biography"
					placeholder="Biography"
					required
				></textarea>
			</td>
			<td>
				<button type="submit" class="btn btn-success" name="add_author">
					Save
				</button>
			</td>
			<td>
				<button
					type="button"
					class="btn btn-secondary"
					onclick="hideAddAuthorForm()"
				>
					Cancel
				</button>
			</td>
		</form>

		<table>
			<thead>
				<tr>
					<th>Book Title</th>
					<th>Author</th>
					<th>Category</th>
					<th>Year Published</th>
					<th>Page Number</th>
					<th>Image URL</th>

				</tr>
			</thead>
			<tbody>
			<?php bookDisplay($books, $authors, $categories); ?>
            <?php handleAddBook($pdo); ?>
			</tbody>
		</table>
		<form id="addBookForm" action="./BOOK/process_book.php" method="POST">

				<div class="form-row">
				    <div class="form-group col-md-6">
		                 <label for="tittleInput">Title</label>
	                  	 <input type="text" class="form-control" name="title" id="tittleInput" 
						 value="<?php echo isset($_SESSION['validInputs']['title']) ? $_SESSION['validInputs']['title'] : ''; ?>" />
		                 <?php if (isset($_SESSION['bookErrors']) && isset($_SESSION['bookErrors']['title'])): ?>
			            <p class="text-danger"><?php echo $_SESSION['bookErrors']['title']; ?></p>
		                <?php endif; ?>
	               </div>
					<div class="form-group col-md-6">
						<label for="inputAuthor"
							>Author</label
						>

						<select class="form-control" name="author"id="inputAuthor" >
							<option selected>Choose...</option>
							<?php authorOption($authors, isset($_SESSION['validInputs']['author']) ? $_SESSION['validInputs']['author'] : ''); ?>
                        </select>
						  <?php if (isset($_SESSION['bookErrors']) && isset($_SESSION['bookErrors']['author'])): ?>
                         <p class="text-danger"><?php echo $_SESSION['bookErrors']['author']; ?></p>
                        <?php endif; ?>
					</div>
					
				</div>
				<div class="form-row">
					
							
	                <div class="form-group col-md-6">
						<label for="inputYear">Year published</label>
						<input type="number" class="form-control" name="year" id="inputYear" 
						value="<?php echo isset($_SESSION['validInputs']['year']) ? $_SESSION['validInputs']['year'] : ''; ?>" />
		                 <?php if (isset($_SESSION['bookErrors']) && isset($_SESSION['bookErrors']['year'])): ?>
		                 	<p class="text-danger"><?php echo $_SESSION['bookErrors']['year']; ?></p>
		                 <?php endif; ?>
					</div>
					<div class="form-group col-md-6">
						<label for="inputPageNumber">Page Number</label>
						<input type="number" class="form-control" name="pages" id="inputPageNumber"
						 value="<?php echo isset($_SESSION['validInputs']['pages']) ? $_SESSION['validInputs']['pages'] : ''; ?>" />
		                 <?php if (isset($_SESSION['bookErrors']) && isset($_SESSION['bookErrors']['pages'])): ?>
		                 	<p class="text-danger"><?php echo $_SESSION['bookErrors']['pages']; ?></p>
		                 <?php endif; ?>
					</div>
					
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="inputCategory"
							>Category</label
						>

						<select class="form-control" name="category" id="inputCategory">
			               <option selected>Choose...</option>
			               <?php
			               foreach ($categories as $category) {
				               $selected = (isset($_SESSION['validInputs']['category']) && $_SESSION['validInputs']['category'] == $category->id) ? 'selected' : '';
				               echo '<option value="' . htmlentities($category->id) . '" ' . $selected . '>' . htmlentities($category->title) . '</option>';
			                  } ?>
		                </select>
		                    <?php if (isset($_SESSION['bookErrors']) && isset($_SESSION['bookErrors']['category'])): ?>
			                    <p class="text-danger"><?php echo $_SESSION['bookErrors']['category']; ?></p>
		                    <?php endif; ?>
					</div>
							
	                <div class="form-group col-md-6">
						<label for="inputURL">URL</label>
						<input type="text" class="form-control" name="image" id="inputURL" 
						value="<?php echo isset($_SESSION['validInputs']['image']) ? $_SESSION['validInputs']['image'] : ''; ?>" />
		                 <?php if (isset($_SESSION['bookErrors']) && isset($_SESSION['bookErrors']['image'])): ?>
		                 	<p class="text-danger"><?php echo $_SESSION['bookErrors']['image']; ?></p>
		                 <?php endif; ?>
					</div>
					
				</div>
				<button type="submit" class="btn btn-success">Add New Book</button>
				
			</form>

			<a href="COMMENT/comments.php" class="btn btn-secondary">Comments by users</a>

		<!-- jQuery library -->
		<script
			src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
			integrity="ha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
			crossorigin="anonymous"
		></script>
		<!-- Latest Compiled Bootstrap 4.6 JavaScript -->
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
		<script src="./main.js"></script>
	   </body>
</html>
