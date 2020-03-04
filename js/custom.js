$(document).ready(function(){
	function alterSidebar(screensize){
		if(screensize==0){
			$(".navbar-toggler-icon").click(function(){
				$(".sdb").css("display","block");
			})
		}
	}
	alterSidebar(0);
})