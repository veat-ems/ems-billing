<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets\theme\login01\img\Canva Design.png">
  <title>AEON MALL DELTAMAS - Login Form</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

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
  <link rel="stylesheet" href="assets/css/login.css">

</head>

<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container-login100" style="background-image: url('images/bg-05.jpg');">
      <div class="container">
        <div class="card login-card bg-dark">
          <div class="row no-gutters">
            <div class="col-md-5">
              <img src="assets/images/bg-04.png" alt="login" class="login-card-img">
            </div>
            <div class="col-md-7">
              <div class="card-body">

                <div class="text">
                  <h1 style="color:gold; font-size:45px;"> <b>AEON MALL DELTAMAS<b></h1>
                </div>
                <br>
                <h1 style="color:white; font-size:14px;">Hegarmukti, Central Cikarang, Bekasi Regency, West Java 17530</h1>

                <br>
                <form action="<?php base_url() ?>login/masuk" method="post">

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
                    <button class="login100-form-btn bg-info">
                      Login
                    </button>

                    <br>
                    <br>
                    <br>
                    <div class="brand-wrapper1">
                      <img style="height:50px; width:220px" src="assets/images/logo_login_ems.png" alt="logo" class="logo">
                    </div>
                    <br>
                    <br>
                    <br>

                  </div>
                </form>
                </nav>
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
          } <
          /scrip>

          <
          script src = "https://code.jquery.com/jquery-3.4.1.min.js" >
      </script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>