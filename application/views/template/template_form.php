<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title; ?></title>
  <link rel="icon" type="image/png" href="<?php echo base_url(); ?>images/EMS_Logo.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/theme/theme01/plugins/fontawesome-free/css/all.min.css'); ?>">


  <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
  <link href="<?php echo base_url('assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css'); ?>" rel="stylesheet" media="screen">
  <link href="<?php echo base_url('assets/vendor/select2/select2.min.css'); ?>" rel="stylesheet" media="screen">
  <link href="<?php echo base_url('assets/vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css'); ?>" rel="stylesheet" media="screen">
  <link href="<?php echo base_url('assets/vendor/bootstrap-timepicker/bootstrap-timepicker.min.css'); ?>" rel="stylesheet" media="screen">
  <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->

  <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
  <link href="<?php echo base_url('assets/vendor/sweetalert/sweet-alert.css'); ?>" rel="stylesheet" media="screen">
  <link href="<?php echo base_url('assets/vendor/sweetalert/ie9.css'); ?>" rel="stylesheet" media="screen">
  <link href="<?php echo base_url('assets/vendor/toastr/toastr.min.css'); ?>" rel="stylesheet" media="screen">
  <link href="<?php echo base_url('assets/vendor/bootstrap-fileinput/jasny-bootstrap.min.css'); ?>" rel="stylesheet" media="screen">
  <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
  <!-- SweetAlert CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">


  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/theme/theme01/dist/css/adminlte.min.css'); ?>">
</head>

<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed layout-navbar-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="<?php echo base_url(); ?>images/EMS_Logo.png" alt="PMS Logo" height="100" width="100">
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