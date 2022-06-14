<?php $user_rights = $this->session->userdata['user_rights']['user-role-list']; ?>
<div class="row" id="row-container" style="display:none;">
   <!-- left column -->
   <div class="col-md-12">
      <!-- general form elements -->
     
      <div class="box box-primary">
        
         <!-- form start -->
         <form role="form" method="post" name="user_role" action="<?php echo SITE_URL ?>controller_user_role/save_update" enctype="multipart/form-data">
         <input type="hidden" name="user_role_id" value="<?php echo $get_data[0]->user_role_id;?>">
         <div class="box-body">
			   <div class="form-group">
                  <label for="user_role">User Type<span class="text text-danger">*</span></label>
                  <input type="text" name="user_role" id="user_role" class="form-control" value="<?php echo $get_data[0]->user_role_name; ?>">
                  <?php echo form_error('user_role', '<div class="error">', '</div>'); ?>
               </div>
            
               <div class="form-group">
                <label>Is Active</label>
              <div class="radio">
                     <label><input type="radio" name="is_active" id="is_active1" value="Y" <?php echo ($get_data[0]->is_active == 'Y'? 'checked':''); ?>>Yes</label>
                     <label><input type="radio" name="is_active" id="is_active2" value="N" <?php echo ($get_data[0]->is_active == 'N'? 'checked':''); ?>>No</label>

              </div>
              </div>
            </div><!-- /.box-body -->
              <div class="box-footer">
                  <input type="submit" name="save_user_type"  class="btn btn-default" value="Update">
                  <a href="<?php echo SITE_URL ?>user-role-list" class="btn btn-info">Cancel</a>
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
	jQuery('#user-role-list').addClass('active');
</script>