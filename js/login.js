function hideStatus() {
	$('#s-status').collapse("hide")
	$('#e-status').collapse("hide")
}

function handleSuccess(result) {
	if(result.status == 0) {
		$('#s-status').collapse("show")
		setTimeout(hideStatus, 1000)
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
				success: handleSuccess
			})
		}
	})

})
