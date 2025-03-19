$(function() {
    $.ajax({
     	url: "user/data_list",
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
		                    '<td>'+data[i].username+'</td>'+
	                        '<td>'+data[i].nama+'</td>'+
	                        '<td>'+data[i].email+'</td>'+
	 						'<td>'+data[i].level+'</td>'+
							'<td>'+data[i].aktif+'</td>'+
							'<td style="text-align:center;">'+
								'<a href="user/edit/'+data[i].id_user+'/'+var_random+'" class="btn btn-warning btn-xs item_edit" title="Edit" data-id_meter="'+data[i].id_meter+'" data-idid="'+data[i].id+'" data-id_serial="'+data[i].id_serial+'" data-id_name="'+data[i].id_name+'" data-type="'+data[i].type+'" data-power="'+data[i].power+'"><i class="fas fa-edit"></i></a>'+' '+
	                            '<a onClick="javascript:delete_item(\''+data[i].id_user+'\',\''+data[i].username+'\');" class="btn btn-danger btn-xs item_delete" title="Delete" data-id_meter="'+data[i].id_meter+'"><i class="fas fa-trash-alt"></i></a>'+' '+
								'<a href="user/usermetergroup/'+data[i].id_user+'/'+var_random+'" class="btn btn-info btn-xs" title="Set User Group" data-id_meter="'+data[i].id_meter+'"><i class="fas fa-key"></i></a>'+
	                        '</td>'+
	                        '</tr>';
				} else {
					html += '<tr>'+
		                    '<td>'+data[i].username+'</td>'+
	                        '<td>'+data[i].nama+'</td>'+
	                        '<td>'+data[i].email+'</td>'+
	 						'<td>'+data[i].level+'</td>'+
							'<td>'+data[i].aktif+'</td>'+
							'<td style="text-align:center;">'+
								'<a href="user/edit/'+data[i].id_user+'/'+var_random+'" class="btn btn-warning btn-xs item_edit" title="Edit" data-id_meter="'+data[i].id_meter+'" data-idid="'+data[i].id+'" data-id_serial="'+data[i].id_serial+'" data-id_name="'+data[i].id_name+'" data-type="'+data[i].type+'" data-power="'+data[i].power+'"><i class="fas fa-search"></i></a>'+' '+
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
		window.location = 'user/delete/' + item_id;
    } 
}