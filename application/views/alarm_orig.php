<style>
.baru a {

	  color:#FFFFFF;
	  background:#0000FF;
	   
 }
</style>
		
				<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<div class="container-fluid container-fullw ">
							<div class="row">
								
								<div class="col-md-12">
									<div class="panel panel-white no-radius">
										<div class="panel-heading border-light bg-dark-red" style="">
											<h4 class="panel-title" style="color:#FFFFFF;">ALARM</h4>
											
										</div>
										<div class="panel-body">
								
											<table class="table datatable-fixed-both" width="100%">
							<thead>
						        <!-- <tr  class="bg-red">
						            <th><b style="color:#FFFFFF;">ID</b></th>
						            <th><b style="color:#FFFFFF;">OVER VOLTAGE</b></th>
						            <th><b style="color:#FFFFFF;">UNDER VOLTAGE</b></th>
						            <th><b style="color:#FFFFFF;">OVER CURRENT</b></th>
						            <th><b style="color:#FFFFFF;">UNDER CURRENT</b></th>
						        </tr>-->
						        <tr  class="bg-red">
						            <th></th>
						            <th></th>
						            <th></th>
						            <th></th>
						            <th></th>
						        </tr>
						    </thead>
						    <tbody>
							<?php foreach($data_teg as $dt){ ?>
						        <tr>
						            <td><?php echo $dt->id ?></td>
						            <td><?php echo $dt->uvlimit ?></td>
						            <td><?php echo $dt->ovlimit ?></td>
						            <td><?php echo $dt->uclimit ?></td>
						            <td><?php echo $dt->oclimit ?></td>
								</tr>
							<?php } ?>
						    </tbody>
						</table>

										</div>
									</div>
									
								</div>

							</div>
						</div>
						<!-- end: RESPONSIVE TABLE -->
					</div>
				</div>