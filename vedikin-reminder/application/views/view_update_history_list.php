<?php $user_rights = $this->session->userdata['user_rights']['update-history-list']; ?>
<div class="row" id="row-container" style="display:none;">
	<div class="col-xs-12">
		<div class="box">
			
			<div class="box-header filter_div">
				<!-- Fillter area -->
				<form class="filter_form" id="frmListDataFilter" action="<?php echo SITE_URL ?>search_update_history" method="post">
					<div class="row">
						<div class="col-sm-2">
							<input size="15" type="text" class="extra_field form-control" name="txtSearchKeyWord" id="txtSearchKeyWord" placeholder="Search Keyword" value="<?php echo set_value('txtSearchKeyWord');  ?>" required/>
						</div>
						
						<div class="col-sm-2">
							<input type="submit" class="btn btn-warning" name="searchSubmit" id="searchSubmit" value="Search">
							<a href="<?php echo SITE_URL.'update-history-list';?>" class="btn btn-info">Reset</a>
						</div>
					</div>
				</form>
				<!-- Fillter area end-->
			</div>
			<!-- /.box-header -->
			
			<div class="box-body">
				<!-- <div class="col-sm-12 box-body" style="text-align: right;">
					
				</div> -->
				<?php 
				/*if (in_array("4", $user_rights)) { ?>
					<button id="delete_selected" class="btn btn-primary">Delete</button>
				<?php }*/ ?>
					<table id="tblUserList" class="display nowrap dataTable no-footer table-responsive" cellspacing="0" width="100%">
					<thead>
					<tr>
					<?php 
					/*	if (in_array("4", $user_rights)) { ?>
							<th><input id="check_all" type="checkbox"></th>
					<?php }*/ ?>
					<th>Sr No</th>
                    <th>Reminder </th>
                    <th>Next Reminder Date</th>
                    <th>Updated Date</th>
					<th>Updated By</th>
					<th>Is Active</th>
					<th>Action</th>
					</tr>
                    </thead>
                    <tbody>
						<?php 
							$i=1;
							if(count($get_data) > 0){
							foreach($get_data as $history){ 
                        ?>
                        <tr>
						<?php 
							/*if (in_array("4", $user_rights)) { ?>
							<td><input type="checkbox" name="row-check" class="delete_checkbox" value="<?php echo $users->user_id;?>"></td>
						<?php } */ ?>
						<td><?php echo $i++; ?></td>
						<td><?php echo $history->reminder_title; ?></td>
						<td><?php echo date('Y-m-d',strtotime($history->next_reminder_date)); ?></td>
						<td><?php echo date('Y-m-d',strtotime($history->modified_datetime)); ?></td>
						<td><?php echo $history->user_name; ?></td>
						<td><?php echo getIsactiveButtonForList($history->is_active,$history->update_history_id,DB_PREFIX.'update_history','update_history_id'); ?></td>
						<td>
							<?php 
								if (in_array("3", $user_rights)) {
									echo '<div class="btn-group" id="action">'.getActionButtonForList($history->update_history_id,'update_history',array("E"))."</div>"; 
								}
								if(in_array("4", $user_rights)) { 
									echo '<div class="btn-group" id="action">'.getActionButtonForList($history->update_history_id,'update_history',array("D"))."</div>";
								}
								// if(in_array("1", $user_rights)) { 
								// 	echo '<div class="btn-group" id="action">'.getActionButtonForList($reminder->reminder_id,'reminder',array("V"))."</div>";
								// }
							?>
						</td>
							
                        </tr>
						<?php 
							} 
						}
						else{
							?>
							<tr>
								<td colspan=6 style="text-align: center;font-size:18px">No Data Available</td>
							</tr>
						<?php
						}
						?>
                    </tbody>
				</table>
				<?php  echo $this->pagination->create_links(); ?>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col -->
</div>
<script>
$(document).ready(function(){
	<?php 
        if (in_array("1", $user_rights) && !in_array("3", $user_rights)) { ?>
			$('#button_url').hide();
	<?php } 
	elseif(in_array("2", $user_rights)){ ?>
		$('#button_url').show();
	<?php
	}
	?>
    $("#row-container").show();
});
</script>
<script>
$(document).ready(function(){
	$(function() {
		//If check_all checked then check all table rows
		$("#check_all").on("click", function () {
			if ($("input:checkbox").prop("checked")) {
				$("input:checkbox[name='row-check']").prop("checked", true);
			} else {
				$("input:checkbox[name='row-check']").prop("checked", false);
			}
		});

		// Check each table row checkbox
		$("input:checkbox[name='row-check']").on("change", function () {
			var total_check_boxes = $("input:checkbox[name='row-check']").length;
			var total_checked_boxes = $("input:checkbox[name='row-check']:checked").length;

			// If all checked manually then check check_all checkbox
			if (total_check_boxes === total_checked_boxes) {
				$("#check_all").prop("checked", true);
			}
			else {
				$("#check_all").prop("checked", false);
			}
		});
	
		$("#delete_selected").on("click", function () {
			var ids = '';
			var comma = '';
			$("input:checkbox[name='row-check']:checked").each(function() {
				ids = ids + comma + this.value;
				comma = ',';			
			});		
			
			if(ids.length > 0) {
				$.ajax({
					type: "POST",
					url:"<?php echo SITE_URL ?>user_delete_all",
					data: {'ids': ids},
					dataType: "html",
					cache: false,
					success: function() {
						window.location.href = "<?php echo SITE_URL ?>user-list";
					},
					error: function(jqXHR, textStatus, errorThrown) {
					}
				});
			} else {
				alert('Select atleast one records');
			}
		});
	});
});
</script>
<script>
//	$('#tblUserList').DataTable();
	jQuery('#dashboard').removeClass('active');
	jQuery('#update-history-list').addClass('active');
</script>
