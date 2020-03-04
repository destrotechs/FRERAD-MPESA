<?php
if (isset($_COOKIE['loggedin'])) {
	unset($_COOKIE['loggedin']);
    setcookie('loggedin', '', time() - 3600, '/');
    header("location:index.php");
}
	 

?>