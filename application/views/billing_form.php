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
									<i class="nav-icon fas fa-file-invoice-dollar"></i>
									<?php echo $title; ?>
								</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">


								<?php
								$mainformattributes = array('class' => 'form-horizontal', 'id' => 'mainform', 'name' => 'mainform');
								$hiddenform = array('is_post' => '1');
								echo form_open(base_url() . 'billing/calculation', $mainformattributes, $hiddenform);
								?>
								<fieldset>

									<div class="row">
										<div class="col-md-3">

											<div class="form-group">
												<label class="control-label">
													Tarif LWBP/kWh (Rp.)
												</label>
												<input type="text" class="form-control" value="<?php echo $tarif_lwbp ?>" id="tarif_lwbp" name="tarif_lwbp">
												<span class="input-group-btn"></span>
												<span class="text-warning"><?php echo form_error('tarif_lwbp'); ?></span>
											</div>

											<div class="form-group">
												<label class="control-label">
													Tarif WBP/kWh (Rp.)
												</label>
												<input type="text" class="form-control" value="<?php echo $tarif_wbp ?>" id="tarif_wbp" name="tarif_wbp">
												<span class="input-group-btn"></span>
												<span class="text-warning"><?php echo form_error('tarif_wbp'); ?></span>
											</div>


											<div class="form-group">
												<label class="control-label">
													Date From
												</label>
												<p class="input-group ">
													<input type="text" class="form-control input-append datepicker date" value="<?php echo $dari; ?>" id="dari" name="dari">
													<span class="input-group-btn">
													</span>
													<input type="text" class="form-control input-append" value="<?php echo $dari_time; ?>" id="dari_time_2" name="dari_time">
												</p>
											</div>

											<div class="form-group">
												<label class="control-label">
													Date Thru
												</label>
												<p class="input-group ">
													<input type="text" class="form-control input-append datepicker date" value="<?php echo $sampai; ?>" id="sampai" name="sampai">
													<span class="input-group-btn">
													</span>
													<input type="text" class="form-control input-append" value="<?php echo $sampai_time; ?>" id="sampai_time_2" name="sampai_time">
												</p>
											</div>

										</div>

										<div class="col-md-1">
										</div>
										<div class="col-md-8">


											<select multiple="multiple" id="my-select" name="my-select[]">
												<?php
												$loop = 0;
												foreach ($meterdatas as $dm) {
												$loop += 1;
												?>
													<!-- <option value='<?php echo $dm->id ?>'><?php echo $dm->id ?> |<?php echo $dm->id_name ?> |<?php echo $dm->metergroupname ?> | <?php echo $dm->lokasi ?></option> -->
													<option value='<?php echo $dm->id ?>'><?php echo $loop ?> . <?php echo $dm->id_name ?> |<?php echo $dm->metergroupname ?></option>

												<?php
												}
												?>
											</select>
											<a href='#' id='select-all'>Select All</a>&nbsp;/&nbsp;
											<a href='#' id='deselect-all'>Deselect All</a>

											<script type="text/javascript">
												$('#my-select').multiSelect({
													keepOrder: true,
													selectableHeader: "<div class='custom-header'><span class='badge bg-teal' style='font-size:14px;'>Selectable Items</span></div>",
													selectionHeader: "<div class='custom-header'><span class='badge bg-teal' style='font-size:14px;'>Selected Items</span></div>"
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
										<div class="col-md-4">&nbsp;</div>
										<div class="col-md-4">
											<button class="btn btn-md btn-info btn-flat" type="submit" id="btn_submit" name="btn_submit" style="margin-top:24px;">
												Calculate <i class="fas fa-chevron-right"></i>
											</button>
										</div>
										<div class="col-md-4">&nbsp;</div>
									</div>

								</fieldset>
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