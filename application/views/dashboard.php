<style>
  table {
    /* border-collapse: collapse; */
    width: 100%;
    vertical-align: middle;
    /* position: relative; */
    color: white;
    padding: 50px 50px 50px 50px;
    border-radius: 5px 5px 5px 5px;
  }

  th,
  td {
    padding: 3px 10px 3px 10px;
    font-size: 12px;

  }



  th {
    /*background-color: #555;*/

    /* letter-spacing: 1px; */
    height: 20px;
    font-size: 22px;
    /* color: rgb(193, 243, 193); */
    text-align: left;

  }

  td {
    /* color: white; */
    border: 0.01px solid rgb(56, 61, 58);
    background-color: #141f16;

  }

  .tf {
    background-color: #666666;
    border: none;
    border-radius: 0px 0px 4px 4px;
    /* letter-spacing: 1px; */
    height: 20px;
    text-align: right;

  }

  .tdnm {
    text-align: right;
    background-color: #CFCFCF;
    height: 20px;
    font-size: 12px;
    border: none;
    border-bottom: solid 1px #999999;
    color: #000000;
  }

  .tdval {
    text-align: right;
    background-color: #BEBEBE;
    height: 20px;
    font-size: 24px;
    font-weight: 800;
    border: none;
    border-bottom: solid 1px #999999;
    color: #004200;
  }

  .tdsat {
    text-align: right;
    background-color: #ACACAC;
    height: 20px;
    font-size: 12px;
    border: none;
    border-bottom: solid 1px #999999;
    color: #009300;
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


            <!-- DATA HEADER -->
            <div class="col-lg-6 col-6 animated ">
              <div class="small-box bg-secondary">
                <table style="height:60px; opacity: 0.8; background: url('<?php echo base_url(); ?>assets/img/meterdata/bg_header_gr.jpg') center">


                  <tr>
                    <input style="display:none;" type="text" id="param_metergroupid" name="param_metergroupid" value="<?php echo $metergroupname->metergroupid; ?>" />
                    <!-- input ini dihapus bikin error jquery --tkh -- Take meter_group id by dashboard_header.js   -->

                    <th><?php echo $metergroupname->metergroupid; ?> : <?php echo $metergroupname->metergroupname; ?></th>
                    <th class="col-1">
                      <?php
                      $mainformattributes = array('class' => 'form-horizontal', 'id' => 'mainform', 'name' => 'mainform');
                      $hiddenform = array('metergroupid' => $metergroupid);
                      echo form_open(base_url() . 'dashboardgroup', $mainformattributes, $hiddenform);
                      ?>
                      <button class="btn btn-sm btn-warning " type="submit" id="btn_submit" name="btn_submit">
                        <i class="fas fa-chevron-left"></i> <i class="fas fa-chevron-left"></i>
                      </button>
                      </form>
                    </th>
                  </tr>


                  <tr style="display: none;">
                    <td width="40%" class="tdnm">Active Energy</td>
                    <td width="45%" class="tdval">
                      <span id="<?php echo 'header_id_val_variable0_' . $metergroupid; ?>">..........</span>
                      <!-- <span id="<?php echo 'header_id_val_variable4_' . $metergroupid; ?>"><?php echo $metergrouprow->active_energy; ?></span> -->

                    </td>
                    <td width="10%" class="tdsat">
                      <span id="<?php echo 'header_id_val_satuan0_' . $metergroupid; ?>">kWh</span>
                    </td>
                  </tr>
                  <tr style="display: none;">
                    <td class="tf " colspan="3">
                      <span class="" id="<?php echo 'header_id_val_dt0_' . $metergroupid; ?>">Date-Time</span>
                    </td>
                  </tr>
                </table>

              </div>
              <!-- </div>  -->
            </div>
            <div class="col-lg-6 col-6 animated ">
            </div>
            <!-- END - DATA HEADER -->


            <?php

            $loop_color = 1;
            $loop_no = 0;
            //foreach ($meter as $dash) {
            foreach ($data_meter_paging as $dash) { // foreach ($data_meter_paging as $dash) 

              $loop_color += 1;
              $loop_no += 1;
              //$loop_color = rand(1,6);
              if ($loop_color == 2) {
                $class_header_box_color = "bg-info";
                $class_header_btn    = "btn-warning";
              } else if ($loop_color == 3) {
                $class_header_box_color = "bg-success";
                $class_header_btn    = "btn-warning";
              } else if ($loop_color == 4) {
                $class_header_box_color = "bg-info";
                $class_header_btn    = "btn-info";
              } else if ($loop_color == 5) {
                $class_header_box_color = "bg-success";
                $class_header_btn    = "btn-warning";
              } else if ($loop_color == 6) {
                $class_header_box_color = "bg-info";
                $class_header_btn    = "btn-warning";
              } else {
                $class_header_box_color = "bg-success";
                $class_header_btn    = "btn-warning";
              }

              // $class_header_box_color = "bg-info";         // tkh

              if ($loop_color > 4) $loop_color = 1;
              $id_meter = $dash->id_meter;
            ?>
              <div class="col-lg-3 col-6 animated ">

                <a href="<?php echo base_url(); ?>variablegraphical?id=<?php echo $dash->id; ?>&idname=<?php echo $dash->id_name; ?>">
                  <div class="small-box <?php echo $class_header_box_color; ?>">
                    <table class="">
                      <tr>
                        <th style="font-size:14px; color:#dfdfdf;">GROUP</th>
                        <th colspan="2" style="font-size:14px;  line-height:14px"><?php echo $dash->metergroupid; ?> / <?php echo $dash->metergroupname; ?></th>

                      </tr>
                      <!-- <tr>
        <th style="font-size:14px; color:#dfdfdf;">NAMA PANEL</th>
        <th colspan="2" style="font-size:14px;  line-height:14px"><?php echo $dash->id_serial; ?></th>
      </tr> -->
                      <tr>
                        <th style="font-size:14px; color:#dfdfdf;">NAMA</th>
                        <th colspan="2" style="font-size:12px; line-height:12px"><?php echo $dash->id_name; ?></th>
                      </tr>
                      <tr>
                        <th style="font-size:14px; color:#dfdfdf;">ID</th>
                        <th colspan="2" style="font-size:12px; line-height:12px"><?php echo $dash->id; ?></th>
                      </tr>
                      <tr>
                        <th style="font-size:14px; color:#dfdfdf;">SERIAL</th>
                        <th colspan="2" style="font-size:12px; line-height:12px"><?php echo $dash->id_serial; ?></th>
                      </tr>
                      <tr>
                        <th style="font-size:14px; color:#dfdfdf;">TYPE</th>
                        <th colspan="2" style="font-size:12px; line-height:12px"><?php echo $dash->type; ?></th>
                      </tr>
                      <!-- <tr>
        <th style="font-size:14px"></th>
        <th colspan="2" style="font-size:12px">ID: <?php echo $dash->id; ?> | Type: <?php echo $dash->type; ?></th>
      </tr> -->

                      <tr>
                        <td width="30%" class="tdnm">Voltage</td>
                        <td width="60%" class="tdval"> <span id="<?php echo 'id_val_variable1_' . $dash->id_meter; ?>">..........</span> </td>
                        <td width="10%" class="tdsat"> <span id="<?php echo 'id_val_satuan1_' . $id_meter; ?>">V</span> </td>
                      </tr>

                      <tr>
                        <td class="tdnm">Current</td>
                        <td class="tdval">
                          <span id="<?php echo 'id_val_variable2_' . $dash->id_meter; ?>">..........</span>
                        </td>
                        <td class="tdsat">
                          <span id="<?php echo 'id_val_satuan2_' . $id_meter; ?>">A</span>
                        </td>
                      </tr>

                      <tr style="display: none;">
                        <td class="tdnm">S Total</td>
                        <td class="tdval">
                          <span id="<?php echo 'id_val_variable3_' . $dash->id_meter; ?>">..........</span>
                        </td>
                        <td class="tdsat">
                          <span id="<?php echo 'id_val_satuan3_' . $id_meter; ?>">KVA</span>
                        </td>
                      </tr>

                      <tr>
                        <td class="tdnm">Power</td>
                        <td class="tdval">
                          <span id="<?php echo 'id_val_variable4_' . $dash->id_meter; ?>">..........</span>
                        </td>
                        <td class="tdsat">
                          <span id="<?php echo 'id_val_satuan4_' . $id_meter; ?>">KW</span>
                        </td>
                      </tr>

                      <tr>
                        <td class="tdnm">Energy</td>
                        <td class="tdval">
                          <span id="<?php echo 'id_val_variable0_' . $dash->id_meter; ?>">..........</span>
                        </td>
                        <td class="tdsat">
                          <span id="<?php echo 'id_val_satuan0_' . $id_meter; ?>">KWh</span>
                        </td>
                      </tr>

                      <tr>
                        <td class="tf" style="text-align: left;">
                          <span><?php echo  $loop_no; ?> </span>
                        </td>
                        <td class="tf" colspan="2">
                          <span class="" id="<?php echo 'id_val_dt0_' . $id_meter; ?>">Date-Time</span>
                        </td>
                      </tr>
                    </table>

                  </div>
                  <!-- </div>  -->

                </a>

              </div>


            <?php
            }   //  foreach ($data_meter_paging as $dash) 
            ?>

          </div>
        </div>
      </div>


    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->