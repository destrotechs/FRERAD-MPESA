
	<div class="container mt-5">
		<hr>
		<div class="row mt-5" style="margin-top: 50px;">
			<div class="offset-3 col-md-6">
				<div class="card-body p-3">
					<form method="post" action="processlogin.php">
						<div class="card-title"><h5>Login to your online account</h5></div><hr>
				<?php if (isset($_SESSION['error_login'])) {
					echo"<div class='alert alert-danger'>". $_SESSION['error_login']."</div>";
				} ?>
						<label>Username</label>
						<input type="text" name="username" required class="form-control" placeholder="username">
						<div class="dropdown-divider"></div>
						<label>Password</label>
						<input type="password" name="password" required class="form-control" placeholder="********">
						<div class="dropdown-divider"></div>
						<input type="submit" name="login" value="Login" class="form-control btn btn-success">
						<div class="dropdown-divider"></div>
						<p>Don't have an account?  <a href="#" class="nav-link" data-toggle="modal" data-target="#exampleModalLong">signup</a></p>
					</form>
				</div>
			</div>
		</div>
	</div>
