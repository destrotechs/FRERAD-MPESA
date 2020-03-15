$(document).ready(function(){
	
	$("#paybtn").click(function(){
		$(".p").css("display","block");
		$("#timer").html( 0 + ":" + 48);
		startTimer();
	})
	$("#payform").submit(function(event){
		var phone=$("#phone").val();
		
		$.ajax({
			url:'processpayment.php',
			method:"POST",
			data:{phone:phone},
			success:function(data){
				if(data=="success"){
					setTimeout(goToCallback, 45000);
				}else{
					alert("Transaction could not be processed at this time, try again later");
				}
			}
		});
		event.preventDefault();
	});

	function goToCallback(){
		window.location.replace('http://192.168.10.140/hewanetwifi/callback.php');
	}
	function callbackStatus(){

	}
	$("#updatephone").submit(function(event){
		//$("#timer").css("display","block");
		
		var phone=$(".phone").val();
		var url="http://192.168.10.140/hewanetwifi/logout.php";
		
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
