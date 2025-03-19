<?php

$namafile = 'Electricity_Usage_Report_' . date('d-m-Y_H-i-s');

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
	<title><?php echo $title; ?></title>
	<!-- start: META -->

	<style>
		body {
			font-family: sans-serif;
			font-size: 10pt;
		}

		p {
			margin: 0pt;
		}

		table.items {
			border: 0.1mm solid #ffffff;
		}

		td {
			vertical-align: middle;
			height: 20px;
			padding-left: 10px;
		}

		.items td {
			border-left: 0.1mm solid #ffffff;
			border-right: 0.1mm solid #ffffff;
			border-bottom: 0.1mm solid #ffffff;
			height: 30px;
		}

		table thead th {
			background-color: #00584E;
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
			text-align: "."right;
		}

		.bggenap {
			background: #E7E7E7;
		}

		.bgganjil {
			background: #FFFFFF;
		}


		.bgfooter {
			background: #086C50;
			color: #ffffff;
			font-size: 16px;
			font-weight: bold;
		}
	</style>
	<style>
		.str {
			mso-number-format:\@;
		}
	</style>


</head>
<!-- end: HEAD -->

<body>


	<table width="100%">
		<thead>
			<tr></tr>
			<tr>
 				<td></td>
				<td width="200px" colspan="4" style="font-size:14px; font-weight:bold; text-align:left;">ELECTRICITY USAGE REPORT</td>
				<td width="200px" style="font-size:14px; font-weight:bold; text-align:left;"></td>
				<td width="200px" style="font-size:14px; font-weight:bold; text-align:left;"></td>
			</tr>
			<tr>
 				<td></td>
				<td colspan="4" style="font-size:12px; font-weight:bold; text-align:left;">PT. MENARA ANTAM SEJAHTERA</td>
				<td style="font-size:14px; font-weight:bold; text-align:left;"></td>
				<td style="font-size:14px; font-weight:bold; text-align:left;"></td>
			</tr>
			<tr>
 				<td></td>
				<td colspan="4" style="font-size:12px; font-weight:bold; text-align:left;">UTILITY DEPARTMENT
				<td style="font-size:14px; font-weight:bold; text-align:left;"></td>
				<td style="font-size:14px; font-weight:bold; text-align:left;"></td>
			</tr>

			<tr>
 				<td></td>
				<td style="font-size:14px; font-weight:bold; text-align:left;"></td>
				<td style="font-size:14px; font-weight:bold; text-align:left;"></td>
				<td style="font-size:14px; font-weight:bold; text-align:left;"></td>
				<td style="font-size:14px; font-weight:bold; text-align:left;"></td>
				<td style="font-size:14px; font-weight:bold; text-align:left;"></td>
				<td style="font-size:14px; font-weight:bold; text-align:left;"></td>
			</tr>

			<tr>
 				<td></td>
				<td colspan="2" style="font-size:12px; font-weight:normal; text-align:left; border:solid 1px #CECECE; background:#EEEEEE;">Tarif LWBP/kWh (Rp.)</td>
				<td style="font-size:12px; font-weight:normal; text-align:left; border:solid 1px #CECECE;"><?php echo number_format($tarif_lwbp, 0) ?></td>
				<td></td>
				<td style="font-size:12px; font-weight:normal; text-align:left; border:solid 1px #CECECE; background:#EEEEEE;">Date From</td>
				<td style="font-size:12px; font-weight:normal; text-align:right; border-top:solid 1px #CECECE; border-bottom:solid 1px #CECECE;"><?php echo date('Y-m-d', strtotime($dari)) ?></td>
				<td style="font-size:12px; font-weight:normal; text-align:left; border-top:solid 1px #CECECE; border-bottom:solid 1px #CECECE; border-right:solid 1px #CECECE;"><?php echo date('H:i:s', strtotime($dari_time)) ?></td>
				<td></td>
				<td style="font-size:12px; font-weight:normal; text-align:left; border:solid 1px #CECECE; background:#EEEEEE;">Report Date</td>
				<td style="font-size:12px; font-weight:normal; text-align:left; border:solid 1px #CECECE;"><?php echo date('Y-m-d') ?></td>
			</tr>
			<tr>
 				<td></td>
				<td colspan="2" style="font-size:12px; font-weight:normal; text-align:left; border:solid 1px #CECECE; background:#EEEEEE;">Tarif WBP/kWh (Rp.)</td>
				<td style="font-size:12px; font-weight:normal; text-align:left; border:solid 1px #CECECE;"><?php echo number_format($tarif_wbp, 0) ?></td>
				<td></td>
				<td style="font-size:12px; font-weight:normal; text-align:left; border:solid 1px #CECECE; background:#EEEEEE;">Date Thru</td>
				<td style="font-size:12px; font-weight:normal; text-align:right; border-top:solid 1px #CECECE; border-bottom:solid 1px #CECECE;"><?php echo date('Y-m-d', strtotime($sampai)) ?></td>
				<td style="font-size:12px; font-weight:normal; text-align:left; border-top:solid 1px #CECECE; border-bottom:solid 1px #CECECE; border-right:solid 1px #CECECE;"><?php echo date('H:i:s', strtotime($sampai_time)) ?></td>
			</tr>

		</thead>
	</table>
	<br />
	<table style="width:100%;">
		<thead>
			<!-- <tr>
               <th class="bg-red" ><b style="color:#FFFFFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></th>
               <th class="bg-red" ><b style="color:#FFFFFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LVMDB&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></th>
               <th class="bg-red" ><b style="color:#FFFFFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Start&nbsp;Meter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></th>
               <th class="bg-red" ><b style="color:#FFFFFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;End&nbsp;Meter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></th>
               <th class="bg-red" ><b style="color:#FFFFFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total&nbsp;Usage&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></th>
               <th class="bg-red" ><b style="color:#FFFFFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cost&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></th>			
            </tr> -->


			<tr>
				<td></td>
				<td class="bg-red" rowspan="2" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-top:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b>NO</b></th>
				<td class="bg-red" colspan="1" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-top:solid 1px #CECECE; text-align:center;"><b>Meter</b></th>
				<td class="bg-red" colspan="1" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-top:solid 1px #CECECE; text-align:center;"><b>Meter</b></th>
				<td class="bg-red" colspan="2" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-top:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b>Usage Periode</b></td>
				<td class="bg-red" colspan="3" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-top:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b>kWh TOTAL</b></th>
				<td class="bg-red" colspan="3" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-top:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b>kWh WBP</b></th>
				<td class="bg-red" colspan="3" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-top:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b>kWh LWBP</b></th>
				<td class="bg-red" colspan="3" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-top:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b>Cost Usage (Rp.)</b></th>
				<td class="bg-red" colspan="1" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-top:solid 1px #CECECE; text-align:center;"><b>PPN</b></th>
				<td class="bg-red" colspan="1" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-top:solid 1px #CECECE; border-right:solid 1px #CECECE; text-align:center;"><b>&nbsp;&nbsp;&nbsp;Cost Usage (Rp.)&nbsp;&nbsp;&nbsp;</b></td>
		
			</tr>


			<tr>
				<td></td>
				<td class="bg-red" colspan="1" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b>&nbsp;&nbsp;&nbsp;ID&nbsp;&nbsp;&nbsp;</b></th>
				<td class="bg-red" colspan="1" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b>&nbsp;&nbsp;&nbsp;Name&nbsp;&nbsp;&nbsp;</b></th>
				<td class="bg-red" colspan="1" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b>&nbsp;&nbsp;&nbsp;Start&nbsp;&nbsp;&nbsp;</b></th>
				<td class="bg-red" colspan="1" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b>&nbsp;&nbsp;&nbsp;End&nbsp;&nbsp;&nbsp;</b></th>
				<td class="bg-red" colspan="1" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b>&nbsp;&nbsp;&nbsp;Start&nbsp;&nbsp;&nbsp;</b></th>
				<td class="bg-red" colspan="1" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b>&nbsp;&nbsp;&nbsp;End&nbsp;&nbsp;&nbsp;</b></th>
				<td class="bg-red" colspan="1" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b>&nbsp;&nbsp;&nbsp;Usage&nbsp;&nbsp;&nbsp;</b></th>
				<td class="bg-red" colspan="1" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b>&nbsp;&nbsp;&nbsp;Start&nbsp;&nbsp;&nbsp;</b></th>
				<td class="bg-red" colspan="1" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b>&nbsp;&nbsp;&nbsp;End&nbsp;&nbsp;&nbsp;</b></th>
				<td class="bg-red" colspan="1" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b>&nbsp;&nbsp;&nbsp;Usage&nbsp;&nbsp;&nbsp;</b></th>
				<td class="bg-red" colspan="1" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b>&nbsp;&nbsp;&nbsp;Start&nbsp;&nbsp;&nbsp;</b></th>
				<td class="bg-red" colspan="1" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b>&nbsp;&nbsp;&nbsp;End&nbsp;&nbsp;&nbsp;</b></th>
				<td class="bg-red" colspan="1" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b>&nbsp;&nbsp;&nbsp;Usage&nbsp;&nbsp;&nbsp;</b></th>
				<td class="bg-red" colspan="1" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b>&nbsp;&nbsp;&nbsp;WBP&nbsp;&nbsp;&nbsp;</b></th>
				<td class="bg-red" colspan="1" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b>&nbsp;&nbsp;&nbsp;LWBP&nbsp;&nbsp;&nbsp;</b></th>
				<td class="bg-red" colspan="1" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b>&nbsp;&nbsp;&nbsp;TOTAL&nbsp;&nbsp;&nbsp;</b></th>
				<td class="bg-red" colspan="1" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b>&nbsp;&nbsp;&nbsp;10%&nbsp;&nbsp;&nbsp;</b></th>
				<td class="bg-red" colspan="1" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center; border-right:solid 1px #CECECE; "><b>&nbsp;&nbsp;&nbsp;TOTAL + PPN&nbsp;&nbsp;&nbsp;</b></th>
				<!-- <th></th> -->
			</tr>


		</thead>
		<tbody style="font-size:14px;">


			<?php

			$no = 1;

			if ($data != 'KOSONG') {
				$datafield = json_decode($data);

				foreach ($datafield as $billing) {
					if ($no % 2 == 0) {
						$trbg = 'bggenap';
					} else {
						$trbg = 'bgganjil';
					}

			?>
					<tr class="<?php echo $trbg; ?>">
					
						<td class="bgganjil"></td>
						<td style="border-left:solid 1px #CECECE; text-align:center;"><?php echo $no; ?></td>
						<td style="border-left:solid 1px #CECECE; text-align: left;"><?php echo $billing->id; ?></td>
						<td style="border-left:solid 1px #CECECE; text-align: left;"><?php echo $billing->id_name; ?></td>

						<td style="border-left:solid 1px #CECECE; text-align: left;"><?php echo $billing->date_start ?></td>
						<td style="border-left:solid 1px #CECECE; text-align: left;"><?php echo $billing->date_stop ?></td>

						<td style="border-left:solid 1px #CECECE; text-align: right;"><?php echo $billing->kwh_exp_start ?></td>
						<td style="border-left:solid 1px #CECECE; text-align: right;"><?php echo $billing->kwh_exp_stop ?></td>
						<td style="border-left:solid 1px #CECECE; text-align: right;"><?php echo $billing->kwh_usage ?></td>
					
						<td style="border-left:solid 1px #CECECE; text-align: right;"><?php echo $billing->kwh1_start ?></td>
						<td style="border-left:solid 1px #CECECE; text-align: right;"><?php echo $billing->kwh1_stop ?></td>
						<td style="border-left:solid 1px #CECECE; text-align: right;"><?php echo $billing->kwh1_usage ?></td>

						<td style="border-left:solid 1px #CECECE; text-align: right;"><?php echo $billing->kwh2_start ?></td>
						<td style="border-left:solid 1px #CECECE; text-align: right;"><?php echo $billing->kwh2_stop ?></td>
						<td style="border-left:solid 1px #CECECE; text-align: right;"><?php echo $billing->kwh2_usage ?></td>

						<td style="border-left:solid 1px #CECECE; text-align: right;"><?php echo $billing->kwh1_total ?></td>
						<td style="border-left:solid 1px #CECECE; text-align: right;"><?php echo $billing->kwh2_total ?></td>
						<td style="border-left:solid 1px #CECECE; text-align: right;"><?php echo $billing->kwh12_totalrpF ?></td>

						<td style="border-left:solid 1px #CECECE; text-align: right;"><?php echo $billing->kwh12_ppnrpF  ?></td>

						<td style="border-left:solid 1px #CECECE; border-right:solid 1px #CECECE; text-align: right; "><?php echo $billing->kwh12_incppnrpF ?></td>





					</tr>
			<?php

					$no++;
				}
			}
			?>

			<tr>
				<td></td>
				<td class="bg-red" colspan="7" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-top:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align: left;"><b>&nbsp;&nbsp;&nbsp;&nbsp;GRAND TOTAL</b></td>
				<td class="bg-red" style="background:#00584E; color:#FFFFFF;  border-left:solid 1px #CECECE; border-top:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:right;"><b><?php echo $tot_usage_kwh; ?></b></td>
				<td class="bg-red" colspan="8" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-top:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b></b></td>
				<td class="bg-red" style="background:#00584E; color:#FFFFFF;  border-left:solid 1px #CECECE; border-right:solid 1px #CECECE; border-top:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:right;"><b><?php echo $tot_usage_amount; ?></b></td>
				<td class="bg-red" colspan="2" style="background:#00584E; color:#FFFFFF; border-left:solid 1px #CECECE; border-top:solid 1px #CECECE; border-bottom:solid 1px #CECECE; text-align:center;"><b></b></td>
			</tr>

		</tbody>
	</table>
</body>

</html>