<?php error_reporting(0); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>VCard</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo ADMIN_PANEL_THEME_PATH; ?>dist/img/vedikin-favicon.png" />
	<link rel="stylesheet" href="<?php echo ADMIN_PANEL_THEME_PATH; ?>bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo ADMIN_PANEL_THEME_PATH; ?>dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo ADMIN_PANEL_THEME_PATH; ?>dist/css/skins/skin-blue.min.css">
	<!-- SCRIPT -->
	<script src="<?php echo ADMIN_PANEL_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="<?php echo ADMIN_PANEL_THEME_PATH; ?>bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo ADMIN_PANEL_THEME_PATH; ?>dist/js/app.min.js"></script>
	<script src="<?php echo ADMIN_PANEL_THEME_PATH; ?>dist/js/jquery.validate.min.js"></script>
	<!-- DataTables -->
	<script src="<?php echo ADMIN_PANEL_THEME_PATH; ?>plugins/datatables/jquery.dataTables1.js"></script>
	<script src="<?php echo ADMIN_PANEL_THEME_PATH; ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
	<link rel="stylesheet" href="<?php echo ADMIN_PANEL_THEME_PATH; ?>plugins/datatables/jquery.dataTables.css" />
	<link rel="stylesheet" href="<?php echo ADMIN_PANEL_THEME_PATH; ?>plugins/datatables/percircle.css">
	<!-- SCRIPT END-->
	<link rel="stylesheet" href="<?php echo ADMIN_PANEL_THEME_PATH; ?>sweetalert/sweetalert.css">
	<script src="<?php echo ADMIN_PANEL_THEME_PATH; ?>sweetalert/sweetalert.js"></script>
	<link rel="stylesheet" href="<?php echo ADMIN_PANEL_THEME_PATH; ?>sweetalert/sweetalert.css">
	<link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/style.css">
	
	<script src="<?php echo ADMIN_PANEL_THEME_PATH; ?>dist/js/adminuser-script.js"></script>
	<script src="<?php echo ADMIN_PANEL_THEME_PATH; ?>dist/js/user-script.js"></script>
	<script src="<?php echo ADMIN_PANEL_THEME_PATH; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
	
	
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<!-- Main Header -->
		<header class="main-header">
			<!-- Logo -->
			<a href="#" class="logo">
				<span class="logo-mini"><b>VC</b></span>
				<!-- <span class="logo-lg" style="font-size: 15px; font-weight: bold;">VedikIn Solutions</span> -->
				<span class="logo-lg" style="font-size: 15px; font-weight: bold;"><img src="<?php echo ADMIN_PANEL_THEME_PATH; ?>dist/img/vedikin-lg.png" width="100%" height="50px" /></span>
			</a>
			<!-- Header Navbar -->
			<nav class="navbar navbar-static-top" role="navigation">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<!-- Navbar Right Menu -->
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<?php if($this->session->userdata['logged_in']['user_role_id'] !== "3"){?>
						<!-- User Account Menu -->
						<li class="dropdown user user-menu">
							<!-- Menu Toggle Button -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<!-- The user image in the navbar-->
								<img src="<?php echo ADMIN_PANEL_THEME_PATH; ?>dist/img/avatar5.png" class="user-image"
									alt="User Image">
								<!-- hidden-xs hides the username on small devices so only the image appears. -->
								<span class="hidden-xs"><?php $tmpArrUser = get_admin_detail(); echo $tmpArrUser['user_name']; ?></span>
							</a>
							<ul class="dropdown-menu">
								<!-- The user image in the menu -->
								<li class="user-header">
									<img src="<?php echo ADMIN_PANEL_THEME_PATH; ?>dist/img/avatar5.png" class="img-circle"
										alt="User Image">
									<p>
										<?php echo $tmpArrUser['user_name']; ?> - 
										<?php echo get_admin_role(); ?>
										<!--<small>Member since <?php //echo date("M Y",strtotime($tmpArrUser['created_datetime'])); ?></small>-->
									</p>
								</li>
								<!-- Menu Body -->
								
								<li class="user-footer">
									<?php if($this->session->userdata['logged_in']['user_role_id'] == 1){ ?>
									<div class="pull-left">
										<a href="<?php echo SITE_URL; ?>profile" class="btn btn-default btn-flat">Profile</a>
									</div>
									<?php } ?>
									<div class="pull-right">
										<a href="<?php echo SITE_URL; ?>logout" class="btn btn-default btn-flat">Sign out</a>
									</div>
								</li>
								<?php } ?>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">

			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar Menu -->
				<ul class="sidebar-menu">
					<!-- Optionally, you can add icons to the links -->
					<li class="active" id="dashboard"><a href="<?php echo SITE_URL; ?>dashboard"><i class="fa fa-dashboard"></i>
						<span>Dashboard</span></a></li>
						<?php foreach($menus as $menu){ ?> 
							<li id="<?php echo $menu->listing_page; ?>" class="treeview">
								<a href="<?php echo SITE_URL.$menu->listing_page;?>">
									<i class="fa <?php echo $menu->site_icon;?>"></i> 
										<span><?php echo $menu->menu_name;?></span>
									</i>
								</a>
							</li>
						<?php } ?>
					<li><a href="<?php echo SITE_URL; ?>logout"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
				</ul><!-- /.sidebar-menu -->
			</section>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1><?php echo $page_title; ?></h1>
				
				<?php if(isset($button_url) && isset($button_label) && $button_url!='' && $button_label!='') { ?>
				<div class="breadcrumb">
					<a href="<?php echo $button_url; ?>" style="display:none;" id="button_url" class="btn btn-block btn-primary"><?php echo $button_label; ?></a>
				</div>
				<?php } 
				if (strpos( $_SERVER['REQUEST_URI'], 'profile') || strpos( $_SERVER['REQUEST_URI'], 'change-password')){ 
					if($this->session->userdata['logged_in']['user_role_id'] == 1 || $this->session->userdata['logged_in']['user_role_id'] == 2) { ?>
						<div class="breadcrumb">
							<a href="<?php echo $button_url1; ?>" id="button_url1" class="btn btn-block btn-primary"><?php echo $button_label1; ?></a>
						</div>
					<?php } 
				} ?>

			</section>

			<!-- Main content -->
			<section class="content">
				<?php include($view_name); ?>
			</section>
		</div>

		<!-- Main Footer -->
		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Version</b> 1.0
			</div>
			<strong>Copyright &copy; <?php echo date("Y"); ?> 
			<a href="#">VedikIn Solutions</a>.</strong> All rights reserved.
			Design & Developed by<a href="https://www.vedikin.com" target="_blank"> VedikIn Solutions</a>
		</footer>

		<div class="control-sidebar-bg"></div>
	</div>

	<?php

/* COMMON JS SCRIPTS & HTML POP UP CODE */
require_once('common_scripts.php');
?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script><style>
.select2-container .select2-selection--single{height: 36px !important;}
.select2-container--default .select2-selection--multiple .select2-selection__choice{color: black !important;}
.select2-container{width:100% !important;}
</style>
<script>
$(document).ready(function() {
   $('.select2').select2();
});

</script>
</body>

</html>
