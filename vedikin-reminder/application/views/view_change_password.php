<style> #password + .glyphicon {
   cursor: pointer;
   pointer-events: all;
 }

/* Styles for CodePen Demo Only */
#wrapper {
  max-width: 500px;
  margin: auto;
  padding-top: 25vh;
}</style>
<div class="row">
<div class="col-md-3">

  <!-- Profile Image -->
  <div class="box box-primary">
    <div class="box-body box-profile">
      <img class="profile-user-img img-responsive img-circle" src="<?php echo ADMIN_PANEL_THEME_PATH; ?>dist/img/avatar5.png" alt="User profile picture">
      <h3 class="profile-username text-center"><?php echo $tmpArrUser['name']; ?></h3>
      <p class="text-muted text-center"><?php echo get_admin_role(); ?></p>
    </div><!-- /.box-body -->
  </div><!-- /.box -->

</div><!-- /.col -->
<div class="col-md-9">
  <div class="box box-primary" style="padding:10px;"><br>
        <form role="form" class="form-horizontal" method="post" action="<?php echo SITE_URL ?>controller_user_login/update_user" name="updatePassword">
          <div class="form-group">
            <label for="inputName" class="col-sm-3 control-label">Old Password</label>
            <div class="input-group col-sm-8 show_hide_password">
              <input type="password" class="form-control" id="oldpassword" name="oldpassword"  placeholder="Old Password" value="<?php echo (isset($_POST['oldpassword']))?$_POST['oldpassword']:'';?>" onKeyDown="if(event.keyCode === 32)return false;" autocomplete="off">
              <div class="input-group-addon">
                  <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                </div>
              <?php echo form_error('oldpassword', '<div class="error">', '</div>'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail" class="col-sm-3 control-label">New Password</label>
              <div class="input-group col-sm-8 show_hide_password">
                <input class="form-control" type="password" id="newPassword" name="newPassword" placeholder="New Password" value="<?php echo (isset($_POST['newPassword']))?$_POST['newPassword']:'';?>" onKeyDown="if(event.keyCode === 32)return false;" autocomplete="off">
                <div class="input-group-addon">
                  <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                </div>
              <?php echo form_error('newPassword', '<div class="error">', '</div>'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="inputName" class="col-sm-3 control-label">Confirm Password</label>
            <div class="input-group col-sm-8 show_hide_password">
              <input type="password" class="form-control" id="confirm_password" name="confirm_password"  placeholder="Confirm Password" value="<?php echo (isset($_POST['confirm_password']))?$_POST['confirm_password']:'';?>" onKeyDown="if(event.keyCode === 32)return false;" autocomplete="off">
              <div class="input-group-addon">
                  <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                </div>
              <?php echo form_error('confirm_password', '<div class="error">', '</div>'); ?>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-10">
              <button type="submit" class="btn btn-default" name="update_pass" value="update_password">Submit</button>
            </div>
          </div>
        </form><br>
          </div>


</div><!-- /.col -->
</div><!-- /.row -->
<script>
	jQuery('#dashboard').removeClass('active');
	jQuery('#change_password').addClass('active');
</script>