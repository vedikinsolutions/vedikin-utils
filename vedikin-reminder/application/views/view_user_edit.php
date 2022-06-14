<?php $user_rights = $this->session->userdata['user_rights']['user-list']; ?>
<div class="row" id="row-container" style="display:none;">
   <!-- left column -->
   <div class="col-md-12">
      <!-- general form elements -->
     
      <div class="box box-primary">
        
         <!-- form start -->
         <form role="form" method="post" name="menu" action="<?php echo SITE_URL ?>controller_user/save_update" enctype="multipart/form-data">
         
         <div class="box-body">
         <input type="hidden" name="user_id" value="<?php echo $get_data[0]->user_id;?>">
                <div class="form-group">
                  <label for="user_type">User Type</label>
                  <select name="user_type" id="user_type" class="form-control" disabled>
                  <?php foreach($user_types as $user_type){ ?>
                  <option value="<?php echo $user_type->user_role_id;?>" <?php echo ($user_type->user_role_id == $get_data[0]->user_role_id ? 'selected':'');?>><?php echo $user_type->user_role_name;?></option>
                  <?php } ?>
                  </select>
               </div>
			   <div class="form-group">
                  <label for="user_name">User Name<span class="text text-danger">*</span></label>
                  <input type="text" name="user_name" id="user_name" class="form-control" value="<?php echo $get_data[0]->user_name; ?>" readonly>
                  <?php echo form_error('user_name', '<div class="error">', '</div>'); ?>
               </div>
               <div class="form-group">
                  <label for="email">User Email<span class="text text-danger">*</span></label>
                  <input type="text" name="email" id="email" class="form-control" value="<?php echo $get_data[0]->email; ?>">
                  <?php echo form_error('email', '<div class="error">', '</div>'); ?>
               </div>
               <div class="form-group">
                  <label for="email">User Password<span class="text text-danger">*</span></label>
                  <input type="password" name="password" id="password" class="form-control" value="<?php echo $get_data[0]->password; ?>">
                  <?php echo form_error('password', '<div class="error">', '</div>'); ?>
               </div>
               <div class="form-group">
                  <label for="email">User Phone</label>
                  <input type="text" name="phone" id="phone" class="form-control" value="<?php echo $get_data[0]->phone; ?>">
                  <?php echo form_error('phone', '<div class="error">', '</div>'); ?>
               </div>
               <div class="form-group">
                <label>Is Active</label>
              <div class="radio">
                     <label><input type="radio" name="is_active" id="is_active1" value="Y" <?php echo ($get_data[0]->is_active == 'Y' ? 'checked':''); ?>>Yes</label>
                     <label><input type="radio" name="is_active" id="is_active2" value="N" <?php echo ($get_data[0]->is_active == 'N' ? 'checked':''); ?>>No</label>

              </div>
              </div>
            </div><!-- /.box-body -->
              <div class="box-footer">
                  <input type="submit" name="save_user"  class="btn btn-default" value="Update">
                  <a href="<?php echo SITE_URL ?>user-list" class="btn btn-info">Cancel</a>
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
	jQuery('#user-list').addClass('active');
</script>