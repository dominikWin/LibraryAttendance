<?php

if(!isset($_COOKIE['sid'])) {
	include($_SERVER['DOCUMENT_ROOT']."/includes/fail.php");
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

include($_SERVER['DOCUMENT_ROOT']."/includes/database.php");

$status = db2_connect();

if(is_null($status)) {
	echo json_encode(array("status" => 30, "error" => "Error connecting to database"));
	exit();
}

$name = verifySession($_COOKIE['sid']);

if($name === null) {
	include($_SERVER['DOCUMENT_ROOT']."/includes/fail.php");
}

$config = include($_SERVER['DOCUMENT_ROOT']."/includes/config.php");
//If execution gets here display dashboard
?>
