$(function() {
    $.ajax({
     	url: "../alarm/data_list_alarmhistory",
        async : false,
        dataType : 'json',
        success : function(data){
            var html = '';
            var i;
            for(i=0; i<data.length; i++){
				//var var_requiredamount = data[i].requiredamount;
				var var_loop = i+1;
                html += '<tr>'+
	                    '<td>'+data[i].id_alarm+'</td>'+
                        '<td>'+data[i].id_name+'</td>'+
						'<td>'+data[i].id_meter+'</td>'+
						'<td>'+data[i].date_time+'</td>'+
						'<td>'+data[i].alarmlog+'</td>'+
                        '</tr>';
            }
            $('#show_data').html(html);
        }

    });

});
