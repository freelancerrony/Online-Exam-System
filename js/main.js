$(function(){
	//user registration
	$("#send").click(function(){
		var name     = $("#name").val();
		var username = $("#username").val();
		var password = $("#password").val();
		var email    = $("#email").val();

		var dataString = 'name='+name+'&username='+username+'&password='+password+'&email='+email;
		$.ajax({
			type:"POST",
			url:"getregister.php",
			data:dataString,
			success:function(data){
				$("#msg").html(data);
				setTimeout(function(){
					$("#msg").fadeOut();
				},2000);
			}
		});
		return false;
	});

	//user login system
	$("#loginsubmit").click(function(){
		var email    = $("#email").val();
		var password = $("#password").val();
		var dataString = 'email='+email+'&password='+password;
		$.ajax({
			type:"POST",
			url:"getlogin.php",
			data:dataString,
			success:function(data){
				if($.trim(data) == "empty"){
					$(".empty").show();
					setTimeout(function(){
						$(".empty").fadeOut();
					}, 2000);
					
				}else if($.trim(data) == "disable"){
					$(".disable").show();
					setTimeout(function(){
						$(".disable").fadeOut();
					}, 2000);
				}else if($.trim(data) == "error"){
					$(".error").show();
					setTimeout(function(){
						$(".error").fadeOut();
					}, 2000);
				}else{
					window.location = "exam.php";
				}
			}
		});
		return false;
	});
});