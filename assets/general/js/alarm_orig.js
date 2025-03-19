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


    // Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        
        dom: '<"datatable-scroll datatable-scroll-wrap"t>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        }
    });



	
	
	
	
	
    // Left and right fixed columns
    $('.datatable-fixed-both').DataTable({
        
						
		paging: false,
		columns: [
			{ "title": "<b style='color:#FFFFFF;'>ID</b>"}, 
			{ "title": "<b style='color:#FFFFFF;'>OVER VOLTAGE</b>"}, 
			{ "title": "<b style='color:#FFFFFF;'>UNDER VOLTAGE</b>"}, 
			{ "title": "<b style='color:#FFFFFF;'>OVER CURRENT</b>"}, 
			{ "title": "<b style='color:#FFFFFF;'>UNDER CURRENT</b>"}],
		columnDefs: [
            
            {   
				width: "120px",
                targets: [0]
            },
			{   width: "100px",
                targets: [1]
            },
            { 
                width: "100px",
                targets: [2,3,4]
            }
        ],
        scrollX: true
    });
	
	
	// Left and right fixed columns
    $('.datatable-log').DataTable({
        paging: false,
		columnDefs: [
            
            { 
               	width: "90px",
                targets: [0]
            },
            { 
                width: "50px",
                targets: [1]
            },
            { 
                width: "90px",
                targets: [2]
            },
            { 
                width: "400px",
                targets: [3]
            }
        ],
        scrollX: true
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
