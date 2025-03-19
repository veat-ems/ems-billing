<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
<link href="<?php echo base_url('assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css');?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url('assets/vendor/select2/select2.min.css');?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url('assets/vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css');?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url('assets/vendor/bootstrap-timepicker/bootstrap-timepicker.min.css');?>" rel="stylesheet" media="screen">
<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->


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

            <div class="card-header" style="background:#EFEFEF;">
              	<?php
				$mainformattributes = array('class' => 'form-horizontal', 'id' => 'mainform', 'name' => 'mainform');
				$hiddenform = array('is_post'=>'1');
				echo form_open(base_url() . 'tabelperjam', $mainformattributes, $hiddenform); 
				?>
		      <div class="row mb-2">
		        <div class="col-sm-3">
		          	<label class="control-label">
						Meter Name
					</label>
					<select id="meterid" name="meterid" class="js-states  cs-skin-elastic form-control" >	
							<?php foreach($data_meter as $dm){ ?>
								<option value="<?php echo $dm->id ?>" <?php if ($dm->id == $id) echo 'selected' ?>><?php echo $dm->id_name ?></option>
							<?php } ?>
					</select>
					<input type="text" class="" value="<?php echo $id?>"  id="meterid2" name="meterid2" style="display:none;">
		        </div>
		        <div class="col-sm-3">
		          	<label class="control-label">
						Date
					</label>
					<input type="text" class="form-control input-append datepicker date" value="<?php echo $dari;?>"  id="dari" name="dari">
		        </div>
		        <div class="col-sm-1">
		          	<label class="control-label">
						&nbsp;<br>&nbsp;
					</label>
					<button class="btn btn-md btn-info btn-flat" type="submit" id="btn_submit" name="btn_submit" style="margin-top:24px;">
		              <i class="fas fa-search"></i>
		            </button>
		        </div>

		      </div>
				</form>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

				<table class="table table-striped" id="datalist24">
	                <thead>
	                    <tr style="background:#d5dde9">
	                        <th>METER NAME</th>
				            <th>TANGGAL</th>
							<th>JAM</th>
							<th>KWH</th>
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


		
		
		
	
	

	

	
