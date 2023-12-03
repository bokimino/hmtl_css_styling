<!DOCTYPE html>
<html>
    <head>
        <title>Comments</title>
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
        <?php 
        require_once __DIR__ . '/admin_comment.php';
        require_once __DIR__ . '/rejected_comments.php';
        ?>
     <nav class="navbar navbar-light bg-light">
             <a class="navbar-brand" href="./../main.php">
				<img src="./../images/booklogo.png" width="50" height="50" alt="" />
			</a>
	</nav>
    <div class="container text-center py-5">
			<h1 class="my-5">Comments by users</h1>

			<table class="table m-auto table-bordered table-info">
				<tr>
					<th>ID</th>
					<th>User ID</th>
					<th>User Email</th>
					<th>Book ID</th>
					<th>Book Title</th>
					<th>Comment Text</th>
					<th>Is Approved</th>
					<th>Created At</th>
				</tr>
                <?php foreach ($comments as $comment) : ?>
		        <tr>
		        	<td><?= $comment['comment_id']; ?></td>
		        	<td><?= $comment['user_id']; ?></td>
		        	<td><?= $comment['user_email']; ?></td>
		        	<td><?= $comment['book_id']; ?></td>
		        	<td><?= $comment['book_title']; ?></td>
		        	<td><?= $comment['comment_text']; ?></td>
		        	<td><?= $comment['is_approved']; ?></td>
		        	<td><?= $comment['created_at']; ?></td>
		        </tr>
	            <?php endforeach; ?>
			</table>
		</div>
        <div class="container text-center p-3">
        <h2 class="my-5">Rejected Comments</h2>

           <?php if (count($rejectedComments) > 0) : ?>
             <table class="table m-auto table-bordered table-danger">
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>User Email</th>
                        <th>Book ID</th>
                        <th>Book Title</th>
                        <th>Comment Text</th>
                        <th>Is Approved</th>
                        <th>Created At</th>
                    </tr>

        <?php foreach ($rejectedComments as $comment) : ?>
                <tr>
                    <td><?= $comment['comment_id']; ?></td>
                    <td><?= $comment['user_id']; ?></td>
                    <td><?= $comment['user_email']; ?></td>
                    <td><?= $comment['book_id']; ?></td>
                    <td><?= $comment['book_title']; ?></td>
                    <td><?= $comment['comment_text']; ?></td>
                    <td><?= $comment['is_approved']; ?></td>
                    <td><?= $comment['created_at']; ?></td>
                    <td>
                        <form action="approve_comment.php" method="post">
                            <input type="hidden" name="comment_id" value="<?= $comment['comment_id']; ?>">
                            <button class="btn btn-success" type="submit">Approve</button>
                        </form>
                    </td>
                </tr>
                  <?php endforeach; ?>
             </table>
                  <?php else : ?>
                      <p>No rejected comments found.</p>
                  <?php endif; ?>
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