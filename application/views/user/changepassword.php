<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper dark-mode">
  <!-- Content Header (Page header) -->
  <section class="content-header">
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
            <div class="card-header bg-gradient-dark">
				<h3 class="card-title">
					<i class="fas fa-user"></i>
					<?php echo $title;?>
				</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">


				<form action="<?php echo base_url('user/changepassword');?>" method="post" role="form" id="formcreate">
					<div class="form-group">
						<label for="username">
							Username 
						</label>
						<input type="text" class="form-control" id="username" name="username"  value="<?php echo set_value('username', $username); ?>" placeholder="Enter Username" readonly="readonly">
						<span class="text-warning" ><?php echo form_error('username'); ?></span>
					</div>
					<div class="form-group">
						<label for="Password">
							Password
						</label>
						<input type="password" class="form-control" id="password" name="password"  value="<?php echo set_value('password'); ?>" placeholder="Password">
						<span class="text-warning" ><?php echo form_error('password'); ?></span>
					</div>
					<div class="form-group">
						<label for="ConfirmPassword">
							New Password
						</label>
						<input type="password" class="form-control" id="passwordnew" name="passwordnew"  value="<?php echo set_value('password2'); ?>" placeholder="New Password">
						<span class="text-warning" ><?php echo form_error('passwordnew'); ?></span>
					</div>

					
					<div class="row">
						<div class="col-md-4 col-sm-12">
						</div>
						<div class="col-md-2 col-sm-6">
							<button class="btn btn-md btn-info btn-flat float-right" type="submit" id="send" name="send">
								Save&nbsp;&nbsp;<i class="fa fa-save"></i>
							</button>
						</div>
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

