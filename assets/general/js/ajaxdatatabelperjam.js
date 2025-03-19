$(function() {
    $.ajax({
     	url: "tabelperjam/datameter",
        async : false,
        dataType : 'json',
		type:"post",
		data: {"meterid2" : document.getElementById("meterid2").value, "dari" : document.getElementById("dari").value },
        success : function(data){
            var html = '';
            var i;
            for(i=0; i<data.length; i++){
				//var var_requiredamount = data[i].requiredamount;
				var var_loop = i+1;
                html += '<tr>'+
                  		'<td>'+data[i][0]+'</td>'+
	                    '<td>'+data[i][1]+'</td>'+
                        '<td>'+data[i][2]+'</td>'+
                        '<td>'+data[i][3]+'</td>'+
                        '</tr>';
            }
            $('#show_data').html(html);
        }

    });

});
