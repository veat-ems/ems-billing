<style>
table {
  /* border-collapse: collapse; */
  width: 100%;
  vertical-align:  middle;
  /* position: relative; */
  color: white;
  padding: 50px 50px 50px 50px;
}

boxed {
  font-family: Arial, Helvetica, sans-serif;
  width: 150px;
  /* height: 200px; */
  /* margin: auto; */
  color: white;
  border-radius: 10px;
  display: inline-block;
  padding: 50px 50px 50px 50px;
 
}

th, td {
  padding: 3px 10px 3px 10px;
  font-size: 12px;  
 
}



th {
  /*background-color: #555;*/
  border-radius: 10px 10px 0px 0px; 
  letter-spacing: 1px;
  height: 30px;
  font-size: 22px;  
  /* color: rgb(193, 243, 193); */
  text-align: left;

}

td {
  /* color: white; */
  border: 0.01px solid  rgb(56, 61, 58);
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
text-align:right; 
background-color: #CFCFCF;
height: 20px;
font-size: 12px;  
border: none;
border-bottom: solid 1px #999999;
color: #000000;
}

.tdval {
text-align:right; 
background-color: #BEBEBE;
height: 20px;
font-size: 18px;
border: none;  
border-bottom: solid 1px #999999;
color: #000000;
}

.tdsat {
text-align:right; 
background-color: #ACACAC;
height: 20px;
font-size: 12px;
border: none;
border-bottom: solid 1px #999999;
color: #ffcc00;
}

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Overview</h1>
        </div>
        <div class="col-sm-6 float-right" style="text-align:right;">
          	<?php echo $pagination;?>
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
			
			$loop_color = 0;
			//foreach ($meter as $dash) {
			foreach ($data_meter_paging as $dash) {
			
			$loop_color += 1;
			//$loop_color = rand(1,6);
			if ($loop_color == 2) {
				$class_header_box_color = "bg-info"; 
			} else if ($loop_color == 3) {
				$class_header_box_color = "bg-success"; 
			} else if ($loop_color == 4) {
				$class_header_box_color = "bg-warning"; 
			} else if ($loop_color == 5) {
				$class_header_box_color = "bg-danger";
			} else if ($loop_color == 6) {
				$class_header_box_color = "bg-primary";
			} else {
				$class_header_box_color = "bg-teal"; 
			}
			
			if ($loop_color >= 4) $loop_color = 0;
            $id_meter = $dash->id_meter;
          ?>
				
                <div class="col-lg-3 col-6 animated ">
                        
                        
                        <a href="<?php echo base_url(); ?>variablegraphical?id=<?php echo $dash->id; ?>&idname=<?php echo $dash->id_name; ?>">
							<div class="small-box <?php echo $class_header_box_color;?>">
								<table class="">
	                                  <tr>
	                                    <th class="th small-box-footer" colspan="3" > <?php echo $dash->id_name; ?></th>
	                                  </tr>
	                                  <tr>
	                                  		<td width="15%" class="tdnm" >WBP</td>
		                                    <td width="70%" class="tdval">
		                                        <span id="<?php echo 'val_kwh1_' . $dash->id_meter; ?>">00000000</span>
		                                    </td>
		                                    <td width="10%" class="tdsat" >
		                                        <span id="<?php echo 'satuan1_' . $id_meter; ?>">kWh</span>
		                                    </td>
	                                  </tr>
	                                  <tr>
	                                    	<td class="tdnm" >LWBP</td>
		                                    <td class="tdval">
		                                        <span id="<?php echo 'val_kwh2_' . $dash->id_meter; ?>">00000000</span>
		                                    </td>
		                                    <td class="tdsat" >
		                                        <span id="<?php echo 'satuan2_' . $id_meter; ?>">kWh</span>
		                                    </td>
	                                  </tr>
	                                  <tr>
	                                      	<td class="tdnm" >TOTAL</td>
		                                      <td class="tdval">
		                                        <span id="<?php echo 'val_kwh_' . $dash->id_meter; ?>">00000000</span>
		                                      </td>
		                                      <td class="tdsat" >
		                                        <span id="<?php echo 'satuan_' . $id_meter; ?>">kWh</span>
		                                      </td>
	                                  </tr>
	                                  <tr>
	                                  		<td class="tf small-box-footer" colspan="3">
			                                  <span class="small-box-footer" id="<?php echo 'dt_back_' . $id_meter; ?>">Date-Time</span>                                                              
	                                  		</td>
	                                  </tr>
								</table>
								
							</div>
                            <!-- </div>  -->

                        </a>
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
          	<?php echo $pagination;?>
        </div>
	</div>

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->