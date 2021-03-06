<?php

if(!isset($_COOKIE['sid'])) {
	include_once($_SERVER['DOCUMENT_ROOT']."/libraryattendance/includes/fail.php");
}

$hash = $_COOKIE['sid'];

if(strlen($hash) < 40 || strlen($hash) > 40) {
	echo "Hash is invalid length";
	exit();
}

if(!ctype_alnum($hash)) {
	echo "sid is not valid";
	exit();
}

include_once($_SERVER['DOCUMENT_ROOT']."/libraryattendance/includes/database.php");

$status = db2_connect();

if(is_null($status)) {
	echo json_encode(array("status" => 30, "error" => "Error connecting to database"));
	exit();
}

$name = verify_session($_COOKIE['sid']);

if($name === null) {
	include_once($_SERVER['DOCUMENT_ROOT']."/libraryattendance/includes/fail.php");
}

?>
