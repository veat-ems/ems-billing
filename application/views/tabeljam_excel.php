<?php 

$namafile = 'Data_KWH_perJam_'.date('d-m-Y_H-i-s');

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$namafile.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<!-- Template Name: Clip-Two - Responsive Admin Template build with Twitter Bootstrap 3.x | Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
		<title><?php echo $title;?></title>
		<!-- start: META -->

<style>
body {font-family: sans-serif;
	font-size: 10pt;
}
p {	margin: 0pt; }
table.items {
	border: 0.1mm solid #ffffff;
}
td { vertical-align: middle; height:30px; padding-left:10px;}
th { vertical-align: middle; height:40px; padding-left:10px;}
.items td {
	border-left: 0.1mm solid #ffffff;
	border-right: 0.1mm solid #ffffff;
	border-bottom: 0.1mm solid #ffffff;
	height:30px;
}
table thead th { background-color: #00584E;
	text-align: center;
	border: 0.1mm solid #ffffff;
	font-variant: small-caps;
}
.items td.blanktotal {
	background-color: #EEEEEE;
	border: 0.1mm solid #ffffff;
	background-color: #FFFFFF;
	border: 0mm none #ffffff;
	border-top: 0.1mm solid #ffffff;
	border-right: 0.1mm solid #ffffff;
}
.items td.totals {
	text-align: right;
	border: 0.1mm solid #ffffff;
}
.items td.cost {
	text-align: "." right;
}
.bggenap{
	background:#E7E7E7;
 }

.bgganjil{
	background:#FFFFFF;
 }
 

.bgfooter{
	background:#086C50;
	color:#ffffff;
	font-size:16px;
	font-weight:bold;
 }
</style>
<style> .str{ mso-number-format:\@; } </style>

		
	</head>
	<!-- end: HEAD -->
    <body>
	
    
    <table width="100%">
    	<thead>
            <tr>
              <td colspan="4" style="font-size:20px; font-weight:bold; text-align:center;">ENERGY MONITORING SYSTEM	</td>
            </tr>
            <tr>
              <td colspan="4" style="font-size:14px; font-weight:bold; text-align:center;">TANGGAL <?php echo $tanggal ?></td>
            </tr>
    	</thead>
    </table>
	<br />
	<table style="width:100%;">
       <thead>
            <tr>
               <th class="bg-red"><b style="color:#FFFFFF;">METER NAME</b></th>
               <th class="bg-red"><b style="color:#FFFFFF;">TANGGAL</b></th>
               <th class="bg-red"><b style="color:#FFFFFF;">JAM</b></th>
               <th class="bg-red"><b style="color:#FFFFFF;">KWH</b></th>
               
            </tr>
        </thead>
        <tbody style="font-size:14px;">
<?php 
    $no = 1;
if($data!='KOSONG'){
	$datafield = json_decode($data);
	
    foreach($datafield as $od){ 
      		if ($no%2 == 0){
      		   $trbg = 'bggenap';
      		}
      		else{
      		   $trbg = 'bgganjil';
      		}
     
?> 
			
			<tr class="<?php echo $trbg;?>">
                <td><?php echo $od->panel ?></td>
                <td><?php echo tgl_indolengkap($od->tanggal); ?></td>
                <td><?php echo $od->jam ?></td>
                <td><?php echo $od->kwh ?></td>
                
            </tr>
<?php 
      	
      	$no++;
		
    } 
}
?>
        
		
			
        </tbody>
    </table>	
	</body>
</html>