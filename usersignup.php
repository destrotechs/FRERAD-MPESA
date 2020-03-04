<?php
session_start();
	if (isset($_COOKIE['name']) && isset($_COOKIE['username']) && isset($_COOKIE['phone'])) {
		header("location:plans.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Account creation and payment
	</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
		<?php include('paginate.php')?>
	<div class="container align-content-center">
		<div class="card card-body shadow-sm">
			<h5 class="card-title bg-dark br-2 p-3 text-white"><span class="badge badge-info">1</span>&nbsp;User signup</h5><hr>
			<form class="form-sm" method="post" action="processsignup.php"><?php
				if (isset($_SESSION['detailserror'])) {
					echo "<div class='alert alert-danger'>".$_SESSION['detailserror']."</div>";
				}

			?>
				<div class="form-group">
			    <label for="exampleInputEmail1">Name</label>
			    <input type="text" name="name" class="form-control">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Phone</label>
			    <input type="text" name="phone" class="form-control">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Email address</label>
			    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
			    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
			  </div>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Username</label>
			    <input type="text" name="username" class="form-control">
			    <small id="emailHelp" class="form-text text-muted">We'll never share your username with anyone else.</small>
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Password</label>
			    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
			  </div>
			  <button type="submit" name="signup" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>