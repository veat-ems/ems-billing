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
							<h3 class="card-title">
								<i class="fas fa-user"></i>
								<?php echo $title; ?>
							</h3>
						</div>
						<div class="row">
							<div class="col-8">
								<!-- /.card-header -->
								<div class="card-body">

									<form action="<?php echo base_url('user/create'); ?>" method="post" role="form" id="formcreate">
										<div class="form-group">
											<label for="username">
												Username
											</label>
											<input type="text" class="form-control" id="username" name="username" value="<?php echo set_value('username'); ?>" placeholder="Enter Username">
											<span class="text-warning"><?php echo form_error('username'); ?></span>
										</div>
										<div class="form-group">
											<label for="Password">
												Password
											</label>
											<input type="password" class="form-control" id="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Password">
											<span class="text-warning"><?php echo form_error('password'); ?></span>
										</div>
										<div class="form-group">
											<label for="ConfirmPassword">
												Confirm Password
											</label>
											<input type="password" class="form-control" id="password2" name="password2" value="<?php echo set_value('password2'); ?>" placeholder="Confirm Password">
											<span class="text-warning"><?php echo form_error('password2'); ?></span>
										</div>
										<div class="form-group">
											<label for="name">
												Your Name
											</label>
											<input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name'); ?>" placeholder="Enter Your Name">
											<span class="text-warning"><?php echo form_error('name'); ?></span>
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">
												Email address
											</label>
											<input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="Enter email">
											<span class="text-warning"><?php echo form_error('email'); ?></span>
										</div>
										<label for="level">
											Level
										</label>
										<br />
										<div class="radio clip-radio radio-primary radio-inline">
											<input type="radio" id="level1" name="level" value="ADM">
											<label for="level1">
												Admin
											</label>
										</div>
										<div class="radio clip-radio radio-primary radio-inline">
											<input type="radio" id="level2" name="level" value="USR" checked="checked">
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

										<div class="row">
											<div class="col-md-4 col-sm-12">
											</div>
											<?php if ($this->session->userdata('level') == "ADM") { ?>
												<div class="col-md-2 col-sm-6">
													<button class="btn btn-md btn-info btn-flat float-right" type="submit" id="send" name="send">
														Save&nbsp;&nbsp;<i class="fa fa-save"></i>
													</button>
												</div>
											<?php } ?>
											<div class="col-md-2 col-sm-6">
												<button class="btn btn-md btn-warning btn-flat float-left" type="button" onClick="javascript:history.back();">
													Cancel&nbsp;&nbsp;<i class="fa fa-chevron-left"></i>
												</button>
											</div>
											<div class="col-md-4 col-sm-12">
											</div>
										</div>

									</form>
								</div>
							</div>

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