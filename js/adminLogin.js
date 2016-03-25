function showLoginFail() {
	$('#admin-error').collapse('show')
}

function closeLoginFail() {
	$('#admin-error').collapse('hide')
}

function adminLoginSuccess(result) {
	console.log(result)
	if(result.status == 6 || result.status == 5) {
		//Failed
		showLoginFail()
		setTimeout(closeLoginFail, 2500)
	}
	else {
		//Success
	}
}

$(document).ready(function() {
	$("#adminLogin").submit(function(event) {
		//Form submited
		//Don't use default post
		event.preventDefault()

		$.ajax({url: "interface/adminlogin.php",
			type: "post",
			data: {uname: $("#uname").val(), passwd: $("#passwd").val()},
			success: adminLoginSuccess
		})

		$("#uname").val("")
		$("#passwd").val("")
	})
})
