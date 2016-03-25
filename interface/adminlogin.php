<?php

/*

Takes a "uname" and "passwd" through POST.

Checks if admin exists and issues a session key

Returns a JSON object.

status object in each return

0 is success
<20 is expected results
<30 is server error_get_last

if status is not 0 "key", "timestamp" and "expireIn" are not included
if status is not 0 "error" is returned with a description

status: 0, success, includes "key", "timestamp" and "expireIn"
status: 10, uname not found
status: 11, passwd not found
status: 5, invalid uname/passwd
status: 6, admin not found
status: 30, error connecting to db

*/

header("Content-Type: application/json");

if(!isset($_POST['uname'])) {
	echo json_encode(array("status" => 10, "error" => "No uname given"));
	exit();
}

if(!isset($_POST['passwd'])) {
	echo json_encode(array("status" => 11, "error" => "No passwd given"));
	exit();
}

$uname = $_POST['uname'];
$passwd = $_POST['passwd'];

if((!ctype_alnum($uname)) || (!ctype_alnum($passwd))) {
	echo json_encode(array("status" => 5, "error" => "uname and passwd are not alphanumeric"));
	exit();
}

include($_SERVER['DOCUMENT_ROOT']."/includes/database.php");

$status = db2_connect();

if(is_null($status)) {
	echo json_encode(array("status" => 30, "error" => "Error connecting to database"));
	exit();
}

$id = isAdmin($uname, $passwd);

if(is_null($id)) {
	echo json_encode(array("status" => 6, "error" => "no admin found"));
	exit();
}

$values = addSessionID($id);

echo json_encode(array('status' => 0, 'key' => $values['key'], 'timestamp' => $values['timestamp'], 'expireIn' => $values['expireIn']));
