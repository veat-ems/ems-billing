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
							<?php
							$xlsformattributes = array('class' => 'form-horizontal', 'id' => 'xlsform', 'name' => 'xlsform');
							$xlshiddenform = array('is_post' => '1', 'tarif' => $tarif, 'tarif_lwbp' => $tarif_lwbp, 'tarif_wbp' => $tarif_wbp, 'kurs' => $kurs, 'dari' => $dari, 'sampai' => $sampai, 'dari_time' => $dari_time, 'sampai_time' => $sampai_time, 'str_meters' => $str_meters);
							echo form_open(base_url() . 'billing/xls', $xlsformattributes, $xlshiddenform);
							?>
							<div class="row">
								<div class="col-8">
									<h3 class="card-title">
										<i class="nav-icon fas fa-file-invoice-dollar"></i>
										<?php echo $title; ?>
									</h3>
								</div>
								<div class="col-4 float-right">

									<!-- <button type="submit" class="btn btn-md btn-info btn-flat float-right" id="btn_submit" name="btn_submit">
							<i class="ti-download"></i>&nbsp;Formatted XLS&nbsp;
						</button> -->
									<button type="button" class="btn btn-md btn-info btn-flat float-right" style="margin-right:4px;" id="btn_back" name="btn_back" onclick="javascript:history.back();">
										&nbsp;Billing Form&nbsp;
									</button>
									<button type="submit" class="btn btn-md btn-info btn-flat float-right" id="btn_submit" name="btn_submit">
										<i class="ti-download"></i>&nbsp;Invoice PDF&nbsp;
									</button>
								</div>
							</div>
							</form>
						</div>
						<!-- /.card-header -->
						<div class="card-body">


							<table class="table table-striped" id="datalist">
								<thead>

									<tr style="background:darkslategray; text-align: center; border: 1px solid red;">
										<td rowspan="2"><b>NO</b></td>
										<td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Meter_(M)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
										<td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Meter_(M)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
										<td colspan="2"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Usage Periode (UP)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
										<td colspan="3"><b>kWh TOTAL (TOT)</b></td>
										<td colspan="3"><b>kWh WBP (WBP)</b></td>
										<td colspan="3"><b>kWh LWBP (LBP)</b></td>
										<td colspan="3"><b>Cost Usage (RP)</b></td>
										<td><b></b></td>
										<td rowspan="2"><b>TOTAL</b></td>
									</tr>
									<tr style="background:darkslategray; text-align: center; border: 1px solid red;">
										<td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;M_ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
										<td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;M_Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
										<td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UP_Start&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
										<td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UP_End&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
										<td><b>TOT_Start</b></td>
										<td><b>TOT_End</b></td>
										<td><b>TOT_Usage</b></td>
										<td><b>WBP_Start</b></td>
										<td><b>WBP_End</b></td>
										<td><b>WBP_Usage</b></td>
										<td><b>LBP_Start</b></td>
										<td><b>LBP_End</b></td>
										<td><b>LBP_Usage</b></td>
										<td><b>RP_WBP</b></td>
										<td><b>RP_LWBP</b></td>
										<td><b>RP_TOTAL</b></td>
										<td><b>PPN-10%</b></td>
									</tr>
								</thead>
								<tbody>

									<?php
									$loop = 0;
									foreach ($rows as $billing) {
										$loop += 1;
										$id 		= $billing->id;
										$name	 	= $billing->id_name;
										$groupid	= $billing->metergroupid;

										$serial 	= $billing->id_serial;
										$area 		= $billing->area;
										$lokasi		= $billing->lokasi;
										$id_name	= $name;


										$date_time_start 	= $billing->date_time_start;
										$date_time_stop 	= $billing->date_time_stop;
										$kwh_exp_start 		= number_format($billing->kwh_exp_start / 1000, 1);
										$kwh_exp_stop 		= number_format($billing->kwh_exp_stop / 1000, 1);
										$kwh_usage 			= number_format($billing->kwh_exp_usage / 1000, 2);
										$kwh_total 			= number_format((($billing->kwh_exp_usage / 1000) * $kurs * $tarif), 0);

										$kwh1_start 		= number_format($billing->kwh1_start / 1000, 1);
										$kwh1_stop 			= number_format($billing->kwh1_stop / 1000, 1);
										$kwh1_usage 		= number_format($billing->kwh1_usage / 1000, 2);
										$kwh1_tot			= ($billing->kwh1_usage / 1000) * $tarif_wbp;
										$kwh1_total 		= number_format($kwh1_tot, 0);

										$kwh2_start 		= number_format($billing->kwh2_start / 1000, 1);
										$kwh2_stop 			= number_format($billing->kwh2_stop / 1000, 1);
										$kwh2_usage 		= number_format($billing->kwh2_usage / 1000, 2);
										// $kwh2_total 		= number_format((($billing->kwh2_usage / 1000) * $kurs * $tarif), 2);
										$kwh2_tot			= ($billing->kwh2_usage / 1000) * $tarif_lwbp;
										$kwh2_total 		= number_format($kwh2_tot, 0);

										$kwh12_totalrp	    = $kwh1_tot + $kwh2_tot;
										$kwh12_totalrpF 	= number_format($kwh12_totalrp, 0);
										$kwh12_ppnrp		= $kwh12_totalrp * 0.1;
										$kwh12_ppnrpF 		= number_format($kwh12_ppnrp, 0);
										$kwh12_incppnrp		= $kwh12_totalrp + $kwh12_ppnrp;
										$kwh12_incppnrpF	= number_format($kwh12_incppnrp, 0);




									?>
										<tr class="">
											<td style="text-align: centre;"><?php echo $loop; ?></td>
											<td style="text-align: left;"><?php echo $id; ?></td>
											<td style="text-align: left;"><?php echo $id_name; ?></td>

											<td style="text-align: left;"><?php echo $date_time_start ?></td>
											<td style="text-align: left;"><?php echo $date_time_stop ?></td>

											<td style="text-align: right;"><?php echo $kwh_exp_start ?></td>
											<td style="text-align: right;"><?php echo $kwh_exp_stop ?></td>
											<td style="text-align: right;"><?php echo $kwh_usage ?></td>
											<!-- <td><?php echo $kwh_total ?></td> -->

											<td style="text-align: right;"><?php echo $kwh1_start ?></td>
											<td style="text-align: right;"><?php echo $kwh1_stop ?></td>
											<td style="text-align: right;"><?php echo $kwh1_usage ?></td>

											<td style="text-align: right;"><?php echo $kwh2_start ?></td>
											<td style="text-align: right;"><?php echo $kwh2_stop ?></td>
											<td style="text-align: right;"><?php echo $kwh2_usage ?></td>

											<td style="text-align: right;"><?php echo $kwh1_total ?></td>
											<td style="text-align: right;"><?php echo $kwh2_total ?></td>
											<td style="text-align: right;"><?php echo $kwh12_totalrpF ?></td>

											<td style="text-align: right;"><?php echo $kwh12_ppnrpF  ?></td>

											<td style="text-align: right;"><?php echo $kwh12_incppnrpF ?></td>

										</tr>
									<?php
									}
									?>
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