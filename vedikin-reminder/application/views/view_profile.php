<div class="row">
            <div class="col-md-3">
              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="<?php echo ADMIN_PANEL_THEME_PATH; ?>dist/img/avatar5.png" alt="User profile picture">
                  <h3 class="profile-username text-center"><?php echo $tmpArrUser['user_name']; ?> </h3>
                  <p class="text-muted text-center"><?php echo get_admin_role(); ?></p>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="box box-primary" style="padding:10px;">
                    <form role="form" class="form-horizontal" method="post" action="<?php echo SITE_URL ?>controller_user_login/update_user" name="updateProfile">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name<span class="text text-danger">*</span></label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo (isset($ArrUser))?$ArrUser['user_name']:'';?>" <?php echo (isset($ArrUser))?'readonly':'';?>>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email Id<span class="text text-danger">*</span></label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Email" value="<?php echo (isset($ArrUser))?$ArrUser['email']:'';?>"  >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPhone" class="col-sm-2 control-label">Phone</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="user_phone" name="user_phone" placeholder="Phone" value="<?php echo (isset($ArrUser))?$ArrUser['mobile_no']:'';?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputAddress" class="col-sm-2 control-label">Password<span class="text text-danger">*</span></label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="user_password" name="user_password" placeholder="Password" value="<?php echo (isset($ArrUser))?$ArrUser['password']:'';?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-default" name="update" value="update">Submit</button>
                        </div>
                      </div>
                    </form><br>
                      </div>
					
					
            </div><!-- /.col -->
          </div><!-- /.row -->
          <script>
	jQuery('#dashboard').removeClass('active');
	jQuery('#profile').addClass('active');
</script>