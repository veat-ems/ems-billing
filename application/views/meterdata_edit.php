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
						<div class="card-header bg-gradient-dark">
							<h3 class="card-title">
								<i class="fas fa-table"></i>
								<?php echo $title; ?>
							</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">

							<?php
							if ($this->session->flashdata('pesan') <> '') {
							?>
								<div class="alert alert-dismissible alert-danger" style="color:#ffffff;">
									<?php echo $this->session->flashdata('pesan'); ?>
								</div>
							<?php } ?>

							<form action="<?php echo base_url('meterdata/edit/' . $data_form->id_meter); ?>" method="post" enctype="multipart/form-data" role="form" id="formcreate">
								<fieldset>
									<div class="row">
										<div class="col-md-7">

											<div class="row">
												<div class="col-md-12">

												</div>
											</div>

											<div class="row">
												<div class="col-md-12">

													<div class="form-group">
														<label class="control-label">
															Meter ID
														</label>
														<input type="text" class="form-control" id="id_tampil" name="id_tampil" value="<?php echo $data_form->id ?>" disabled>
														<input type="hidden" class="form-control" id="id_meter" name="id_meter" value="<?php echo $data_form->id_meter ?>">
														<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $data_form->id ?>">
														<span class="text-warning"><?php echo form_error('id'); ?></span>
													</div>

													<div class="form-group">
														<label class="control-label">
															Meter Type
														</label>
														<!-- <select class="form-control" id="type" name="type">
												<option value="<?php echo $data_form->type ?>"><?php echo $data_form->type ?></option>
												<option value="1 PHASE">1 PHASE</option>
												<option value="3 PHASE">3 PHASE</option>
											</select> -->
														<input type="text" placeholder="Type Meter" class="form-control" name="type" id="type" value="<?php echo set_value('type', $data_form->type); ?>">
														<span class="text-warning"><?php echo form_error('type'); ?></span>
													</div>

													<div class="form-group">
														<label class="control-label">
															Meter SN
														</label>
														<input type="text" placeholder="20220101" class="form-control" name="id_serial" id="id_serial" value="<?php echo set_value('id_serial', $data_form->id_serial); ?>">
														<span class="text-warning"><?php echo form_error('id_serial'); ?></span>
													</div>

													<div class="form-group">
														<label class="control-label">
															Meter Name
														</label>
														<input type="text" placeholder="LMVDP1" class="form-control" name="id_name" id="id_name" value="<?php echo set_value('id_name', $data_form->id_name); ?>">
														<span class="text-warning"><?php echo form_error('id_name'); ?></span>
													</div>

													<div class="form-group">
														<label class="control-label">
															Meter Group
														</label>
														<select id="metergroupid" name="metergroupid" class="js-states  cs-skin-elastic form-control">
															<option value="">-- Meter Group --</option>
															<?php foreach ($data_metergroup as $dmg) { ?>
																<option value="<?php echo $dmg->metergroupid ?>" <?php if ($dmg->metergroupid == $data_form->metergroupid) echo 'selected' ?>><?php echo $dmg->metergroupname ?></option>
															<?php } ?>
														</select>
														<input type="text" class="" value="<?php echo $data_form->metergroupid ?>" id="metergroupid2" name="metergroupid2" style="display:none;">
													</div>

													<div class="form-group">
														<label class="control-label">
															Meter Location
														</label>
														<input type="text" placeholder="POWER HOUSE" class="form-control" name="lokasi" id="lokasi" value="<?php echo set_value('lokasi', $data_form->lokasi); ?>">
														<span class="text-warning"><?php echo form_error('lokasi'); ?></span>
													</div>

													<div class="form-group">
														<label class="control-label">
															V Nominal (Volt)
														</label>
														<input type="text" placeholder="400" class="form-control" name="v_nominal" id="v_nominal" value="<?php echo set_value('v_nominal', $data_form->v_nominal); ?>">
														<span class="text-warning"><?php echo form_error('v_nominal'); ?></span>
													</div>

													<div class="form-group">
														<label class="control-label">
															I Nominal (Ampere)
														</label>
														<input type="text" placeholder="100" class="form-control" name="i_nominal" id="i_nominal" value="<?php echo set_value('i_nominal', $data_form->i_nominal); ?>">
														<span class="text-warning"><?php echo form_error('i_nominal'); ?></span>
													</div>

													<div class="form-group">
														<label class="control-label">
															Daya (VA)
														</label>
														<input type="text" placeholder="40000" class="form-control" name="p_nominal" id="p_nominal" value="<?php echo set_value('p_nominal', $data_form->p_nominal); ?>">
														<span class="text-warning"><?php echo form_error('p_nominal'); ?></span>
													</div>



												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<label class="control-label">
														Alarm Configuration
													</label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													TO - Timeout : High Limit (Minute)
												</div>
												<div class="col-md-1">
													<input type="checkbox" name="alarm_to_yesno" value="1" <?php if ($data_form->alarm_to_yesno == 1) echo 'checked' ?>>
												</div>
												<div class="col-md-11">
													<div class="form-group">
														<input type="text" placeholder="15" class="form-control" name="alarm_to_high_limit" id="alarm_to_high_limit" value="<?php echo set_value('alarm_to_high_limit', $data_form->alarm_to_high_limit); ?>">
														<span class="text-warning"><?php echo form_error('alarm_to_high_limit'); ?></span>
													</div>
												</div>
											</div>
											<div class="row" style="display: none;">
												<div class="row">
													<div class="col-md-12">
														VT - Voltage Tolerance : (1.0 - 100 %) < V < (100.1 - 200 %) </div>
															<div class="col-md-1">
																<input type="checkbox" name="alarm_vt_yesno" value="1" <?php if ($data_form->alarm_vt_yesno == 1) echo 'checked' ?>>
															</div>
															<div class="col-md-2">
																Low Limit
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" placeholder="80" class="form-control" name="alarm_vt_low_limit" id="alarm_vt_low_limit" value="<?php echo set_value('alarm_vt_low_limit', $data_form->alarm_vt_low_limit); ?>">
																	<span class="text-warning"><?php echo form_error('alarm_vt_low_limit'); ?></span>
																</div>
															</div>
															<div class="col-md-1">
																&nbsp;
															</div>
															<div class="col-md-2">
																High Limit
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" placeholder="120" class="form-control" name="alarm_vt_high_limit" id="alarm_vt_high_limit" value="<?php echo set_value('alarm_vt_high_limit', $data_form->alarm_vt_high_limit); ?>">
																	<span class="text-warning"><?php echo form_error('alarm_vt_high_limit'); ?></span>
																</div>
															</div>
													</div>

													<div class="row">
														<div class="col-md-12">
															UC - Current Unbalance : Low Limit (1.0 - 100 %)
														</div>
														<div class="col-md-1">
															<input type="checkbox" name="alarm_uc_yesno" value="1" <?php if ($data_form->alarm_uc_yesno == 1) echo 'checked' ?>>
														</div>
														<div class="col-md-11">
															<div class="form-group">
																<input type="text" placeholder="80" class="form-control" name="alarm_uc_high_limit" id="alarm_uc_high_limit" value="<?php echo set_value('alarm_uc_high_limit', $data_form->alarm_uc_high_limit); ?>">
																<span class="text-warning"><?php echo form_error('alarm_uc_high_limit'); ?></span>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-12">
															OC - Over Current : High Limit (1.0 - 100 %)
														</div>
														<div class="col-md-1">
															<input type="checkbox" name="alarm_oc_yesno" value="1" <?php if ($data_form->alarm_oc_yesno == 1) echo 'checked' ?>>
														</div>
														<div class="col-md-11">
															<div class="form-group">
																<input type="text" placeholder="150" class="form-control" name="alarm_oc_high_limit" id="alarm_oc_high_limit" value="<?php echo set_value('alarm_oc_high_limit', $data_form->alarm_oc_high_limit); ?>">
																<span class="text-warning"><?php echo form_error('alarm_oc_high_limit'); ?></span>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-12">
															PF - Power Factor : Low Limit ( 0.01 - 1.00 )
														</div>
														<div class="col-md-1">
															<input type="checkbox" name="alarm_pf_yesno" value="1" <?php if ($data_form->alarm_pf_yesno == 1) echo 'checked' ?>>
														</div>
														<div class="col-md-11">
															<div class="form-group">
																<input type="text" placeholder="0.8" class="form-control" name="alarm_pf_low_limit" id="alarm_pf_low_limit" value="<?php echo set_value('alarm_pf_low_limit', $data_form->alarm_pf_low_limit); ?>">
																<span class="text-warning"><?php echo form_error('alarm_pf_low_limit'); ?></span>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-12">
															RP - Reserve Power
														</div>
														<div class="col-md-1">
															<input type="checkbox" name="alarm_rp_yesno" value="1" <?php if ($data_form->alarm_rp_yesno == 1) echo 'checked' ?>>
														</div>
														<div class="col-md-11">
															<div class="form-group">
																<input type="text" placeholder="watt1 < 0 or watt2 < 0 or watt3 < 0 or watt < 0" class="form-control" name="dlpd_p_val" id="dlpd_p_val" value="watt1 < 0 or watt2 < 0 or watt3 < 0 or watt < 0" readonly="readonly">

															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-12">
															HV - Harmonic Voltage : High Limit (1.0 - 100 %)
														</div>
														<div class="col-md-1">
															<input type="checkbox" name="alarm_hv_yesno" value="1" <?php if ($data_form->alarm_hv_yesno == 1) echo 'checked' ?>>
														</div>
														<div class="col-md-11">
															<div class="form-group">
																<input type="text" placeholder="10" class="form-control" name="alarm_hv_high_limit" id="alarm_hv_high_limit" value="<?php echo set_value('alarm_hv_high_limit', $data_form->alarm_hv_high_limit); ?>">
																<span class="text-warning"><?php echo form_error('alarm_hv_high_limit'); ?></span>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-12">
															HC - Harmonic Current : High Limit (1.0 - 100 %)
														</div>
														<div class="col-md-1">
															<input type="checkbox" name="alarm_hc_yesno" value="1" <?php if ($data_form->alarm_hc_yesno == 1) echo 'checked' ?>>
														</div>
														<div class="col-md-11">
															<div class="form-group">
																<input type="text" placeholder="30" class="form-control" name="alarm_hc_high_limit" id="alarm_hc_high_limit" value="<?php echo set_value('alarm_hc_high_limit', $data_form->alarm_hc_high_limit); ?>">
																<span class="text-warning"><?php echo form_error('alarm_hc_high_limit'); ?></span>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-1">
											</div>
											<div class="col-md-4">


												<div class="row">
													<div class="col-md-12 col-sm-12">
														<!-- <label>
															GROUP FRONT PICTURE
														</label> -->
													</div>
													<!-- <div class="col-md-12 col-sm-12">
														<div class="fileinput fileinput-new" data-provides="fileinput">
															<?php
															$dtfrontpicture = $data_form->frontpicture;
															if ($dtfrontpicture == '') {
																$fontpicture = base_url('assets/general/images/no-image.jpg');
															} else {
																$fontpicture = base_url('assets/img/meterdata/' . $dtfrontpicture);
															}

															?>
															<div class="fileinput-new thumbnail"><img src="<?php echo $fontpicture; ?>" alt="<?php echo $random; ?>" style="width: 200px;">
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px; height: 150px;"></div>

															<?php if ($this->session->userdata('level') == "ADM") { ?>
																<div class="user-edit-image-buttons">
																	<span class="btn btn-azure btn-file btn-info"><span class="fileinput-new"><i class="fa fa-picture"></i> Select image</span><span class="fileinput-exists"><i class="fa fa-picture"></i> Change</span>
																		<input type="file" id="frontpicture" name="frontpicture">
																	</span>
																	<span>JPG ~ 300x500px</span>
																	<a href="#" class="btn fileinput-exists btn-danger" data-dismiss="fileinput">
																		<i class="fa fa-times"></i> Remove
																	</a>
																</div>
															<?php } ?>
														</div>
													</div> -->
												</div>
												<div class="row">
													&nbsp;
												</div>

												<div style="display: none;" class="row">
													<div class="col-md-12 col-sm-12">
														<label>
															BACK PICTURE
														</label>
													</div>
													<div class="col-md-12 col-sm-12">
														<div class="fileinput fileinput-new" data-provides="fileinput">
															<?php
															$dtbackpicture = $data_form->backpicture;
															if ($dtbackpicture == '') {
																$backpicture = base_url('assets/general/images/no-image.jpg');
															} else {
																$backpicture = base_url('assets/img/meterdata/' . $dtbackpicture);
															}

															?>
															<div class="fileinput-new thumbnail"><img src="<?php echo $backpicture; ?>" alt="">
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px; height: 150px;"></div>

															<?php if ($this->session->userdata('level') == "ADM") { ?>
																<div class="user-edit-image-buttons">
																	<span class="btn btn-azure btn-file btn-info"><span class="fileinput-new"><i class="fa fa-picture"></i> Select image</span><span class="fileinput-exists"><i class="fa fa-picture"></i> Change</span>
																		<input type="file" id="backpicture" name="backpicture">
																	</span>
																	<a href="#" class="btn fileinput-exists btn-danger" data-dismiss="fileinput">
																		<i class="fa fa-times"></i> Remove
																	</a>
																</div>
															<?php } ?>
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