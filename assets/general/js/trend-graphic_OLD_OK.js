/* ------------------------------------------------------------------------------
 *
 *  # Echarts - lines and areas
 *
 *  Lines and areas chart configurations
 *
 *  Version: 1.0
 *  Latest update: August 1, 2015
 *
 * ---------------------------------------------------------------------------- */

$(function() {

 		 
    // Set paths
    // ------------------------------

    require.config({
        paths: {
            echarts: 'assets/vendor/echarts'
        }
    });


    // Configuration
    // ------------------------------

    require(
        [
            'echarts',
            'echarts/theme/limitless',
            'echarts/chart/bar',
            'echarts/chart/line'
        ],


        // Charts setup
        function (ec, limitless) {


            // Initialize charts
            // ------------------------------

            var basic_lines = ec.init(document.getElementById('basic_lines'), limitless);



            // Charts setup
            // ------------------------------

            //
            // Basic lines options
            //
			
			
			
function TrendGrafik(link, datapost) {
			
   
   $.ajax({
       url: link,
       type:"post",
       data:datapost,
       success: function(data) {
           		
			databaru = JSON.parse(data);	
			// document.getElementById("testku").innerHTML = data;
			
			var parameter = databaru[1].datagrf;
			
			
			var legendaku  = [];
			
			if(databaru[1].datagrf=='Power'){
				var jmlgrf 	   = '4';
				legendaku  = ["WATT-1","WATT-2","WATT-3","WATT"];
				var nama1	   = "WATT-1";
				var nama2	   = "WATT-2";
				var nama3	   = "WATT-3";
				var nama4	   = "WATT";
				var tipe1	   = "line";
				var tipe2	   = "line";
				var tipe3	   = "line";
				var tipe4	   = "line";
				
				
			}			
			else if(databaru[1].datagrf=='Current'){
				var jmlgrf 	   = '4';
				legendaku  = ['I-1','I-2','I-3','I-NET'];
				var nama1	   = "I-1";
				var nama2	   = "I-2";
				var nama3	   = "I-3";
				var nama4	   = "I-NET";
				var tipe1	   = "line";
				var tipe2	   = "line";
				var tipe3	   = "line";
				var tipe4	   = "line";
				
			}		
			else if(databaru[1].datagrf=='Voltage Phase To Netral'){
				var jmlgrf 	   = '3';
				legendaku  = ['V-1','V-2','V-3',''];
				var nama1	   = "V-1";
				var nama2	   = "V-2";
				var nama3	   = "V-3";
				var nama4	   = "";
				var tipe1	   = "line";
				var tipe2	   = "line";
				var tipe3	   = "line";
				var tipe4	   = "";
				
			}	
			else if(databaru[1].datagrf=='Voltage Phase to Phase'){
				var jmlgrf 	   = '3';
				legendaku  = ['V-12','V-23','V-31',''];
				var nama1	   = "V-12";
				var nama2	   = "V-23";
				var nama3	   = "V-31";
				var nama4	   = "";
				var tipe1	   = "line";
				var tipe2	   = "line";
				var tipe3	   = "line";
				var tipe4	   = "";
				
			}
			else if(databaru[1].datagrf=='Power Factor'){
				var jmlgrf 	   = '3';
				legendaku  = ['PF1','PF2','PF3',''];
				var nama1	   = "PF1";
				var nama2	   = "PF2";
				var nama3	   = "PF3";
				var nama4	   = "";
				var tipe1	   = "line";
				var tipe2	   = "line";
				var tipe3	   = "line";
				var tipe4	   = "";
				
			}
			else if(databaru[1].datagrf=='Frequency'){
				var jmlgrf 	   = '1';
				legendaku  = ['Frequency','','',''];
				var nama1	   = "Frequency";
				var nama2	   = "";
				var nama3	   = "";
				var nama4	   = "";
				var tipe1	   = "line";
				var tipe2	   = "";
				var tipe3	   = "";
				var tipe4	   = "";
				
			}
			else if(databaru[1].datagrf=='Export kWh'){
				var jmlgrf 	   = '1';
				legendaku  = ['Export kWh','','',''];
				var nama1	   = "Export kWh";
				var nama2	   = "";
				var nama3	   = "";
				var nama4	   = "";
				var tipe1	   = "line";
				var tipe2	   = "";
				var tipe3	   = "";
				var tipe4	   = "";
				
			}
			else if(databaru[1].datagrf=='Import kWh'){
				var jmlgrf 	   = '1';
				legendaku  = ['Import kWh','','',''];
				var nama1	   = "Import kWh";
				var nama2	   = "";
				var nama3	   = "";
				var nama4	   = "";
				var tipe1	   = "line";
				var tipe2	   = "";
				var tipe3	   = "";
				var tipe4	   = "";
				
			}
			else if(databaru[1].datagrf=='Export kVARh'){
				var jmlgrf 	   = '1';
				legendaku  = ['Export kVARh','','',''];
				var nama1	   = "Export kVARh";
				var nama2	   = "";
				var nama3	   = "";
				var nama4	   = "";
				var tipe1	   = "line";
				var tipe2	   = "";
				var tipe3	   = "";
				var tipe4	   = "";
				
			}
			else if(databaru[1].datagrf=='Import kVARh'){
				var jmlgrf 	   = '1';
				legendaku  = ['Import kVARh','','',''];
				var nama1	   = "Import kVARh";
				var nama2	   = "";
				var nama3	   = "";
				var nama4	   = "";
				var tipe1	   = "line";
				var tipe2	   = "";
				var tipe3	   = "";
				var tipe4	   = "";
				
			}
			else if(databaru[1].datagrf=='THD V'){
				var jmlgrf 	   = '3';
				legendaku  = ['THD V1','THD V2','THD V3',''];
				var nama1	   = "THD V1";
				var nama2	   = "THD V2";
				var nama3	   = "THD V3";
				var nama4	   = "";
				var tipe1	   = "line";
				var tipe2	   = "line";
				var tipe3	   = "line";
				var tipe4	   = "";
				
			}
			else if(databaru[1].datagrf=='THD I'){
				var jmlgrf 	   = '3';
				legendaku  = ['THD I1','THD I2','THD I3',''];
				var nama1	   = "THD I1";
				var nama2	   = "THD I2";
				var nama3	   = "THD I3";
				var nama4	   = "";
				var tipe1	   = "line";
				var tipe2	   = "line";
				var tipe3	   = "line";
				var tipe4	   = "";
				
			}
			else{
			
				var jmlgrf 	   = '4';
				legendaku  = ['WATT-1','WATT-2','WATT-3','WATT'];
				var nama1	   = "WATT-1";
				var nama2	   = "WATT-2";
				var nama3	   = "WATT-3";
				var nama4	   = "WATT";
				
			}	
			
			
			var parameterku = databaru[1].datagrf;
			// document.getElementById("test").innerHTML = jmlgrf;
			
	
			basic_lines_options = {

                title: {
        		 	x: 'center',
					y: 0,
        			text: databaru[0].datagrf,
        			subtext: databaru[1].datagrf
    			},
				// Setup grid
                grid: {
                    y: 70,
                    y2: 80
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis'
                },
				
    			toolbox: {
        			show : true,
        			feature : {
            			mark : {
							   	show: true,
							   	title : {
            						  mark : 'Mark',
            						  markUndo : 'Undo',
            						  markClear : 'Clear'
        							  }
								},
						
    					dataZoom : {
        						show : true,
        						title : {
            						  dataZoom : 'Zoom',
            						  dataZoomReset : 'Zoom Reset'
        							  }
    							},
            			dataView : {
														
								show: true, 
								readOnly: false,
								title : 'Data View',
								lang: ['Data View', 'Close', 'Copy']
								},
            			magicType : {
								show: true, 
								type: ['line', 'bar'],
								title : {
            						  line : 'Line',
            						  bar : 'Bar'
        							  }
								},
            			restore : {
								show: true,
        						title : 'Restore'
								
								},
            			saveAsImage : {
								show: true,
        						title : 'Save as Image'
								
								}
        			}
    			},

                // Add legend
                legend: {
                    data: legendaku,
					x: 'center',
					y: 'bottom'
                },

                // Add custom colors
                color: ['#EF5350', '#0080C0','#FF8000', '#66BB6A'],

                // Enable drag recalculate
                calculable: true,

                // Horizontal axis
                xAxis: [{
                    type: 'category',
					name: 'Date Time',
                    boundaryGap: false,
                    data: databaru[3].datagrf,
                    
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value',
					name: databaru[2].datagrf,
                    axisLabel: {
                        formatter: '{value} '
                    }
                }],

                
			
				// Add series
                series: [
                
				   
					
					{
                        name: nama1,
                        type: tipe1,
                        data: databaru[4].datagrf,
            			markPoint : {
                			data : [
                    		 	 {type : 'max', name: 'Maximum'},
                    		 	 {type : 'min', name: 'Minimum'}
                			 ]
            			}
                    },
					{
                        name: nama2,
                        type: tipe2,
                        data: databaru[5].datagrf,
            			markPoint : {
                			data : [
                    		 	 {type : 'max', name: 'Maximum'},
                    		 	 {type : 'min', name: 'Minimum'}
                			 ]
            			}
                    },
					{
                        name: nama3,
                        type: tipe3,
                        data: databaru[6].datagrf,
            			markPoint : {
                			data : [
                    		 	 {type : 'max', name: 'Maximum'},
                    		 	 {type : 'min', name: 'Minimum'}
                			 ]
            			}
                    },
					
					
					{
                        name: nama4,
                        type: tipe4,
            			tooltip : {
        						show: false,
              					showContent: false
    					},
                        data: databaru[7].datagrf,
						
            			markPoint : {
                			data : [
                    		 	 {type : 'max', name: 'Maximum'},
                    		 	 {type : 'min', name: 'Minimum'}
                			 ]
            			}
                    }
				 
					
					
                ]
            };
			
			basic_lines.setOption(basic_lines_options);
			
			
			
			
				
					
        },
			
        error: function(errmsg) {
                alert("Ajax??????????!"+ errmsg);
        }
   });	
			
			

}

function CekData(link, datapost) {
			
   var dataHome = "";
   $.ajax({
       url: link,
       type:"post",
       data:datapost,
       success: function(data) {
           		
			databaru = JSON.parse(data);	
			
			
			
			
				
					
        },
			
        error: function(errmsg) {
                //alert("Ajax??????????!"+ errmsg);
        }
   });	
			

}




function Satuanku(idku) {
	
	if(idku=='Power'){
		
		var satuan = 'W';
	}
	else if(idku=='Current'){
		
		var satuan = 'A';
	}
	else if(idku=='Voltage Phase To Netral'){
		
		var satuan = 'V';
	}
	else if(idku=='Voltage Phase to Phase'){
		
		var satuan = 'V';
	}
	else if(idku=='Power Factor'){
		
		var satuan = '';
	}
	else if(idku=='Frequency'){
		
		var satuan = 'Hz';
	}
	else if(idku=='Export kWh'){
		
		var satuan = 'kWh';
	}
	else if(idku=='Import kWh'){
		
		var satuan = 'kWh';
	}
	else if(idku=='Export kVARh'){
		
		var satuan = 'kVARh';
	}
	else if(idku=='Import kVARh'){
		
		var satuan = 'kVARh';
	}
	else if(idku=='THD V'){
		
		var satuan = '';
	}
	else if(idku=='THD I'){
		
		var satuan = '';
	}
	
	return satuan;


}

	$("#button1").on("click", function(e) {
			var idku = $("#id2").val();
			var parameter = $("#parameter").val();
			swal({
				title: "Are you sure?"+idku+""+parameter,
				text: "You will not be able to recover this Username!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes, delete it!",
				cancelButtonText: "No, cancel pls!",
				closeOnConfirm: false,
				closeOnCancel: false
			}, function(isConfirm) {
				if(isConfirm) {
					swal("Deleted!", "This Username has been deleted.", "success");
					$(location).attr('href','user/delete/'+memberId);
					
				} else {
					swal("Cancelled", "This Username is safe :)", "error");
				}
			});

			e.preventDefault
		}); 




			var idku 	  = $("#id2").val();
			var parameter = $("#parameter").val();
			var dari 	  = $("#dari").val();
			var sampai 	  = $("#sampai").val();
			var satuan1   = Satuanku(parameter);
			var tempo 	  = $('input[name="tempo"]:checked').val();
			
			var linkku   = 'trend/datagrafik';
			var dataposku = "id="+escape(idku)+"&parameter="+escape(parameter)+"&dari="+dari+"&sampai="+sampai+"&satuan="+satuan1+"&tempo="+escape(tempo);
			
			// document.getElementById("test").innerHTML = dataposku;
			
			
			//CekData(linkku, dataposku);
			TrendGrafik(linkku, dataposku); 

			$("#btnView").on("click", function(e) {
            		
					var idku2 	  	  = $("#id2").val();
					var parameter2 	  = $("#parameter").val();
					var dari2 	  	  = $("#dari").val();
					var sampai2 	  = $("#sampai").val();	
					var satuan2		  = Satuanku(parameter2);
					var tempo2 	  	  = $('input[name="tempo"]:checked').val();
					
					
					var linkku2   = 'trend/datagrafik';
					var dataposku2 = "id="+escape(idku2)+"&parameter="+escape(parameter2)+"&dari="+dari2+"&sampai="+sampai2+"&satuan="+satuan2+"&tempo="+escape(tempo2);
					//CekData(linkku2, dataposku2);
					
					// document.getElementById("test").innerHTML = dataposku2;
					
					TrendGrafik(linkku2, dataposku2);		
			
        	});


            //
           

            // Apply options
            // ------------------------------

            



            // Resize charts
            // ------------------------------

            window.onresize = function () {
                setTimeout(function () {
                    basic_lines.resize();
                }, 200);
            }
        }
    );
});
