<?php
  if(!isset($_COOKIE['loggedin'])){
    $out="your session has expired, please login again";
    if (!isset($_COOKIE['loggedout'])) {
      setcookie("loggedout",$out,time()+(60*2),"/");
    }
  header("location:index.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Plans
	</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
	<style type="text/css">

	</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm mb-3">
  <a class="navbar-brand text-white" href="#">HewaNet</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="color: white;">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link text-white" href="profile.php"><span class="sr-only">(current)</span>Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="plans.php">Purchase Plan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="myplans.php">My Details</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="transactions.php">Transactions</a>
      </li>
    </ul>
<a href="#"><?php echo $_COOKIE['username'];?></a>&nbsp;
<a href="logout.php" class="btn btn-sm btn-outline-danger">logout</a>
  </div>
</nav>
<hr>
<div class="container-fluid">
	<br>
<div class="row" style="margin-top: 0px;">
    <nav class="col-md-2 d-none d-md-block  bg-dark shadow-sm sidebar" style="">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link text-white" href="profile.php">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <div class="dropdown-divider"></div>
          <li class="nav-item">
            <a class="nav-link text-white" href="myplans.php">
              <span data-feather="file"></span>
              My Details
            </a>
          </li>
          <div class="dropdown-divider"></div>
          <li class="nav-item">
            <a class="nav-link text-white" href="plans.php">
              <span data-feather="shopping-cart"></span>
              Purchase Plan
            </a>
          </li>
          <div class="dropdown-divider"></div>
          <li class="nav-item">
            <a class="nav-link text-white" href="confirmpayment.php">
              <span data-feather="shopping-cart"></span>
              Confirm Payment
            </a>
          </li>
          <div class="dropdown-divider"></div>
          <li class="nav-item">
            <a class="nav-link text-white" href="transactions.php">
              <span data-feather="shopping-cart"></span>
              Transactions
            </a>
          </li>
          <div class="dropdown-divider"></div>
        </ul>   
      </div>
    </nav>
    <main role="main" class="col-md-10 col-sm-12 px-4">