<?php $user_rights = $this->session->userdata['user_rights']['user-list'];
if (!in_array("2", $user_rights)) { 
   header('Location:'.SITE_URL. 'user-list');
}
?>
<div class="row">
   <!-- left column -->
   <div class="col-md-12">
      <!-- general form elements -->
     
      <div class="box box-primary">
        
         <!-- form start -->
         <form role="form" method="post" name="menu" action="<?php echo SITE_URL ?>controller_user/save" enctype="multipart/form-data">
         
         <div class="box-body">
                <div class="form-group">
                  <label for="user_type">User Type</label>
                  <select name="user_type" id="user_type" class="form-control">
                  <?php foreach($user_types as $user_type){ ?>
                  <option value="<?php echo $user_type->user_role_id;?>"><?php echo $user_type->user_role_name;?></option>
                  <?php } ?>
                  </select>
               </div>
			   <div class="form-group">
                  <label for="user_name">User Name<span class="text text-danger">*</span></label>
                  <input type="text" name="user_name" id="user_name" class="form-control" value="<?php echo set_value('user_name'); ?>">
                  <?php echo form_error('user_name', '<div class="error">', '</div>'); ?>
               </div>
               <div class="form-group">
                  <label for="email">User Email<span class="text text-danger">*</span></label>
                  <input type="text" name="email" id="email" class="form-control" value="<?php echo set_value('email'); ?>">
                  <?php echo form_error('email', '<div class="error">', '</div>'); ?>
               </div>
               <div class="form-group">
                  <label for="email">User Password<span class="text text-danger">*</span></label>
                  <input type="password" name="password" id="password" class="form-control" value="<?php echo set_value('password'); ?>">
                  <?php echo form_error('password', '<div class="error">', '</div>'); ?>
               </div>
               <div class="form-group">
                  <label for="email">User Phone</label>
                  <input type="text" name="phone" id="phone" class="form-control" value="<?php echo set_value('phone'); ?>">
                  <?php echo form_error('phone', '<div class="error">', '</div>'); ?>
               </div>
               <div class="form-group">
                <label>Is Active</label>
              <div class="radio">
                     <label><input type="radio" name="is_active" id="is_active1" value="Y" checked>Yes</label>
                     <label><input type="radio" name="is_active" id="is_active2" value="N" >No</label>

              </div>
              </div>
            </div><!-- /.box-body -->
              <div class="box-footer">
                  <input type="submit" name="save_user"  class="btn btn-default" value="Add">
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
	jQuery('#dashboard').removeClass('active');
	jQuery('#user-list').addClass('active');
</script>