<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title;?></title>
  <link rel="icon" type="image/png" href="<?php echo base_url();?>images/EMS_Logo.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/theme/theme01/plugins/fontawesome-free/css/all.min.css');?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('assets/theme/theme01/plugins/overlayScrollbars/css/OverlayScrollbars.min.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/theme/theme01/dist/css/adminlte.min.css');?>">
</head>
<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed layout-navbar-fixed">
<!-- <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed"> -->
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="<?php echo base_url(); ?>images/EMS_Logo.png" alt="EMS Logo" height="60" width="60">
  </div> -->

	<?php echo $_header; ?>

	<?php echo $_sidebar; ?>

	<?php echo $_content; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

	<?php echo $_footer; ?>
	
</div>
<!-- ./wrapper -->
<?php echo $_js; ?>
</body>
</html>
