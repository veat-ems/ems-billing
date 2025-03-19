
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



		<div class="main-content bg-dark-red" style="" id="trend" >
			<div class="container bg-dark-red" id="container" style="color:#ffffff; height:55px;">
					<div class="row">
						<form action="<?php echo base_url('tabelperjam/printexcel');?>" method="post" role="form" class="form-horizontal">
							  <div class="col-md-4">
							 	 <div class="row">
								 	 <div class="col-md-12">
										  <div class="form-group">
											  <label class="col-sm-4 control-label" style="color:#ffffff;">
													METER NAME:
											  </label>
											  <div class="col-sm-8">
											  	   
												   <select id="meterid" name="meterid" class="js-states  cs-skin-elastic form-control" >
															
														<?php foreach($data_meter as $dm){ ?>
															<option value="<?php echo $dm->id ?>"><?php echo $dm->id_name ?></option>
														<?php } ?>
												   </select>
											  </div>
										  </div>
									  </div>
								  </div>
							 </div>
							 <div class="col-md-4">	
							 	 <div class="row">
								 	 <div class="col-md-3">
									 	 <div class="form-group">
										 	 <label class="col-sm-11 control-label" style="color:#ffffff;" >
											 	DATE:
											 </label>
										  </div>
									 	 
									 </div>	
									 <?php
									 
									 	 $harini = date('Y-m-d');
									 
									 ?>	
								 	 <div class="col-md-9">
									 	 <p class="input-group input-append datepicker date">
										 	<input type="text" class="form-control" value="<?php echo $harini;?>"  id="tanggal" name="tanggal">
											<span class="input-group-btn">
												<button type="button" class="btn btn-default">
													<i class="glyphicon glyphicon-calendar"  style="color:#B40000;"></i>
												</button> 
											</span>
										 </p>
									 </div>
								 </div>
							 </div>
							 <div class="col-md-4">
							 	 <div class="row">
								 	 <div class="col-md-6">
        								
										<button type="button" class="btn btn-light-azure btn-block" id="btnView" name="btnView">
        									<i class="ti-target"></i>&nbsp; View
        								</button>
									 </div>	
								 	 <div class="col-md-6">
        								<button type="submit" class="btn btn-success btn-block" id="btnXls" name="btnXls">
        									<i class="ti-target"></i>&nbsp; Excel
        								</button>
									 </div>	
								 </div>
							 </div>
							 
							 
						</form>
					</div>
			</div>
			<div class="row" style="background:#FFFFFF;">
				<div class="col-md-12" style="background:#ffffff;">
					<div class="container" style="#1F59A8;">
						<div id="test"></div>
						<div id="test1"></div>
						<div id="test2"></div>
						<div id="test3"></div>
						<div id="test4"></div>
						
						<div class="row">
							<div class="col-md-12" >
							
								<div id="datameter">
        						<table class="table datatable-tabel-per-jam">
        							<thead>
        								<tr  class="bg-red">
        					                <th><b style="color:#FFFFFF;">METER NAME</b></th>
        					                <th><b style="color:#FFFFFF;">TANGGAL</b></th>
        					                <th><b style="color:#FFFFFF;">JAM</b></th>
        					                <th><b style="color:#FFFFFF;">KWH</b></th>
        					                
        					            </tr>
        							</thead>
        							<tbody>
        							</tbody>
        						</table>
								</div>
								
							</div>
						</div>
						<div style="height:100px;"></div>
					</div>	
				</div>
			
			</div>
			
	</div>