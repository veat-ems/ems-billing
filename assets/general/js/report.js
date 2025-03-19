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

	var radioBtn = $('input[name="tempo"]:checked').val();
	var idku 	  = $("#id2").val();
	var parameter = $("#parameter").val();
	var dari 	  = $("#dari").val();
	var sampai 	  = $("#sampai").val();
	var dataposall = "id="+escape(idku)+"&parameter="+escape(parameter)+"&dari="+dari+"&sampai="+sampai+"&tempo="+radioBtn;
	DataTabelAll("report/tampil", dataposall);
	// document.getElementById("testtempo").innerHTML = radioBtn+'-'+idku+'-'+parameter+'-'+dari+'-'+sampai;
	
	$("#btnPrint").on("click", function(e) {
            var divContents = $("#table_report").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>DIV Contents</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
	
	
	
	$("#btnView").on("click", function(e) {
			var idku 	  = $("#id2").val();
			var parameter = $("#parameter").val();			
			var dari 	  = $("#dari").val();
			var sampai 	  = $("#sampai").val();
			var radioBtn = $('input[name="tempo"]:checked').val();
			// document.getElementById("testtempo").innerHTML = radioBtn+'-'+idku+'-'+parameter+'-'+dari+'-'+sampai;
			
			var linkku2   = 'report/tampilsort';
			var dataposku = "id="+escape(idku)+"&parameter="+escape(parameter)+"&dari="+dari+"&sampai="+sampai+"&tempo="+radioBtn;
			
			if(parameter=='Power'){			
				DataTabelPower(linkku2, dataposku);					
			}
			else if(parameter=='Current'){			
				DataTabelCurrent(linkku2, dataposku);	
			}
			else if(parameter=='Voltage Phase To Netral'){			
				DataTabelPTN(linkku2, dataposku);			
			}
			else if(parameter=='Voltage Phase to Phase'){			
				DataTabelPTP(linkku2, dataposku);			
			}
			else if(parameter=='Power Factor'){			
				DataTabelPF(linkku2, dataposku);			
			}
			else if(parameter=='Frequency'){			
				DataTabelFreq(linkku2, dataposku);			
			}
			else if(parameter=='Export kWh'){			
				DataTabelEKWH(linkku2, dataposku);			
			}
			else if(parameter=='Import kWh'){			
				DataTabelIKWH(linkku2, dataposku);			
			}
			else if(parameter=='Export kVARh'){			
				DataTabelEKVARH(linkku2, dataposku);			
			}
			else if(parameter=='Import kVARh'){			
				DataTabelIKVARH(linkku2, dataposku);			
			}
			else if(parameter=='THD V'){			
				DataTabelTHDV(linkku2, dataposku);			
			}
			else if(parameter=='THD I'){			
				DataTabelTHDI(linkku2, dataposku);			
			}
			else if(parameter=='All'){			
				
				DataTabelAll("report/tampil", dataposku);
							
			}
			else{
				DataTabelAll("report/tampil", dataposku);
			}
			
		});  
		
	$("#btnViewall").on("click", function(e) {
			var radioBtn = $('input[name="tempo"]:checked').val();
			var idku 	  = 'All';
			var parameter = 'All';
			var dari 	  = $("#dari").val();
			var sampai 	  = $("#sampai").val();
			var dataposall = "id="+escape(idku)+"&parameter="+escape(parameter)+"&dari="+dari+"&sampai="+sampai+"&tempo="+radioBtn;
			DataTabelAll("report/tampil", dataposall);
		});  
		
	
	
	
	function DataTabelAll(link, datapost) {
      	var databaru = "";
      	$.ajax({
         	url: link,
         	type:"post",
         	data:datapost,
         	success: function(data) {
           		
				databaru = JSON.parse(data);

    			// Left and right fixed columns
    			$('.datatable-fixed-both').DataTable({
        				data: databaru,
						paging: true,
        				scrollX: true,
						columnDefs: [
								{
									visible: true, 
									targets: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,
											 26,27,28,29,30,31,32,33,34,35,36,37,38,39]
								},
            					{ 
                				  	width: "50px",
                					targets: [0]
           						},
            					{ 
                				  	width: "300px",
                					targets: [1]
            					},
            					{ 
                				  	width: "200px",
                					targets: [1]
            					}
						],
        				fixedColumns: {
            				leftColumns: 1,
							leftColumns: 2
        				}
					
    			}); 	
				      
            }  
                  
      	  });
     }
	 
	 
	 
	function DataTabelPower(link, datapost) {
      	var databaru = "";
      	$.ajax({
         	url: link,
         	type:"post",
         	data:datapost,
         	success: function(data) {
           		
				databaru = JSON.parse(data);
				//document.getElementById("testku").innerHTML = data;

    			// Left and right fixed columns
    			$('.datatable-fixed-both').DataTable({
        				data: databaru,
						paging: true,
        				scrollX: true,
						columnDefs: [
								{
									visible: false, 
									targets: [0,3,4,5,6,7,8,9,10,11,12,13,14,15,16,21,22,23,24,25,
											 26,27,28,29,30,31,32,33,34,35,36,37,38,39]
								}
						]
					
    			}); 	
				      
            }  
                  
      	  });
     } 
	 
	function DataTabelCurrent(link, datapost) {
      	var databaru = "";
      	$.ajax({
         	url: link,
         	type:"post",
         	data:datapost,
         	success: function(data) {
           		
				databaru = JSON.parse(data);
				

    			// Left and right fixed columns
    			$('.datatable-fixed-both').DataTable({
        				data: databaru,
						paging: true,
        				scrollX: true,
						columnDefs: [
								{
									visible: false, 
									targets: [0,3,4,5,6,7,8,9,10,11,12,17,18,19,20,21,22,23,24,25,
											 26,27,28,29,30,31,32,33,34,35,36,37,38,39]
								}
						]
					
    			}); 	
				      
            }  
                  
      	  });
     }
	
	 
	 
	function DataTabelPTN(link, datapost) {
      	var databaru = "";
      	$.ajax({
         	url: link,
         	type:"post",
         	data:datapost,
         	success: function(data) {
           		
				databaru = JSON.parse(data);
				

    			// Left and right fixed columns
    			$('.datatable-fixed-both').DataTable({
        				data: databaru,
						paging: true,
        				scrollX: true,
						columnDefs: [
								{
									visible: false, 
									targets: [0,3,4,5,6,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,
											 26,27,28,29,30,31,32,33,34,35,36,37,38,39]
								}
						]
					
    			}); 	
				      
            }  
                  
      	  });
     }
	
	 
	 
	function DataTabelPTP(link, datapost) {
      	var databaru = "";
      	$.ajax({
         	url: link,
         	type:"post",
         	data:datapost,
         	success: function(data) {
           		
				databaru = JSON.parse(data);
				

    			// Left and right fixed columns
    			$('.datatable-fixed-both').DataTable({
        				data: databaru,
						paging: true,
        				scrollX: true,
						columnDefs: [
								{
									visible: false, 
									targets: [0,3,4,5,6,7,8,9,13,14,15,16,17,18,19,20,21,22,23,24,25,
											 26,27,28,29,30,31,32,33,34,35,36,37,38,39]
								}
						]
					
    			}); 	
				      
            }  
                  
      	  });
     }
	 
	 
	 
	 
	function DataTabelPF(link, datapost) {
      	var databaru = "";
      	$.ajax({
         	url: link,
         	type:"post",
         	data:datapost,
         	success: function(data) {
           		
				databaru = JSON.parse(data);
				

    			// Left and right fixed columns
    			$('.datatable-fixed-both').DataTable({
        				data: databaru,
						paging: true,
        				scrollX: true,
						columnDefs: [
								{
									visible: false, 
									targets: [0,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,
											 29,30,31,32,33,34,35,36,37,38,39]
								}
						]
					
    			}); 	
				      
            }  
                  
      	  });
     }
	 
	 
	 
	 
	function DataTabelFreq(link, datapost) {
      	var databaru = "";
      	$.ajax({
         	url: link,
         	type:"post",
         	data:datapost,
         	success: function(data) {
           		
				databaru = JSON.parse(data);
				

    			// Left and right fixed columns
    			$('.datatable-fixed-both').DataTable({
        				data: databaru,
						paging: true,
        				scrollX: true,
						columnDefs: [
								{
									visible: false, 
									targets: [0,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,
											 26,27,28,29,30,31,32,33,34,35,36,37,38,39]
								}
						]
					
    			}); 	
				      
            }  
                  
      	  });
     } 
	 
	 
	function DataTabelIKWH(link, datapost) {
      	var databaru = "";
      	$.ajax({
         	url: link,
         	type:"post",
         	data:datapost,
         	success: function(data) {
           		
				databaru = JSON.parse(data);
				

    			// Left and right fixed columns
    			$('.datatable-fixed-both').DataTable({
        				data: databaru,
						paging: true,
        				scrollX: true,
						columnDefs: [
								{
									visible: false, 
									targets: [0,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,
											 26,27,28,30,31,32,33,34,35,36,37,38,39]
								}
						]
					
    			}); 	
				      
            }  
                  
      	  });
     }
	 
	 
	 
	 
	function DataTabelEKWH(link, datapost) {
      	var databaru = "";
      	$.ajax({
         	url: link,
         	type:"post",
         	data:datapost,
         	success: function(data) {
           		
				databaru = JSON.parse(data);
				

    			// Left and right fixed columns
    			$('.datatable-fixed-both').DataTable({
        				data: databaru,
						paging: true,
        				scrollX: true,
						columnDefs: [
								{
									visible: false, 
									targets: [0,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,
											 26,27,28,29,31,32,33,34,35,36,37,38,39]
								}
						]
					
    			}); 	
				      
            }  
                  
      	  });
     }
	 
	 
	function DataTabelIKVARH(link, datapost) {
      	var databaru = "";
      	$.ajax({
         	url: link,
         	type:"post",
         	data:datapost,
         	success: function(data) {
           		
				databaru = JSON.parse(data);
				

    			// Left and right fixed columns
    			$('.datatable-fixed-both').DataTable({
        				data: databaru,
						paging: true,
        				scrollX: true,
						columnDefs: [
								{
									visible: false, 
									targets: [0,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,
											 26,27,28,29,30,32,33,34,35,36,37,38,39]
								}
						]
					
    			}); 	
				      
            }  
                  
      	  });
     }
	 
	
	 
	 
	function DataTabelEKVARH(link, datapost) {
      	var databaru = "";
      	$.ajax({
         	url: link,
         	type:"post",
         	data:datapost,
         	success: function(data) {
           		
				databaru = JSON.parse(data);
				

    			// Left and right fixed columns
    			$('.datatable-fixed-both').DataTable({
        				data: databaru,
						paging: true,
        				scrollX: true,
						columnDefs: [
								{
									visible: false, 
									targets: [0,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,
											 26,27,28,29,30,31,33,34,35,36,37,38,39]
								}
						]
					
    			}); 	
				      
            }  
                  
      	  });
     }
	 
	
	 
	 
	function DataTabelTHDV(link, datapost) {
      	var databaru = "";
      	$.ajax({
         	url: link,
         	type:"post",
         	data:datapost,
         	success: function(data) {
           		
				databaru = JSON.parse(data);
				

    			// Left and right fixed columns
    			$('.datatable-fixed-both').DataTable({
        				data: databaru,
						paging: true,
        				scrollX: true,
						columnDefs: [
								{
									visible: false, 
									targets: [0,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,
											 26,27,28,29,30,31,32,33,37,38,39]
								}
						]
					
    			}); 	
				      
            }  
                  
      	  });
     }
	 
	 
	 
	
	 
	 
	function DataTabelTHDI(link, datapost) {
      	var databaru = "";
      	$.ajax({
         	url: link,
         	type:"post",
         	data:datapost,
         	success: function(data) {
           		
				databaru = JSON.parse(data);
				

    			// Left and right fixed columns
    			$('.datatable-fixed-both').DataTable({
        				data: databaru,
						paging: true,
        				scrollX: true,
						columnDefs: [
								{
									visible: false, 
									targets: [0,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,
											 26,27,28,29,30,31,32,33,34,35,36]
								}
						]
					
    			}); 	
				      
            }  
                  
      	  });
     }
	 
	
	// Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        destroy: true,
		dom: '<"datatable-header"fTl><"datatable-scroll"t><"datatable-footer"ip>',
		
        language: {
            search: '<span>Filter:</span> _INPUT_',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        }
    });
	
	
	// Define default path for DataTables SWF file
    $.fn.dataTable.TableTools.defaults.sSwfPath = "assets/swf/datatables/copy_csv_xls_pdf.swf"


    // Tabletools defaults
    $.extend(true, $.fn.dataTable.TableTools.classes, {
        "container" : "btn-group conbar DTTT_container", // buttons container
        "buttons" : {
            "normal" : "btn btn-warning btn-block ", // default button classes
            "disabled" : "disabled" // disabled button classes
        },
        "collection" : {
            "container" : "dropdown-menu" // collection container to take dropdown menu styling
        },
        "select" : {
            "row" : "success" // selected row class
        }
    });


    // Collection dropdown defaults
    $.extend(true, $.fn.dataTable.TableTools.DEFAULTS.oTags, {
        collection: {
            container: "ul",
            button: "li",
            liner: "a"
        }
    });



	



    // External table additions
    // ------------------------------

    // Add placeholder to the datatable filter option
    $('.dataTables_filter input[type=search]').attr('placeholder','Type to filter...');


    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: "-1"
    });
	
	
    
});
