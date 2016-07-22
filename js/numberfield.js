$(document).ready(function() {
	$("[numonly]").keypress(validateNumber)
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
	else return !(key < 48 || key > 57);
};
