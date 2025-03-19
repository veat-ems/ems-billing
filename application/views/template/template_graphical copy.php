<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php echo $title; ?></title>
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/theme/login01/img/image.png">
	<!-- start: META -->
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- end: META -->
	<!-- start: GOOGLE FONTS -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- end: GOOGLE FONTS -->
	<!-- start: MAIN CSS -->
	<link rel="stylesheet" href="<?php echo base_url('assets/theme/theme01/plugins/fontawesome-free/css/all.min.css'); ?>">

	<link rel="stylesheet" href="<?php echo base_url('assets/theme/theme01/dist/css/adminlte.min.css'); ?>">
	<!-- end: MAIN CSS -->

	<!-- start: GRAPH style -->
	<!-- background frekwensi -->
	<link href="<?php echo base_url('assets/general/fonts/icomoon/styles.css'); ?>" rel="stylesheet" type="text/css">

	<link rel="stylesheet" href="<?php echo base_url('assets/general/css/themes/iaspp.css'); ?>" id="skin_color" />
	<link rel="stylesheet" href="<?php echo base_url('assets/general/css/themes/iaspp_custom.css'); ?>" id="skin_color_custom" />
	<link rel="stylesheet" href="<?php echo base_url('assets/general/css/color/colors.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/general/css/color/palette-gradient.css'); ?>">
	<!-- end: GRAPH style -->







</head>
<!-- end: HEAD -->

<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed layout-navbar-fixed">
	<div class="wrapper">

		<!-- Preloader -->
		<div class="preloader flex-column justify-content-center align-items-center">
			<img class="animation__wobble" src="<?php echo base_url(); ?>images/EMS_Logo.png" alt="PMS Logo" height="60" width="60">
		</div>

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