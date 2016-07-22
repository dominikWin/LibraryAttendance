function showLoginFail() {
	$('#admin-error').collapse('show')
}

function closeLoginFail() {
	$('#admin-error').collapse('hide')
}

function adminLoginSuccess(result) {
	console.log(result)
	if(result.status != 0) {
		//Failed
		showLoginFail()
		setTimeout(closeLoginFail, 2500)
	}
	else {
		//Success
		console.log("successful login")

		if(sidExists())
			removeSID()

		setSID(result.key)

		top.location = "admin/visits.php"
	}
}

function emptyInputs() {
	$("#uname").val("")
	$("#passwd").val("")
}

$(document).ready(function() {
	$("#adminLogin").submit(function(event) {
		//Form submitted
		//Don't use default post
		event.preventDefault()

		if($('#uname').val().length == 0) {
			emptyInputs()
			return
		}
		if($('#passwd').val().length == 0) {
			emptyInputs()
			return
		}

		$.ajax({url: "interface/adminlogin.php",
			type: "post",
			data: {uname: $("#uname").val(), passwd: $("#passwd").val()},
			success: adminLoginSuccess
		})
		emptyInputs()
	})
})
