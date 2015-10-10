$(document).ready(function() { 
	$('#signup').submit(function(e){
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
			
			var fnamelegal=/(?:^[A-Z][a-z]+$)/g;
			var lnamelegal=/(?:^[A-Z][a-z]+$)/g;
			var phonelegal=/^[0-9]{10}$/g;
			var emaillegal=/^[a-z_][a-z0-9]+(?:[-._][a-z0-9]+)*@[a-z]+(?:[-._][a-z0-9]+)*\.[a-z]+$/g;
			var passlegal=/^[a-zA-Z0-9!@*+-\/%.$]{8,12}$/g;
			if($('#fname').val()==""){
				errorfields.push('fname');
			}
			if ($('#email').val()=="") {
				errorfields.push('email');
			}
			if ($('#password1').val()=="") {
				errorfields.push('password1');
			}
			if ($('#mobile').val()=="") {
				errorfields.push('mobile');
			}
			if ($('#password2').val()=="") {
				errorfields.push('password2');
			}
			if($('#lname').val()=="") {
				errorfields.push('lname');
			}
			if($('#gender').val()==""){
				errorfields.push('gender');
			}
			var fname_ok=fnamelegal.exec($('#fname').val());
			if(!fname_ok){
				illegalfields.push('fname');	
			}
			var lname_ok=lnamelegal.exec($('#lname').val());
			if(!lname_ok) {
				illegalfields.push('lname');
			}
			var phone_ok=phonelegal.exec($('#mobile').val());
			if(!phone_ok){
				illegalfields.push('mobile');
			}
			var email_ok=emaillegal.exec($('#email').val());
			if(!email_ok){
				illegalfields.push('email');
			}
			var pass_ok=passlegal.exec($('#password1').val());
			if (!pass_ok) {
				illegalfields.push('password1');
			}


			if($('#password2').val()!=$('#password1').val()){
				illegalfields.push('password2');
			}
			
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
					if(illegalfields[j]=="fname"){
						$("#fname").addClass('errorclass');
						$("#fnameerror").html("Not a Valid Name.Please enter in correct Name Format");
						$("#fnameerror").css("visibility","visible");
					}
					if(illegalfields[j]=="lname"){
						$("#lname").addClass('errorclass');
						$("#lnameerror").html("Not a Valid Name.Please enter in correct Name Format");
						$("#lnameerror").css("visibility","visible");
					}
					if(illegalfields[j]=="mobile"){
						$("#mobile").addClass('errorclass');
						$("#mobileerror").html("Not a Valid Phone Number.Please enter in correct Format");
						$("#mobileerror").css("visibility","visible");
	
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
					if (illegalfields[j]=="password1") {
						$("#password1").addClass('errorclass');
						$("#password1error").html("Password entered is not valid");
						$("#password1error").css("visibility","visible");
					}
				}
			}
			if(incomingerrors[i]=="errorfields"){
				for(var j=0; j<errorfields.length;j++){
					if(errorfields[j]=="fname"){
						$("#fname").addClass('errorclass');
						$("#fnameerror").html("Name is required");
						$("#fnameerror").css("visibility","visible");
					}
					if(errorfields[j]=="lname"){
						$("#lname").addClass('errorclass');
						$("#lnameerror").html("Name is required");
						$("#lnameerror").css("visibility","visible");
					}
					if (errorfields[j]=="mobile") {
						$("#mobile").addClass('errorclass');
						$("#mobileerror").html("Phone Number is required");
				        $("#mobileerror").css("visibility","visible");
					}
					if (errorfields[j]=="email") {
						$("#email").addClass('errorclass');
						$("#emailerror").html("Email is required");
				        $("#emailerror").css("visibility","visible");
					}
					if (errorfields[j]=="gender") {
						$("#gendererror").html("Gender is required");
				        $("#gendererror").css("visibility","visible");
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
