<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title><?php echo $title;?></title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link rel="shortcut icon" href="<?php echo base_url('assets-login/img/logo/favicon.ico');?>" type="image/x-icon" />
	<link href="<?php echo base_url();?>assets-login/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets-login/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets-login/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets-login/css/style_default.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets-login/css/style-responsive_default.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets-login/css/default_tem.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets-login/css/style_nyunyu.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets-login/css/style-responsive_nyunyu.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets-login/css/default_nyunyu.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets-login/css/notifIt.css" type="text/css" />
    <link href="<?php echo base_url();?>assets-login/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />
    <script src="<?php echo base_url();?>assets-login/plugins/pace/pace.min.js"></script>
    <script src="<?php echo base_url();?>assets-login/plugins/jquery/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url();?>assets-login/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
    <script src="<?php echo base_url();?>assets-login/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
    <script src="<?php echo base_url();?>assets-login/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets-login/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets-login/js/notifIt.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets-login/js/jquery.blockUI.js"></script>
    <script src="<?php echo base_url();?>assets-login/js/login.js"></script>
    <script src="<?php echo base_url();?>assets-login/js/apps.min.js"></script>
</head>
<style>

.news-caption{
	background:rgba(2,60,91,.7);
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
	color:rgba(180,0,0,.8);
	font-weight:300;
	font-size:28px;
	}
</style>
<body class="pace-top bg-white">
    <div id="page-loader" class="fade in"><span class="spinner"></span></div>
    <div id="page-container" class="fade">
        <div class="login login-with-news-feed">
            <div class="news-feed">
                <div class="news-image">
                <video autoplay loop width="auto" height="100%"  muted>
                    <source src="<?php echo base_url();?>assets-login/img/background/bg-jw.mp4" type="video/mp4">
                    Your browser does not support the audio element.
                </video>
                </div>
                <div class="news-caption">
                    <h4 class="caption-title"><?php echo $judul;?></h4>
                    <?php echo $alamat;?>
                </div>
            </div>
            <div class="right-content">
                <div class="login-header">
                    <br/>
                    <br/>
                    <div align="center" class="brand">
                        <img width="100%" src="<?php echo base_url();?>assets-login/img/logo/logo2.png" alt="" />
                    </div>
                    <div class="icon">
                        <i class="fa fa-sign-in"></i>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                </div>
                <br/>
                <br/>
                <br/>
                <div class="login-content">
                    
                    <?php
                    if($this->session->flashdata('pesan') <> ''){
                    ?>
                        <div class="alert alert-dismissible alert-danger">
                            <?php echo $this->session->flashdata('pesan');?>
                        </div>
                    <?php
                    }
                    ?>
                    
                    
                    <form action="<?php echo base_url('login/masuk');?>" method="post">
                        <div class="form-group m-b-15">
                            <input type="text" class="form-control input-lg" name="username" id="username" placeholder="Masukan Username" />
                        </div>
                        <div class="form-group m-b-15">
                            <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Masukan Password" />
                        </div>
                        <br/>
                        <div class="login-buttons">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Login</button>
                        </div>
                        <hr />
                    </form>
                </div>
            </div>
        </div>
    </div>
    
	<script src="<?php echo base_url(); ?>app-assets/vendors/js/backstretch/jquery.backstretch.min.js"></script>
        
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
</body>
</html>
