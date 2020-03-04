<?php
include('header.php');
?>
	<div class="container align-content-center">
		<div class="card card-body">
			<h4 class="bg-dark br-2 p-3 text-white"><span class="badge badge-info">4</span>&nbsp;payment Status</h4>
				<?php 
				if (isset($_COOKIE['status'])) {
					echo "<div class='alert alert-success'>".$_COOKIE['status']."<div>";
				}else{
					echo "<div class='alert alert-danger'>you have not performed a transaction yet!</div>";
				}
				?>					
		</div>
	</div>
<?php include('footer.php');?>