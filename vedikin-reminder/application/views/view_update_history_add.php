<?php $user_rights = $this->session->userdata['user_rights']['reminder-list'];
if (!in_array("2", $user_rights)) { 
   header('Location:'.SITE_URL. 'reminder-list');
}
?> <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<div class="row">
   <!-- left column -->
   <div class="col-md-12">
      <!-- general form elements -->
     
      <div class="box box-primary">
        
         <!-- form start -->
         <form role="form" method="post" name="menu" action="<?php echo SITE_URL ?>controller_update_history/save" enctype="multipart/form-data">
         
         <div class="box-body">
               <div class="form-group">
                  <label for="reminder">Reminder</label>
                    <select name="reminder" id="reminder" class="form-control">
                        <?php foreach($reminders as $reminder){ 
                            echo "<option value=".$reminder->reminder_id.">".$reminder->reminder_title."</option>";
                         } ?>
                    </select>
               </div>
               <div class="form-group">
                  <label for="reminder_date">Next Reminder Date<span class="text text-danger">*</span></label>
                  <input type="text" name="reminder_date" id="reminder_date" class="form-control" value="<?php echo set_value('reminder_date'); ?>">
                  <?php echo form_error('reminder_date', '<div class="error">', '</div>'); ?>
               </div>
               <div class="form-group">
                  <label for="remarks">Remarks</label>
                  <textarea name="remarks" class="form-control"><?php echo set_value('remarks'); ?></textarea>
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
                  <input type="submit" name="save_history"  class="btn btn-default" value="Add">
                  <a href="<?php echo SITE_URL ?>update-history-list" class="btn btn-info">Cancel</a>
              </div>
         <!-- /.box-footer -->
         </form>
      </div>
      <!-- /.box -->
      <!-- /.box-body -->
   </div>
   <!-- /.box -->
</div>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#reminder_date" ).datepicker();
  } );
  </script>
<script>
    
	jQuery('#dashboard').removeClass('active');
	jQuery('#update-history-list').addClass('active');
</script>