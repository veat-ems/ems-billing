$(function() {
    $.ajax({
     	url: "alarm/alarm_list_today",
        async : false,
        dataType : 'json',
        success : function(data){
            var html = '';
            var i;
            var name;
            for(i=0; i<data.length; i++){
				//var var_requiredamount = data[i].requiredamount;
				var var_loop = i+1;
                // $id_serial . '|' . $area . '/' . $lokasi;
                name = data[i].id_serial + '|' + data[i].area + '/' +data[i].lokasi;
                html += '<tr>'+
	                    '<td>'+data[i].id_alarm+'</td>'+
						'<td>'+data[i].alarmtype+'</td>'+
                        '<td>'+data[i].id+'</td>'+
						'<td>'+name+'</td>'+
                        // '<td>'+data[i].id_name+'</td>'+
                        '<td>'+data[i].alarmlog+'</td>'+
                        '<td>'+data[i].date_time+'</td>'+
						'<td>'+data[i].created+'</td>'+
                        '<td>'+data[i].updated+'</td>'+
                        '</tr>';
            }
            $('#show_data').html(html);
        }

    });

});
