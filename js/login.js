$(document).ready(function(){

	$("#q").keypress(validateNumber);

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
			$.ajax({url: "insert.php", type: "post", data: data,
			success: function(result) {
				$("#result").html(result)
			}})
		}
	})

})

//Thanks stackoverflow
function validateNumber(event) {
	//If this fails see http://stackoverflow.com/questions/469357/html-text-input-allow-only-numeric-input
	var key = window.event ? event.keyCode : event.which
	if (event.keyCode === 8 || event.keyCode === 46
 	|| event.keyCode === 37 || event.keyCode === 39
	|| event.keyCode === 13) {
		return true
	}
	else if ( key < 48 || key > 57 ) {
		return false
	}
	else return true
};
