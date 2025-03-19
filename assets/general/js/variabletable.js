$(function() {
    $.ajax({
     	url: "variabletable/data_list",
        async : false,
        dataType : 'json',
        success : function(data){
            var html = '';
            var i;
            for(i=0; i<data.length; i++){
				//var var_requiredamount = data[i].requiredamount;
				var var_loop = i+1;
                html += '<tr>'+
                  		'<td>'+ var_loop +'</td>'+
	                    '<td>'+data[i].id_name+'</td>'+
                        '<td>'+data[i].id+'</td>'+
                        '<td>'+data[i].date_time+'</td>'+
 						'<td>'+data[i].v1+'</td>'+
 						'<td>'+data[i].v2+'</td>'+
 						'<td>'+data[i].v3+'</td>'+
 						'<td>'+data[i].v12+'</td>'+
 						'<td>'+data[i].v23+'</td>'+
 						'<td>'+data[i].v31+'</td>'+
 						'<td>'+data[i].i1+'</td>'+
 						'<td>'+data[i].i2+'</td>'+
 						'<td>'+data[i].i3+'</td>'+
 						'<td>'+data[i].inet+'</td>'+
 						'<td>'+data[i].watt1+'</td>'+
 						'<td>'+data[i].watt2+'</td>'+
 						'<td>'+data[i].watt3+'</td>'+
 						'<td>'+data[i].watt+'</td>'+
 						'<td>'+data[i].va1+'</td>'+
 						'<td>'+data[i].va2+'</td>'+
 						'<td>'+data[i].va3+'</td>'+
 						'<td>'+data[i].va+'</td>'+
 						'<td>'+data[i].freq+'</td>'+
 						'<td>'+data[i].pf1+'</td>'+
 						'<td>'+data[i].pf2+'</td>'+
 						'<td>'+data[i].pf3+'</td>'+
 						'<td>'+data[i].kwh_imp+'</td>'+
 						'<td>'+data[i].kwh_exp+'</td>'+
 						'<td>'+data[i].kvarh_imp+'</td>'+
 						'<td>'+data[i].kvarh_exp+'</td>'+
 						'<td>'+data[i].kvah+'</td>'+
 						'<td>'+data[i].thd_v1+'</td>'+
 						'<td>'+data[i].thd_v2+'</td>'+
 						'<td>'+data[i].thd_v3+'</td>'+
 						'<td>'+data[i].thd_i1+'</td>'+
 						'<td>'+data[i].thd_i2+'</td>'+
 						'<td>'+data[i].thd_i3+'</td>'+
                        '</tr>';
            }
            $('#show_data').html(html);
        }

    });

});
