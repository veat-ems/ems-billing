<!DOCTYPE html>
<html lang="en">

<style>
.login-page {
  background-image: url("<?php echo base_url();?>./assets/theme/login01/img/jkt_living_1.jpg" );
}


</style>

<head>
	<title>LOGIN - PMS</title>
	<p>

		JALAN RAYA LAPANGAN TEMBAK NO.10, KECAMATAN PASAR REBO, KELURAHAN PEKAYON, RT.04 RW.04, JAKARTA 13710 
	</p>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<!-- <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/img/favicon.ico"/> -->
	<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/theme/login01/img/ems.jfif">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/theme/theme01/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/theme/theme01/plugins/fontawesome-free/css/all.min.css">

	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/theme/login01/css/login_v3_util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/theme/login01/css/login_v3_main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/theme/login01/css/login_v3_slider.css"> -->
<!--===============================================================================================-->
  <link rel="stylesheet" href="<?= base_url();?>assets/theme/theme01/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url();?>assets/theme/theme01/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <form class="form-horizontal" action="<?php base_url()?>login/masuk" method="post">
	  	<div class="card-body")>						
					<div class="text-center p-b-2" style="color: black; font-weight: bold; font-size: 24px;">
						<img src="<?php echo base_url();?>assets/theme/login01/img/5d8a8037-69cd-4f35-8da7-21411b604cf6.jfif">
						<br>
						Jakarta Living Star
					</div>
		
					<div class="text-center">
						<p>Jl. Lap. Tembak No.10, Pekayon, Jakarta Timur <br>DKI Jakarta 13710, Jakarta, Indonesia</p>
						<p>Phone: +62 21 386000</p>
					</div>

					<img src="<?php echo base_url();?>assets/theme/login01/img/7d51930b-4541-4a03-91cc-337bfacf01b5.jfif" widht="120" height="123" >
					
					<br> </br>
					
					<div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">User Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="username" id="username" placeholder="ID">
                    </div>
                  </div>
					
				  <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="password" name="password" placeholder="Password">
                    </div>
                  </div>


				  <div class="card-footer">
                  <button type="submit" class="btn btn-info btn-block btn-flat"> Login</button>
                </div>

				<br></br>
							<img src="<?php echo base_url();?>assets/theme/login01/img/energy management.jfif" widht=80px height="80" >				
					</div>
				</form>
    </div>

    <!-- /.login-card-body -->
  </div>
</div>

<!--===============================================================================================-->
	<script src="<?= base_url();?>assets/theme/theme01/plugins/jquery/jquery.min.js"></script>
	<script src="<?= base_url();?>assets/theme/theme01/plugins/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/theme/login01/js/login_v3_main.js"></script>
	<script src="<?php echo base_url();?>assets/theme/login01/js/login_v3_slider.js"></script>

	<script src="<?= base_url();?>assets/theme/theme01/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
	<script src="<?= base_url();?>assets/theme/theme01/plugins/dist/js/adminlte.min.js"></script>

<script>
window.onload = function() {
  document.getElementById('username').value = '';
  }
</script>


</body>



</html>