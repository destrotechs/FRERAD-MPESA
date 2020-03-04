<?php
	include('header.php');
?>

<div class="alert alert-danger">
	<?php
		if (isset($_COOKIE['err'])) {
			echo $_COOKIE['err'];
		}
	?>
</div>

<?php
	include('footer.php');
?>