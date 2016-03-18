function hideStatus() {
	$('#s-status').collapse("hide")
	$('#e-status').collapse("hide")
}

function handleError(obj, text, error) {
	$('#db-message').html(`<span class="glyphicon glyphicon-remove"></span>  Error connecting to server!`)
	$('#db-status').collapse('show')
}

function handleSuccess(result) {
	$('#db-status').collapse('hide')
	if(result.status == 0) {
		$('#s-status').collapse("show")
		setTimeout(hideStatus, 1000)
		reloadUsers()
	}
	else {
		$('#e-status').collapse("show")
		setTimeout(hideStatus, 1000)
	}
}

$(document).ready(function(){
	// $("#q").keypress(validateNumber);

	$("#login").submit(function(event) {
		//Form submited

		//Don't use default post
		event.preventDefault()

		//Get data
		var data = $("#q").serialize()
		$("#q").val("")

		//Clear results
		$("#result").html("")

		//serialize adds 2 chars
		if(data.length > 2) {
			$.ajax({url: "interface/logvisit.php",
				type: "post",
				data: data,
				success: handleSuccess,
				error: handleError
			})
		}
	})

})

function replaceUsers(result) {
		$('#db-status').collapse('hide')
	var text = "<li class=\"list-group-item list-group-item-heading\"><b>Students</b></li>"

	for(var i = 0; i < result.names.length; i++) {
		text += '\n<li class="list-group-item">' + result.names[i] + '</li>'
	}
	$("#student-list").html(text)
	console.log("Updated student list")
}

function reloadUsers() {
	$.ajax({
		url: "interface/retrive.php/10",
		type: "get",
		success: replaceUsers,
		error: handleError
	})
}

function updateUsers() {
	reloadUsers()
	setTimeout(updateUsers, 2500)
}

updateUsers()
