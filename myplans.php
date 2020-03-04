<?php
  if(!isset($_COOKIE['loggedin'])){
    $out="your session has expired, please login again";
    if (!isset($_COOKIE['loggedout'])) {
      setcookie("loggedout",$out,time()+(60*2),"/");
    }
  header("location:index.php");
  }
  include('header.php');
?>
      <div class="row">
        <div class="col-md-12">
          <div class="card bg-light">
            <div class="card-title"><h5>My Details</h5></div>
            <div class="card-body">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">Username: <b><?php echo $_COOKIE['username'];?></b></li>
                <li class="list-group-item">Password: <b><?php echo $_COOKIE['password'];?></b></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <hr>
	   <h5>My Sessions</h5><hr>
	
		<div class="card card-body">
    <?php
    require_once('conf.php');
    $myplans= new Payment("radreply");
    $myplans->fetchPlans();

    ?>  
    </div>
    <?php include('footer.php');?>