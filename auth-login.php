<?php 

include 'database/config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<!--link rel="preconnect" href="https://fonts.gstatic.com"-->
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<!--link rel="canonical" href="https://demo-basic.adminkit.io/" /-->

	<title>Ohipopo SMS Technology</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<!--link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet"-->
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Welcome Back</h1>
							<p class="lead">
								Please sign in to your account to continue
							</p>
						</div>


						<?php
							if (isset($_POST['submit'])) {
								$username = $_POST['username'];
								$password = md5($_POST['password']);

								$sql = "SELECT * FROM users WHERE (username='$username' AND password='$password') AND (username != '' OR password != '')";
								$result = mysqli_query($conn, $sql);
								if ($result->num_rows > 0) {
									$row = mysqli_fetch_assoc($result);
									$_SESSION['username'] = $row['username'];		
									header("Location: index.php");
								} else {
									echo '<p class="alert alert-danger">Wrong Credentials. Please verify and try again. God bless you.</p>';
								}
							}

						?>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<img src="img/employee/faa192cbe59145dce397923adedfcd6f1f21d18f-306989866_2931249587019087_1853878794807830941_n.jpg" alt="Oipopo technologies" class="img-fluid rounded-circle" style="width:200px; height:200px" />
									</div>
									<form action="" method="POST" >
										<div class="mb-3">
											<label class="form-label">User Name</label>
											<input class="form-control form-control-lg" type="text" name="username" placeholder="Enter your username" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
											<small>
												<a href="index.php">Forgot password?</a>
											</small>
										</div>
										<div>
											<label class="form-check">
												<input class="form-check-input" type="checkbox" value="remember-me" name="remember-me" checked>
												<span class="form-check-label">
												Remember me next time
												</span>
											</label>
										</div>
										<div class="text-center mt-3">
											<button type="submit" name="submit" class="btn btn-lg btn-primary">Sign in</button>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>

</body>

</html>