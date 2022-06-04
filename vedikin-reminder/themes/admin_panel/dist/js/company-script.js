$(document).ready(function(){
	
});
/* function is_text(text_value){

} */
function validateCompanyFrom(){
	var company_name = $("#company_name").val().trim();
	var company_id = $("#company_id").val().trim();
	if(company_name !=""){
		var res = false;
		$.ajax({
			type        : "POST",
			url         : $("#ajaxCheckDublicateURL").val(),
			data        : "company_name="+company_name+"&company_id="+company_id,
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
		$('#company_name').focus();
		$('.alert-danger').hide();
        $("#company_name").siblings('.alert-danger').show();
        $("#company_name").siblings('.alert-danger').text('The company already exist! please enter the different company name');
		return false;
	}

	if(company_name==""){
		$('#company_id').focus();
        $('.alert-danger').hide();
        $("#company_id").siblings('.alert-danger').show();
        $("#company_id").siblings('.alert-danger').text('Please enter the company name');
        return false;
	}else{
		return true;
	}
	
}