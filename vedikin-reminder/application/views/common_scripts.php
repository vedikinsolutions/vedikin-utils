<div class="modal fade" id="myModal_add_property" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" style="text-align:center;">Add Property</h4>
			</div>
			<div class="modal-body text_line_height">
				<div class="row">
					<div class="col-sm-12">
						<h3>Please provide your property's  info.</h3>
						<form role="form">
							<div class="box-body" style="padding:0px 10px 10px;">
								<div class="form-group" style="width:100%;">
									<label for="exampleInputEmail1" style="font-weight:400;">Property address</label><br>
									<input type="text" class="form-control" id="exampleInputEmail1" placeholder="">
								</div>	
								<div class="form-group" style="width:100%;">
									<label for="exampleInputEmail1" style="font-weight:400;">Unit number</label><br>
									<input type="text" class="form-control" id="exampleInputEmail1" placeholder="(Optional)">
								</div>						
								<div class="form-group">
									<label style="font-weight:400;">Property Type</label>
									<select class="form-control select2" style="width: 100%;">
									<option selected="selected">Please select</option>
									<option>Condo / Apartment Unit</option>
									<option>House</option>
									<option>Townhouse</option>
									<option>Entire Apartment Community</option>
									</select>
								</div>
								<div class="form-group">                 
									<div class="checkbox">
										<label>
										<input type="checkbox"> Room for rent
										</label>
									</div>
								</div>	
								<div class="form-group" style="width:100%;">
									<button type="button" class="btn btn-info" style="width:100%;">Add property</button>
								</div>	
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
  
<!-- details pop up start -->
<div class="modal fade" id="recordDetailsPopUp" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="detailsPopUpTitle"></h4>
         </div>
         <div class="modal-body text_line_height" id="detailsPopUpData">
            Loading.....
         </div>
      </div>
   </div>
</div>
<!-- details pop up end -->

<link href="<?php echo ADMIN_PANEL_THEME_PATH; ?>dist/css/toastr.css" rel="stylesheet" />
<script src="<?php echo ADMIN_PANEL_THEME_PATH; ?>dist/js/toastr.js"></script>

<script>

$(document).ready(function() {
    toastr.options= {
        "debug": false,
        "positionClass": "toast-bottom-right",
        "onclick": null,
        "fadeIn": 300,
        "fadeOut": 1000,
        "timeOut": 2000,
        "extendedTimeOut": 1000
    }
	<?php if($this->session->flashdata('success_message')) { ?>
	toastr.success('<?php echo $this->session->flashdata('success_message'); ?>');
	<?php } ?>
	<?php if($this->session->flashdata('error_message')) { ?>
	toastr.error('<?php echo $this->session->flashdata('error_message'); ?>');
	<?php } ?>
});

</script>

<script>
/* DATA TABLE CREATE */
jQuery(document).ready(function(){  
	var initCompleteFunction = function(settings, json) {};	
    
	if($('#tblListData').length > 0){
		var oTable = $('#tblListData').DataTable( {
			"scrollX": true,
			//"bScrollCollapse": true,
			"aoColumns": cols,
			"paging": false,
			"aaSorting": [],
			"pageLength": 10,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"order": orderCol,
			"info": true,
			"autoWidth": false,
			"bPaginate": true,
			//"sDom" : 'lipt',
			"sDom" : '<"topsearch"li<"pagination_div"p>fB>rt<"bottom"<"clear">>',                
			"processing": true,
			"serverSide": true,
		 	"ajax": ajaxURL1,
			"pagingType": "input",
			"language": {
				       "info": " _TOTAL_ entries", // Showing _START_ to _END_ of _TOTAL_ entries
				       "infoFiltered": "", // - filtering from _MAX_ records
				       "lengthMenu": 'Showing <select>'+
						             '<option value="10">10</option>'+
						             '<option value="20">20</option>'+
						             '<option value="30">30</option>'+
						             '<option value="40">40</option>'+
						             '<option value="50">50</option>'+
						             '<option value="100">100</option>'+
						             //'<option value="-1">All</option>'+
						             '</select> of ',
						"sSearch": "",
						"sSearchPlaceholder": "Search",	 
						"paginate": {
							             "first": "<<",
							             "last": ">>",
							             "next": ">",
							             "previous": "<",
							        },
				        "sInfoEmpty": " 0 entries"
			},
			"columnDefs": colDef,
			"footerCallback": footerCallBack,
			"aoColumnDefs": [
		                     { "sClass": "numericCol", "aTargets": aoColumnDefs },
		                     { "sClass": "centerClass", "aTargets": aoColumnDefsCenter }
		                   ],
            "initComplete": initCompleteFunction
		});	
	}
  	/* DATA TABLE SUBMIT BUTTON ACTION */
    $('#frmListDataFilter').on('submit', function(e) {
	      oTable.draw();
	      e.preventDefault();
		});
    $("#searchReset").click(function(){location.reload();});
	
});
/* DATA TABLE END */
</script>

<script>
/* IS ACTIVE - UPDATE AJAX CALL */
/* IS ACTIVE - UPDATE AJAX CALL */
function updateIsActiveValue(primary_id,tablename,column_name)
{
	$(document.body).css({'cursor' : 'wait'});
	$.ajax({
		type        : "POST",
		url         : "<?php echo base_url() ?>controller_common/ajaxStatusUpdate",
		data        : "page_id="+primary_id+"&tablename="+tablename+"&column_name="+column_name,
		success: function(results) {
			var obj = JSON.parse(results);
			$(document.body).css({'cursor' : 'default'});
			if(obj.message=="success" && obj.is_active == '0')
			{
				$(".update_status_i"+primary_id).html('<small class="label label-warning">No</small>');
			}
			if(obj.message=="success" && obj.is_active == '1')
			{
				$(".update_status_i"+primary_id).html('<small class="label label-info">Yes</small>');
			}
			toastr.success('Is active status has been updated successfully.');
		},
		error: function() {
			$(document.body).css({'cursor' : 'default'});
			toastr.error('Oops...! Is active status updating failed, please try again');
		}
	});
}
/* IS DISPLAY ON HOME PAGE - UPDATE AJAX CALL */
function updateIsactiveForHomeList(primary_id,tablename,column_name)
{
	$(document.body).css({'cursor' : 'wait'});
	$.ajax({
		type        : "POST",
		url         : "<?php echo base_url() ?>controller_common/updateIsactiveForHomeList",
		data        : "page_id="+primary_id+"&tablename="+tablename+"&column_name="+column_name,
		success: function(results) {
			var obj = JSON.parse(results);
			$(document.body).css({'cursor' : 'default'});
			if(obj.message=="success" && obj.display_on_home_listing == '0')
			{
				$(".flag_status_i"+primary_id).html('<small class="label label-warning">No</small>');
			}
			if(obj.message=="success" && obj.display_on_home_listing == '1')
			{
				$(".flag_status_i"+primary_id).html('<small class="label label-info">Yes</small>');
			}
			toastr.success('Home page listing flag has been updated successfully.');
		},
		error: function() {
			$(document.body).css({'cursor' : 'default'});
			toastr.error('Oops...! Home page listing flag updating failed, please try again');
		}
	});
}
/* Is Featured - UPDATE AJAX CALL */
function updateIsFeatured(primary_id,tablename,column_name)
{
	$(document.body).css({'cursor' : 'wait'});
	$.ajax({
		type        : "POST",
		url         : "<?php echo base_url() ?>controller_common/updateIsFeatured",
		data        : "page_id="+primary_id+"&tablename="+tablename+"&column_name="+column_name,
		success: function(results) {
			var obj = JSON.parse(results);
			$(document.body).css({'cursor' : 'default'});
			if(obj.message=="success" && obj.is_featured == '0')
			{
				$(".flag_is_featured_i"+primary_id).html('<small class="label label-warning">No</small>');
			}
			if(obj.message=="success" && obj.is_featured == '1')
			{
				$(".flag_is_featured_i"+primary_id).html('<small class="label label-info">Yes</small>');
			}
			toastr.success('Featured flag has been updated successfully.');
		},
		error: function() {
			$(document.body).css({'cursor' : 'default'});
			toastr.error('Oops...! Featured flag updating failed, please try again');
		}
	});
}
/* IS DISPLAY ON SIDE BAR - UPDATE AJAX CALL */
function updateIsactiveForSideBaerList(primary_id,tablename,column_name)
{
	$(document.body).css({'cursor' : 'wait'});
	$.ajax({
		type        : "POST",
		url         : "<?php echo base_url() ?>controller_common/updateIsactiveForSideBaerList",
		data        : "page_id="+primary_id+"&tablename="+tablename+"&column_name="+column_name,
		success: function(results) {
			var obj = JSON.parse(results);
			$(document.body).css({'cursor' : 'default'});
			if(obj.message=="success" && obj.display_on_sidebar_listing == '0')
			{
				$(".flag_sidebar_i"+primary_id).html('<small class="label label-warning">No</small>');
			}
			if(obj.message=="success" && obj.display_on_sidebar_listing == '1')
			{
				$(".flag_sidebar_i"+primary_id).html('<small class="label label-info">Yes</small>');
			}
			toastr.success('Sidebar listing flag has been updated successfully.');
		},
		error: function() {
			$(document.body).css({'cursor' : 'default'});
			toastr.error('Oops...! Sidebar listing flag updating failed, please try again');
		}
	});
}

/* DELETE RECORD WARNING */
$(document).on('click', '.deleteRecord', function(){
	var action_url = $(this).attr('rel');
	swal({
		title: "Are you sure? Do you want to delete this record?",
		text: "You will not be able to recover this record!",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: "Yes, delete it!",
		closeOnConfirm: true
	},
	function(isConfirm){
		if (isConfirm)
		{
			$.ajax({
			type        : "POST",
			url         : action_url,
			success: function(results) {
				if(results.trim()=="Yes"){
                    $('#tblListData').DataTable().ajax.reload();
					toastr.success('Record has been deleted successfully');
					setTimeout(function(){
      					 location.reload();
   					},1000);
				}else{
					toastr.error('Oops...! status updating has been failed, please try again.');
				}
			},
			error: function() {
				toastr.error('Oops...! status updating has been failed, please try again.');
			}
			});
		}
	});
});

function GetCityDropDown(state)
{
	$.ajax({
			type        : "POST",
			url         : "<?php echo base_url() ?>controller_common/GetCityDropDown",
			data        : "state="+state,
			success: function(results) {
			$("#divCity").html(results);
			},
			error: function() {
				$(document.body).css({'cursor' : 'default'});
				toastr.error('Oops...! Is active status updating failed, please try again');
			}
	});
}

function autoFillUserDetailsInForm(user_id)
{
	if(user_id>0)
	{
		$.ajax({
			type        : "POST",
			url         : "<?php echo base_url() ?>controller_common/getUserMasterDetailsAsString",
			data        : "user_id="+user_id,
			success: function(results) {
				var obj = JSON.parse(results);
				
				$("#contact_person_name").val(obj.name);
				$("#email").val(obj.email);
				$("#mobile").val(obj.phone);
				$("#phone").val(obj.mobile);
				$("#state").val(obj.state);
				$("#city").val(obj.city);
				$("#address").val(obj.address);
				
			},
			error: function() {
				$("#contact_person_name").val('');
				$("#email").val('');
				$("#mobile").val('');
				$("#phone").val('');
				$("#state").val('');
				$("#city").val('');
				$("#address").val('');
				$(document.body).css({'cursor' : 'default'});
				toastr.error('Oops...! something went wrong to fatch user master details, please try again');
			}
		});
	}
	else
	{
		$("#contact_person_name").val('');
		$("#email").val('');
		$("#mobile").val('');
		$("#phone").val('');
		$("#state").val('');
		$("#city").val('');
		$("#address").val('');
	}
}
</script>