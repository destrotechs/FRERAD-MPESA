<?php
	include('header.php');
?>
    <div class="row">
      <div class="col-md-12">
        <div class="jumbotron jumbotron-fluid" style="background-color: #136a8a;">
          <div class="container">
            <center><h3 class="display-4 text-white">Welcome <b><?php echo $_COOKIE['username'];?></b></h3>
            <p class="lead text-white">This is HewaNet Internet self service Portal.</p>
            <hr>
            <p class="card-text text-white">The credentials (login username and password) created on this portal are valid yes, but are active for internet usage if a user has an active purchased plan, for example, if i purchase a <em>daily</em> plan on 10/03/2020 at 10:00:00 a.m, then i can use my username and password to login to any HewaNet internet service any time between 10:00:01 a.m 10/03/2020 and 11:00:00 a.m 11/03/2020. That is validity is automatically rejected after 24+1 hours.</p>
          </center>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      
    </div>
	</main>
</div>
</div>
<?php include('footer.php'); ?>