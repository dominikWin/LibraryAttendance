$(document).ready(function() {
	$("#adminLogin").submit(function(event) {
		//Form submited
		//Don't use default post
		event.preventDefault()

		$.ajax({url: "interface/adminlogin.php",
			type: "post",
			data: {uname: $("#uname").val(), passwd: $("#passwd").val()},
			success: function(result) {
				console.log(result)
			},
			error: handleError
		})

		$("#uname").val("")
		$("#passwd").val("")
	})
})
