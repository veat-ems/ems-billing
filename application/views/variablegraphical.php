<style>
	@font-face {
		font-family: "Font Digital";
		src: url('assets/general/fonts/digital-7.regular.ttf');
	}
</style>

<style>
	.service-box {
		border-radius: 5px;
	}

	.box-shadowku {

		border-radius: 5px;
	}

	.chart-container {
		border: 4px solid;
		border-color: #ffffff;
		background: #fcfcfc;
	}

	.chart.has-fixed-height-120 {
		border-radius: 5px;

	}

	div.absolutekiri {
		position: absolute;
		left: 0;
		width: 67%;
		background: #ffffff;
		color: #C82E29;
		font-size: 14px;
		font-weight: bold;
		padding-left: 8px;
		padding-bottom: 7px;
		padding-top: 7px;
		border-top: 1px solid #C82E29;
		text-align: left;
	}

	div.absolutekanan {
		position: absolute;
		right: 0;
		width: 33%;
		background: #C82E29;
		color: #ffffff;
		font-size: 14px;
		font-weight: bold;
		padding-left: 5px;
		padding-right: 5px;
		padding-bottom: 7px;
		padding-top: 7px;
		text-align: right;
	}
</style>

<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
<link href="<?php echo base_url('assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css'); ?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url('assets/vendor/select2/select2.min.css'); ?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url('assets/vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css'); ?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url('assets/vendor/bootstrap-timepicker/bootstrap-timepicker.min.css'); ?>" rel="stylesheet" media="screen">
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
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<?php echo $title; ?>
							</h3>
						</div>

						<div class="card-header" >
							<form role="form" class="form-horizontal">

								<div class="col-sm-12">
									<div id="panelpilih">
										<label style="color:aquamarine;">
											Meter &nbsp;&nbsp;
										</label>
										<label style="color:aquamarine; font-weight: normal;">
											( Id | Name | Group | Location ) :&nbsp;&nbsp;
										</label>
										<select id="meterid" name="meterid" style="border-radius: 5px; font-size:16px;">
											<?php
											$loop = 0;
											foreach ($data_meter as $dm) {
												$loop += 1;
											?>
												<option value="<?php echo $dm->id ?>">&nbsp;&nbsp;<?php echo $loop ?> . <?php echo $dm->id ?> | <?php echo $dm->id_name ?> | <?php echo $dm->metergroupname ?> | <?php echo $dm->lokasi ?> &nbsp;&nbsp; &nbsp;&nbsp; Type: <?php echo $dm->type ?>&nbsp;&nbsp;</option>
											<?php
											}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-4 float-right" style="text-align:right;" hidden>
									<span class="badge bg-teal btn-lg">
										<div id="namameter" style="font-weight:bold; font-size:14px; text-align:right;"></div>
									</span>
								</div>

							</form>
						</div>
					</div>

				</div>
			</div>

			<div id="demourl"></div>

			<div class="row">
				<div class="col-md-7 col-sm-12">

					<div class="row" style="margin-bottom:10px;">
						<div class="col-md-4 col-sm-6 ">
							<div class="box-shadowku">
								<div class="chart-container">
									<div class="chart has-fixed-height-120" id="gauge_v1"></div>
								</div>
								<div style="height:35px;">
									<div class="boxleft absolutekiri" style="width:50%">Teg. Phase RN</div>
									<div class="boxright absolutekanan" style="width:50%" id="gauge_v1_back">0 V</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-6">
							<div class="box-shadowku">
								<div class="chart-container">
									<div class="chart has-fixed-height-120" id="gauge_v2"></div>
								</div>
								<div style="height:35px;">
									<div class="boxleft absolutekiri" style="width:50%">Teg. Phase SN</div>
									<div class="boxright absolutekanan" style="width:50%" id="gauge_v2_back">0 V</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-6">
							<div class="box-shadowku">
								<div class="chart-container">
									<div class="chart has-fixed-height-120" id="gauge_v3"></div>
								</div>
								<div style="height:35px;">
									<div class="boxleft absolutekiri" style="width:50%">Teg. Phase TN</div>
									<div class="boxright absolutekanan" style="width:50%" id="gauge_v3_back">0 V</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row" style="margin-bottom:10px;">
						<div class="col-md-4 col-sm-6">
							<div class="box-shadowku">
								<div class="chart-container">
									<div class="chart has-fixed-height-120" id="gauge_v12"></div>
								</div>
								<div style="height:35px;">
									<div class="boxleft absolutekiri" style="width:50%">Teg. Phase RS</div>
									<div class="boxright absolutekanan" style="width:50%" id="gauge_v12_back">0 V</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-6">
							<div class="box-shadowku">
								<div class="chart-container">
									<div class="chart has-fixed-height-120" id="gauge_v23"></div>
								</div>
								<div style="height:35px;">
									<div class="boxleft absolutekiri" style="width:50%">Teg. Phase ST</div>
									<div class="boxright absolutekanan" style="width:50%" id="gauge_v23_back">0 V</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-6">
							<div class="box-shadowku">
								<div class="chart-container">
									<div class="chart has-fixed-height-120" id="gauge_v31"></div>
								</div>
								<div style="height:35px;">
									<div class="boxleft absolutekiri" style="width:50%">Teg. Phase TR</div>
									<div class="boxright absolutekanan" style="width:50%" id="gauge_v31_back">0 V</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row" style="margin-bottom:20px;">
						<div class="col-md-4 col-sm-6">
							<div class="box-shadowku">
								<div class="chart-container">
									<div class="chart has-fixed-height-120" id="gauge_i1"></div>
								</div>
								<div style="height:35px;">
									<div class="boxleft absolutekiri" style="width:50%">Arus Phase R</div>
									<div class="boxright absolutekanan" style="width:50%" id="gauge_i1_back">0 A</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-6">
							<div class="box-shadowku">
								<div class="chart-container">
									<div class="chart has-fixed-height-120" id="gauge_i2"></div>
								</div>
								<div style="height:35px;">
									<div class="boxleft absolutekiri" style="width:50%">Arus Phase S</div>
									<div class="boxright absolutekanan" style="width:50%" id="gauge_i2_back">0 A</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-6">
							<div class="box-shadowku">
								<div class="chart-container">
									<div class="chart has-fixed-height-120" id="gauge_i3"></div>
								</div>
								<div style="height:35px;">
									<div class="boxleft absolutekiri" style="width:50%">Arus Phase T</div>
									<div class="boxright absolutekanan" style="width:50%" id="gauge_i3_back">0 A</div>
								</div>
							</div>
						</div>
					</div>

				</div>

				<div class="col-md-5  col-sm-12">
					<div class="row" style="margin-bottom:10px;">
						<i class="progress-description" style="font-size:16px; color:grey;">&nbsp;&nbsp; updated @&nbsp;&nbsp;</i>
						<i class="progress-description" style="font-size:16px; color:orange;" id="date_time"></i>
					</div>

					<div class="row" style="margin-bottom:10px;">
						<div class="col-md-6 col-sm-6">
							<div class="box-shadowku">
								<div class="chart-container">
									<div class="chart has-fixed-height-200" id="gauge_kw"></div>
								</div>
								<div style="height:35px;">
									<div class="boxleft absolutekiri" style="width:50%">Daya Aktif</div>
									<div class="boxright absolutekanan" style="width:50%" id="gauge_kw_back">0 kW</div>
								</div>
							</div>

						</div>
						<div class="col-md-6 col-sm-6">
							<div class="box-shadowku">
								<div class="chart-container">
									<div class="chart has-fixed-height-200" id="gauge_kva"></div>
								</div>
								<div style="height:35px;">
									<div class="boxleft absolutekiri" style="width:50%">Daya Semu</div>
									<div class="boxright absolutekanan" style="width:50%" id="gauge_kva_back">0 kVA</div>
								</div>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="service-box">
								<div class="service-icon white service-heigth-80">
									<div class="front-content" style="top:45px;">
										<div class="info-box bg-aqua" style="color:#ffffff;">
											<span class="info-box-icon" style="width:50px; margin-left:-8px; margin-top:-4px;"><i class="far fa-arrow-alt-circle-down"></i></span>
											<div class="info-box-content">
												<span class="info-box-number" style="font-size:22px; text-align:right;" id="gauge_kwhi">0000000000000</span>

												<div class="progress">
													<div class="progress-bar" style="width: 90%"></div>
												</div>
												<span class="progress-description" style="font-size:16px;" id="satuan_gauge_kwhi">
													<b>IMPORT kWh</b>
												</span>
											</div>
											<!-- /.info-box-content -->
										</div>
										<!-- /.info-box -->
									</div>
								</div>
								<div class="service-content blue  service-heigth-500">
									<h3 id="gauge_kwhi_back" style="margin-top:10px; font-size:26px"></h3>
								</div>
							</div>

						</div>
						<div class="col-md-6 col-sm-6">
							<div class="service-box">
								<div class="service-icon white service-heigth-80">
									<div class="front-content" style="top:45px;">
										<div class="info-box bg-aqua" style="color:#ffffff;">
											<span class="info-box-icon" style="width:50px; margin-left:-8px; margin-top:-4px;"><i class="far fa-arrow-alt-circle-down"></i></span>
											<div class="info-box-content">
												<span class="info-box-number" style="font-size:22px; text-align:right;" id="gauge_kvari">0000000000000</span>

												<div class="progress">
													<div class="progress-bar" style="width: 90%"></div>
												</div>
												<span class="progress-description" style="font-size:16px;" id="satuan_gauge_kvari">
													<b>IMPORT kVARh</b>
												</span>
											</div>
											<!-- /.info-box-content -->
										</div>
										<!-- /.info-box -->
									</div>
								</div>
								<div class="service-content blue  service-heigth-500">
									<h3 id="gauge_kvari_back" style="margin-top:10px; font-size:26px"></h3>
								</div>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top:10px;">
						<div class="col-md-6 col-sm-6">
							<div class="service-box">
								<div class="service-icon white service-heigth-80">
									<div class="front-content" style="top:45px;">
										<div class="info-box bg-red" style="color:#ffffff;">
											<span class="info-box-icon" style="width:50px; margin-left:-8px; margin-top:-4px;"><i class="far fa-arrow-alt-circle-up"></i></span>
											<div class="info-box-content">
												<span class="info-box-number" style="font-size:22px; text-align:right;" id="gauge_kwhe">0000000000000</span>

												<div class="progress">
													<div class="progress-bar" style="width: 90%"></div>
												</div>
												<span class="progress-description" style="font-size:16px;" id="satuan_gauge_kwhe">
													<b>EXPORT kWh</b>
												</span>
											</div>
											<!-- /.info-box-content -->
										</div>
										<!-- /.info-box -->
									</div>
								</div>
								<div class="service-content red  service-heigth-500">
									<h3 id="gauge_kwhe_back" style="margin-top:10px; font-size:26px"></h3>
								</div>
							</div>

						</div>
						<div class="col-md-6 col-sm-6">
							<div class="service-box">
								<div class="service-icon white service-heigth-80">
									<div class="front-content" style="top:45px;">
										<div class="info-box bg-red" style="color:#ffffff;">
											<span class="info-box-icon" style="width:50px; margin-left:-8px; margin-top:-4px;"><i class="far fa-arrow-alt-circle-up"></i></span>
											<div class="info-box-content">
												<span class="info-box-number" style="font-size:22px; text-align:right;" id="gauge_kvare">0000000000000</span>

												<div class="progress">
													<div class="progress-bar" style="width: 90%"></div>
												</div>
												<span class="progress-description" style="font-size:16px;" id="satuan_gauge_kvare">
													<b>EXPORT kVARh</b>
												</span>
											</div>
											<!-- /.info-box-content -->
										</div>
										<!-- /.info-box -->
									</div>
								</div>
								<div class="service-content red  service-heigth-500">
									<h3 id="gauge_kvare_back" style="margin-top:10px; font-size:26px"></h3>
								</div>
							</div>
						</div>
					</div>


				</div>

			</div>



			<div class="row">
				<div class="col-md-9">
					<div class="row" style="margin-bottom:10px;">
						<div class="col-md-4 col-sm-6">
							<div class="service-box">
								<div class="service-icon white service-heigth-80">
									<div class="front-content" style="top:45px;">
										<div class="info-box bg-red" style="color:#ffffff;">
											<div class="info-box-icon" style="width:100px; margin-left:-8px; height:100px; margin-bottom:-14px;  ">
												<div style="font-style:italic; font-size:24px; font-weight:bold; margin-left:16px;">P F</div>
												<div style="font-style:italic; font-size:12px;  margin-top:46px; margin-left:-46px;">(Faktor Daya)</div>
											</div>
											<div class="info-box-content" style="margin-left: 65px;">
												<span class="info-box-number" style="font-size:35px;" id="gauge_pf1">0.00</span>
												<div class="progress">
													<div class="progress-bar" style="width: 90%"></div>
												</div>
												<span class="progress-description" style="font-size:12px; margin-top:-6px;">
													<b>Faktor Daya Phase R</b>
												</span>
											</div>
											<!-- /.info-box-content -->
										</div>
										<!-- /.info-box -->
									</div>
								</div>
								<div class="service-content red  service-heigth-500">
									<h3 id="gauge_pf1_back" style="margin-top:0px; font-size:50px"></h3>
								</div>
							</div>

						</div>
						<div class="col-md-4 col-sm-6">
							<div class="service-box">
								<div class="service-icon white service-heigth-80">
									<div class="front-content" style="top:45px;">
										<div class="info-box bg-yellow" style="color:#ffffff;">
											<div class="info-box-icon" style="width:100px; margin-left:-8px; height:100px; margin-bottom:-14px;  ">
												<div style="font-style:italic; font-size:24px; font-weight:bold;">THD V</div>
												<div style="font-style:italic; font-size:12px; margin-top:46px; margin-left:-56px;">(TEGANGAN)</div>
											</div>
											<div class="info-box-content" style="margin-left: 95px;">
												<span class="info-box-number" style="font-size:35px;" id="gauge_thdv1">0.0</span>

												<div class="progress">
													<div class="progress-bar" style="width: 90%"></div>
												</div>
												<span class="progress-description" style="font-size:12px;">
													<b>THD V Phase R</b>
												</span>
											</div>
											<!-- /.info-box-content -->
										</div>
										<!-- /.info-box -->
									</div>
								</div>
								<div class="service-content yellow  service-heigth-500">
									<h3 id="gauge_thdv1_back" style="margin-top:0px; font-size:50px"></h3>
								</div>
							</div>

						</div>
						<div class="col-md-4 col-sm-6">
							<div class="service-box">
								<div class="service-icon white service-heigth-80">
									<div class="front-content" style="top:45px;">
										<div class="info-box bg-green" style="color:#ffffff;">
											<div class="info-box-icon " style="width:100px; margin-left:-8px; height:100px; margin-bottom:-14px;  ">
												<div style="font-style:italic; font-size:24px; font-weight:bold; margin-left:-16px;">THD I</div>
												<div style="font-style:italic; font-size:12px; margin-top:46px; margin-left:-40px;">(ARUS)</div>
											</div>
											<div class="info-box-content" style="margin-left: 95px;">
												<span class="info-box-number" style="font-size:35px;" id="gauge_thdi1">0.0</span>

												<div class="progress">
													<div class="progress-bar" style="width: 90%"></div>
												</div>
												<span class="progress-description" style="font-size:12px;">
													<b>THD I Phase R</b>
												</span>
											</div>
											<!-- /.info-box-content -->
										</div>
										<!-- /.info-box -->
									</div>
								</div>
								<div class="service-content green  service-heigth-500">
									<h3 id="gauge_thdi1_back" style="margin-top:0px; font-size:50px"></h3>
								</div>
							</div>

						</div>
					</div>

					<div class="row" style="margin-bottom:10px;">
						<div class="col-md-4 col-sm-6">
							<div class="service-box">
								<div class="service-icon white service-heigth-80">
									<div class="front-content" style="top:45px;">
										<div class="info-box bg-red" style="color:#ffffff;">
											<div class="info-box-icon" style="width:100px; margin-left:-8px; height:100px; margin-bottom:-14px;  ">
												<div style="font-style:italic; font-size:24px; font-weight:bold; margin-left:16px;">P F</div>
												<div style="font-style:italic; font-size:12px;  margin-top:46px; margin-left:-46px;">(Faktor Daya)</div>
											</div>
											<div class="info-box-content" style="margin-left: 65px;">
												<span class="info-box-number" style="font-size:35px;" id="gauge_pf2">0.00</span>

												<div class="progress">
													<div class="progress-bar" style="width: 90%"></div>
												</div>
												<span class="progress-description" style="font-size:12px;">
													<b>Faktor Daya Phase S</b>
												</span>
											</div>
											<!-- /.info-box-content -->
										</div>
										<!-- /.info-box -->
									</div>
								</div>
								<div class="service-content red  service-heigth-500">
									<h3 id="gauge_pf2_back" style="margin-top:0px; font-size:50px"></h3>
								</div>
							</div>

						</div>
						<div class="col-md-4 col-sm-6">
							<div class="service-box">
								<div class="service-icon white service-heigth-80">
									<div class="front-content" style="top:45px;">
										<div class="info-box bg-yellow" style="color:#ffffff;">
											<div class="info-box-icon " style="width:100px; margin-left:-8px; height:100px; margin-bottom:-14px;  ">
												<div style="font-style:italic; font-size:24px; font-weight:bold;">THD V</div>
												<div style="font-style:italic; font-size:12px; margin-top:46px; margin-left:-56px;">(TEGANGAN)</div>
											</div>
											<div class="info-box-content" style="margin-left: 95px;">
												<span class="info-box-number" style="font-size:35px;" id="gauge_thdv2">0.0</span>

												<div class="progress">
													<div class="progress-bar" style="width: 90%"></div>
												</div>
												<span class="progress-description" style="font-size:12px;">
													<b>THD V Phase S</b>
												</span>
											</div>
											<!-- /.info-box-content -->
										</div>
										<!-- /.info-box -->
									</div>
								</div>
								<div class="service-content yellow  service-heigth-500">
									<h3 id="gauge_thdv2_back" style="margin-top:0px; font-size:50px"></h3>
								</div>
							</div>

						</div>
						<div class="col-md-4 col-sm-6">
							<div class="service-box">
								<div class="service-icon white service-heigth-80">
									<div class="front-content" style="top:45px;">
										<div class="info-box bg-green" style="color:#ffffff;">
											<div class="info-box-icon" style="width:100px; margin-left:-8px; height:100px; margin-bottom:-14px;  ">
												<div style="font-style:italic; font-size:24px; font-weight:bold; margin-left:-16px;">THD I</div>
												<div style="font-style:italic; font-size:12px; margin-top:46px; margin-left:-40px;">(ARUS)</div>
											</div>
											<div class="info-box-content" style="margin-left: 95px;">
												<span class="info-box-number" style="font-size:35px;" id="gauge_thdi2">0.0</span>

												<div class="progress">
													<div class="progress-bar" style="width: 90%"></div>
												</div>
												<span class="progress-description" style="font-size:12px;">
													<b>THD I Phase S</b>
												</span>
											</div>
											<!-- /.info-box-content -->
										</div>
										<!-- /.info-box -->
									</div>
								</div>
								<div class="service-content green  service-heigth-500">
									<h3 id="gauge_thdi2_back" style="margin-top:0px; font-size:50px"></h3>
								</div>
							</div>
						</div>
					</div>

					<div class="row" style="margin-bottom:10px;">
						<div class="col-md-4 col-sm-6">
							<div class="service-box">
								<div class="service-icon white service-heigth-80">
									<div class="front-content" style="top:45px;">
										<div class="info-box bg-red" style="color:#ffffff;">
											<div class="info-box-icon" style="width:100px; margin-left:-8px; height:100px; margin-bottom:-14px;  ">
												<div style="font-style:italic; font-size:24px; font-weight:bold; margin-left:16px;">P F</div>
												<div style="font-style:italic; font-size:12px;  margin-top:46px; margin-left:-46px;">(Faktor Daya)</div>
											</div>
											<div class="info-box-content" style="margin-left: 65px;">
												<span class="info-box-number" style="font-size:35px;" id="gauge_pf3">0.00</span>

												<div class="progress">
													<div class="progress-bar" style="width: 90%"></div>
												</div>
												<span class="progress-description" style="font-size:12px;">
													<b>Faktor Daya Phase T</b>
												</span>
											</div>
											<!-- /.info-box-content -->
										</div>
										<!-- /.info-box -->
									</div>
								</div>
								<div class="service-content red  service-heigth-500">
									<h3 id="gauge_pf3_back" style="margin-top:0px; font-size:50px"></h3>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-6">
							<div class="service-box">
								<div class="service-icon white service-heigth-80">
									<div class="front-content" style="top:45px;">
										<div class="info-box bg-yellow" style="color:#ffffff;">
											<div class="info-box-icon" style="width:100px; margin-left:-8px; height:100px; margin-bottom:-14px;  ">
												<div style="font-style:italic; font-size:24px; font-weight:bold;">THD V</div>
												<div style="font-style:italic; font-size:12px; margin-top:46px; margin-left:-56px;">(TEGANGAN)</div>
											</div>
											<div class="info-box-content" style="margin-left: 95px;">
												<span class="info-box-number" style="font-size:35px;" id="gauge_thdv3">0.0</span>

												<div class="progress">
													<div class="progress-bar" style="width: 90%"></div>
												</div>
												<span class="progress-description" style="font-size:12px;">
													<b>THD V Phase T</b>
												</span>
											</div>
											<!-- /.info-box-content -->
										</div>
										<!-- /.info-box -->
									</div>
								</div>
								<div class="service-content yellow  service-heigth-500">
									<h3 id="gauge_thdv3_back" style="margin-top:0px; font-size:50px"></h3>
								</div>
							</div>

						</div>
						<div class="col-md-4 col-sm-6">
							<div class="service-box">
								<div class="service-icon white service-heigth-80">
									<div class="front-content" style="top:45px;">
										<div class="info-box bg-green" style="color:#ffffff;">
											<div class="info-box-icon " style="width:100px; margin-left:-8px; height:100px; margin-bottom:-14px;  ">
												<div style="font-style:italic; font-size:24px; font-weight:bold; margin-left:-16px;">THD I</div>
												<div style="font-style:italic; font-size:12px; margin-top:46px; margin-left:-40px;">(ARUS)</div>
											</div>
											<div class="info-box-content" style="margin-left: 95px;">
												<span class="info-box-number" style="font-size:35px;" id="gauge_thdi3">0.0</span>

												<div class="progress">
													<div class="progress-bar" style="width: 90%"></div>
												</div>
												<span class="progress-description" style="font-size:12px;">
													<b>THD I Phase T</b>
												</span>
											</div>
											<!-- /.info-box-content -->
										</div>
										<!-- /.info-box -->
									</div>
								</div>
								<div class="service-content green  service-heigth-500">
									<h3 id="gauge_thdi3_back" style="margin-top:0px; font-size:50px"></h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3  col-sm-12">
					<div class="row">
						<div class="col-md-12 col-sm-12">

							<!-- small box -->
							<div class="small-box bg-aqua" style="color:#ffffff; ">
								<br />
								<br />
								<div class="inner">
									<h3 style="font-size:70px; color:#ffffff; text-align:center;" id="gauge_freq">0.00</h3>
									<h3 style="font-size:60px; text-align:right;">Hz</h3>
								</div>
								<div class="icon" style="top:65px;">
									<i class="icon-pulse2" style="font-size:180px;"></i>
								</div>
								<a href="#" class="small-box-footer" style="font-size:35px; font-weight:bold; ">
									Frekuensi
								</a>
							</div>



						</div>
					</div>

				</div>

			</div>


		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->