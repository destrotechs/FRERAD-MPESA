<?php
require_once('conf.php');
	if(isset($_POST['phone'])){
		$phone=$_POST['phone'];
		$myphone= new Payment("tempaccount");
		$myphone->updatePhone($phone);
	}
?>