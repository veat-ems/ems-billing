<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper dark-mode">
	<!-- Content Header (Page header) -->
	<section class="content-header ">
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
						<div class="card-header bg-gradient-dark">
							<h3 class="card-title">
								<i class="fas fa-table"></i>
								<?php echo $title; ?>
							</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">


							<form action="<?php echo base_url('meterdata/create'); ?>" method="post" enctype="multipart/form-data" role="form" id="formcreate">
								<fieldset>
									<div class="row">
										<div class="col-md-7">

											<div class="row">
												<div class="col-md-12">
													<!-- <div class="form-group">
											<label class="control-label">
												ID Meter
											</label>
											<input type="text" placeholder="12345678" class="form-control" id="id" name="id"  value="<?php echo set_value('id'); ?>">
											<span class="text-warning" ><?php echo form_error('id'); ?></span>
										</div> -->

													<div class="form-group">
														<label class="control-label">
															Meter ID
														</label>
														<select id="id" name="id" class="js-states  cs-skin-elastic form-control">
															<option value="">-- Meter ID --</option>
															<?php foreach ($data_id as $dmi) { ?>
																<option value="<?php echo $dmi->id ?>" <?php if ($dmi->id == $id) echo 'selected' ?>><?php echo $dmi->id ?></option>
															<?php } ?>
														</select>
														<input type="text" class="" value="<?php echo $id ?>" id="id2" name="id2" style="display:none;">
													</div>

													<div class="form-group">
														<label class="control-label">
															Meter Type
														</label>
														<!-- <select class="form-control" id="type" name="type">
												<option value="">-- Meter Type --</option>
												<option value="1 PHASE">1 PHASE</option>
												<option value="3 PHASE">3 PHASE</option>
											</select> -->
														<input type="text" placeholder="EMH LZQJ" class="form-control" name="type" id="type" value="<?php echo set_value('type'); ?>">
														<span class="text-warning"><?php echo form_error('type'); ?></span>
													</div>

													<div class="form-group">
														<label class="control-label">
															Meter SN
														</label>
														<input type="text" placeholder="12345678" class="form-control" id="id_serial" name="id_serial" value="<?php echo set_value('id_serial'); ?>">
														<span class="text-warning"><?php echo form_error('id_serial'); ?></span>
													</div>

													<div class="form-group">
														<label class="control-label">
															Meter Name
														</label>
														<input type="text" placeholder="INC Trafo" class="form-control" id="id_name" name="id_name" value="<?php echo set_value('id_name'); ?>">
														<span class="text-warning"><?php echo form_error('id_name'); ?></span>
													</div>

													<div class="form-group">
														<label class="control-label">
															Meter Group
														</label>
														<select id="metergroupid" name="metergroupid" class="js-states  cs-skin-elastic form-control">
															<option value="">-- Meter Group --</option>
															<?php foreach ($data_metergroup as $dmg) { ?>
																<option value="<?php echo $dmg->metergroupid ?>" <?php if ($dmg->metergroupid == $metergroupid) echo 'selected' ?>><?php echo $dmg->metergroupname ?></option>
															<?php } ?>
														</select>
														<input type="text" class="" value="<?php echo $metergroupid ?>" id="metergroupid2" name="metergroupid2" style="display:none;">
													</div>

													<div class="form-group">
														<label class="control-label">
															Meter Location
														</label>
														<input type="text" placeholder="Panel LV" class="form-control" name="lokasi" id="lokasi" value="<?php echo set_value('lokasi'); ?>">
														<span class="text-warning"><?php echo form_error('lokasi'); ?></span>
													</div>

													<div class="form-group">
														<label class="control-label">
															V Nominal (Volt)
														</label>
														<input type="text" placeholder="400" class="form-control" name="v_nominal" id="v_nominal" value="<?php echo set_value('v_nominal'); ?>">
														<span class="text-warning"><?php echo form_error('v_nominal'); ?></span>
													</div>
													<div class="form-group">
														<label class="control-label">
															I Nominal (Ampere)
														</label>
														<input type="text" placeholder="100" class="form-control" name="i_nominal" id="i_nominal" value="<?php echo set_value('i_nominal'); ?>">
														<span class="text-warning"><?php echo form_error('i_nominal'); ?></span>
													</div>
													<div class="form-group">
														<label class="control-label">
															Daya (VA)
														</label>
														<input type="text" placeholder="40000" class="form-control" name="p_nominal" id="p_nominal" value="<?php echo set_value('p_nominal'); ?>">
														<span class="text-warning"><?php echo form_error('p_nominal'); ?></span>
													</div>

												</div>
											</div>

										</div>

									</div>
								</fieldset>

								<div class="row">
									<div class="col-md-4 col-sm-12">
									</div>
									<?php if ($this->session->userdata('level') == "ADM") { ?>
										<div class="col-md-2 col-sm-6">
											<button class="btn btn-md btn-info btn-flat float-right" type="submit">
												Save&nbsp;&nbsp;<i class="fa fa-save"></i>
											</button>
										</div>
									<?php } ?>
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