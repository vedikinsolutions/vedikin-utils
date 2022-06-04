<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>VedikIn Solutions | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo ADMIN_PANEL_THEME_PATH; ?>dist/img/vedikin.jpg" />
    <link rel="stylesheet" href="<?php echo ADMIN_PANEL_THEME_PATH; ?>bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo ADMIN_PANEL_THEME_PATH; ?>dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo ADMIN_PANEL_THEME_PATH; ?>plugins/iCheck/square/blue.css">

  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
		<img src="<?php echo ADMIN_PANEL_THEME_PATH; ?>dist/img/logo.jpg" width="100%" />
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to enter the Admin panel</p>
        <?php if($this->session->flashdata('authorized_error') != ""){ ?>
        <div class="alert alert-danger" role="alert" style=""><?php echo $this->session->flashdata('authorized_error'); ?></div>
        <?php } ?>
        <?php if (isset($error_message)) { ?>
          <div class="alert alert-danger" role="alert" style="">
          <?php echo $error_message; ?>
          </div>
        <?php } ?>
        
        <form action="<?php echo base_url() ?>login-process" method="post" name="adminLogin">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="User Name" name="email" id="email" value="<?php if(isset($_COOKIE["user_email"])) { echo $_COOKIE["user_email"]; } ?>" required>
            <?php echo form_error('email', '<div class="error">', '</div>'); ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" id="password" value="<?php if(isset($_COOKIE["user_password"])) { echo base64_decode( $_COOKIE["user_password"]); } ?>" required>
            <?php echo form_error('password', '<div class="error">', '</div>'); ?>
            <input type="hidden" name="user_type" value="1" >
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <input type="submit" id="btnLogin" class="btn btn-primary btn-block btn-flat" value="Sign In" name="submit"/>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo ADMIN_PANEL_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo ADMIN_PANEL_THEME_PATH; ?>bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo ADMIN_PANEL_THEME_PATH; ?>plugins/iCheck/icheck.min.js"></script>
    <script src="<?php echo ADMIN_PANEL_THEME_PATH; ?>dist/js/jquery.validate.min.js"></script>
    <?php
/* MINIFY CSS & JS USING CI HELPER */
echo $this->carabiner->display('css');	
echo $this->carabiner->display('js');

/* COMMON JS SCRIPTS & HTML POP UP CODE */
require_once('common_scripts.php');
?>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
