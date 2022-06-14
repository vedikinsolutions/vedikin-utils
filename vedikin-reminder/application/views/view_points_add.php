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
         <form role="form" method="post" name="points" action="<?php echo SITE_URL ?>controller_point/save" enctype="multipart/form-data">
         
         <div class="box-body">
         <div class="form-group">
                  <label for="point_category">Point Category</label>
                  <select name="point_category" id="point_category" class="form-control">
                     <option>Select Point Category</option>
                     <?php foreach($get_categories as $category){
                       echo "<option value=".$category->point_category_id.">".$category->point_category_name."</option>";
                     } ?>
                  </select>
               </div>
			   <div class="form-group">
                  <label for="user_name">User Name<span class="text text-danger">*</span></label>
                  <select name="user_name" id="user_name" class="form-control">
                     <option>Select User</option>
                     <?php foreach($get_users as $user){
                       echo "<option value=".$user->user_id.">".$user->user_name."</option>";
                     } ?>
                  </select>
               </div>
               <div class="form-group">
                  <label for="points">Points<span class="text text-danger">*</span></label>
                  <input type="text" name="points" id="points" class="form-control" value="<?php echo set_value('points'); ?>">
                  <?php echo form_error('points', '<div class="error">', '</div>'); ?>
               </div>
               <div class="form-group">
                  <label for="date">Date</label>
                  <input type="text" name="date" id="date" class="form-control" value="<?php echo set_value('date'); ?>">
                  
               </div>
               <div class="form-group">
                  <label for="remarks">Remarks</label>
                  <textarea name="remarks" id="remarks" class="form-control" ><?php echo set_value('remarks'); ?></textarea>
               
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