$(document).ready(function(){
	$.validator.addMethod(
		"regex",
		function(value, element, regexp) {
			if (regexp.constructor != RegExp)
				regexp = new RegExp(regexp);
			else if (regexp.global)
				regexp.lastIndex = 0;
			return this.optional(element) || regexp.test(value);
		},
		"Please check your input."
	);
	$("form[name='user']").validate({
		// Specify validation rules
		rules: {
			name:  {
				required: true,
				regex: /^[a-zA-Z ]+$/,
			},
			mobile: {
				regex: /^[0-9]+$/,
			},
			email: {
				regex: /^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,7}$/,
				email: true
			},
		},
		// Specify validation error messages
		messages: {
			name: "Please enter a valid name",
			mobile: "Please enter a valid mobile number",
			email: "Please enter a valid email address"
		},
		submitHandler: function(form) {
			form.submit();
		}
	});
});
/* function is_text(text_value){

} */
function validate_adduser(){
	var user_role_id = $("#user_role_id").val().trim();
	var name = $("#name").val().trim();
	var email = $("#email").val().trim();
	var password1 = $("#password").val().trim();
	/* var editor1 = $("#editor1").val();
	var meta_title = $("#meta_title").val();
	var meta_desc = $("#meta_desc").val(); */
	var user_id = $("#user_id").val().trim();
	if(email !=""){
		var res = false;
		$.ajax({
			type        : "POST",
			url         : $("#check_email").val(),
			data        : "email="+email+"&user_id="+user_id,
			async		: false,
			success: function(results) {
				if(results.trim() == 'Yes'){
					res = true;
				}else{
					res = false;
				}
			},
			error: function() {
				toastr.error('Oops...! somthing went wrong please try again!!');
			}
		});
	}
	if(res){
		$('#email').focus();
		$('.alert-danger').hide();
        $("#email").siblings('.alert-danger').show();
        $("#email").siblings('.alert-danger').text('Email already exist! please enter the different email');
		return false;
	} 

	if(user_role_id==""){
		$('#user_role_id').focus();
        $('.alert-danger').hide();
        $("#user_role_id").siblings('.alert-danger').show();
        $("#user_role_id").siblings('.alert-danger').text('Please Select User Type');
        return false;
	}else if(name ==""){
		$('#name').focus();
        $('.alert-danger').hide();
        $("#name").siblings('.alert-danger').show();
        $("#name").siblings('.alert-danger').text('Please enter the First Name');
        return false;
	}else if(password1 ==""){
		$('#password').focus();
        $('.alert-danger').hide();
        $("#password").siblings('.alert-danger').show();
        $("#password").siblings('.alert-danger').text('Please Enter the Password');
        return false;
	}else if(mobile ==""){
		$('#mobile').focus();
        $('.alert-danger').hide();
        $("#mobile").siblings('.alert-danger').show();
        $("#mobile").siblings('.alert-danger').text('Please enter the mobile Number');
        return false;
	}else{
		return true;
	}
	
}
function convertToSlug()
{
	var Text = $("#email").val().trim();
	var emailval = Text.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
	$("#email").val(emailval);
}

