<?php
	if(!isset($_COOKIE['plan'])){
		$err_plan="You need to select a plan in order to proceed!";
		setcookie("err_plan",$err_plan,time()+(30),"/");
		header("location:plans.php");
	}
	include('header.php');
?>
		<div class="card card-body">
			<h5 class="card-title bg-success br-2 p-3 text-white"><span class="badge badge-info">3</span>&nbsp;Payment details</h5><hr>
			<form method="post" action="processpayment.php">
			<table class="table table-bordered table-active table-stripped">
				<tbody>
					<tr>
						<td>Payment Method</td>
						<td><img src="img/1.png" height="60" width="120"></td>
					</tr>
					<tr>
						<td>Phone</td>
						<td><label>Mpesa Mobile number</label><input type="text" required name="phone" class="form-control" value="<?php echo $_COOKIE['phone'];?>" style="border:solid 1px red;"><small class="text-danger">This is the number that will be used to complete the transaction via mpesa, ensure the mobile device it is on is on and unlocked. you can edit the number displayed above</small></td>
					</tr>
					<tr>
						<td>Plan</td>
						<td><?php echo $_COOKIE['plan'];?></td>
					</tr>
					<tr>
						<td>Amount</td>
						<td>KES. <?php echo $_COOKIE['amount'];?></td>
					</tr>
				</tbody>
			</table>
			
				<input type="hidden" name="username" value="<?php echo['username']?>">
				<!-- <input type="hidden" name="phone" value="<?php echo['phone']?>"> -->
				<input type="hidden" name="plan" value="<?php echo $_COOKIE['plan'];?>">
				<input type="hidden" name="password" value="1<?php echo['password']?>">
				<hr>
				<input type="submit" name="submit" class="btn btn-success btn-lg" value="Perform Payment">
			</form>
			<br>
			<center><img src="img/1.png" height="100" width="200"></center>
		</div>
<?php include('footer.php');?>