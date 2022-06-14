<?php $user_rights = $this->session->userdata['user_rights']['user-right-list']; ?>
<div class="row">
   <!-- left column -->
   <div class="col-md-12">
      <!-- general form elements -->
     
      <div class="box box-primary">
        
         <!-- form start -->
         <form role="form" method="post" name="user_right" action="<?php echo SITE_URL ?>controller_user_right/save_update" enctype="multipart/form-data">
            <input type="hidden" name="menu_name" id="menu_name" value="<?php echo $get_data[0]->menu_id; ?>">
            <div class="box-body">
			      <div class="form-group">
                  <label for="menu_name">Menu Name</label>
                  <input type="text" name="menu" id="menu" value="<?php echo $get_data[0]->menu_name; ?>" class="form-control" readonly>
               </div>
               <div class="form-group">
                  <label for="user_type">User Role</label>
                     <select name="user_type" id="user_type" class="form-control" disabled="disabled">
                        <?php foreach($user_type_list as $user_type){ ?>
                           <option value="<?php echo $user_type->user_role_id;?>" 
                                <?php echo ($user_type->user_role_id ==  $get_data[0]->user_role_id ? 'selected':'');?>>
                                <?php echo $user_type->user_role_name;?>
                            </option>
                        <?php } ?>
                     </select>
               </div>
               <input type="hidden" name="user_type" id="user_type" value="<?php echo $get_data[0]->user_role_id; ?>">
               <div class="form-group" >
                  <label for="user_type">User Right</label><br/>
                  <input type="checkbox" name="right[]" value="1" <?php echo (($get_data[0]->user_rights == "1" || $get_data[1]->user_rights == "1" || $get_data[2]->user_rights == "1" || $get_data[3]->user_rights == "1") ?'checked':'');?> id="right1"><label for="right1"> View</label>
                  <input type="checkbox" name="right[]" value="2" <?php echo (($get_data[0]->user_rights == "2" || $get_data[1]->user_rights == "2" || $get_data[2]->user_rights == "2" || $get_data[3]->user_rights == "2") ?'checked':'');?> id="right2"><label for="right2"> Add</label>
                  <input type="checkbox" name="right[]" value="3" <?php echo (($get_data[0]->user_rights == "3" || $get_data[1]->user_rights == "3" || $get_data[2]->user_rights == "3" || $get_data[3]->user_rights == "3") ?'checked':'');?> id="right3"> <label for="right3"> Edit</label>
                  <input type="checkbox" name="right[]" value="4" <?php echo (($get_data[0]->user_rights == "4" || $get_data[1]->user_rights == "4" || $get_data[2]->user_rights == "4" || $get_data[3]->user_rights == "4") ?'checked':'');?> id="right4"><label for="right4"> Delete</label>
               </div>
               <div class="form-group">
                  <label>Is Active</label>
                  <div class="radio">
                     <label><input type="radio" name="is_active" id="is_active1" value="Y" <?php echo (($get_data[0]->is_active == "Y") ?'checked':'');?>>Yes</label>
                     <label><input type="radio" name="is_active" id="is_active2" value="N" <?php echo (($get_data[0]->is_active == "N") ?'checked':'');?>>No</label>
                  </div>
               </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
               <input type="submit" name="save_right"  class="btn btn-default" value="Update">
               <a href="<?php echo SITE_URL ?>user-right-list" class="btn btn-info">Cancel</a>
            </div>
            <!-- /.box-footer -->
         </form>
      </div>
      <!-- /.box -->
      <!-- /.box-body -->
   </div>
   <!-- /.box -->
</div>
<script>
$(document).ready(function(){
	<?php 
        if (in_array("1", $user_rights) && !in_array("3", $user_rights)) { ?>
            $('input[type="submit"]').hide();
            $('input[type="text"]').prop("disabled", true);
            $('textarea').prop("disabled", true);
            $('input[type="file"]').prop("disabled", true);
            $('.btn').hide();
	<?php } ?>
    $("#row-container").show();
});
</script>
<script>
	jQuery('#dashboard').removeClass('active');
	jQuery('#user-right-list').addClass('active');
</script>