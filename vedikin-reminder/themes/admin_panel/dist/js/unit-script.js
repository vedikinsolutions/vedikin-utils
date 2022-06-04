$(document).ready(function(){
	
});
/* function is_text(text_value){

} */
function validateUnitFrom(){
	var unit_name = $("#unit_name").val().trim();
	var unit_id = $("#unit_id").val().trim();
	if(unit_name !=""){
		var res = false;
		$.ajax({
			type        : "POST",
			url         : $("#ajaxCheckDublicateURL").val(),
			data        : "unit_name="+unit_name+"&unit_id="+unit_id,
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
		$('#unit_name').focus();
		$('.alert-danger').hide();
        $("#unit_name").siblings('.alert-danger').show();
        $("#unit_name").siblings('.alert-danger').text('The unit name already exist! please enter the different unit name');
		return false;
	}

	if(unit_name==""){
		$('#unit_id').focus();
        $('.alert-danger').hide();
        $("#unit_id").siblings('.alert-danger').show();
        $("#unit_id").siblings('.alert-danger').text('Please enter the unit name');
        return false;
	}else{
		return true;
	}
	
}