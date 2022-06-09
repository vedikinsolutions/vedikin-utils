<?php $user_rights = $this->session->userdata['user_rights']['point-category-list'];
if (!in_array("2", $user_rights)) { 
   header('Location:'.SITE_URL. 'point-category-list');
}
?>
<div class="row">
   <!-- left column -->
   <div class="col-md-12">
      <!-- general form elements -->
     
      <div class="box box-primary">
        
         <!-- form start -->
         <form role="form" method="post" name="point_category" action="<?php echo SITE_URL ?>controller_point_category/save_update" enctype="multipart/form-data">
         <input type="hidden" name="point_category_id" value="<?php echo $get_data[0]->point_category_id;?>">
         <div class="box-body">
			   <div class="form-group">
                  <label for="point_category_name">Point Category Name<span class="text text-danger">*</span></label>
                  <input type="text" name="point_category_name" id="point_category_name" class="form-control" value="<?php echo $get_data[0]->point_category_name; ?>">
                  <?php echo form_error('point_category_name', '<div class="error">', '</div>'); ?>
               </div>
              
               <div class="form-group">
                <label>Is Active</label>
              <div class="radio">
                     <label><input type="radio" name="is_active" id="is_active1" value="Y" <?php echo $get_data[0]->is_active == 'Y' ?'checked':''; ?>>Yes</label>
                     <label><input type="radio" name="is_active" id="is_active2" value="N" <?php echo $get_data[0]->is_active == 'N' ?'checked':''; ?> >No</label>

              </div>
              </div>
            </div><!-- /.box-body -->
              <div class="box-footer">
                  <input type="submit" name="save_point_category"  class="btn btn-default" value="Add">
                  <a href="<?php echo SITE_URL ?>point-category-list" class="btn btn-info">Cancel</a>
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
	jQuery('#point-category-list').addClass('active');
</script>