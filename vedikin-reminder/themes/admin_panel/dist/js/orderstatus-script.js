$(document).ready(function(){
	
});
/* function is_text(text_value){

} */
function validateOrderStatusFrom(){
	var orderstatus_name = $("#orderstatus_name").val().trim();
	var orderstatus_id = $("#orderstatus_id").val().trim();
	if(orderstatus_name !=""){
		var res = false;
		$.ajax({
			type        : "POST",
			url         : $("#ajaxCheckDublicateURL").val(),
			data        : "orderstatus_name="+orderstatus_name+"&orderstatus_id="+orderstatus_id,
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
		$('#orderstatus_name').focus();
		$('.alert-danger').hide();
        $("#orderstatus_name").siblings('.alert-danger').show();
        $("#orderstatus_name").siblings('.alert-danger').text('The order status already exist! please enter the different order status');
		return false;
	}

	if(orderstatus_name==""){
		$('#orderstatus_id').focus();
        $('.alert-danger').hide();
        $("#orderstatus_id").siblings('.alert-danger').show();
        $("#orderstatus_id").siblings('.alert-danger').text('Please enter the order status');
        return false;
	}else{
		return true;
	}
	
}