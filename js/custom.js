$(document).ready(function(){
	$("#pay").submit(function(event){
		$(".paymentstatus").html("waiting for transaction to complete, it may take a maximum of 45 seconds...").addClass("alert alert-success");
		//alert();
		//event.preventDefault();
	});
	$("#updatephone").submit(function(event){
		var phone=$(".phone").val();
		var url="http://localhost/hotspotmpesapayment/logout.php";
		
		$.ajax({
			url:"phoneupdate.php",
			method:"post",
			data:{phone:phone},
			success:function(data){
				alert(data);
				window.location.replace(url);

			}
		});
		event.preventDefault();
	});
});