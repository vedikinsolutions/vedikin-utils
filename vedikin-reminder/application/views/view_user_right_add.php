<?php $user_rights = $this->session->userdata['user_rights']['user-right-list'];
if (!in_array("2", $user_rights)) { 
   header('Location:'.SITE_URL. 'user-right-list');
}
?>
<div class="row">
   <!-- left column -->
   <div class="col-md-12">
      <!-- general form elements -->
     
      <div class="box box-primary">
        
         <!-- form start -->
         <form role="form" method="post" name="user_right" action="<?php echo SITE_URL ?>controller_user_right/save" enctype="multipart/form-data">
         
            <div class="box-body">
               <div class="form-group">
                  <label for="menu_name">Menu Name</label>
                  <select name="menu_name" id="menu_name" class="form-control">
                     <?php foreach($menu_list as $menu){ ?>
                        <option value="<?php echo $menu->menu_id;?>"><?php echo $menu->menu_name;?></option>
                     <?php } ?>
                  </select>
               </div>
               <div class="form-group">
                  <label for="user_type">User Role</label>
                  <select name="user_type" id="user_type" class="form-control">
                  <?php foreach($user_type_list as $user_type){ ?>
                  <option value="<?php echo $user_type->user_role_id;?>"><?php echo $user_type->user_role_name;?></option>
                  <?php } ?>
                  </select>
                  <option></option>
                  
               </div>
               <div class="form-group" >
                  <label for="user_right">User Right</label><br/>
                  <input type="checkbox" name="right[]" id="right1" value="1">
                     <label for="right1"> View</label>
                  <input type="checkbox" name="right[]" id="right2" value="2">
                     <label for="right2"> Add</label>
                  <input type="checkbox" name="right[]" id="right3" value="3">
                     <label for="right3"> Edit</label>
                  <input type="checkbox" name="right[]" id="right4" value="4">
                     <label for="right4"> Delete</label>
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
               <input type="submit" name="save_right"  class="btn btn-default" value="Add">
               <a href="<?php echo SITE_URL ?>user-right-list" class="btn btn-info">Cancel</a>
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
	jQuery('#user-right-list').addClass('active');
</script>