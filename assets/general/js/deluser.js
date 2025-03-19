$(function() {
	//function to initiate Toastr notifications
	 	
		$(".button1").on("click", function(e) {
			var memberId = $(this).attr('id');
			swal({
				title: "Are you sure?",
				text: "You will not be able to recover this Username!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes, delete it!",
				cancelButtonText: "No, cancel pls!",
				closeOnConfirm: false,
				closeOnCancel: false
			}, function(isConfirm) {
				if(isConfirm) {
					swal("Deleted!", "This Username has been deleted.", "success");
					$(location).attr('href','user/delete/'+memberId);
					
				} else {
					swal("Cancelled", "This Username is safe :)", "error");
				}
			});

			e.preventDefault
		});  
		
		
		
		
});