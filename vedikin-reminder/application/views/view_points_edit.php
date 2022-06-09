<?php $user_rights = $this->session->userdata['user_rights']['points-list'];
if (!in_array("2", $user_rights)) { 
   header('Location:'.SITE_URL. 'points-list');
}

?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<div class="row">
   <!-- left column -->
   <div class="col-md-12">
      <!-- general form elements -->
     
      <div class="box box-primary">
        
         <!-- form start -->
         <form role="form" method="post" name="points" action="<?php echo SITE_URL ?>controller_point/save_update" enctype="multipart/form-data">
         <input type="hidden" name="point_id" value="<?php echo $get_data[0]->points_id; ?>">
         <div class="box-body">
         <div class="form-group">
                  <label for="point_category">Point Category</label>
                  <select name="point_category" id="point_category" class="form-control">
                     <option>Select Point Category</option>
                     <?php foreach($get_categories as $category){
                       echo "<option value='".$category->point_category_id. "'" .($category->point_category_id == $get_data[0]->point_category_id ? 'selected':'').">".$category->point_category_name."</option>";
                     } ?>
                  </select>
               </div>
			   <div class="form-group">
                  <label for="user_name">User Name<span class="text text-danger">*</span></label>
                  <input type="text" name="user_name" id="user_name" class="form-control" value="<?php echo $get_data[0]->user; ?>">
                  <?php echo form_error('user_name', '<div class="error">', '</div>'); ?>
               </div>
               <div class="form-group">
                  <label for="points">Points<span class="text text-danger">*</span></label>
                  <input type="text" name="points" id="points" class="form-control" value="<?php echo $get_data[0]->points; ?>">
                  <?php echo form_error('points', '<div class="error">', '</div>'); ?>
               </div>
               <div class="form-group">
                  <label for="date">Date</label>
                  <input type="text" name="date" id="date" class="form-control" value="<?php echo $get_data[0]->date; ?>">
                  
               </div>
               <div class="form-group">
                  <label for="remarks">Remarks</label>
                  <textarea name="remarks" id="remarks" class="form-control" ><?php echo $get_data[0]->remarks; ?></textarea>
               
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
                  <input type="submit" name="save_points"  class="btn btn-default" value="Add">
                  <a href="<?php echo SITE_URL ?>points-list" class="btn btn-info">Cancel</a>
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
	jQuery('#points-list').addClass('active');
</script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#date" ).datepicker();
  } );
  </script>