<?php
session_start();
if (isset($_COOKIE['loggedin'])) {
	header("location:profile.php");
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
		<?php 
		include('paginate.php');?>
		<div style="margin-top: 60px;">
		<?php
			if (isset($_COOKIE['loggedout'])) {
			echo "<div class='alert alert-info'>".$_COOKIE['loggedout']."</div>";
			}
		?></div>
		<?php include('login.php')?>
		<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">User Signup</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<form class="form-md">
				<div class="err"></div>
			<div class="form-group">
			    <label for="exampleInputEmail1">Name*</label>
			    <input type="text" name="name" class="form-control name">
			</div>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Phone*</label>
			    <input type="text" name="phone" class="form-control phone" placeholder="in form of 07xxxxxxxx">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Email address (optional)</label>
			    <input type="email" name="email" class="form-control email" id="exampleInputEmail1" aria-describedby="emailHelp">
			    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
			  </div>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Username*</label>
			    <input type="text" name="username" class="form-control username">
			    <small id="emailHelp" class="form-text text-muted">We'll never share your username with anyone else.</small>
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Password*</label>
			    <input type="password" name="password" class="form-control password" id="exampleInputPassword1">
			  </div>
			  <button type="button" name="signup" class="btn btn-primary signup">Submit</button>
			</form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".signup").click(function(){
			var nam=$(".name").val();
			var phon=$(".phone").val();
			var eml=$(".email").val();
			var usernme=$(".username").val();
			var pass=$(".password").val();
			if (nam!="" && phon!="" && usernme!="" &&pass!="") {
				var request=$.ajax({
						url:"processsignup.php",
						method:"POST",
						data:{name:nam,phone:phon,email:eml,username:usernme,password:pass},
					});
					request.done(function(data){
						if (data=="u") {
							$(".err").empty().html("A user with this username already exist, use a different one!!").addClass("alert alert-danger");
						}else if (data=="p") {
							$(".err").empty().html("A user with this phone number already exist, use a different one!!").addClass("alert alert-danger");
						}else if (data=="e") {
							$(".err").empty().html("There was an error, try again or contact system administrator!!").addClass("alert alert-danger");
						}else{
							alert("user was created successfully, login!");
							setTimeout(reloadPage(), 5000);
						}
					});
				}else{
					$(".err").empty().html("Fields with * are required!").addClass("alert alert-danger");
				}
			
			function reloadPage(){
				location.reload();
			}
		});
	});
</script>
</body>
</html>