$(document).ready(function(){
	
});
/* function is_text(text_value){

} */
function validateGenericNameFrom(){
	var generic_name = $("#generic_name").val().trim();
	var generic_name_id = $("#generic_name_id").val().trim();
	if(generic_name !=""){
		var res = false;
		$.ajax({
			type        : "POST",
			url         : $("#ajaxCheckDublicateURL").val(),
			data        : "generic_name="+generic_name+"&generic_name_id="+generic_name_id,
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
		$('#generic_name').focus();
		$('.alert-danger').hide();
        $("#generic_name").siblings('.alert-danger').show();
        $("#generic_name").siblings('.alert-danger').text('The generic name already exist! please enter the different generic name');
		return false;
	}

	if(generic_name==""){
		$('#generic_name_id').focus();
        $('.alert-danger').hide();
        $("#generic_name_id").siblings('.alert-danger').show();
        $("#generic_name_id").siblings('.alert-danger').text('Please enter the generic name');
        return false;
	}else{
		return true;
	}
	
}