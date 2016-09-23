<?php

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

$students = get_past_students($id);

echo json_encode(array("status" => 0, "students" => $students));
