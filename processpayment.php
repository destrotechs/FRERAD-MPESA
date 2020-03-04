<?php
header('Content-type: application/json');
require_once('conf.php');
$phone;
if ($_POST['phone']!="" && strlen($_POST['phone'])==10) {
	if(strlen($_POST['phone'])==10){
		$phone='254'.substr($_POST['phone'], 1);
		// die($phone);
		// exit(0);
	}else if(strlen($_POST['phone'])>10){
		$phone=$_POST['phone'];
		// die($phone);
		// exit(0);
	}
	$payment = new Payment("payments");
	$payment->generateSandboxToken();
	//$payment->registerUrl();
	$payment->processRequest($phone);
	//header("location:waiting.php");
}else{
	$err="enter a valid phone number in form of 07********";
	setcookie("err",$err,time()+(60*1),"/");
	header("location:err.php");
}
	
	//$payment->createPlan($_COOKIE['username'],$_COOKIE['plan']);
?>