<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>images/EMS_Logo.png">

	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->


</head>

<body class="hold-transition login-page">
	<div class="login">
		<form class="form-horizontal" action="<?php base_url() ?>login/masuk" method="post">

			<div class="limiter">
				<div class="container-login100" style="background-image: url('images/lmp.jpg'); display: flex; justify-content: flex-end; padding: 20px; ">
					<div class="wrap-login100" style="position: absolute; top: 25px; right: 50px;">

						<div class="card login-card bg-dark">
							<div class="row no-gutters">
								<div class="col-md-12">
									<div class="card-body">

										<form class="login100-form validate-form">
											
											<span class="login100-form-title p-t-10 p-b-25">
												<h6>
													<!-- KAMPUS CIREBON -->
												</h6>
											</span>
											
											<div class="login100-form-avatar" style="display: flex; justify-content: center; align-items: center;">
												<img src="images/logo-login form.png" alt="" style="width: 80%; height: auto;">
											</div>


											<div class="login100-form-avatar" style="display: flex; justify-content: center; align-items: center;">
												<img src="images/logo_login_ems.png" alt="AVATAR" style="width: 200px; height: auto;">
											</div>


											<span class="login100-form-title p-t-20 p-b-45">
												<!-- Jl. Kebonturi Arjawinangun, Kab. Cirebon, Jawa Barat Indonesia 45162 -->
											</span>

											<div class="wrap-input100 validate-input m-b-10" data-validate="Username is required">
												<input class="input100" type="text" name="username" id="username" placeholder="User ID">
												<span class="focus-input100"></span>
												<span class="symbol-input100">
													<i class="fa fa-user"></i>
												</span>
											</div>

											<div class="wrap-input100 validate-input m-b-10" data-validate="Password is required">
												<input class="input100" type="password" name="password" placeholder="Password">
												<span class="focus-input100"></span>
												<span class="symbol-input100">
													<i class="fa fa-lock"></i>
												</span>
											</div>

											<div class="container-login100-form-btn p-t-10">
												<button class="login100-form-btn">
													Login
												</button>
											</div>

											<div class="text-center w-full  p-t-20 p-b-20">
											</div>




										</form>
									</div>
								</div>
							</div>
							<div>
								<br>
								<br>


							</div>
						</div>
					</div>
				</div>
			</div>


			<!--===============================================================================================-->
			<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
			<!--===============================================================================================-->
			<script src="vendor/bootstrap/js/popper.js"></script>
			<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
			<!--===============================================================================================-->
			<script src="vendor/select2/select2.min.js"></script>
			<!--===============================================================================================-->
			<script src="js/main.js"></script>

			<script>
				window.onload = function() {
					document.getElementById('username').value = '';
				}
			</script>


</body>



</html>