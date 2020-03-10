<?php
header('Content-type: application/json');
require_once('conf.php');
$phone;
if ($_POST['phone']!="" && strlen($_POST['phone'])==10) {
	if(strlen($_POST['phone'])==10){
	$phone='254'.substr($_POST['phone'], 1);

	$payment = new Payment("payments");
	$payment->generateSandboxToken();
	$payment->processRequest($phone);

	}else{
		$err="enter a valid phone number in form of 07********";
		setcookie("err",$err,time()+(60*1),"/");
		header("location:err.php");
	}
	
}else{
	$err="enter a valid phone number in form of 07********";
	setcookie("err",$err,time()+(60*1),"/");
	header("location:err.php");
}
	
	//$payment->createPlan($_COOKIE['username'],$_COOKIE['plan']);
?>