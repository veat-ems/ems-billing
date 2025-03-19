<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper dark-mode">
  <!-- Content Header (Page header) -->
  <section class="content-header mb-0">
    <div class="container-fluid">
      <!--
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>DataTables</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">DataTables</li>
          </ol>
        </div>
      </div>
	-->
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card card-teal card-outline">
            <div class="card-header" style="background:darkslategray;">
              <div class="row">
                <div class="col-10">
                  <h3 class="card-title">
                    <i class="fas fa-bell"></i>
                    <?php echo $title; ?>
                  </h3>
                </div>
                <div class="col-2">
                  <a href="<?php echo base_url(); ?>alarm/alarmhistory" style="border-radius: 5px;" class="btn btn-md btn-danger btn-flat float-right">
                    <i class="fas fa-search"></i>&nbsp; Alarm History
                  </a>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body bg-gradient-dark">

              <table class="table table-striped" id="datalist">
                <thead>
                  <tr style="background:darkslategray">
                    <th>No</th>
                    <th>Alarm_Type</th>
                    <th>Id_Meter</th>
                    <th>Name_Group_Sub</th>
                    <th>Alarm_Log</th>
                    <th>Date_Time</th>
                    <th>Created</th>
                    <th>Updated</th>
                  </tr>
                </thead>
                <tbody id="show_data">

                </tbody>
              </table>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->