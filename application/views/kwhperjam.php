<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
<link href="<?php echo base_url('assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css');?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url('assets/vendor/select2/select2.min.css');?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url('assets/vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css');?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url('assets/vendor/bootstrap-timepicker/bootstrap-timepicker.min.css');?>" rel="stylesheet" media="screen">
<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
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
            <div class="card-header">
              <h3 class="card-title">
				<i class="fas fa-table"></i>
				<?php echo $title;?>
              </h3>
            </div>

            <div class="card-header" style="background:#EFEFEF;">
              	<?php
				$mainformattributes = array('class' => 'form-horizontal', 'id' => 'mainform', 'name' => 'mainform');
				$hiddenform = array('is_post'=>'1');
				echo form_open(base_url() . 'kwhperjam', $mainformattributes, $hiddenform); 
				?>
		      <div class="row mb-2">
		        <div class="col-sm-3">
		          	<label class="control-label">
						Meter
					</label>
					<select id="meterid" name="meterid" class="js-states  cs-skin-elastic form-control" >	
							<?php foreach($data_meter as $dm){ ?>
								<option value="<?php echo $dm->id ?>" <?php if ($dm->id == $id) echo 'selected' ?>><?php echo $dm->id_name ?></option>
							<?php } ?>
					</select>
					<input type="text" class="" value="<?php echo $id?>"  id="meterid2" name="meterid2" style="display:none;">
		        </div>
		        <div class="col-sm-2">
		          	<label class="control-label">
						Mode
					</label>
					<select id="mode" name="mode" class="js-states  cs-skin-elastic form-control" >
						<option value="Cummulative" <?php if ($mode == 'Cummulative') echo 'selected';?>>Cummulative</option>
						<option value="Difference" <?php if ($mode == 'Difference') echo 'selected';?>>Difference</option>
					</select>
		        </div>		
		        <div class="col-sm-2">
		          	<label class="control-label">
						Date
					</label>
					<select id="dateselected" name="dateselected" class="js-states  cs-skin-elastic form-control" >
							<?php if (date('Y-m-d', strtotime($dateselected . " +6 days")) <= date('Y-m-d')) { ?>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " +6 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " +6 days"))?></option>
							<?php }?>
							<?php if (date('Y-m-d', strtotime($dateselected . " +5 days")) <= date('Y-m-d')) { ?>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " +5 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " +5 days"))?></option>
							<?php }?>
							<?php if (date('Y-m-d', strtotime($dateselected . " +4 days")) <= date('Y-m-d')) { ?>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " +4 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " +4 days"))?></option>
							<?php }?>
							<?php if (date('Y-m-d', strtotime($dateselected . " +3 days")) <= date('Y-m-d')) { ?>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " +3 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " +3 days"))?></option>
							<?php }?>
							<?php if (date('Y-m-d', strtotime($dateselected . " +2 days")) <= date('Y-m-d')) { ?>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " +2 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " +2 days"))?></option>
							<?php }?>
							<?php if (date('Y-m-d', strtotime($dateselected . " +1 days")) <= date('Y-m-d')) { ?>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " +1 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " +1 days"))?></option>
							<?php }?>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected))?>" selected><?php echo date('Y-m-d', strtotime($dateselected))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -1 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -1 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -2 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -2 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -3 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -3 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -4 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -4 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -5 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -5 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -6 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -6 days"))?></option>
							
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -7 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -7 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -8 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -8 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -9 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -9 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -10 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -10 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -11 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -11 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -12 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -12 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -13 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -13 days"))?></option>
							
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -14 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -14 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -15 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -15 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -16 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -16 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -17 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -17 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -18 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -18 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -19 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -19 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -20 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -20 days"))?></option>
							
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -21 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -21 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -22 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -22 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -23 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -23 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -24 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -24 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -25 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -25 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -26 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -26 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -27 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -27 days"))?></option>
							
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -28 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -28 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -29 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -29 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -30 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -30 days"))?></option>
							<option value="<?php echo date('Y-m-d', strtotime($dateselected . " -31 days"))?>"><?php echo date('Y-m-d', strtotime($dateselected . " -31 days"))?></option>
							
					   </select>
		        </div>

				<div class="col-sm-2">
		          	<label class="control-label">
						Show Label
					</label>
					<select id="showpointvalue" name="showpointvalue" class="js-states  cs-skin-elastic form-control" >
						<option value="1" <?php if ($showpointvalue == 1) echo 'selected';?>>Show</option>
						<option value="0" <?php if ($showpointvalue == 0) echo 'selected';?>>Hide</option>
					</select>
		        </div>

		        <div class="col-sm-1">
		          	<label class="control-label">
						&nbsp;<br>&nbsp;
					</label>
					<button class="btn btn-md btn-info btn-flat" type="submit" id="btn_submit" name="btn_submit" style="margin-top:24px;">
		              <i class="fas fa-search"></i>
		            </button>
		        </div>

		      </div>
				</form>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

				<div class="row">
					<div class="col-md-12" >
					
						<div id="energy_trend" style="min-width: 310px; height: 450px; margin: 0 auto"></div>
						</div>
						
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

<script type="text/javascript">

Highcharts.chart('energy_trend', {
    chart: {
        type: 'line',
		zoomType: 'xy'
    },
    title: {
        text: 'GRAFIK PEMAKAIAN KWH PERJAM'
    },
    subtitle: {
        text: '<?php echo $id_name . " : Mode " .  $mode . " : Date " . $dateselected?>'
    },
    xAxis: {
        categories: [<?php echo $jam_graph;?>]
    },
    yAxis: {
		labels: {
			formatter: function() {
			       return this.value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
			    }
		},
        title: {
            text: '<?php echo $satuan;?>'
        }
    },
    <?php
	if ($showpointvalue==1) {
	?>
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
	<?php
	} else {
	?>
	plotOptions: {
        line: {
            dataLabels: {
                enabled: false
            },
            enableMouseTracking: false
        }
    },
	<?php
	}
	?>
    series: [{
        name: 'KWh',
        data: [<?php echo $kwh_graph;?>]
    }]
});
</script>		
	
	

	

	
