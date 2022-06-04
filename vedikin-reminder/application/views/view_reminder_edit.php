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
         <form role="form" method="post" name="menu" action="<?php echo SITE_URL ?>controller_reminder/save_update" enctype="multipart/form-data">
         
         <div class="box-body">
               
			   <div class="form-group">
                  <label for="title">Title<span class="text text-danger">*</span></label>
                  <input type="text" name="title" id="title" class="form-control" value="<?php echo $get_data[0]->reminder_title; ?>">
                  <?php echo form_error('title', '<div class="error">', '</div>'); ?>
               </div>
               <div class="form-group">
                  <label for="type">Type</label>
                    <select name="type" id="type" class="form-control">
                        <option value="ssl" <?php echo ($get_data[0]->reminder_type == 'ssl'?'selected':''); ?>>SSL</option>
                        <option value="domain" <?php echo ($get_data[0]->reminder_type == 'domain'?'selected':''); ?>>Domain</option>
                        <option value="other" <?php echo ($get_data[0]->reminder_type == 'other'?'selected':''); ?>>Other</option>
                    </select>
               </div>
               <div class="form-group">
                  <label for="reminder_date">Reminder Date<span class="text text-danger">*</span></label>
                  <input type="text" name="reminder_date" id="reminder_date" class="form-control" value="<?php echo date('Y-m-d',strtotime($get_data[0]->reminder_date)); ?>">
                  <?php echo form_error('reminder_date', '<div class="error">', '</div>'); ?>
               </div>
               <div class="form-group">
                  <label for="remarks">Remarks</label>
                  <textarea name="remarks" class="form-control"><?php echo $get_data[0]->remarks; ?></textarea>
               </div>
               <div class="form-group">
                <label>Is Active</label>
              <div class="radio">
                     <label><input type="radio" name="is_active" id="is_active1" value="Y" checked>Yes</label>
                     <label><input type="radio" name="is_active" id="is_active2" value="N" >No</label>

              </div>
              <input type="hidden" name="reminder_id" value="<?php echo $get_data[0]->reminder_id; ?>">
              </div>
            </div><!-- /.box-body -->
              <div class="box-footer">
                  <input type="submit" name="save_reminder"  class="btn btn-default" value="Add">
                  <a href="<?php echo SITE_URL ?>reminder-list" class="btn btn-info">Cancel</a>
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
	jQuery('#reminder-list').addClass('active');
</script>