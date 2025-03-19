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
							// 'target' => '_blank' untuk open ne tab
							$xlsformattributes = array('target' => '_blank', 'class' => 'form-horizontal', 'id' => 'xlsform', 'name' => 'xlsform');
							$xlshiddenform = array('is_post' => '1', 'tarif' => $tarif, 'tarif_lwbp' => $tarif_lwbp, 'tarif_wbp' => $tarif_wbp, 'kurs' => $kurs, 'dari' => $dari, 'sampai' => $sampai, 'dari_time' => $dari_time, 'sampai_time' => $sampai_time, 'str_meters' => $str_meters);
							// echo form_open(base_url() . 'billing/xls', $xlsformattributes, $xlshiddenform);
							echo form_open(base_url() . 'billingm/pdf', $xlsformattributes, $xlshiddenform);
							?>
                            <div class="row">
                                <div class="col-8">
                                    <h3 class="card-title">
                                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                                        <?php echo $title; ?>
                                    </h3>
                                </div>
                                <div class="col-4 float-right">

                                    <button type="submit" class="btn btn-md btn-info btn-flat float-right"
                                        id="btn_submit" name="btn_submit">
                                        <i class="ti-download"></i>&nbsp;Invoice PDF&nbsp;
                                    </button>
                                    <!-- <button type="button" class="btn btn-md btn-info btn-flat float-right" style="margin-right:4px;" id="btn_back" name="btn_back" onclick="javascript:history.back();">
										&nbsp;Billing Form&nbsp;
									</button> -->
                                </div>
                            </div>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">


                            <table class="table table-striped" id="datalist">
                                <thead>

                                    <tr class="bg-dark-grey" style="text-align: center; border: 1px solid red;">
                                        <td rowspan="2"><b>NO</b></td>
                                        <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Meter_(M)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                                        </td>
                                        <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Meter_(M)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                                        </td>
                                        <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Group_(M)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                                        </td>
                                        <td colspan="2"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Usage Periode
                                                (UP)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                                        <!-- <td colspan="3"><b>kWh TOTAL (TOT)</b></td> -->
                                        <td style="display: none;" colspan="3"><b>kWh (WBP)</b></td>
                                        <td colspan="3"><b>kWh (LWBP)</b></td>
                                        <td colspan="1"><b>Cost Usage (RP)</b></td>
                                        <!-- <td><b></b></td> -->
                                        <td><b>ADMIN</b></td>
                                        <td colspan="1"><b>TAX</b></td>
                                        <td colspan="1"><b>TOTAL</b></td>
                                        <!-- <td rowspan="3"><b>TOTAL</b></td> -->
                                    </tr>
                                    <tr class="bg-dark-grey" style="text-align: center; border: 1px solid red;">
                                        <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;M_ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                                        </td>
                                        <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;M_Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                                        </td>
                                        <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Location&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                                        </td>
                                        <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UP_Start&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                                        </td>
                                        <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UP_End&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                                        </td>
                                        <!-- <td><b>TOT_Start</b></td>
							<td><b>TOT_End</b></td>
							<td><b>TOT_Usage</b></td> -->
                                        <td style="display: none;"><b>WBP_Start</b></td>
                                        <td style="display: none;"><b>WBP_End</b></td>
                                        <td style="display: none;"><b>WBP_Usage</b></td>
                                        <td><b>LWBP_Start</b></td>
                                        <td><b>LWBP_End</b></td>
                                        <td><b>LWBP_Usage</b></td>
                                        <td style="display: none;"><b>RP_WBP</b></td>
                                        <td><b>RP_LWBP</b></td>
                                        <td style="display: none;"><b>RP_TOTAL</b></td>
                                        <td><b>COST</b></td>
                                        <td><b>PPN</b></td>
                                        <td><b>BILLING</b></td>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
									$loop = 0;
									foreach ($rows as $billing) {
										$loop += 1;
										$id 		= $billing->id;
										// $id_name 	= $billing->id_name; 

										$id_serial 	= $billing->id_serial;
										// $area 		= $billing->area;
										$lokasi		= $billing->lokasi;
										// $id_name	= $id_serial . '|'. $lokasi;
										$id_name	= $billing->id_name;

										$date_time_start 	= $billing->date_time_start;
										$date_time_stop 	= $billing->date_time_stop;

										$this->db->select("metergroupname")
											->from('metergroups')
											->where("metergroupid", $billing->metergroupid);
										$query 	= $this->db->get();

										if ($query->num_rows() == 1) {
											$metergroupname	= $query->row('metergroupname') . ' | ' . $lokasi;
										} else {
											$metergroupname	= '-';
										}






										// $kwh_exp_start 		= number_format($billing->kwh_exp_start / 1000, 1);
										// $kwh_exp_stop 		= number_format($billing->kwh_exp_stop / 1000, 1);
										// $kwh_usage 			= number_format($billing->kwh_exp_usage / 1000, 1);
										// $kwh_total 			= number_format((($billing->kwh_exp_usage / 1000) * $kurs * $tarif), 0);

										$kwh1_start 		= number_format($billing->kwh1_start / 1000, 1);
										$kwh1_stop 			= number_format($billing->kwh1_stop / 1000, 1);
										$kwh1_usage 		= number_format($billing->kwh1_usage / 1000, 1);
										$kwh1_tot			= ($billing->kwh1_usage / 1000) * $tarif_wbp;
										$kwh1_total 		= number_format($kwh1_tot, 0);

										$kwh2_start 		= number_format($billing->kwh2_start / 1000, 1);
										$kwh2_stop 			= number_format($billing->kwh2_stop / 1000, 1);
										$kwh2_usage 		= number_format($billing->kwh2_usage / 1000, 1);
										$kwh2_tot			= ($billing->kwh2_usage / 1000) * $tarif_lwbp;
										$kwh2_total 		= number_format($kwh2_tot, 0);

										$kwh12_totalrp	    = $kwh1_tot + $kwh2_tot;
										$kwh12_totalrpF 	= number_format(($kwh12_totalrp), 0);

										$adminrp			= $kurs; //$kwh12_totalrp * $kurs/100 ;
										$adminrpF 			= number_format($adminrp, 0);

										// 

										$kwh12_ppnrp		= ($kwh12_totalrp + $adminrp) * 0.11;
										$kwh12_ppnrpF 		= number_format($kwh12_ppnrp, 0);

										$kwh12_admin_ppn_totalrp			= $kwh12_totalrp + $adminrp + $kwh12_ppnrp;
										$kwh12_admin_ppn_totalrpF			= number_format($kwh12_admin_ppn_totalrp, 0);




									?>
                                    <tr class="">
                                        <td style="text-align: centre;"><?php echo $loop; ?></td>
                                        <td style="text-align: left;"><?php echo $id; ?></td>
                                        <td style="text-align: left;"><?php echo $id_name; ?></td>
                                        <td style="text-align: left;"><?php echo $metergroupname; ?></td>

                                        <td style="text-align: left;"><?php echo $date_time_start ?></td>
                                        <td style="text-align: left;"><?php echo $date_time_stop ?></td>

                                        <!-- <td style="text-align: right;"><?php echo $kwh_exp_start ?></td>
								<td style="text-align: right;"><?php echo $kwh_exp_stop ?></td>
								<td style="text-align: right;"><?php echo $kwh_usage ?></td> -->

                                        <td style="display: none;" style="text-align: right;"><?php echo $kwh1_start ?></td>
                                        <td style="display: none;" style="text-align: right;"><?php echo $kwh1_stop ?></td>
                                        <td style="display: none;" style="text-align: right;"><?php echo $kwh1_usage ?></td>

                                        <td style="text-align: right;"><?php echo $kwh2_start ?></td>
                                        <td style="text-align: right;"><?php echo $kwh2_stop ?></td>
                                        <td style="text-align: right;"><?php echo $kwh2_usage ?></td>

                                        <td style="display: none;" style="text-align: right;"><?php echo $kwh1_total ?></td>
                                        <td style="text-align: right;"><?php echo $kwh2_total ?></td>
                                        <td style="display: none;" style="text-align: right;"><?php echo $kwh12_totalrpF ?></td>

                                        <td style="text-align: right;"><?php echo $adminrpF  ?></td>
                                        <td style="text-align: right;"><?php echo $kwh12_ppnrpF  ?></td>

                                        <td style="text-align: right;"><?php echo $kwh12_admin_ppn_totalrpF ?></td>

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