$(document).ready(function(){
	
});
/* function is_text(text_value){

} */
function validateFrom(){
	var labor_skill = $("#labor_skill").val().trim();
	var labor_skill_id = $("#labor_skill_id").val().trim();
	if(labor_skill !=""){
		var res = false;
		$.ajax({
			type        : "POST",
			url         : $("#ajaxCheckDublicateURL").val(),
			data        : "labor_skill="+labor_skill+"&labor_skill_id="+labor_skill_id,
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
		$('#labor_skill').focus();
		$('.alert-danger').hide();
        $("#labor_skill").siblings('.alert-danger').show();
        $("#labor_skill").siblings('.alert-danger').text('Labor Skill already exist! please enter the different Labor Skill');
		return false;
	}

	if(labor_skill==""){
		$('#labor_skill_id').focus();
        $('.alert-danger').hide();
        $("#labor_skill_id").siblings('.alert-danger').show();
        $("#labor_skill_id").siblings('.alert-danger').text('Please enter the Labor Skill');
        return false;
	}else{
		return true;
	}
	
}