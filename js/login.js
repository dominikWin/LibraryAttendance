//Default number of students to list
var listed_students = 10

function loadMore() {
	if(listed_students < 100)
		listed_students += 10
	if(listed_students >= 100) {
		$('#loadMoreContainer').html('')
	}
	reloadUsers()
}

function hideStatus() {
	$('#s-status').collapse("hide")
	$('#e-status').collapse("hide")
}

function handleError(obj, text, error) {
	$('#db-message').html("<span class=\"glyphicon glyphicon-remove\"></span>  Error connecting to server!")
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
		//Form submitted

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

	for(var i = 0; i < result.users.length; i++) {
		if(result.users[i].img.length == 0) continue

		text += '\n<li class="list-group-item"><img height=\'' + img_height + '\' width=\'' + img_width + '\' src=\'' + result.users[i].img + '\'> ' + result.users[i].name + '</li>'
	}
	$("#student-list").html(text)

	//Remove load more button if out of students
	if(result.users.length < listed_students)
		$("#loadMoreContainer").html('')
	else
		$("#loadMoreContainer").html('<button class="btn btn-default" onclick="loadMore();" style="width:100%;">Load More</button>')
}

function reloadUsers() {
	$.ajax({
		url: "interface/fetchlast.php/" + listed_students,
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
