
	<div class="container-fluid mt-5">
		<hr>
		<div class="row mt-5" style="margin-top: 50px;">
			<div class="col-sm-9 col-md-6">
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
						<p><b>Don't have an account? </b> <a href="#" class="btn btn-primary btn-md" data-toggle="modal" data-target="#exampleModalLong">signup</a></p>
					</form>
				</div>
			</div>
			<div class="col-md-6 col-sm-3 col-lg-6">
				<div class="jumbotron" style="background-color: #0066CC;color: white;">
				  <h4 class="display-5">HewaNet self service portal</h4><hr>
				  <p class="lead">welcome, please signup if you are a new user then login and purchase a plan.</p>
				  <hr class="my-2">
				  <p class="alert alert-danger"><b>&starf; NOTE&starf;  Your choosen username and password are active for internet connection only when you have an active purchased plan.</b></p>
				</div>
			</div>
		</div>
	</div>
