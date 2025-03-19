<style>
	.bok {

		height: 300px;
		padding: 5px 0px 5px 0px;
	}

	table {

		border-radius: 10px 10px 0px 0px;
		border-collapse: collapse;
		width: 100%;
		/* vertical-align: middle; */
		/* position: relative; */
		/* height: 300px; */
		padding: 50px 50px 50px 50px;
		/* bottom: 0px; */
		/* margin-top: 50px; */
		font-size: 18px;
		line-height: 25px;
		background-color: #141f16;
		color: white;
	}

	td {

		border-radius: 10px 10px 0px 0px;
		padding: 0px 10px 10px 10px;
		/* border: 0.01px solid rgb(56, 61, 58); */
		/* font-size: 12px; */
		vertical-align: top;

	}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-dark">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="card card-teal card-outline">
				<div class="card-header" style="background:darkslategray;">
					<div class="row">
						<div class="col-6">
							<h3 class="card-title">
								<i class="fas fa-table"></i>
								<?php echo $title; ?>
							</h3>
						</div>
						<div class="col-sm-6 float-right" style="text-align:right;">
							<?php echo $pagination; ?>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

			<div class="row">
				<div class="col-md-12">
					<div class="row">

						<?php

						$loop_color = 1;
						//foreach ($meter as $dash) {
						foreach ($data_meter_paging as $dash) {

							$loop_color += 1;
							//$loop_color = rand(1,6);
							if ($loop_color == 2) {
								$class_header_box_color = "bg-info";
								$class_header_btn		= "btn-warning";
							} else if ($loop_color == 3) {
								$class_header_box_color = "bg-success";
								$class_header_btn		= "btn-warning";
							} else if ($loop_color == 4) {
								$class_header_box_color = "bg-warning";
								$class_header_btn		= "btn-warning";
							} else if ($loop_color == 5) {
								$class_header_box_color = "bg-danger";
								$class_header_btn		= "btn-warning";
							} else if ($loop_color == 6) {
								$class_header_box_color = "bg-primary";
								$class_header_btn		= "btn-warning";
							} else {
								$class_header_box_color = "bg-teal";
								$class_header_btn		= "btn-warning";
							}

							// $class_header_box_color = "bg-teal";        // tkh
							// $class_header_btn		= "btn-warning";	// tkh

							if ($loop_color > 4) $loop_color = 1;
							$metergroupid = $dash->metergroupid;
						?>

							<div class="col-lg-3 col-6 animated">
								<div class="bok">
									<div class="small-box <?php echo $class_header_box_color; ?>" style=" height:150px; width:100%; border-radius: 10px 10px 5px 5px; background: url('<?php echo base_url(); ?>images/asrama_group_bg.jpg'); background-size: cover;">
										<div>
											<table>
												<td width="10%"></td>
												<td width="80%"></td>
												<td width="10%"></td>
												</tr>
												<tr>
													<td style="font-size: 12px; line-height: 25px; border-right: 0.01px solid rgb(56, 61, 58);"><?php echo $dash->metergroupid; ?>
													</td>
													<td><?php echo $dash->metergroupname; ?>
													</td>
													<td>
														<?php
														$mainformattributes = array('class' => 'form-horizontal', 'id' => 'mainform', 'name' => 'mainform');
														$hiddenform = array('metergroupid' => $dash->metergroupid);
														echo form_open(base_url() . 'dashboard/index/0', $mainformattributes, $hiddenform);
														?>
														<button class="btn btn-sm <?php echo $class_header_btn ?> " type="submit" id="btn_submit" name="btn_submit">
															<i class="fas fa-search"></i>
														</button>
														</form>
													</td>
												</tr>
											</table>
										</div>
										<!-- <div class="inner" style="color: #000000; margin-top:-15px; "> -->
										<div class="inner" style="color: orange; margin-top:-15px; ">
											<h1><?php echo $dash->num_member; ?></h1>
											<p style=" margin-top:-15px; ">KWH Meters</p>
										</div>
										<div class="icon fixed-bottom">
											<i class="nav-icon fas fa-tachometer-alt"></i>
										</div>
									</div>

								</div>


							</div>


						<?php
						}
						?>

					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6">
					&nbsp;
				</div>
				<div class="col-sm-6" style="text-align:right;">
					<?php echo $pagination; ?>
				</div>
			</div>

		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->