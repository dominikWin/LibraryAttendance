<?php

/*
Can take value "num" through GET.
Example: interface/fetchlast.php/10

Returns a JSON Object.

status object in each return

0 is success
<20 is expected results
<30 is server error_get_last
<40 is user error

if status is not 0 usera are not included
if status is not 0 "error" is returned with a description

status: 0, success, includes "users"
status: 42, num is not in valid range
status: 11, extra data given
status: 30, error connecting to db
status: 40, no number given
status: 41, num is not a number

users is an object that contains user objects
if user is included so is the "count"

each user object has a "name" and timestamp (as "time")
*/

header("Content-Type: application/json");

// Default: [1] => interface [2] => fetchlast.php
$uri = array_filter(explode('/', $_SERVER['REQUEST_URI']));

// Make indexs incremental
$uri = array_values($uri);


if(count($uri) <= 2) {
	echo json_encode(array("status" => 40, "error" => "No number given"));
	exit();
}

if(count($uri) > 3) {
	echo json_encode(array("status" => 11, "error" => "Extra data given"));
	exit();
}

$id = intval($uri[2]);

if($id === 0) {
	echo json_encode(array("status" => 41, "error" => "num is not a number"));
	exit();
}

if($id <1 || $id > 100) {
	echo json_encode(array("status" => 42, "error" => "num is not in valid range"));
	exit();
}

include($_SERVER['DOCUMENT_ROOT']."/includes/database.php");

$status = db1_connect();

if(is_null($status)) {
	echo json_encode(array("status" => 30, "error" => "Error connecting to database"));
	exit();
}

$status = db2_connect();

if(is_null($status)) {
	echo json_encode(array("status" => 30, "error" => "Error connecting to database"));
	exit();
}

$users = get_past_users($id);

echo json_encode(array("status" => 0, "users" => $users));
