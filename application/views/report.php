<style>

.conbar {

		margin-left:300px;
		width:200px;
		right:0px;


}


</style>
		
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link href="<?php echo base_url('assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css');?>" rel="stylesheet" media="screen">
		<link href="<?php echo base_url('assets/vendor/select2/select2.min.css');?>" rel="stylesheet" media="screen">
		<link href="<?php echo base_url('assets/vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css');?>" rel="stylesheet" media="screen">
		<link href="<?php echo base_url('assets/vendor/bootstrap-timepicker/bootstrap-timepicker.min.css');?>" rel="stylesheet" media="screen">
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link href="<?php echo base_url('assets/vendor/sweetalert/sweet-alert.css');?>" rel="stylesheet" media="screen">
		<link href="<?php echo base_url('assets/vendor/sweetalert/ie9.css');?>" rel="stylesheet" media="screen">
		<link href="<?php echo base_url('assets/vendor/toastr/toastr.min.css');?>" rel="stylesheet" media="screen">
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		
		
		
		
				<div class="main-content bg-dark-red" style=" " >
					<div class="container bg-dark-red" id="container" style=" color:#ffffff; height:55px;">
							<div id="testku"></div>
							<div class="row">
								<form role="form" class="form-horizontal">
									 <div class="col-md-6">
									 	 <div class="row">
										 	 <div class="col-md-5">
											 	 <div class="form-group">
												 	 <label class="col-sm-2 control-label" style="color:#ffffff;">
																ID:
													 </label>
													 <div class="col-sm-10">
														<select class="js-state form-control" id="id2" name="id2">
															<option value="All">All</option>
														<?php foreach($data_meter as $dm){ ?>
															<option value="<?php echo $dm->id ?>"><?php echo $dm->id ?></option>
														<?php } ?>
														</select>
													 </div>
												  </div>
											 </div>	
										 	 <div class="col-md-7">
											 	 <div class="form-group">
												 	 <label class="col-sm-5 control-label" style="color:#ffffff;">
																PARAMETER:
													 </label>
													 <div class="col-sm-7">
														<select class="js-state form-control"  id="parameter" name="parameter">
															<option value="All">All</option>
															
														<?php foreach($parameter as $prm){ ?>
															<option value="<?php echo $prm->nama ?>"><?php echo $prm->nama ?></option>
														<?php } ?>															
														</select>
													 </div>
												  </div>
											 </div>	
										 </div>
									 </div>
									 <div class="col-md-6">
									 	 <div class="row">
										 	 <div class="col-md-3">
											 	 <div class="form-group">
												 	 <label class="col-sm-11 control-label" style="color:#ffffff;" >
													 	DATE/TIME:
													 </label>
												  </div>
											 	 
											 </div>
											 <?php
											 
											 	 $harini = date('Y-m-d');
												 // $harini = '2017-08-29';
											 
											 ?>	
										 	 <div class="col-md-4">
											 	 <p class="input-group input-append datepicker date">
												 	<input type="text"  class="form-control" value="<?php echo $harini;?>" id="dari" name="dari">
													<span class="input-group-btn">
														<button type="button" class="btn btn-default">
															<i class="glyphicon glyphicon-calendar"  style="color:#B40000;"></i>
														</button> 
													</span>
												 </p>
											 </div>	
										 	 <div class="col-md-1">
											 	 <div class="form-group" align="center">
												 	 <label class="col-sm-8 control-label" style="color:#ffffff;" >
													 	s/d
													 </label>
												  </div>
											 </div>	
										 	 <div class="col-md-4">
											 	 <p class="input-group input-append datepicker date">
												 	<input type="text" class="form-control" value="<?php echo $harini;?>" id="sampai" name="sampai">
													<span class="input-group-btn">
														<button type="button" class="btn btn-default">
															<i class="glyphicon glyphicon-calendar"  style="color:#B40000;"></i>
														</button> 
													</span>
												 </p>
											 </div>	
										 </div>
									 </div>
								</form>
							</div>
					</div>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					<div class="row" style="background:#FFFFFF;height:100%;">
						<div class="col-md-2" style="background:#E7E7E7;height:100%; min-height:1000px;" >
							<div class="container">
								<br />
								<button type="button" class="btn btn-light-azure btn-block button1" id="btnView" name="btnView">
									<i class="ti-target"></i>&nbsp; View Trending
								</button>
								<!-- <button type="button" class="btn btn-warning btn-block" id="btnPrint" name="btnPrint">
									<i class="ti-printer"></i>&nbsp; Print View
								</button> -->
								
								<a href="#" onclick="$('#table2').tableExport({type:'excel',tableName:'Report XLS',escape:'false'});"  class="btn btn-green btn-block "><i class="fa fa-file-excel-o"></i>&nbsp; Export To Excel</a>
								<a href="#" onclick="$('#table2').tableExport({type:'pdf',tableName:'Report PDF',escape:'false'});"  class="btn btn-red btn-block "><i class="fa fa-file-pdf-o"></i>&nbsp; Export To PDF</a>
								<br />
								<div class="radio clip-radio radio-primary">
														<input type="radio" id="radio3" name="tempo" value="Monthly">
														<label for="radio3">
															Monthly
														</label>
								</div>
								<div class="radio clip-radio radio-primary">
														<input type="radio" id="radio4" name="tempo" value="Daily">
														<label for="radio4">
															Daily
														</label>
								</div>
								<div class="radio clip-radio radio-primary">
														<input type="radio" id="radio5" name="tempo" value="Date Between" checked="checked">
														<label for="radio5">
															Date Between
														</label>
								</div>
								<br />
								<button type="button" class="btn btn-warning btn-block" id="btnViewall" name="btnViewall">
									View All Parameter
								</button>
								<button type="button" class="btn btn-danger btn-block">
									<i class="ti-server"></i>&nbsp; Create Database
								</button>
								<br />
								<br />
								<br />
								<br />
							</div>
						</div>
						<div class="col-md-10" style="background:#ffffff;">
							<div class="container" style="#1F59A8;">
								<div class="row">
									<div class="col-md-12">
									<div id="testtempo"></div>
						<div id="table_report">					
						<table  id="table2" class="table datatable-fixed-both" width="100%">
							<thead>
						        <tr class="bg-red" >
						            <th><b style="color:#FFFFFF;">NO.</b></th>
						            <th><b style="color:#FFFFFF;">ID LINE</b></th>
						            <th><b style="color:#FFFFFF;">TIME</b></th>
						            <th><b style="color:#FFFFFF;">COM</b></th>
						            <th><b style="color:#FFFFFF;">DEV</b></th>
						            <th><b style="color:#FFFFFF;">TYPE</b></th>
						            <th><b style="color:#FFFFFF;">STATUS</b></th>
						            <th><b style="color:#FFFFFF;">V1</b></th>
						            <th><b style="color:#FFFFFF;">V2</b></th>
						            <th><b style="color:#FFFFFF;">V3</b></th>
						            <th><b style="color:#FFFFFF;">V12</b></th>
						            <th><b style="color:#FFFFFF;">V23</b></th>
						            <th><b style="color:#FFFFFF;">V31</b></th>
						            <th><b style="color:#FFFFFF;">I-1</b></th>
						            <th><b style="color:#FFFFFF;">I-2</b></th>
						            <th><b style="color:#FFFFFF;">I-3</b></th>
						            <th><b style="color:#FFFFFF;">I-N</b></th>
						            <th><b style="color:#FFFFFF;">WATT1</b></th>
						            <th><b style="color:#FFFFFF;">WATT2</b></th>
						            <th><b style="color:#FFFFFF;">WATT3</b></th>
						            <th><b style="color:#FFFFFF;">WATT</b></th>
						            <th><b style="color:#FFFFFF;">VA1</b></th>
						            <th><b style="color:#FFFFFF;">VA2</b></th>
						            <th><b style="color:#FFFFFF;">VA3</b></th>
						            <th><b style="color:#FFFFFF;">VA</b></th>
						            <th><b style="color:#FFFFFF;">FREQ</b></th>
						            <th><b style="color:#FFFFFF;">FP1</b></th>
						            <th><b style="color:#FFFFFF;">FP2</b></th>
						            <th><b style="color:#FFFFFF;">FP3</b></th>
						            <th><b style="color:#FFFFFF;">kWh Imp</b></th>
						            <th><b style="color:#FFFFFF;">kWh Exp</b></th>
						            <th><b style="color:#FFFFFF;">kVARh Imp</b></th>
						            <th><b style="color:#FFFFFF;">kVARh Exp</b></th>
						            <th><b style="color:#FFFFFF;">kVAh</b></th>
						            <th><b style="color:#FFFFFF;">THD V1</b></th>
						            <th><b style="color:#FFFFFF;">THD V2</b></th>
						            <th><b style="color:#FFFFFF;">THD V3</b></th>
						            <th><b style="color:#FFFFFF;">THD I1</b></th>
						            <th><b style="color:#FFFFFF;">THD I2</b></th>
						            <th><b style="color:#FFFFFF;">THD I3</b></th>
						        </tr>
						    </thead>
						    <tbody>
						    </tbody>
						</table>
						</div>				
								
									
									</div>
								</div>
							</div>	
						</div>
					
					</div>
					
			</div>