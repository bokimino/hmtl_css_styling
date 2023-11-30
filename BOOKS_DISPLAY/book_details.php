<?php require_once 'printBookDetails.php';
$loggedInUserId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Document</title>
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
				
           <?php
           
           if (isset($_SESSION['user_id'])) {
               echo '<a href="./../LOGIN/logout.php">Log Out</a>';
               echo '<p>User Email: ' . $_SESSION['user_email'] . '</p>';
           } else {
               echo '
               <form class="form-inline text-white">
                   <a class="btn btn-outline-success m-1" data-toggle="modal" data-target="#modalLoginForm" href="./../main.php"">Log in</a>
                   <a class="btn btn-outline-secondary m-1" href="./../REGISTER/register.php">Register</a>
               </form>';
           }
           ?>
		</nav>   
    <div class="container">
			<div class="row">
				<div class="col-10 offset-1">
                <?php 
                     printingBook($pdo, $loggedInUserId);?> 
                </div>
			</div>
	</div> 
	
	    <footer class="text-white-50 bg-dark mt-3">
           <div class="container text-center">
                <p class="blockquote font-italic" id="quote"></p>
           </div>
        </footer>
    
		<div
			class="modal fade"
			id="modalLoginForm"
			tabindex="-1"
			role="dialog"
			aria-labelledby="myModalLabel"
			aria-hidden="true"
		>
			<div class="modal-dialog" role="document">
				<div class="modal-content bg-info">
					<div class="modal-header text-center">
						<h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
						<button
							type="button"
							class="close"
							data-dismiss="modal"
							aria-label="Close"
						>
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body mx-3">
						<form
							id="loginForm"
							method="POST"
							action="./../LOGIN/login_process.php"
						>
							<div class="md-form mb-5">
								<i class="fas fa-envelope prefix grey-text"></i>
								<input
									type="email"
									id="defaultForm-email"
									name="email"
									class="form-control validate"
									required
								/>
								<label
									data-error="wrong"
									data-success="right"
									for="defaultForm-email"
									>Your email</label
								>
							</div>

							<div class="md-form mb-4">
								<i class="fas fa-lock prefix grey-text"></i>
								<input
									type="password"
									id="defaultForm-pass"
									name="password"
									class="form-control validate"
									required
								/>
								<label
									data-error="wrong"
									data-success="right"
									for="defaultForm-pass"
									>Your password</label
								>
							</div>

							<div class="modal-footer d-flex justify-content-center">
								<button type="submit" class="btn btn-default">Login</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
        <!-- jQuery library -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="ha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        
        <!-- Latest Compiled Bootstrap 4.6 JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
        <script src="../main.js"></script>
    </body>
</html>
