<?php

require_once('conf.php');
if (isset($_POST['username'])) {
	if($_POST['name']!="" && $_POST['phone']!=""){
		session_unset();
		$name=$_POST['name'];
		$phone=$_POST['phone'];
		$email=$_POST['email'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		//set cookies containing tese values
		// setcookie("name",$name, time() + (60 * 5), "/");
		// setcookie("phone",$phone, time() + (60 * 5), "/");
		// setcookie("email",$email, time() + (60 * 5), "/");
		// setcookie("username",$username, time() + (60 * 5), "/");
		// setcookie("password",$password, time() + (60 * 5), "/");
		$user = new Payment('tempaccount');
		$user->registerUser($name,$phone,$email,$username,$password);
	}else{
		echo "all fields on this form are required!";
	}
	
}else{
	echo "all fields on this form are required!";
}
// PHP function to print a 
// random string of length n 
function RandomStringGenerator($n) 
{ 
	// Variable which store final string 
	$generated_string = ""; 
	
	// Create a string with the help of 
	// small letters, capital letters and 
	// digits. 
	$domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"; 
	
	// Find the length of created string 
	$len = strlen($domain); 
	
	// Loop to create random string 
	for ($i = 0; $i < $n; $i++) 
	{ 
		// Generate a random index to pick 
		// characters 
		$index = rand(0, $len - 1); 
		
		// Concatenating the character 
		// in resultant string 
		$generated_string = $generated_string . $domain[$index]; 
	} 
	
	// Return the random generated string 
	return $generated_string; 
} 

// Driver code to test above function 
 



?>