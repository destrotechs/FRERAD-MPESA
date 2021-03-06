<?php
	if(!isset($_COOKIE['plan'])){
		$err_plan="You need to select a plan in order to proceed!";
		setcookie("err_plan",$err_plan,time()+(30),"/");
		header("location:plans.php");
	}
	include('header.php');
?>		
		
		<div class="card card-body">
			<h5 class="card-title bg-success br-2 p-3 text-white">Payment details<p class="alert alert-danger p" style="float: right;display: none;">please wait...<span id="timer" class="badge badge-light pull-right"></span></p></h5><hr>
			<div class="paymentstatus"></div>
			
			<form id="payform">
			<table class="table table-light table-bordered table-active table-stripped">
				<tbody>
					<tr>
						<td>Payment Method</td>
						<td><img src="img/1.png" height="60" width="120"></td>
					</tr>
					<tr>
						<td>Phone</td>
						<td><?php echo $_COOKIE['phone'];?></td>
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
				<input type="hidden" name="phone" id="phone" value="<?php echo$_COOKIE['phone']?>">
				<input type="hidden" name="plan" value="<?php echo $_COOKIE['plan'];?>">
				<input type="hidden" name="password" value="1<?php echo['password']?>">
				<hr>
				<button type="submit" class="btn btn-success rounded btn-lg" id="paybtn">Buy Now</button>
			</form>
			<br>
			<center><img src="img/1.png" height="100" width="200"></center>
		</div>
<?php include('footer.php');?>
