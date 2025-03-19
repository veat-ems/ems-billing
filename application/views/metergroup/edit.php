<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper dark-mode">
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
						<div class="card-header" style="background:darkslategray;">
							<h3 class="card-title">
								<i class="fas fa-user"></i>
								<?php echo $title; ?>
							</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">


							<form action="<?php echo base_url('metergroup/edit/' . $data_form->metergroupid) ?>" method="post" role="form" id="formcreate">
								<div class="form-group">
									<label for="metergroupid">
										Meter Group ID
									</label>
									<input type="text" class="form-control" id="metergroup_tampil" name="metergroup_tampil" value="<?php echo set_value('metergroup', $data_form->metergroupid); ?>" placeholder="Enter Meter Group ID" disabled="disabled">
									<input type="hidden" class="form-control" id="metergroupid" name="metergroupid" value="<?php echo $data_form->metergroupid ?>">
									<span class="text-warning"><?php echo form_error('metergroupid'); ?></span>
								</div>
								<div class="form-group">
									<label for="name">
										Meter Group Name
									</label>
									<input type="text" class="form-control" id="metergroupname" name="metergroupname" value="<?php echo set_value('metergroupname', $data_form->metergroupname); ?>" placeholder="Enter Meter Group Name">
									<span class="text-warning"><?php echo form_error('metergroupname'); ?></span>
								</div>

								<div class="row">
									<div class="col-md-4 col-sm-12">
									</div>
									<div class="col-md-2 col-sm-6">
										<button class="btn btn-md btn-info btn-flat float-right" type="submit" id="send" name="send">
											Save&nbsp;&nbsp;<i class="fa fa-save"></i>
										</button>
									</div>
									<div class="col-md-2 col-sm-6">
										<button class="btn btn-md btn-warning btn-flat float-left" type="button" onClick="javascript:history.back();">
											Cancel&nbsp;&nbsp;<i class="fa fa-chevron-left"></i>
										</button>
									</div>
									<div class="col-md-4 col-sm-12">
									</div>
								</div>

							</form>


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