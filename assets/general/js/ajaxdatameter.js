$(function() {

	function numberWithCommas(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	  }

    $.ajax({
     	url: "meterdata/data_list",
        async : false,
        dataType : 'json',
        success : function(data){
            var html = '';
            var i;
            for(i=0; i<data.length; i++){
				//var var_requiredamount = data[i].requiredamount;
				var var_random = Math.floor((Math.random() * 1000) + 1);
				var var_loop = i+1;
				
				if (data[i].userlevel == "ADM") {
					html += '<tr>'+
		                    '<td>'+data[i].id+'</td>'+
							'<td>'+data[i].type+'</td>'+
	                        '<td>'+data[i].id_serial+'</td>'+
	                        '<td>'+data[i].id_name+'</td>'+
							'<td>'+data[i].metergroupname_formatted+'</td>'+
							'<td>'+data[i].lokasi+'</td>'+
							'<td>'+numberWithCommas(data[i].p_nominal)+'</td>'+
							'<td>'+numberWithCommas(data[i].v_nominal)+'</td>'+
							'<td>'+numberWithCommas(data[i].i_nominal)+'</td>'+
							'<td style="text-align:center;">'+
								'<a href="meterdata/edit/'+data[i].id_meter+'/'+var_random+'" class="btn btn-warning btn-xs item_edit" title="Edit" data-id_meter="'+data[i].id_meter+'" data-idid="'+data[i].id+'" data-id_serial="'+data[i].id_serial+'" data-id_name="'+data[i].id_name+'" data-lokasi="'+data[i].lokasi+'" data-type="'+data[i].type+'" data-power="'+data[i].p_nominal+'"><i class="fas fa-edit"></i></a>'+' '+
	                            '<a onClick="javascript:delete_item('+data[i].id_meter+',\''+data[i].id+'\');" class="btn btn-danger btn-xs item_delete" title="Delete" data-id_meter="'+data[i].id_meter+'"><i class="fas fa-trash-alt"></i></a>'+
	                        '</td>'+
	                        '</tr>';
				} else {
					html += '<tr>'+
							'<td>'+data[i].id+'</td>'+
							'<td>'+data[i].type+'</td>'+
							'<td>'+data[i].id_serial+'</td>'+
							'<td>'+data[i].id_name+'</td>'+
							'<td>'+data[i].metergroupname_formatted+'</td>'+
							'<td>'+data[i].lokasi+'</td>'+
							'<td>'+numberWithCommas(data[i].p_nominal)+'</td>'+
							'<td>'+numberWithCommas(data[i].v_nominal)+'</td>'+
							'<td>'+numberWithCommas(data[i].i_nominal)+'</td>'+
							'<td style="text-align:center;">'+
								'<a href="meterdata/edit/'+data[i].id_meter+'/'+var_random+'" class="btn btn-warning btn-xs item_edit" title="Edit" data-id_meter="'+data[i].id_meter+'" data-idid="'+data[i].id+'" data-id_serial="'+data[i].id_serial+'" data-id_name="'+data[i].id_name+'" data-lokasi="'+data[i].lokasi+'" data-type="'+data[i].type+'" data-power="'+data[i].p_nominal+'"><i class="fas fa-search"></i></a>'+' '+
	                        '</td>'+
	                        '</tr>';
				}
                
            }
            $('#show_data').html(html);
        }

    });

});


function delete_item(item_id, item_name){

	var conf = confirm("Are you sure to delete data " + item_name);
    if(conf == true){
		//alert('delete ' + item_id);
		window.location = 'meterdata/delete/' + item_id;
    } 
}