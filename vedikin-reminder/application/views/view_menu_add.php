<?php $user_rights = $this->session->userdata['user_rights']['menu-list'];
if (!in_array("2", $user_rights)) { 
   header('Location:'.SITE_URL. 'menu-list');
}
?>
<div class="row">
   <!-- left column -->
   <div class="col-md-12">
      <!-- general form elements -->
     
      <div class="box box-primary">
        
         <!-- form start -->
         <form role="form" method="post" name="menu" action="<?php echo SITE_URL ?>controller_menu/save" enctype="multipart/form-data">
         
         <div class="box-body">
			   <div class="form-group">
                  <label for="menu_name">Menu Name<span class="text text-danger">*</span></label>
                  <input type="text" name="menu_name" id="menu_name" class="form-control" value="<?php echo set_value('menu_name'); ?>">
                  <?php echo form_error('menu_name', '<div class="error">', '</div>'); ?>
               </div>
               <div class="form-group">
                  <label for="listing_page">Menu Listing Page<span class="text text-danger">*</span></label>
                  <input type="text" name="listing_page" id="listing_page" class="form-control" value="<?php echo set_value('listing_page'); ?>">
                  <?php echo form_error('listing_page', '<div class="error">', '</div>'); ?>
               </div>
               <div class="form-group">
                  <label for="menu_order">Menu Order<span class="text text-danger">*</span></label>
                  <input type="text" name="menu_order" id="menu_order" class="form-control" value="<?php echo set_value('menu_order'); ?>">
                  <?php echo form_error('menu_order', '<div class="error">', '</div>'); ?>
               </div>
               <div class="form-group">
                  <label for="menu_icon">Menu Icon</label>
                  <input type="file" name="menu_icon" id="menu_icon">
                  <!-- <div class="error"><?php //echo @$error;?></div> -->
               </div>
               <div class="form-group">
                  <label for="site_icon">Site Icon</label>
                  <input type="text" name="site_icon" id="site_icon" class="form-control" value="<?php echo set_value('site_icon'); ?>">
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
                  <input type="submit" name="save_menu"  class="btn btn-default" value="Add">
                  <a href="<?php echo SITE_URL ?>menu-list" class="btn btn-info">Cancel</a>
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
	jQuery('#menu-list').addClass('active');
</script>