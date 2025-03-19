<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<!-- Template Name: Clip-Two - Responsive Admin Template build with Twitter Bootstrap 3.x | Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>

		<title><?php echo $title; ?></title>
		<link rel="icon" type="image/png" href="<?php echo base_url();?>images/EMS_Logo.png">
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
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<!-- end: GOOGLE FONTS -->
		<!-- start: MAIN CSS -->		
		<link rel="shortcut icon" href="<?php echo base_url('assets-login/img/logo/favicon.ico');?>" type="image/x-icon" />
		<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/vendor/fontawesome/css/font-awesome.min.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/vendor/themify-icons/themify-icons.min.css');?>">
		<link href="<?php echo base_url('assets/general/fonts/icomoon/styles.css');?>" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url('assets/vendor/animate.css/animate.min.css');?>" rel="stylesheet" media="screen">
		<link href="<?php echo base_url('assets/vendor/perfect-scrollbar/perfect-scrollbar.min.css');?>" rel="stylesheet" media="screen">
		<link href="<?php echo base_url('assets/vendor/switchery/switchery.min.css');?>" rel="stylesheet" media="screen">
		<!-- end: MAIN CSS -->
		
		<link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap-toggle/bootstrap-toggle.min.css');?>">
		
		<style>
		  .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
		  .toggle.ios .toggle-handle { border-radius: 20px; }
		</style>
		
		<!-- start: CLIP-TWO CSS -->
		<link rel="stylesheet" href="<?php echo base_url('assets/general/css/styles.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/general/css/onoffslide.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/general/css/plugins.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/general/css/themes/iaspp.css');?>" id="skin_color" />
		<link rel="stylesheet" href="<?php echo base_url('assets/general/css/themes/iaspp_custom.css');?>" id="skin_color_custom" />
		<link rel="stylesheet" href="<?php echo base_url('assets/general/css/colors.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/general/css/animate.css');?>">
		<!-- end: CLIP-TWO CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		
		<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendor/multiselect-lou/jquery.multi-select.js"></script>
	</head>
	<!-- end: HEAD -->
	<body>
		<div id="app">
			<?php echo $_sidebar; ?>
			
			<div class="app-content">
				<?php echo $_header; ?>
				<?php echo $_content; ?>
			</div>
			<!-- start: FOOTER -->
			<?php echo $_footer; ?>
			<!-- end: FOOTER -->
			<!-- start: OFF-SIDEBAR -->
			<?php echo $_offsidebar; ?>			
			<!-- end: OFF-SIDEBAR -->
			<!-- start: SETTINGS -->
			<?php echo $_setting; ?>
			<!-- end: SETTINGS -->
		</div>
		<?php echo $_js; ?>
	</body>
</html>
