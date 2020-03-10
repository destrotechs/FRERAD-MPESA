$(document).ready(function(){
	
	$("#paybtn").click(function(){
		$(".p").css("display","block");
		$("#timer").html( 0 + ":" + 46);
		startTimer();
	})
	$("#pay").submit(function(event){
		//$(".paymentstatus").html("waiting for transaction to complete, it may take a maximum of 45 seconds...").addClass("alert alert-success");
		//alert();
		//event.preventDefault();
	});
	$("#updatephone").submit(function(event){
		//$("#timer").css("display","block");
		
		var phone=$(".phone").val();
		var url="http://localhost/hotspotmpesapayment/logout.php";
		
		$.ajax({
			url:"phoneupdate.php",
			method:"post",
			data:{phone:phone},
			success:function(data){
				if(data=='error'){
					alert("The phone number you entered is already registered to another customer");
				}else{
					alert(data);
					window.location.replace(url);
				}
				
			}
		});
		event.preventDefault();
	});


function startTimer() {
  var presentTime = document.getElementById('timer').innerHTML;
  var timeArray = presentTime.split(/[:]+/);
  var m = timeArray[0];
  var s = checkSecond((timeArray[1] - 1));
  if(s==59){m=m-1}
  //if(m<0){alert('timer completed')}
  
  document.getElementById('timer').innerHTML =
    m + ":" + s;
  console.log(m)
  setTimeout(startTimer, 1000);
}

function checkSecond(sec) {
  if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
  if (sec < 0) {sec = "59"};
  return sec;
}
});