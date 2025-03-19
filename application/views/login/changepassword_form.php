<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
    	<?php echo $title?>
	</h1>
	<ol class="breadcrumb">
    	<li><a href="<?php echo page_url();?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
    	<li class="active">Change Password</li>
  	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
	
			<div class="box box-info">
				<div class="box-header " >
					<h3 class="box-title"><?php echo '&nbsp;'?></h3>
					&nbsp;
				</div>
        		<!-- /.box-header -->

				<div class="box-body">
 

					<div class="row">
						<div class="col-xs-12">
							<div class="col-xs-10">

								<?php 
								if (!empty($message)): ?>
									<div class="alert alert-error">
										<a class="close" data-dismiss="alert">&nbsp;</a>
										<?php echo $message; ?>
									</div>
								<?php endif; ?>

								<?

								if ($message != 'Your password has been changed.') {

								$f_password_old		= array('name'=>'password_old', 'id'=>'password_old', 'class'=>'col-xs-11','value'=>set_value('password_old',''));
								$f_password_new		= array('name'=>'password_new', 'id'=>'password_new', 'class'=>'col-xs-11','value'=>set_value('password_new',''));
								$f_password_conf	= array('name'=>'password_conf', 'id'=>'password_conf', 'class'=>'col-xs-11','value'=>set_value('password_conf',''));

								echo form_open(page_url() . 'login/changepassword'); 
								?>
								<div class="row">
									<div class="col-xs-3">Old Password</div>
									<div class="col-xs-4">&nbsp;
										<?php echo form_password($f_password_old);?>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-3">New Password</div>
									<div class="col-xs-4">&nbsp;
										<?php echo form_password($f_password_new);?>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-3">New Password (Again)</div>
									<div class="col-xs-4">&nbsp;
										<?php echo form_password($f_password_conf);?>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-xs-3">&nbsp;</div>
									<div class="col-xs-4">&nbsp;
										<button type="submit" class="btn btn-xs btn-success" >Save&nbsp;<i class="fa fa-plus"></i></button>&nbsp;
										<button type="button" class="btn btn-xs btn-warning" onclick='history.back();' >Cancel&nbsp;<i class="fa fa-remove"></i></button>&nbsp;
									</div>
								</div>

								<?
								echo form_close();


								}
								?>

							</div>

						</div>
					</div>


				</div>
				<!-- /.box-body -->
				
			</div>
			<!-- /.box -->

		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>
<!-- /.content -->