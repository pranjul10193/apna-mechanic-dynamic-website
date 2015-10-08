$(document).ready(function(){ 
	$('#userForm').submit(function(e){
		removeFeedback();
		var errors=validateForm();
		if(errors==""){
			return true;
		}
		else{
			provideFeedback(errors);
			e.preventDefault();
			return false;
		}
	});	
		var illegalfields=new Array();
		var errorfields=new Array();
		var error=new Array();
		
		function validateForm(){
			
			var namelegal=/(?:^[A-Z][a-z]+$)/g;
			var phonelegal=/^[0-9]{4}-[0-9]{7}$/g;
			var emaillegal=/^[a-z_][a-z0-9]+(?:[-._][a-z0-9]+)*@[a-z]+(?:[-._][a-z0-9]+)*\.[a-z]+$/g;
			if($('#name').val()==""){
				errorfields.push('name');
			}
			//if ($('#email').val()=="") {
			//	errorfields.push('email');
			//}
			if ($('#password1').val()=="") {
				errorfields.push('password1');
			}
			if ($('#phone').val()=="") {
				errorfields.push('phone');
			}
			if ($('#password2').val()=="") {
				errorfields.push('password2');
			}

			var name_ok=namelegal.exec($('#name').val());
			if(!name_ok){
				illegalfields.push('name');	
			}
			var phone_ok=phonelegal.exec($('#phone').val());
			if(!phone_ok){
				illegalfields.push('phone');
			}
			//var email_ok=emaillegal.exec($('#email').val());
			//if(!email_ok){
				//illegalfields.push('email');
			//}
			if($('#password2').val()!=$('#password1').val()){
				illegalfields.push('password2');
			}
			//for (var i = 0; i <nameillegal.length; i++) {
			//	if ($("#name").val()==nameillegal[i]) {
			//		illegalfields.push('name');
				//}
		    //}
		    if(illegalfields!=""){
		    	error.push("illegalfields");
				
			}
			
			if(errorfields!=""){
				error.push("errorfields");
			}
			return error;
		}
	

	function provideFeedback(incomingerrors){
		for (var i = 0; i < incomingerrors.length; i++) {
			if(incomingerrors[i]=="illegalfields"){
				for (var j = 0; j < illegalfields.length; j++) {
					if(illegalfields[j]=="name"){
						$("#name").addClass('errorclass');
						$("#nameerror").html("Not a Valid Name.Please enter in correct Name Format");
						$("#nameerror").css("visibility","visible");
					}
					if(illegalfields[j]=="phone"){
						$("#phone").addClass('errorclass');
						$("#phoneerror").html("Not a Valid Phone Number.Please enter in correct Format");
						$("#phoneerror").css("visibility","visible");
	
					}
					if(illegalfields[j]=="email"){
						$("#email").addClass('errorclass');
						$("#emailerror").html("Not a Valid Email.Please enter correct email");
						$("#emailerror").css("visibility","visible");

					}
					if(illegalfields[j]=="password2"){
						$("#password2").addClass('errorclass');
						$("#password2error").html("Passwords do not match");
						$("#password2error").css("visibility","visible");
					}
				}
			}
			if(incomingerrors[i]=="errorfields"){
				for(var j=0; j<errorfields.length;j++){
					if(errorfields[j]=="name"){
						$("#name").addClass('errorclass');
						$("#nameerror").html("Name is required");
						$("#nameerror").css("visibility","visible");
					}
					if (errorfields[j]=="phone") {
						$("#phone").addClass('errorclass');
						$("#phoneerror").html("Phone Number is required");
				        $("#phoneerror").css("visibility","visible");
					}
					if (errorfields[j]=="email") {
						$("#email").addClass('errorclass');
						$("#emailerror").html("Email is required");
				        $("#emailerror").css("visibility","visible");
					}
					if (errorfields[j]=="password1") {
						$("#password1").addClass('errorclass');
						$("#password1error").html("Password is required");
				        $("#password1error").css("visibility","visible");
					}
					if (errorfields[j]=="password2") {
						$("#password2").addClass('errorclass');
						$("#password2error").html("Password verification is required");
				        $("#password2error").css("visibility","visible");
					}
				}
			}
		}

		//for(var i=0;i<incomingerrors.length;i++){
			//$('#'+incomingerrors[i]).addClass("errorclass");
			//$('#'+incomingerrors[i]+'error').removeClass("errorfeedback");
		//}
		//$("#errordiv").html("errors encountered");
	}
	


	function removeFeedback(){
		$('#errordiv').html(""); 
		illegalfields=[];
		errorfields=[];
		error=[];
		$("input").each(function(){
			$(this).removeClass("errorclass");
		});
		$(".errorspan").each(function(){
			$(this).css("visibility","hidden");
	});
   }
});