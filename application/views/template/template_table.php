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
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/theme/theme01/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/theme/theme01/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/theme/theme01/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/theme/theme01/plugins/datatables-fixedcolumns/css/fixedColumns.bootstrap4.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/theme/theme01/dist/css/adminlte.min.css'); ?>">
</head>

<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed layout-navbar-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="<?php echo base_url(); ?>images/EMS_Logo.png" alt="EMS Logo" height="60" width="60">
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

  <script>
    $(function() {
      $("#datalist").DataTable({
        "responsive": false,
        "lengthChange": false,
        "autoWidth": false,
        "scrollX": true,
        "scrollCollapse": true,
        "fixedColumns": {
          leftColumns: 0,
          leftColumns: 0
        },
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#datalist_wrapper .col-md-6:eq(0)');

      $("#datalist24").DataTable({
        "responsive": false,
        "lengthChange": false,
        "autoWidth": false,
        "scrollX": true,
        "scrollCollapse": true,
        "fixedColumns": {
          leftColumns: 1,
          leftColumns: 2
        },
        "pageLength": 24,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#datalist24_wrapper .col-md-6:eq(0)');



      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
</body>

</html>