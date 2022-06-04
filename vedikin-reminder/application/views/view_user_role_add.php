<?php $user_rights = $this->session->userdata['user_rights']['user-role-list'];
if (!in_array("2", $user_rights)) { 
   header('Location:'.SITE_URL. 'user-role-list');
}
?>
<div class="row">
   <!-- left column -->
   <div class="col-md-12">
      <!-- general form elements -->
     
      <div class="box box-primary">
        
         <!-- form start -->
         <form role="form" method="post" name="menu" action="<?php echo SITE_URL ?>controller_user_role/save" enctype="multipart/form-data">
         
         <div class="box-body">
			   <div class="form-group">
                  <label for="user_role">User Role<span class="text text-danger">*</span></label>
                  <input type="text" name="user_role" id="user_role" class="form-control" value="<?php echo set_value('user_role'); ?>">
                  <?php echo form_error('user_role', '<div class="error">', '</div>'); ?>
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
                  <input type="submit" name="save_user_type"  class="btn btn-default" value="Add">
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
	jQuery('#dashboard').removeClass('active');
	jQuery('#user-role-list').addClass('active');
</script>