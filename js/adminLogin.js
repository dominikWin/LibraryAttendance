$(document).ready(function() {
	$("#adminLogin").submit(function(event) {
		//Form submited
		//Don't use default post
		event.preventDefault()

		$.ajax({url: "interface/adminlogin.php",
			type: "post",
			data: {uname: $("#uname").val().length, passwd: $("#passwd").val().length},
			success: function(result) {
				console.log(result)
			},
			error: handleError
		})

		$("#uname").val("")
		$("#passwd").val("")
	})
})
