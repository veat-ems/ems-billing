<!DOCTYPE html>
<!-- Template Name: Clip-Two - Responsive Admin Template build with Twitter Bootstrap 3.x | Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<!-- start: HEAD -->
	<head>
		<title><?php echo $title;?></title>
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
		<link rel="shortcut icon" href="<?php echo base_url('assets/general/images/sipbaja.ico');?>" type="image/x-icon" />
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<!-- end: GOOGLE FONTS -->
		<!-- start: MAIN CSS -->
		<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/vendor/fontawesome/css/font-awesome.min.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/vendor/themify-icons/themify-icons.min.css');?>">
		<link href="<?php echo base_url('assets/vendor/animate.css/animate.min.css');?>" rel="stylesheet" media="screen">
		<link href="<?php echo base_url('assets/vendor/perfect-scrollbar/perfect-scrollbar.min.css');?>" rel="stylesheet" media="screen">
		<link href="<?php echo base_url('assets/vendor/switchery/switchery.min.css');?>" rel="stylesheet" media="screen">
		<!-- end: MAIN CSS -->
		<!-- start: CLIP-TWO CSS -->
		<link rel="stylesheet" href="<?php echo base_url('assets/general/css/styles.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/general/css/plugins.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/general/css/themes/theme-1.css');?>" id="skin_color" />
		<!-- end: CLIP-TWO CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->


		<style>

		.login-header .brand .logo {
		    border-color: #2679D7 #1F4AB1 #2679D7;
		}

		login-header{
			position:absolute;
			top:-80px;
			left:50%;
			right:0;
			width:850px;
			padding:0 40px;
			margin-left:-225px;
			font-weight:300;
		}

		.login-header .brand{
			padding:0;
			font-size:40px;

		}

		.login-header .brand .logo{
			border:18px solid transparent;
			border-color:#FFFF00 #FF8000 #B40000;
			width:40px;
			height:40px;
			position:relative;
			font-size:0;
			margin-right:10px;
			top:-9px;
		}

		.login-header .brand small{
			font-size:14px;
			display:block
		}

		.login-header .icon{
			position:absolute;
			right:40px;
			top:-2px;
			opacity:.1;
			filter:alpha(opacity=10);
		}

		login-header .icon i{
			font-size:70px;
		}
		.login-header .icon{
			top:125px;
			right:60px;
			font-size:70px;
			}



		.news-feed{
			position:fixed;
			left:0;
			right:440px;
			top:0;
			bottom:0;
			-webkit-transform:translateZ(0);
			overflow:hidden;
			}

		.news-image{
			position:absolute;
			bottom:0;
			left:0;
			right:0;
			top:0;
			}
		.news-image img{
			position:absolute;
			max-height:100%;
			min-width:100%;
			top:-1960px;
			bottom:-1960px;
			left:-1960px;
			right:-1960px;
			margin:auto
			}

		.lg-image{
			position:absolute;
			bottom:0;
			left:0;
			}
		.lg-image img{
			position:fixed;
			height:15%;
			bottom:25px;
			left:25px;
			margin:auto
			}

		.news-caption{
			background:rgba(0,0,0,.95);
			color:#999;
			position:absolute;
			bottom:0;
			left:0;
			right:0;
			padding:15px 60px;
			font-size:14px;
			z-index:20;
			font-weight:300;
			min-width:680px;
			}

		.news-caption .caption-title{
			color:#fff;
			color:rgba(0,128,192,1);
			font-weight:300;
			font-size:28px;
			}


		 .main-login .box-login, .main-login .box-forgot, .main-login .box-register {
		  	   		background: #1F59A8;
		  			overflow: hidden;
		  			padding: 15px;
		  			bottom:0;
		  			height:109%;

		  		}

		/* Large screens ----------- */
		@media only screen and (min-width : 1824px) {


			   .main-login .box-login, .main-login .box-forgot, .main-login .box-register {
		  	   		background: #1F59A8;
		  			overflow: hidden;
		  			padding: 15px;
		  			bottom:0;
		  			height:154%;

		  		}
		/* Style CSS di Sini */
		}

		/* Added in v1.5 */



		</style>
		
		
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body class="login">
		<!-- start: LOGIN -->
<div class="row" >
	<div class="col-md-8" style="background:#1F59A8">
	
	
            <div class="news-feed">
                <div class="news-image">
                	 
                </div>
                <div class="news-caption">
                    <div class="col-md-1">
						<div class="lg-image">
						<img src="assets/img/background/lg-chemco.png" />
						</div>
					</div>
					<div class="col-md-11">
						<h4 class="caption-title" style="font-size:35px; font-weight:bold;"><i class="ion-android-contacts fa-2x text-success"></i> PT. CHEMCO HARAPAN NUSANTARA</h4>
                    	<h4 style="color:#FFFFFF;">Jl. Jababeka Raya Blok F. 29 No.31 Cikarang Utara Bekasi 17530</h4>
					</div>
                </div>
            </div>
	
	
	</div>
	<div class="col-md-4 "  >
		
		<div class="row" style="background:#1F59A8;min-height:600px;">
			<div class="main-login margin-top-30">				
				<br />
				<div class="logo margin-top-30">
					<div align="center">
						 <img width="34%" src="assets/img/background/lg-chemco.png" alt="Power Meter"/>
					</div>
				</div>
				<!-- start: LOGIN BOX -->
				<div class="box-login" >
				
					<form action="<?php echo base_url('login/masuk');?>" method="post">
						<fieldset style="background:#1F59A8; border-color:#1F59A8;">
							
							
					

				<?php
				if($this->session->flashdata('pesan') <> ''){
				?>
					<div class="alert alert-dismissible alert-danger">
						<?php echo $this->session->flashdata('pesan');?>
					</div>
				<?php
				}
				?>
					
							
							<p style="color:#FFFFFF;">
								Please enter your name and password to log in.
							</p>
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="form-control" name="username" placeholder="Username">
									<i class="fa fa-user" style="color:#1F59A8;"></i> </span>
							</div>
							<div class="form-group form-actions">
								<span class="input-icon">
									<input type="password" class="form-control password" name="password" placeholder="Password">
									<i class="fa fa-lock" style="color:#1F59A8;"></i>
									<a class="forgot" href="login_forgot.html">
										I forgot my password
									</a> </span>
							</div>
							<div class="form-actions">
								<div class="checkbox clip-check check-primary">
									<input type="checkbox" id="remember" value="1">
									<label for="remember">
										Keep me signed in
									</label>
								</div>
								<button type="submit" class="btn pull-right"  style="background:#538DD5;color:#ffffff;">
									Login <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
							
							
						</fieldset>
					
					<div style="height:80px;">
					    
					</div>
					<br/>
					<br/>
					<br/>
					<br/>
					</form>
					
					<!-- start: COPYRIGHT -->
					<div class="copyright" >
						&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> QolamMedia</span>. <span>All rights reserved</span>
					</div>
					<!-- end: COPYRIGHT -->
				</div>
				<!-- end: LOGIN BOX -->
			</div>
		</div>
		
		
	</div>

</div>
		
		<!-- end: LOGIN -->
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendor/modernizr/modernizr.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="<?php echo base_url(); ?>assets/vendor/jquery-validation/jquery.validate.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="<?php echo base_url(); ?>assets/general/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="<?php echo base_url(); ?>assets/general/js/login.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendor/backstretch/jquery.backstretch.min.js"></script>
		<script>
			jQuery(document).ready(function() {
	
				$.backstretch(
					[
					 	"assets/img/background/bg1.jpg",
						"assets/img/background/bg2.jpg",
						"assets/img/background/bg3.jpg",
						"assets/img/background/bg4.jpg"
					], 
					{
					   	duration: 2000, 
						fade: 600
				});
				
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
	<!-- end: BODY -->
</html>