<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
<link href="<?php echo base_url('assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css'); ?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url('assets/vendor/select2/select2.min.css'); ?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url('assets/vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css'); ?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url('assets/vendor/bootstrap-timepicker/bootstrap-timepicker.min.css'); ?>" rel="stylesheet" media="screen">
<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->

<style>
	.highcharts-background {
		/* border-radius: 5px 5px 5px 5px;
	background:#ffffff; */
	}
</style>

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


					<div class="card card-outline card-success">
						<div class="card-header" style="background:darkslategray;">
							<h3 class="card-title">
								<i class="fas fa-table"></i>
								<?php echo $title; ?>
							</h3>
						</div>

						<div class="card-header" style="background:darkslategray;">
							<?php
							$mainformattributes = array('class' => 'form-horizontal', 'id' => 'mainform', 'name' => 'mainform');
							$hiddenform = '';
							echo form_open(base_url() . 'trendperiodicmultiple', $mainformattributes, $hiddenform);
							?>

							<div class="row mb-0">

								<div class="col-sm-4">
									<label style="color:aquamarine;">
										Meter &nbsp;&nbsp;
									</label>
									<label style="color:aquamarine; font-weight: normal;">
										( Id | Name | Group | Location - Type )
									</label>
									<select id="meterid" name="id" class="js-states cs-skin-elastic form-control">
										<?php
										$loop = 0;
										foreach ($data_meter as $dm) {
											$loop += 1;
										?>
											<option value="<?php echo $dm->id ?>" <?php if ($dm->id == $id) echo 'selected' ?>><?php echo $loop ?> . <?php echo $dm->id ?> | <?php echo $dm->id_name ?> | <?php echo $dm->metergroupname ?> | <?php echo $dm->lokasi ?> &nbsp;&nbsp; &nbsp;&nbsp; Type: <?php echo $dm->type ?>&nbsp;&nbsp;</option>
										<?php
										}
										?>
									</select>
									<input type="text" class="" value="<?php echo $id ?>" id="meterid2" name="meterid2" style="display:none;">
								</div>
								<div class="col-sm-2">
									<label style="color:aquamarine;">
										Show Data
									</label>
									<select class="js-states  cs-skin-elastic form-control" id="tempo" name="tempo">
										<option value="Detail" <?php if ($tempo == 'Detail') echo 'selected' ?>>D e t a i l</option>
										<option value="Hourly" <?php if ($tempo == 'Hourly') echo 'selected' ?>>H o u r l y</option>
										<option value="Daily" <?php if ($tempo == 'Daily') echo 'selected' ?>>D a i l y</option>
									</select>
								</div>
								<div class="col-sm-3">
									<label style="color:aquamarine;">
										Date From
									</label>
									<p class="input-group ">
										<input type="text" class="form-control input-append datepicker date" value="<?php echo $dari; ?>" id="dari" name="dari">
										<span class="input-group-btn">
										</span>
										<input type="text" class="form-control input-append" value="<?php echo $dari_time; ?>" id="dari_time_2" name="dari_time">
									</p>
								</div>
								<div class="col-sm-3">
									<label style="color:aquamarine;">
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

							<div class="row mb-0">
								<div class="col-sm-2">
									<button style="border-radius: 5px; text-align:left;" class="btn-info js-states form-control" type="button" data-toggle="collapse" data-target="#collapse_parameter" aria-expanded="false" aria-controls="collapse_parameter">
										Meter Variables &nbsp;&nbsp;<i class="fa fa-chevron-down"></i>
									</button>
								</div>
								<div class="col-sm-1">
									<select id="select-style-chart" style="border-radius: 5px;" class="js-states cs-skin-elastic form-control">
										<option value="line">Line</option>
										<option value="column">B a r</option>
									</select>
								</div>
								<div class="col-sm-2">
									<input type="checkbox" id="chk_showpointvalue" name="chk_showpointvalue" value="1" <?php if ($showpointvalue == 1) echo 'checked'; ?>>&nbsp;<label for="chk1" style="font-weight: normal;">Show Point Value</label>
								</div>
								<div class="col-sm-1">
									<button style="border-radius: 5px;" type="submit" class="btn btn-md btn-info btn-flat" id="btn_submit2" name="btn_submit2">
										<i class="fa fa-sync-alt"></i>
									</button>
								</div>

								<!-- <div class="col-sm-1" style="align-items: right;">
									<button style="border-radius: 5px;" class="btn btn-md btn-warning btn-flat" type="submit" id="btn_submit" name="btn_submit">
										<i class="fas fa-search"></i>
									</button>
								</div> -->
							</div>

							<div class="collapse" id="collapse_parameter" style="background:darkslategray; color:#ffffff; border: solid 1px #007700; border-radius:5px;">
								<div style="margin:10px;">
									<div class="row">

										<div class="col-md-2">
											<!-- <span class="badge bg-teal" style="display: block;">&nbsp;Tegangan Arus Daya KWh&nbsp;</span> -->
											<input type="checkbox" id="chk_v1" name="chk_v1" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'V1') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">V - Tegangan</label><br>
											<input type="checkbox" id="chk_i1" name="chk_i1" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'I1') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">I - Arus</label><br>
											<input type="checkbox" id="chk_watt" name="chk_watt" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'P') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">P - Daya</label><br>
											<input type="checkbox" id="chk_kwh_exp" name="chk_kwh_exp" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'kWh_Exp') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">kWh - Energy</label><br>

										</div>

										<div style="display: none;">
											<input type="checkbox" id="chk_v2" name="chk_v2" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'V2') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">V2</label><br>
											<input type="checkbox" id="chk_v3" name="chk_v3" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'V3') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">V3</label><br>

											<span class="badge bg-teal" style="display: block;">&nbsp;Tegangan Phase to Phase&nbsp;</span>
											<input type="checkbox" id="chk_v12" name="chk_v12" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'V12') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">V12</label><br>
											<input type="checkbox" id="chk_v23" name="chk_v23" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'V23') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">V23</label><br>
											<input type="checkbox" id="chk_v31" name="chk_v31" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'V31') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">V31</label><br>

											<div class="col-md-2">
												<span class="badge bg-teal" style="display: block;">&nbsp;Arus Phase&nbsp;</span>
												<input type="checkbox" id="chk_i2" name="chk_i2" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'I2') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">I2</label><br>
												<input type="checkbox" id="chk_i3" name="chk_i3" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'I3') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">I3</label><br>
												<input type="checkbox" id="chk_inet" name="chk_inet" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'INet') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">INet</label><br>
											</div>

											<div class="col-md-2">
												<span class="badge bg-teal" style="display: block;">&nbsp;Active Power&nbsp;</span>
												<input type="checkbox" id="chk_watt1" name="chk_watt1" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'P1') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">P1</label><br>
												<input type="checkbox" id="chk_watt2" name="chk_watt2" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'P2') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">P2</label><br>
												<input type="checkbox" id="chk_watt3" name="chk_watt3" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'P3') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">P3</label><br>

												<span class="badge bg-teal" style="display: block;">&nbsp;Apparent Power&nbsp;</span>
												<input type="checkbox" id="chk_va1" name="chk_va1" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'S1') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">S1</label><br>
												<input type="checkbox" id="chk_va2" name="chk_va2" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'S2') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">S2</label><br>
												<input type="checkbox" id="chk_va3" name="chk_va3" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'S3') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">S3</label><br>
												<input type="checkbox" id="chk_va" name="chk_va" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'S') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">S</label><br>
											</div>

											<div class="col-md-2">
												<span class="badge bg-teal" style="display: block;">&nbsp;Power Factor & Frequency&nbsp;</span>
												<input type="checkbox" id="chk_pf1" name="chk_pf1" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'PF1') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">PF1</label><br>
												<input type="checkbox" id="chk_pf2" name="chk_pf2" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'PF2') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">PF2</label><br>
												<input type="checkbox" id="chk_pf3" name="chk_pf3" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'PF3') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">PF3</label><br>
												<input type="checkbox" id="chk_freq" name="chk_freq" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'Freq') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">Freq</label><br>
											</div>

											<div class="col-md-2">
												<span class="badge bg-teal" style="display: block;">&nbsp;Total Harmonic Distortion&nbsp;</span>
												<input type="checkbox" id="chk_thd_v1" name="chk_thd_v1" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'THD_V1') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">THD V1</label><br>
												<input type="checkbox" id="chk_thd_v2" name="chk_thd_v2" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'THD_V2') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">THD V2</label><br>
												<input type="checkbox" id="chk_thd_v3" name="chk_thd_v3" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'THD_V3') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">THD V3</label><br>

												<input type="checkbox" id="chk_thd_i1" name="chk_thd_i1" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'THD_I1') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">THD I1</label><br>
												<input type="checkbox" id="chk_thd_i2" name="chk_thd_i2" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'THD_I2') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">THD I2</label><br>
												<input type="checkbox" id="chk_thd_i3" name="chk_thd_i3" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'THD_I3') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">THD I3</label><br>
											</div>

											<div class="col-md-2">
												<span class="badge bg-teal" style="display: block;">&nbsp;Energy&nbsp;</span>
												<input type="checkbox" id="chk_kwh_imp" name="chk_kwh_imp" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'kWh_Imp') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">KWh - Imp</label><br>

												<input type="checkbox" id="chk_kvarh_exp" name="chk_kvarh_exp" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'kVArh_Exp') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">kVarh Exp</label><br>
												<input type="checkbox" id="chk_kvarh_imp" name="chk_kvarh_imp" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'kVArh_Imp') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">kVarh Imp</label><br>

												<input type="checkbox" id="chk_kwh1" name="chk_kwh1" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'kWh1') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">kWh1 (WBP)</label><br>
												<input type="checkbox" id="chk_kwh2" name="chk_kwh2" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'kWh2') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">kWh2 (LWBP)</label><br>

												<input type="checkbox" id="chk_kwh_inc1" name="chk_kwh_inc1" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'kWh_Inc1') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">kWh_Inc1</label><br>
												<input type="checkbox" id="chk_kwh_inc2" name="chk_kwh_inc2" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'kWh_Inc2') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">kWh_Inc2</label><br>
												<input type="checkbox" id="chk_kwh_inc3" name="chk_kwh_inc3" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'kWh_Inc3') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">kWh_Inc3</label><br>

											</div>
										</div>

										<!--
											<input type="checkbox" id="chk_kvah" name="chk_kvah" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'kvah') == 1) echo 'checked'; ?>>&nbsp;<label for="chk1">kvah</label><br>

											<input type="checkbox" id="chk_kwh" name="chk_kwh" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'kwh') == 1) echo 'checked'; ?> >&nbsp;<label for="chk1">kwh</label><br>
											<input type="checkbox" id="chk_kwh1" name="chk_kwh1" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'kwh1') == 1) echo 'checked'; ?> >&nbsp;<label for="chk1">kwh1</label><br>
											<input type="checkbox" id="chk_kwh2" name="chk_kwh2" value="1" <?php if ($this->model_trend->get_parameter_value($username, 'trend', 'kwh2') == 1) echo 'checked'; ?> >&nbsp;<label for="chk1">kwh2</label><br>
										-->

									</div>
								</div>
							</div>

							</form>
						</div>
						<!-- /.card-header -->
						<div class="card-body">

							<div class="row">
								<div class="col-md-12">

									<div id="energy_trend" style="min-width: 310px;  height: 450px; margin: 0 auto"></div>
								</div>
							</div>
						</div>

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


<script type="text/javascript">
	var chartData = Highcharts.chart('energy_trend', {
		chart: {
			type: 'line',
			zoomType: 'xy',
			backgroundColor: 'rgba(100, 100, 100, 0.35)', // Dark green color using RGB values
		},

		legend: {
			itemStyle: {
				color: 'grey', // Set the legend text color to white
			},
			itemHoverStyle: {
				color: 'white' // Set the legend item color on hover
			},
		},
		title: {
			text: '<?php echo $graph_title ?>',
			style: {
				color: 'white', // Set the title text color to white
			}
		},
		subtitle: {
			text: '<?php echo $graph_subtitle ?>'
		},
		xAxis: {
			categories: [<?php echo $str_categories ?>]
		},
		yAxis: [
			<?php
			$loopyaxis = 0;
			foreach ($fieldparameters as $fieldparameter) {
				$loopyaxis += 1;

				$fpname = $fieldparameter->fieldname;
				if ($fpname == 'V1' or $fpname == 'V2' or $fpname == 'V3' or $fpname == 'V12' or $fpname == 'V23' or $fpname == 'V31') {
					$satuan = ' Volt ';
				} else if ($fpname == 'I1' or $fpname == 'I2' or $fpname == 'I3' or $fpname == 'INet') {
					$satuan = ' Ampere ';
				} else if ($fpname == 'P1' or $fpname == 'P2' or $fpname == 'P3' or $fpname == 'P') {
					$satuan = ' Watt ';
				} else if ($fpname == 'S1' or $fpname == 'S2' or $fpname == 'S3' or $fpname == 'S') {
					$satuan = ' VA ';
				} else if ($fpname == 'Freq') {
					$satuan = ' Hz ';
				} else if ($fpname == 'PF1' or $fpname == 'PF2' or $fpname == 'PF3') {
					$satuan = ' ';
				} else if ($fpname == 'kWh_Exp' or $fpname == 'kWh_Imp' or $fpname == 'kWh1' or $fpname == 'kWh2' or $fpname == 'kWh_Inc1' or $fpname == 'kWh_Inc2' or $fpname == 'kWh_Inc3') {
					$satuan = ' kWh ';
				} else if ($fpname == 'kVArh_Exp' or $fpname == 'kVArh_Imp') {
					$satuan = ' kVARh ';
				} else if ($fpname == 'THD_V1' or $fpname == 'THD_V2' or $fpname == 'THD_V3') {
					$satuan = ' % ';
				} else if ($fpname == 'THD_I1' or $fpname == 'THD_I2' or $fpname == 'THD_I3') {
					$satuan = ' % ';
				} else if ($fpname == 'kWh1' or $fpname == 'kWh2' or $fpname == 'kWh') {
					$satuan = ' kWh ';
				} else {
					$satuan = '';
				}

				// rename variable & satuan
				if ($fpname == 'kWh_Expxxx') {
					$fieldparameter_alias = 'kubik';
					$satuan = ' M3 ';
				} else {
					$fieldparameter_alias = $fpname;
				}

			?> { // per y-axis
					labels: {
						formatter: function() {
							return this.value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
						},
						style: {
							color: Highcharts.getOptions().colors[<?php echo $loopyaxis ?>]
						}
					},
					title: {

						// text: '<?php echo $fieldparameter->fieldname . " (" . $satuan . ")" ?>',
						text: '<?php echo $fieldparameter_alias . " (" . $satuan . ")" ?>',

						style: {
							color: Highcharts.getOptions().colors[<?php echo $loopyaxis ?>]
						}
					},
					<?php
					if ($loopyaxis <= $count_variable_middle) {
					?>
						opposite: false
					<?php } else { ?>
						opposite: true
					<?php } ?>
				},
			<?php
			}
			?>
		],
		<?php
		if ($showpointvalue == 1) {
		?>
			plotOptions: {
				line: {
					dataLabels: {
						enabled: true
					},
					enableMouseTracking: false
				}
			},
		<?php
		} else {
		?>
			plotOptions: {
				line: {
					dataLabels: {
						enabled: false
					},
					enableMouseTracking: false
				}
			},
		<?php
		}
		?>
		series: [
			<?php
			$loopyaxis = 0;
			foreach ($fieldparameters as $fieldparameter) {
				$loopyaxis += 1;
				// rename variable & satuan
				if ($fieldparameter->fieldname == 'kWh_Expxxx') {
					$fieldparameter_alias2 = 'kubik';
				} else {
					$fieldparameter_alias2 = $fieldparameter->fieldname;
				}
			?> {


					// name: '<?php echo $fieldparameter->fieldname ?>',
					name: '<?php echo  $fieldparameter_alias2 ?>',
					color: Highcharts.getOptions().colors[<?php echo $loopyaxis ?>],
					yAxis: <?php echo $loopyaxis - 1 ?>,
					data: [
						<?php
						$paramname = 'param_' . $fieldparameter->fieldname;
						echo $$paramname;
						?>
					]
				},
			<?php
			}
			?>
		]
	});
	$('#select-style-chart').change(function() {
		var value = $(this).val();
		chartData.update({
			chart: {
				type: value
			}
		});
	})
</script>