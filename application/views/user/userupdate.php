
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		
		
		
				<div class="main-content" style="background:#B40000; " >
					<div class="row" style="background:#FFFFFF;height:100%;">
						<div class="col-md-3" style="background:#E7E7E7;height:100%; min-height:500px;" >
							<div class="container">
								<br />
								<form role="form">
									<div class="form-group">
										<label for="username">
											Username
										</label>
										<input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
									</div>
									<div class="form-group">
										<label for="Password">
											Password
										</label>
										<input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
									</div>
									<div class="form-group">
										<label for="ConfirmPassword">
											Confirm Password
										</label>
										<input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password">
									</div>
									<div class="form-group">
										<label for="name">
											Your Name
										</label>
										<input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name">
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">
											Email address
										</label>
										<input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
									</div>
									<label for="level">
										Level
									</label>
									<br />
									<div class="radio clip-radio radio-primary radio-inline">
										<input type="radio" id="level1" name="level" value="USR">
										<label for="level1">
											Admin
										</label>
									</div>
									<div class="radio clip-radio radio-primary radio-inline">
										<input type="radio" id="level2" name="level" value="ADM" checked="checked">
										<label for="level2">
											User
										</label>
									</div>
									<br />
									<label for="Aktif">
										Aktif
									</label>
									<br />
									<div class="radio clip-radio radio-success radio-inline">
										<input type="radio" id="aktif1" name="aktif" value="Y" checked="checked">
										<label for="aktif1">
											Ya
										</label>
									</div>
									<div class="radio clip-radio radio-primary radio-inline">
										<input type="radio" id="aktif2" name="aktif" value="N">
										<label for="aktif2">
											Tidak
										</label>
									</div>
									<br />
									<button type="button" class="btn btn-danger btn-o btn-block" id="send" name="send">
										<i class="ti-server"></i>&nbsp; Create User
									</button>
								</form>
								<br />
								<br />
								<br />
								<br />
								<br />
							</div>
						</div>
						<div class="col-md-9" style="background:#ffffff;">
							<div class="container" style="#1F59A8;">
								<div class="row">
									<div class="col-md-12">
										<table class="table datatable-fixed-both" width="100%">
											<thead>
						        				<tr class="bg-red">
						            				<th><b style="color:#FFFFFF;">USERNAME</b></th>
						            				<th><b style="color:#FFFFFF;">NAME</b></th>
						            				<th><b style="color:#FFFFFF;">EMAIL</b></th>
						            				<th><b style="color:#FFFFFF;">LEVEL</b></th>
						            				<th><b style="color:#FFFFFF;">ACTIVE</b></th>
						            				<th><b style="color:#FFFFFF;">ACTION</b></th>
						        				</tr>
						    				</thead>
						    				<tbody>
											<?php foreach($user as $u){ ?>
						        				<tr>
						            				<td><?php echo $u->username ?></td>
						            				<td><?php echo $u->nama ?></td>
						            				<td><?php echo $u->email ?></td>
						            				<td><?php echo $u->level ?></td>
						            				<td><?php echo $u->aktif ?></td>
						            				<td>
                                            			<a href="<?=site_url('userupdate/'.$u->id_user);?>" class="btn btn-warning btn-o  btn-sm" ><i class="ti-pencil-alt"></i></a>
                                            			
                                            			<a href="<?=site_url('user/delete/'.$u->id_user);?>" class="btn btn-danger btn-o  btn-sm" onClick="return doconfirm();"><i class="ti-trash"></i></a>
                                        
													</td>
												</tr>
											<?php } ?>
						    				</tbody>
										</table>
									
									
									
									
									</div>
								</div>
							</div>	
						</div>
					
					</div>
					
			</div>