<?php include('header.php');?>
		<div class="card card-body">
			<h5 class="card-title">&nbsp;Select your Plan</h5><hr>
			<form method="post" action="processplans.php">
        <?php 
          if (isset($_COOKIE['err_plan'])) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"> '.$_COOKIE['err_plan'].'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
          }
        ?>
        <div class="form-check">
          <input class="form-check-input" name="plan" type="radio" value="dailyplan">
          <label class="form-check-label" for="defaultCheck1">
            Daily Plan (@ KES 50 per day)
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" name="plan" type="radio" value="weeklyplan">
          <label class="form-check-label" for="defaultCheck1">
            Weekly Plan (@KES 300 per week)
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" name="plan" type="radio" value="monthlyplan">
          <label class="form-check-label" for="defaultCheck1">
            Monthly Plan (@ KES 1500 per month)
          </label>
        </div><hr>
				  <div class="form-group">
				    <label for="exampleFormControlInput1">Amount</label>
				    <input type="text" name="amount" class="form-control amount" value="0.00" readonly="">
				  </div>
				  <div class="form-group">
				    <input type="submit"  name="Checkout" class="btn btn-success btn-md pull-right" value="NEXT" style="">
				  </div>
			</form>
		</div>
</main>
</div>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $(".form-check-input").click(function(){
      var plan=$(this).val();
      if(plan=="dailyplan"){
        $(".amount").empty().val("50");
      }else if(plan=="weeklyplan"){
        $(".amount").empty().val("300");
      }else if(plan=="monthlyplan"){
        $(".amount").empty().val("1500");
      }

    })
  })
</script>
</body>
</html>