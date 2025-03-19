<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
<link href="<?php echo base_url('assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css'); ?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url('assets/vendor/select2/select2.min.css'); ?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url('assets/vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css'); ?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url('assets/vendor/bootstrap-timepicker/bootstrap-timepicker.min.css'); ?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url('assets/vendor/multiselect-lou/multi-select.css'); ?>" rel="stylesheet" media="screen">
<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->

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

							<h3 class="card-title">
								<i class="fas fa-user"></i>
								<?php echo $title; ?>
							</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">


							<form action="<?php echo base_url('user/usermetergroup/' . $id_user) ?>" method="post" role="form" id="formcreate">
								<div class="row">
									<div class="col-md-7">
										<div class="form-group">
											<label for="username">
												User
											</label>
											<input type="text" class="form-control" id="username_tampil" name="username_tampil" value="<?php echo set_value('username', $data_form->username . ' / ' . $data_form->nama); ?>" placeholder="Enter Username" disabled="disabled">
											<input type="hidden" class="form-control" id="id_user" name="id_user" value="<?php echo $data_form->id_user ?>">
											<input type="hidden" class="form-control" id="username" name="username" value="<?php echo $data_form->username ?>">
											<span class="text-warning"><?php echo form_error('username'); ?></span>
										</div>
										<div class="form-group">
											<label for="name">
												User Privilege
											</label>
											<span class="text-warning"><?php echo form_error('my-select[]'); ?></span>
										</div>

										<select multiple="multiple" id="my-select" name="my-select[]">
											<?php
											foreach ($metergroups_notselected as $metergroupnotselectedrow) {
											?>
												<option value='<?php echo $metergroupnotselectedrow->metergroupid ?>'><?php echo $metergroupnotselectedrow->metergroupname ?></option>

											<?php
											}
											?>

											<?php
											foreach ($metergroups_selected as $metergroupselectedrow) {
											?>
												<option selected value='<?php echo $metergroupselectedrow->metergroupid ?>'><?php echo $metergroupselectedrow->metergroupname ?></option>

											<?php
											}
											?>
										</select>
										<a href='#' id='select-all'>Select All</a>&nbsp;/&nbsp;
										<a href='#' id='deselect-all'>Deselect All</a>&nbsp;/&nbsp;
										<a href='<?php echo site_url("user/usermetergroup/" . $id_user . '/' . rand()) ?>' id='refresh-all'>Refresh</a>

										<script type="text/javascript">
											$('#my-select').multiSelect({
												keepOrder: true,
												selectableHeader: "<div class='custom-header'><span class='badge bg-teal' style='font-size:14px;'>  Available Meter</span></div>",
												selectionHeader: "<div class='custom-header'><span class='badge bg-teal' style='font-size:14px;'>  Selected Meter</span></div>"
											});

											$('#select-all').click(function() {
												$('#my-select').multiSelect('select_all');
												return false;
											});

											$('#deselect-all').click(function() {
												$('#my-select').multiSelect('deselect_all');
												return false;
											});
										</script>
									</div>


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