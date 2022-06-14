$(document).ready(function(){
	
});
function validate_addproduct(){
	var producttitle = $("#producttitle").val().trim();
	var product_id = $("#product_id").val().trim();
	if(producttitle !=""){
		var res = false;
		$.ajax({
			type        : "POST",
			url         : $("#check_url").val(),
			data        : "producttitle="+producttitle+"&product_id="+product_id,
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
		$('#producttitle').focus();
		$('.alert-danger').hide();
        $("#producttitle").siblings('.alert-danger').show();
        $("#producttitle").siblings('.alert-danger').text('Product name already exist! please enter the different product name');
		return false;
	}

	if(producttitle==""){
		$('#producttitle').focus();
        $('.alert-danger').hide();
        $("#producttitle").siblings('.alert-danger').show();
        $("#producttitle").siblings('.alert-danger').text('Please enter the product name');
        return false;
	}else if(company ==""){
		$('#company').focus();
        $('.alert-danger').hide();
        $("#company").siblings('.alert-danger').show();
        $("#company").siblings('.alert-danger').text('Please enter the product name');
        return false;
	}else{
		return true;
	}
	
}
