<?php
include("config/dbconfig.php");

$db1conn = null;
$db2conn = null;

function db1_connect() {
	global $db1;
	global $db1conn;
	$servername = $db1['name'];
	$username = $db1['uname'];
	$password = $db1['passwd'];
	$dbname = $db1['dbname'];
	try {
		$db1conn = new PDO("mysql:host=".$db1['name'].";dbname=".$db1['dbname'], $db1['uname'], $db1['passwd']);
		$db1conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e) {
		die($e);
	}
}

function db2_connect() {
	global $db2;
	global $db2conn;
	$servername = $db2['name'];
	$username = $db2['uname'];
	$password = $db2['passwd'];
	$dbname = $db2['dbname'];
	try {
		$db2conn = new PDO("mysql:host=".$db2['name'].";dbname=".$db2['dbname'], $db2['uname'], $db2['passwd']);
		$db2conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e) {
		die($e);
	}
}

function db1_close() {
	global $db1conn;
	$db1conn = null;
}

function db2_close() {
	global $db2conn;
	$db2conn = null;
}

function isValidID($id) {
	//TODO
}

function logVisit($id) {
	global $db2conn;
	$stmt = $db2conn->prepare("INSERT INTO visits (student_id, timestamp)
        VALUES (:id, :time)");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':time', $time);
	$time = time();
	$stmt->execute();
}

function getPastUsers($number=25) {
	//TODO
}
