<?php
	include('header.php');
?>
    <div class="row">
      <div class="col-md-12">
        <div class="jumbotron jumbotron-fluid bg-success">
          <div class="container">
            <h3 class="display-4 text-white">Welcome <b><?php echo $_COOKIE['username'];?></b></h3>
            <p class="lead text-white">This is HewaNet Internet self service Portal.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <div class="card-title">Hewanet Services</div>
            <ol>
              <li>Wireless connections (WiFi)</li>
              <li>Home networks</li>
              <li>Web development</li>
            </ol>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <img class="card-img-top" src="...">
          <div class="card-body">
            <div class="card-title">Get Connected</div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title">Contact us</div>
          </div>
        </div>
      </div>
    </div>
	</main>
</div>
</div>
<?php include('footer.php'); ?>