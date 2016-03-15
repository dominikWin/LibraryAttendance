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

status: 0, success, includes "name", added request to db
status: 10, id not found
status: 11, extra data given
status: 30, error connecting to db
status: 41, id not a number
status: 40, id not given

*/

header("Content-Type: application/json");

// Default: [1] => interface [2] => insert.php
$uri = array_filter(explode('/', $_SERVER['REQUEST_URI']));

// Make indexs incremental
$uri = array_values($uri);


if(count($uri) <= 2) {
	echo json_encode(array("status" => 40, "error" => "No ID given"));
	exit();
}

if(count($uri) > 3) {
	echo json_encode(array("status" => 11, "error" => "Extra data given"));
	exit();
}

$id = intval($uri[2]);

if($id === 0) {
	reset($uri);
	print_r($uri);
	echo json_encode(array("status" => 41, "error" => "ID not a valid number"));
	exit();
}

include($_SERVER['DOCUMENT_ROOT']."/includes/database.php");

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

$name = isValidID($id);
if($name == null) {
	echo json_encode(array("status" => 10, "error" => "No student with given ID"));
	exit();
}

logVisit((string) $id);

echo json_encode(array("status" => 0, "name" => $name));
