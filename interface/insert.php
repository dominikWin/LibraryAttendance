<?php

/*

Takes value "q" through POST.

Returns a JSON object.

status object in each return

0 is success
<20 is expected results
<30 is server error_get_last
<40 is user error

if status is not 0 name is not included
if status is not 0 "error" is returned with a description

status: 0, success, includes "name"
status: 10, id not found
status: 30, error connecting to db
status: 31, found but name wrong
status: 40, id not included
status: 41, id not a number

*/

if(isset(!$_POST['id']) {
	
}
else {
	include($_SERVER['DOCUMENT_ROOT']."/includes/database.php");
}