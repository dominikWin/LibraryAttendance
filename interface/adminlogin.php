<?php

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

include($_SERVER['DOCUMENT_ROOT']."libraryattendance/includes/database.php");

$status = db2_connect();

if(is_null($status)) {
	echo json_encode(array("status" => 30, "error" => "Error connecting to database"));
	exit();
}

$id = is_admin($uname, $passwd);

if(is_null($id)) {
	echo json_encode(array("status" => 6, "error" => "no admin found"));
	exit();
}

$values = add_session_id($id);

echo json_encode(array('status' => 0, 'key' => $values['key'], 'timestamp' => $values['timestamp'], 'expireIn' => $values['expireIn']));
