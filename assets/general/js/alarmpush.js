/* ------------------------------------------------------------------------------

 *

 *  # Push Alarm Notification

 *

 * ---------------------------------------------------------------------------- */



$(function () {


	 clearInterval(timeAlarm);

	 var timeAlarm = setInterval(function () {

	 	$.ajax({

         	url: "alarm/pushdataalarm",

         	type:"post",

         	success: function(data) {

					dataku = JSON.parse(data);	
					
					var obj = dataku[0];
					
					var alarm_description  = obj.alarm_description;
					
					var alarm_link  = obj.alarm_link;
					var alarm_notif  = obj.alarm_notif;
				
					
 					document.getElementById('id_alarm_content').innerHTML  = alarm_description;

					document.getElementById('id_alarm_link').innerHTML  = alarm_link;
					
					document.getElementById('id_alarm_notif').innerHTML  = alarm_notif;
					/*
					if (alarm_link == '') {
						var alarm_str_notif = '<span class="badge badge-warning navbar-badge">X</span>';
					} else {
						var alarm_str_notif = '<span class="badge badge-warning navbar-badge">N</span>';
					}
					*/

         	}                 

   	 	});

	}, 600000000);                 

});


$(document).ready(function(){
    $('#togglealarm').change(function() {
        if ($(this).prop('checked')) {
            //alert(" - ON2 - "); //checked

			$.ajax({
				type: "POST",
				url: "alarm/togglesave",
				data: {"alarmonoff" : 1 },
			}).done(function(data) {
				//alert('ok');
				$('#id_alarm_all').show();
			});
			
        }
        else {
            //alert(" - OFF - "); //not checked

			$.ajax({
				type: "POST",
				url: "alarm/togglesave",
				data: {"alarmonoff" : 0 },
			}).done(function(data) {
				//alert('ok');
				$('#id_alarm_all').hide();
			});
        }
    });


	$('.toggleitemalarm').change(function() {
        //alert("Text: " + $(this).val());
		var_id_alarm = $(this).val();
		$.ajax({
			type: "POST",
			url: "alarm/toggleitemsave",
			data: {"id_alarm" : var_id_alarm},
		}).done(function(data) {
			//alert('ok');
			$('#alarm_' + var_id_alarm).hide();
		});
    });


	$('.xyz').click(function() {
        alert("Text: " + $(this).val());
	
    });

	$("#btnalarm").click(function(){
	        alert("button");
	    });
});
