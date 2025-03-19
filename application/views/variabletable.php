<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
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
            <div class="card-header">
              <h3 class="card-title">
				<i class="fas fa-table"></i>
				<?php echo $title;?>
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

				<table class="table table-striped" id="datalist">
	                <thead>
	                    <tr style="background:#d5dde9">
	                        <th>NO.</th>
				            <th>METER_NAME</th>
							<th>ID LINE</th>
				            <th>TIME</th>
				            <th>V1</th>
				            <th>V2</th>
				            <th>V3</th>
				            <th>V12</th>
				            <th>V23</th>
				            <th>V31</th>
				            <th>I-1</th>
				            <th>I-2</th>
				            <th>I-3</th>
				            <th>I-N</th>
				            <th>WATT1</th>
				            <th>WATT2</th>
				            <th>WATT3</th>
				            <th>WATT</th>
				            <th>VA1</th>
				            <th>VA2</th>
				            <th>VA3</th>
				            <th>VA</th>
				            <th>FREQ</th>
				            <th>FP1</th>
				            <th>FP2</th>
				            <th>FP3</th>
				            <th>kWh Imp</th>
				            <th>kWh Exp</th>
				            <th>kVARh Imp</th>
				            <th>kVARh Exp</th>
				            <th>kVAh</th>
				            <th>THD V1</th>
				            <th>THD V2</th>
				            <th>THD V3</th>
				            <th>THD I1</th>
				            <th>THD I2</th>
				            <th>THD I3</th>
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