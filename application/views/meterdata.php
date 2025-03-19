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
                    <i class="nav-icon fas fa-bolt"></i>
                    <?php echo $title; ?>
                  </h3>
                </div>
                <div class="col-2">
                  <?php if ($this->session->userdata('level') == "ADM") { ?>
                    <a href="meterdata/create" class="btn btn-md btn-info btn-flat float-right">
                      <i class="fas fa-plus"></i>&nbsp; Create
                    </a>
                  <?php } ?>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body bg-gradient-dark">

              <table class="table table-striped" id="datalist">
                <thead>
                  <tr style="background:darkslategray;">
                    <th>ID</th>
                    <th>Type</th>
                    <th>Serial</th>
                    <th>Name</th>
                    <th>Group</th>
                    <th>Location</th>
                    <th>Power</th>
                    <th>V Nominal</th>
                    <th>I Nominal</th>
                    <th>Action</th>
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