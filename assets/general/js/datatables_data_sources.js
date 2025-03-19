/* ------------------------------------------------------------------------------
*
*  # Datatables data sources
*
*  Specific JS code additions for datatable_data_sources.html page
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


   
	
	DataTabelAjax("http://localhost/powermeter/report/tampil", "");
	function DataTabelAjax(link, datapost) {
      	var dataHome = "";
      
      	$.ajax({
         	url: link,
         	type:"post",
         	data:datapost,
         	success: function(data) {
           		
				dataHome = JSON.parse(data);
		
		
		

   
    $('.datatable-js').dataTable({
        data: dataHome,
						paging: false,
        				scrollX: true,
        				scrollY: '400px',
        				scrollCollapse: true,
        				fixedColumns: {
            				leftColumns: 1,
							leftColumns: 2
        				},
        columnDefs: []
    });
            	      
            }  
                  
      	  });
     }
	
	





    // External table additions
    // ------------------------------

    // Add placeholder to the datatable filter option
    $('.dataTables_filter input[type=search]').attr('placeholder','Type to filter...');


    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: "-1"
    });
    
});
