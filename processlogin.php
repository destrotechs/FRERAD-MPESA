<?php
require_once('conf.php');
if(isset($_POST['login'])){
	if ($_POST['username']!="" && $_POST['password']!="") {
		$username=$_POST['username'];
		$password=$_POST['password'];
		$user = new Payment("tempaccount");
		$user->login($username,$password);
	}else{
		setcookie("error_login","your username or password maybe wrong!",time()+(60*1),"/");
		header("location:index.php");
	}
}else{
	header("location:index.php");
}


?>