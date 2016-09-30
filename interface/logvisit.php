<?php

header("Content-Type: application/json");

if(!isset($_POST['q'])) {
	echo json_encode(array("status" => 40, "error" => "No ID given"));
	exit();
}

$id = intval($_POST['q']);

if($id === 0) {
	echo json_encode(array("status" => 41, "error" => "ID not a valid number"));
	exit();
}

include($_SERVER['DOCUMENT_ROOT']."libraryattendance/includes/database.php");

$status = db2_connect();

if(is_null($status)) {
	echo json_encode(array("status" => 30, "error" => "Error connecting to database"));
	exit();
}


$status = db1_connect();

if(is_null($status)) {
	echo json_encode(array("status" => 30, "error" => "Error connecting to database"));
	exit();
}

$name = is_valid_id($id);
if($name == null) {
	echo json_encode(array("status" => 10, "error" => "No student with given ID"));
	exit();
}

log_visit((string) $id);

echo json_encode(array("status" => 0, "name" => $name));
