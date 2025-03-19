/* ------------------------------------------------------------------------------
 *
 *  # Echarts - candlestick and other charts
 *
 *  Candlestick and other chart configurations
 *
 *  Version: 1.0
 *  Latest update: August 1, 2015
 *
 * ---------------------------------------------------------------------------- */

$(function () {

	function padDigits(number, digits) {
		//return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + numberWithCommas(number);
	   return numberWithCommas(number);
	}

	function numberWithCommas(x) {
	   return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

   function fetchdata(){
	//alert(window.location.pathname);
	var_url = window.location.pathname;
	
	/*
	var_pageno = var_url.substring(var_url.lastIndexOf('index/') + 6);
	*/
	
	var_pageno = var_url.substring(var_url.lastIndexOf('/') + 1);
	if (var_pageno == "index") {
		var_pageno = 0;
	}
	
	$.ajax({
		url: "../../dashboard/datameter/"+var_pageno,
		type:"post",
		success: function(data) {
				dataku = JSON.parse(data);		   
				   for ( var i = 0; i < dataku.length; i++) {		
					 	var obj = dataku[i];

					 	var c  = obj.id_meter;

					 	var val_kwh   = 'val_kwh_'+c;
					 	var val_kwh1  = 'val_kwh1_'+c;
					 	var val_kwh2  = 'val_kwh2_'+c;

						var back  = 'back_'+c;
					 	var dt_back  = 'dt_back_'+c;									

					 	var kwh  = obj.kwh;
						var kwh1  = obj.kwh1;
						var kwh2  = obj.kwh2;
			   
					 	var dt  = obj.date_time;		
			   
					 	var id_satuan  = 'satuan_'+c;	
					 	var id_satuan1  = 'satuan1_'+c;
					 	var id_satuan2  = 'satuan2_'+c;

					 	var id_back_satuan  = 'back_satuan_'+c;	
			   
					 	var val_satuan  = '';						
					 	var val_satuan1  = '';		
						var val_satuan2  = '';		
				   
					if(true){ 

					   if (kwh > 9999999999999) {
						   kwh = kwh / 1000;
						   val_satuan  = 'mWh';
					   } else {
						   val_satuan  = 'kWh';
					   }
					   
					   if (kwh1 > 9999999999999) {
						   kwh1 = kwh1 / 1000;
						   val_satuan1  = 'mWh';
					   } else {
						   val_satuan1  = 'kWh';
					   }

					   if (kwh2 > 9999999999999) {
						   kwh2 = kwh2 / 1000;
						   val_satuan2  = 'mWh';
					   } else {
						   val_satuan2  = 'kWh';
					   }

						 // document.getElementById(c).innerHTML  = padDigits(kwh,13);
						 document.getElementById(val_kwh).innerHTML  = padDigits(kwh,13);
						 document.getElementById(val_kwh1).innerHTML  = padDigits(kwh1,13);
						 document.getElementById(val_kwh2).innerHTML  = padDigits(kwh2,13);

					   	// document.getElementById(back).innerHTML  = padDigits(kwh,13);	

					   	document.getElementById(dt_back).innerHTML  = dt;
					   
					   	document.getElementById(id_satuan).innerHTML  = val_satuan;
					   	document.getElementById(id_satuan1).innerHTML  = val_satuan1;
					   	document.getElementById(id_satuan2).innerHTML  = val_satuan2;

					   	// document.getElementById(id_back_satuan).innerHTML  = val_satuan;
					}

					else if(kwh==0){ 

					   	val_satuan  = 'kWh';
					   	val_satuan1  = 'kWh';
					   	val_satuan2  = 'kWh';
					   	//document.getElementById(c).innerHTML  = '0000000000000';
					   	//document.getElementById(c).innerHTML  = '0';
					   	document.getElementById(val_kwh).innerHTML  = '0';
						document.getElementById(val_kwh1).innerHTML  = '0';
						document.getElementById(val_kwh2).innerHTML  = '0';

					   // document.getElementById(back).innerHTML  = '0';					   
					   // document.getElementById(dt_back).innerHTML  = dt;
					   // document.getElementById(id_satuan).innerHTML  = val_satuan;
					   // document.getElementById(id_satuan1).innerHTML  = val_satuan1;
					   // document.getElementById(id_satuan2).innerHTML  = val_satuan2;
					   // document.getElementById(id_back_satuan).innerHTML  = val_satuan;

					}

					else{ 

						// var kwh2  = kwh*(-1);
				   
					   // if (kwh2 < -9999999999999) {
					   // 	kwh2 = kwh2 / 1000;
					   // 	val_satuan  = 'mWh';
					   // } else {
					   // 	val_satuan  = 'kWh';
					   // }

					   // document.getElementById(c).innerHTML  = '-'+padDigits(kwh2,13);
					   // document.getElementById(back).innerHTML  = '-'+padDigits(kwh2,13);
					   // document.getElementById(dt_back).innerHTML  = dt;
					   // document.getElementById(id_satuan).innerHTML  = val_satuan;
					   // document.getElementById(id_back_satuan).innerHTML  = val_satuan;

					}

				}

		},                 
		complete:function(data){
		setTimeout(fetchdata,1000);
		}
			 
	   });
   }
   
   $(document).ready(function(){
	setTimeout(fetchdata,1000);
   });

});

