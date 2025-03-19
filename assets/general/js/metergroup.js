$(function() {
    $.ajax({
     	url: "metergroup/data_list",
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
		                    '<td>'+data[i].metergroupid+'</td>'+
	                        '<td>'+data[i].metergroupname+'</td>'+
							'<td style="text-align:center;">'+
								'<a href="metergroup/edit/'+data[i].metergroupid+'/'+var_random+'" class="btn btn-warning btn-xs item_edit" title="Edit" data-metergroupid="'+data[i].metergroupid+'" data-metergroupname="'+data[i].metergroupname+'"><i class="fas fa-edit"></i></a>'+' '+
	                            '<a onClick="javascript:delete_item(\''+data[i].metergroupid+'\',\''+data[i].metergroupname+'\');" class="btn btn-danger btn-xs item_delete" title="Delete" data-metergroupid="'+data[i].metergroupid+'"><i class="fas fa-trash-alt"></i></a>'+
	                        '</td>'+
	                        '</tr>';
				} else {
					html += '<tr>'+
		                    '<td>'+data[i].metergroupid+'</td>'+
	                        '<td>'+data[i].metergroupname+'</td>'+
							'<td style="text-align:center;">'+
								''+
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
		window.location = 'metergroup/delete/' + item_id;
    } 
}