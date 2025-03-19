<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i>
        <?php echo $judul; ?>
      </a>

    </li>

    <!--
    <li class="nav-item d-none d-sm-inline-block">
      <a href="index3.html" class="nav-link">Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Contact</a>
    </li>
	-->
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">

    <!-- Notifications Dropdown Menu -->
    <!-- <li class="nav-item dropdown"> -->
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url(); ?>alarm">
      <!-- <a class="nav-link" data-toggle="dropdown" href="<?php echo base_url(); ?>alarm"> -->
        Alarm <i class="far fa-bell"></i>

      </a>
      <!-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="">
        <span class="dropdown-item dropdown-header">Alarms</span>

        <div class="col-md-12 text-sm" id="id_alarm_content" style="color:#000000; height:300px;overflow-y: scroll;">null</div>

        <div class="dropdown-divider"></div>
        <a href="<?php echo base_url(); ?>alarm" class="dropdown-item dropdown-footer">See All Alarms</a>
      </div> -->
    </li>

    <!-- <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        Alarm <i class="far fa-bell"></i>
        
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="">
        <span class="dropdown-item dropdown-header">Alarms</span>

		<div class="col-md-12 text-sm" id="id_alarm_notif" style="color:#ff0000; height:100px;overflow-y: scroll;">100</div>

        <div class="dropdown-divider"></div>
      </div>
    </li> -->

    <li class="nav-item dropdown user-menu">
      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <img src="<?php echo base_url(); ?>images\EMS_Logo.png" class="user-image img-circle elevation-2" alt="User Image">
        <span class="d-none d-md-inline"><?php echo $this->session->userdata('nama') ?> &nbsp;<i class="fas fa-chevron-down"></i></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
        <li class="user-header bg-dark">
          <img src="<?php echo base_url(); ?>assets/theme/theme01/dist/img/user_icon.png" class="img-circle elevation-2" alt="User Image">

          <p>
            <?php echo $this->session->userdata('nama') ?>
          </p>
        </li>
        <!-- Menu Body -->
        <!-- Menu Footer-->
        <li class="user-footer">

          <a href="<?php echo base_url(); ?>user/changepassword" class="btn btn-info btn-flat">Change Password</a>

          <a href="<?php echo base_url(); ?>login/keluar" class="btn btn-danger btn-flat float-right">Sign out</a>
        </li>
      </ul>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <!--
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
      </a>
    </li>
	-->
  </ul>
</nav>
<!-- /.navbar -->