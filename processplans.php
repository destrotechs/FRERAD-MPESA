<?php
if (isset($_POST['Checkout'])) {
	$plan=$_POST['plan'];
	$amount=$_POST['amount'];
	//set cookies containing tese values
	setcookie("plan",$plan, time() + (60 * 10), "/");
	setcookie("amount",$amount, time() + (60 * 10), "/");
	
	header("location:payment.php");
}else{
	header("location:plans.php");
}




?>