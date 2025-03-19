
		
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
		
		
		
		
				<div class="main-content" style="background:#B40000; " >
					<div class="container" id="container" style="background:#B40000; color:#ffffff; height:55px;">
							
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
											 
											 	 $harini = date('d-m-Y');
											 
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
						<div class="col-md-2" style="background:#E7E7E7;height:100%; min-height:500px;" >
							<div class="container">
								<br />
								<button type="button" class="btn btn-light-azure btn-block button1" id="btnView" name="btnView">
									<i class="ti-target"></i>&nbsp; View Trending
								</button>
								<button type="button" class="btn btn-warning btn-block" id="btnPrint" name="btnPrint">
									<i class="ti-printer"></i>&nbsp; Print View
								</button>
								
								<a href="#" onclick="$('#datatableku').tableExport({type:'excel',tableName:'Report XLS',escape:'false'});"  class="btn btn-green btn-block "><i class="fa fa-file-excel-o"></i>&nbsp; Export To Excel</a>
								<a href="#" onclick="$('#datatableku').tableExport({type:'pdf',tableName:'Report PDF',escape:'false'});"  class="btn btn-red btn-block "><i class="fa fa-file-pdf-o"></i>&nbsp; Export To PDF</a>
								<br />
								<div class="radio clip-radio radio-primary">
														<input type="radio" id="radio3" name="vertical" value="radio3">
														<label for="radio3">
															Monthly
														</label>
								</div>
								<div class="radio clip-radio radio-primary">
														<input type="radio" id="radio4" name="vertical" value="radio4">
														<label for="radio4">
															Daily
														</label>
								</div>
								<div class="radio clip-radio radio-primary">
														<input type="radio" id="radio5" name="vertical" value="radio5" checked="checked">
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
									
						<div id="cobacoba">
								 <table id="datatableku"  class="table datatableku">
								 		<thead>
											  <tr class='bg-red'  id="headku">
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