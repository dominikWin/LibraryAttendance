<?php

include($_SERVER['DOCUMENT_ROOT']."/includes/database.php");

$status = db2_connect();

if(is_null($status)) {
	echo json_encode(array("status" => 30, "error" => "Error connecting to database"));
	exit();
}

echo verifySession($_COOKIE['sid']);
