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
        autoWidth: false,
        destroy: true,
        dom: '<"datatable-header"fTl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
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

	


	
	var dataHome = "";
      
    $.ajax({
         url: "billing/ajax_list",
         type:"post",
		data: {"tarif" : document.getElementById("tarif").value, "kurs" : document.getElementById("kurs").value, "dari" : document.getElementById("dari").value, "dari_time" : document.getElementById("dari_time_2").value, "sampai" : document.getElementById("sampai").value, "sampai_time" : document.getElementById("sampai_time_2").value, "selectedmeters" : document.getElementById("lstBox2").value },
         success: function(data) {
           dataHome = JSON.parse(data);
         
           $('.datatable-billing').dataTable({
           		paging: true,
				filter: true,
				data: dataHome,
				order: [[ 1, "asc" ]],
				dom: 'Bfrtip',
				        buttons: [
				            'copy', 'csv', 'excel', 'print'
				        ],
    		});
         
            	      
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
