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

	function DataTabel(datapost) {
      	var databaru = "";
		$.ajax({
         	url: 'tabelperjam/datameter',
         	type:"post",
         	data:datapost,
         	success: function(data) {
           		//alert(data);
				databaru = JSON.parse(data);

    			// Left and right fixed columns
    			$('.datatable-tabel-per-jam').DataTable({
        				destroy: true,		
						data: databaru,
						paging: true,
        				scrollX: true,
						columnDefs: [
								{
									visible: true, 
									targets: [0,1,2,3]
								},
            					{ 
                				  	width: "150px",
                					targets: [0]
           						},
            					{ 
                				  	width: "40px",
                					targets: [1]
            					},
            					{ 
                				  	width: "30px",
                					targets: [2,3]
            					}
						],
						dom: 'Bfrtip',
						        buttons: [
						            'copy', 'csv', 'excel', 'print'
						        ],
        				fixedColumns: {
            				leftColumns: 0,
							leftColumns: 1
        				},
						
						iDisplayLength: -1
					
    			}); 	
				      
            }  
                  
      	  });
     }
		  

    
	
	var id       = $("#meterid").val();
	var tanggal  = $("#tanggal").val();
	
	
	var dataposall = "id="+escape(id)+"&tanggal="+tanggal;
	// alert(dataposall);
	DataTabel(dataposall);
	
	 
		
	$("#btnView").on("click", function(e) {
    	var id2       = $("#meterid").val();
    	var tanggal2  = $("#tanggal").val();
    	var dataposall2 = "id="+escape(id2)+"&tanggal="+tanggal2;
		//alert(dataposall2);
    	DataTabel(dataposall2);
	});  


   	// Table setup
	    // ------------------------------

	    // Setting datatable defaults
	    $.extend( $.fn.dataTable.defaults, {
	        destroy: true,
			dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',

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
	
	
