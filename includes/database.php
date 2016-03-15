<?php
include($_SERVER['DOCUMENT_ROOT']."config/dbconfig.php");

$db1conn = null;
$db2conn = null;

//Returns exceptions, if success returns null
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
		return $e;
	}
	return false;
}

//Returns exceptions, if success returns null
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
		return $e;
	}
	return false;
}

function db1_close() {
	global $db1conn;
	$db1conn = null;
}

function db2_close() {
	global $db2conn;
	$db2conn = null;
}

// Returns name if present, null if not
function isValidID($id) {
	global $db1conn;
	$stmt = $db1conn->prepare("SELECT `fname`, `lname` FROM `students` WHERE `id`=:id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();

	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	if($result != true)
		return null;
	$students = $stmt->fetchAll();
	if(count($students) == 0) {
		return null;
	}
	return $students[0]['fname'].' '.$students[0]['lname'];
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
