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
            <hr>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              Update Phone
            </button>
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
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Phone update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="updatephone">
      <div class="modal-body">
        <div class="form-group">
          <label>Phone</label>
          <input type="text" name="phone" class="form-control phone" value="<?php echo $_COOKIE['phone'];?>">
          <small>Edit the number and save changes</small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
    <?php include('footer.php');?>