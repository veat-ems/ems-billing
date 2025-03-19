/* ------------------------------------------------------------------------------
*
*  # Fixed Columns extension for Datatables
*
*  Specific JS code additions for datatable_extension_fixed_columns.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {

	
	
		
		
	var linkku = 'report/tampil';	
	
	
	
	var h1 =  "<th><b style='color:#FFFFFF;'>NO.</b></th><th><b style='color:#FFFFFF;'>ID LINE</b></th><th><b style='color:#FFFFFF;'>TIME</b></th><th><b style='color:#FFFFFF;'>COM</b></th><th><b style='color:#FFFFFF;'>DEV</b></th><th><b style='color:#FFFFFF;'>TYPE</b></th>";
	var h2 =  "<th><b style='color:#FFFFFF;'>STATUS</b></th><th><b style='color:#FFFFFF;'>V1</b></th><th><b style='color:#FFFFFF;'>V2</b></th><th><b style='color:#FFFFFF;'>V3</b></th><th><b style='color:#FFFFFF;'>V12</b></th>";
	var h3 =  "<th><b style='color:#FFFFFF;'>V23</b></th><th><b style='color:#FFFFFF;'>V31</b></th><th><b style='color:#FFFFFF;'>I-1</b></th><th><b style='color:#FFFFFF;'>I-2</b></th><th><b style='color:#FFFFFF;'>I-3</b></th>";
	var h4 =  "<th><b style='color:#FFFFFF;'>I-N</b></th><th><b style='color:#FFFFFF;'>WATT1</b></th><th><b style='color:#FFFFFF;'>WATT2</b></th><th><b style='color:#FFFFFF;'>WATT3</b></th><th><b style='color:#FFFFFF;'>WATT</b></th>";
	var h5 =  "<th><b style='color:#FFFFFF;'>VA1</b></th><th><b style='color:#FFFFFF;'>VA2</b></th><th><b style='color:#FFFFFF;'>VA3</b></th><th><b style='color:#FFFFFF;'>VA</b></th><th><b style='color:#FFFFFF;'>FREQ</b></th>";
	var h6 =  "<th><b style='color:#FFFFFF;'>FP1</b></th><th><b style='color:#FFFFFF;'>FP2</b></th><th><b style='color:#FFFFFF;'>FP3</b></th><th><b style='color:#FFFFFF;'>kWh Imp</b></th><th><b style='color:#FFFFFF;'>kWh Exp</b></th>";
	var h7 =  "<th><b style='color:#FFFFFF;'>kVARh Imp</b></th><th><b style='color:#FFFFFF;'>kVARh Exp</b></th><th><b style='color:#FFFFFF;'>kVAh</b></th><th><b style='color:#FFFFFF;'>THD V1</b></th><th><b style='color:#FFFFFF;'>THD V2</b></th>";
	var h8 =  "<th><b style='color:#FFFFFF;'>THD V3</b></th><th><b style='color:#FFFFFF;'>THD I1</b></th><th><b style='color:#FFFFFF;'>THD I2</b></th><th><b style='color:#FFFFFF;'>THD I3</b></th>";
	
	var headerall = h1+''+h2+''+h3+''+h4+''+h5+''+h6+''+h7+''+h8;
	var linkku   = 'report/tampilsort';
	dataheader2 = "<th><b style='color:#FFFFFF;'>NO.</b></th><th><b style='color:#FFFFFF;'>ID LINE</b></th><th><b style='color:#FFFFFF;'>TIME</b></th><th><b style='color:#FFFFFF;'>WATT1</b></th><th><b style='color:#FFFFFF;'>WATT2</b></th><th><b style='color:#FFFFFF;'>WATT3</b></th><th><b style='color:#FFFFFF;'>WATT</b></th>";		
	DataTabelSort(linkku, '', dataheader2);
	
	$("#btnView").on("click", function(e) {
			var idku 	  = $("#id2").val();
			var parameter = $("#parameter").val();			
			var dari 	  = $("#dari").val();
			var sampai 	  = $("#dari").val();
			var linkku2   = 'report/tampilsort';
			var dataposku = "id="+idku+"&parameter="+parameter+"&dari="+dari+"&sampai="+sampai;
			
			if(parameter=='Power'){			
				dataheader2 = "<th><b style='color:#FFFFFF;'>NO.</b></th><th><b style='color:#FFFFFF;'>ID LINE</b></th><th><b style='color:#FFFFFF;'>TIME</b></th><th><b style='color:#FFFFFF;'>WATT1</b></th><th><b style='color:#FFFFFF;'>WATT2</b></th><th><b style='color:#FFFFFF;'>WATT3</b></th><th><b style='color:#FFFFFF;'>WATT</b></th>";		
				DataTabelSort(linkku2, dataposku, dataheader2);
			}
			else if(parameter=='Current'){			
				dataheader2 = "<th><b style='color:#FFFFFF;'>NO.</b></th><th><b style='color:#FFFFFF;'>ID LINE</b></th><th><b style='color:#FFFFFF;'>TIME</b></th><th><b style='color:#FFFFFF;'>I-1</b></th><th><b style='color:#FFFFFF;'>I-2</b></th><th><b style='color:#FFFFFF;'>I-3</b></th><th><b style='color:#FFFFFF;'>I-N</b></th>";		
				DataTabelSort(linkku2, dataposku, dataheader2);	
			}
			else if(parameter=='Voltage Phase To Netral'){			
				dataheader2 = "<th><b style='color:#FFFFFF;'>NO.</b></th><th><b style='color:#FFFFFF;'>ID LINE</b></th><th><b style='color:#FFFFFF;'>TIME</b></th><th><b style='color:#FFFFFF;'>V1</b></th><th><b style='color:#FFFFFF;'>V2</b></th><th><b style='color:#FFFFFF;'>V3</b></th>";	
				DataTabelSort(linkku2, dataposku, dataheader2);		
			}
			else if(parameter=='Voltage Phase to Phase'){			
				dataheader2 = "<th><b style='color:#FFFFFF;'>NO.</b></th><th><b style='color:#FFFFFF;'>ID LINE</b></th><th><b style='color:#FFFFFF;'>TIME</b></th><th><b style='color:#FFFFFF;'>V12</b></th><th><b style='color:#FFFFFF;'>V23</b></th><th><b style='color:#FFFFFF;'>V31</b></th>";	
				DataTabelSort(linkku2, dataposku, dataheader2);		
			}
			else if(parameter=='Power Factor'){			
				dataheader2 = "<th><b style='color:#FFFFFF;'>NO.</b></th><th><b style='color:#FFFFFF;'>ID LINE</b></th><th><b style='color:#FFFFFF;'>TIME</b></th><th><b style='color:#FFFFFF;'>PF1</b></th><th><b style='color:#FFFFFF;'>PF2</b></th><th><b style='color:#FFFFFF;'>PF3</b></th>";		
				DataTabelSort(linkku2, dataposku, dataheader2);	
			}
			else if(parameter=='Frequency'){			
				dataheader2 = "<th><b style='color:#FFFFFF;'>NO.</b></th><th><b style='color:#FFFFFF;'>ID LINE</b></th><th><b style='color:#FFFFFF;'>TIME</b></th><th><b style='color:#FFFFFF;'>FREQ</b></th>";		
				DataTabelSort(linkku2, dataposku, dataheader2);	
			}
			else if(parameter=='Export kWh'){			
				dataheader2 = "<th><b style='color:#FFFFFF;'>NO.</b></th><th><b style='color:#FFFFFF;'>ID LINE</b></th><th><b style='color:#FFFFFF;'>TIME</b></th><th><b style='color:#FFFFFF;'>kWh Exp</b></th>";		
				DataTabelSort(linkku2, dataposku, dataheader2);	
			}
			else if(parameter=='Import kWh'){			
				dataheader2 = "<th><b style='color:#FFFFFF;'>NO.</b></th><th><b style='color:#FFFFFF;'>ID LINE</b></th><th><b style='color:#FFFFFF;'>TIME</b></th><th><b style='color:#FFFFFF;'>kWh Imp</b></th>";		
				DataTabelSort(linkku2, dataposku, dataheader2);	
			}
			else if(parameter=='Export kVARh'){			
				dataheader2 = "<th><b style='color:#FFFFFF;'>NO.</b></th><th><b style='color:#FFFFFF;'>ID LINE</b></th><th><b style='color:#FFFFFF;'>TIME</b></th><th><b style='color:#FFFFFF;'>kVARh Exp</b></th>";	
				DataTabelSort(linkku2, dataposku, dataheader2);		
			}
			else if(parameter=='Import kVARh'){			
				dataheader2 = "<th><b style='color:#FFFFFF;'>NO.</b></th><th><b style='color:#FFFFFF;'>ID LINE</b></th><th><b style='color:#FFFFFF;'>TIME</b></th><th><b style='color:#FFFFFF;'>kVARh Imp</b></th>";		
				DataTabelSort(linkku2, dataposku, dataheader2);	
			}
			else if(parameter=='THD V'){			
				dataheader2 = "<th><b style='color:#FFFFFF;'>NO.</b></th><th><b style='color:#FFFFFF;'>ID LINE</b></th><th><b style='color:#FFFFFF;'>TIME</b></th><th><b style='color:#FFFFFF;'>THD V1</b></th><th><b style='color:#FFFFFF;'>THD V2</b></th><th><b style='color:#FFFFFF;'>THD V3</b></th>";	
				DataTabelSort(linkku2, dataposku, dataheader2);		
			}
			else if(parameter=='THD I'){			
				dataheader2 = "<th><b style='color:#FFFFFF;'>NO.</b></th><th><b style='color:#FFFFFF;'>ID LINE</b></th><th><b style='color:#FFFFFF;'>TIME</b></th><th><b style='color:#FFFFFF;'>THD I1</b></th><th><b style='color:#FFFFFF;'>THD I2</b></th><th><b style='color:#FFFFFF;'>THD I3</b></th>";		
				DataTabelSort(linkku2, dataposku, dataheader2);	
			}
			else{
				
				var h1a1 =  "<th><b style='color:#FFFFFF;'>NO.</b></th><th><b style='color:#FFFFFF;'>ID LINE</b></th><th><b style='color:#FFFFFF;'>TIME</b></th><th><b style='color:#FFFFFF;'>COM</b></th><th><b style='color:#FFFFFF;'>DEV</b></th><th><b style='color:#FFFFFF;'>TYPE</b></th>";
				var h2a1 =  "<th><b style='color:#FFFFFF;'>STATUS</b></th><th><b style='color:#FFFFFF;'>V1</b></th><th><b style='color:#FFFFFF;'>V2</b></th><th><b style='color:#FFFFFF;'>V3</b></th><th><b style='color:#FFFFFF;'>V12</b></th>";
				var h3a1 =  "<th><b style='color:#FFFFFF;'>V23</b></th><th><b style='color:#FFFFFF;'>V31</b></th><th><b style='color:#FFFFFF;'>I-1</b></th><th><b style='color:#FFFFFF;'>I-2</b></th><th><b style='color:#FFFFFF;'>I-3</b></th>";
				var h4a1 =  "<th><b style='color:#FFFFFF;'>I-N</b></th><th><b style='color:#FFFFFF;'>WATT1</b></th><th><b style='color:#FFFFFF;'>WATT2</b></th><th><b style='color:#FFFFFF;'>WATT3</b></th><th><b style='color:#FFFFFF;'>WATT</b></th>";
				var h5a1 =  "<th><b style='color:#FFFFFF;'>VA1</b></th><th><b style='color:#FFFFFF;'>VA2</b></th><th><b style='color:#FFFFFF;'>VA3</b></th><th><b style='color:#FFFFFF;'>VA</b></th><th><b style='color:#FFFFFF;'>FREQ</b></th>";
				var h6a1 =  "<th><b style='color:#FFFFFF;'>FP1</b></th><th><b style='color:#FFFFFF;'>FP2</b></th><th><b style='color:#FFFFFF;'>FP3</b></th><th><b style='color:#FFFFFF;'>kWh Imp</b></th><th><b style='color:#FFFFFF;'>kWh Exp</b></th>";
				var h7a1 =  "<th><b style='color:#FFFFFF;'>kVARh Imp</b></th><th><b style='color:#FFFFFF;'>kVARh Exp</b></th><th><b style='color:#FFFFFF;'>kVAh</b></th><th><b style='color:#FFFFFF;'>THD V1</b></th><th><b style='color:#FFFFFF;'>THD V2</b></th>";
				var h8a1 =  "<th><b style='color:#FFFFFF;'>THD V3</b></th><th><b style='color:#FFFFFF;'>THD I1</b></th><th><b style='color:#FFFFFF;'>THD I2</b></th><th><b style='color:#FFFFFF;'>THD I3</b></th>";
	
				var headerallA1 = h1a1+''+h2a1+''+h3a1+''+h4a1+''+h5a1+''+h6a1+''+h7a1+''+h8a1;
				document.getElementById("headku").innerHTML = headerallA1;
				
				DataTabelAll("report/tampil", "");
			}
			
			
			
		}); 
	
	$("#btnPrint").on("click", function(e) {
            var divContents = $("#cobacoba").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>DIV Contents</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }); 
		
	$("#btnViewall").on("click", function(e) {
			
			var h1a =  "<th><b style='color:#FFFFFF;'>NO.</b></th><th><b style='color:#FFFFFF;'>ID LINE</b></th><th><b style='color:#FFFFFF;'>TIME</b></th><th><b style='color:#FFFFFF;'>COM</b></th><th><b style='color:#FFFFFF;'>DEV</b></th><th><b style='color:#FFFFFF;'>TYPE</b></th>";
			var h2a =  "<th><b style='color:#FFFFFF;'>STATUS</b></th><th><b style='color:#FFFFFF;'>V1</b></th><th><b style='color:#FFFFFF;'>V2</b></th><th><b style='color:#FFFFFF;'>V3</b></th><th><b style='color:#FFFFFF;'>V12</b></th>";
			var h3a =  "<th><b style='color:#FFFFFF;'>V23</b></th><th><b style='color:#FFFFFF;'>V31</b></th><th><b style='color:#FFFFFF;'>I-1</b></th><th><b style='color:#FFFFFF;'>I-2</b></th><th><b style='color:#FFFFFF;'>I-3</b></th>";
			var h4a =  "<th><b style='color:#FFFFFF;'>I-N</b></th><th><b style='color:#FFFFFF;'>WATT1</b></th><th><b style='color:#FFFFFF;'>WATT2</b></th><th><b style='color:#FFFFFF;'>WATT3</b></th><th><b style='color:#FFFFFF;'>WATT</b></th>";
			var h5a =  "<th><b style='color:#FFFFFF;'>VA1</b></th><th><b style='color:#FFFFFF;'>VA2</b></th><th><b style='color:#FFFFFF;'>VA3</b></th><th><b style='color:#FFFFFF;'>VA</b></th><th><b style='color:#FFFFFF;'>FREQ</b></th>";
			var h6a =  "<th><b style='color:#FFFFFF;'>FP1</b></th><th><b style='color:#FFFFFF;'>FP2</b></th><th><b style='color:#FFFFFF;'>FP3</b></th><th><b style='color:#FFFFFF;'>kWh Imp</b></th><th><b style='color:#FFFFFF;'>kWh Exp</b></th>";
			var h7a =  "<th><b style='color:#FFFFFF;'>kVARh Imp</b></th><th><b style='color:#FFFFFF;'>kVARh Exp</b></th><th><b style='color:#FFFFFF;'>kVAh</b></th><th><b style='color:#FFFFFF;'>THD V1</b></th><th><b style='color:#FFFFFF;'>THD V2</b></th>";
			var h8a =  "<th><b style='color:#FFFFFF;'>THD V3</b></th><th><b style='color:#FFFFFF;'>THD I1</b></th><th><b style='color:#FFFFFF;'>THD I2</b></th><th><b style='color:#FFFFFF;'>THD I3</b></th>";
	
			var headerallA = h1a+''+h2a+''+h3a+''+h4a+''+h5a+''+h6a+''+h7a+''+h8a;
			document.getElementById("headku").innerHTML = headerallA;			
			DataTabelAll("report/tampil", "");
		});  
		
	
	
	
	function DataTabelAll(link, datapost, dataheader) {
      	var dataHome = "";
      	$.ajax({
         	url: link,
         	type:"post",
         	data:datapost,
         	success: function(data) {
           		
				databaru = JSON.parse(data);

    			// Left and right fixed columns
    			$('.datatableku').DataTable({
        				data: databaru,
						paging: false,
        				scrollX: true,
        				scrollY: '400px',
        				scrollCollapse: true,
        				fixedColumns: {
            				leftColumns: 1,
							leftColumns: 2
        				}
					
    			}); 	
				      
            }  
                  
      	  });
     }
	 
	 function DataTabelSort(link, datapost, dataheader) {
      	var dataHome = "";
		document.getElementById("headku").innerHTML = dataheader;
		
      	$.ajax({
         	url: link,
         	type:"post",
         	data:datapost,
         	success: function(data) {
           		
				databaru = JSON.parse(data);

    			// Left and right fixed columns
    			$('.datatableku').DataTable({
        				data: databaru,
						paging: false,
					
    			}); 	
				      
            }  
                  
      	  });
     }
	 
	 


	
	
	
	
	
	
	 
	
	// Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        destroy: true,
		dom: '<"datatable-scroll datatable-scroll-wrap"t>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        }
    });


	$('.datatableku').DataTable(); 	



    // External table additions
    // ------------------------------

    // Add placeholder to the datatable filter option
    $('.dataTables_filter input[type=search]').attr('placeholder','Type to filter...');


    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: "-1"
    });
	
	
    
});
