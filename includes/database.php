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

//Returns array of users
function getPastUsers($number=25) {
	global $db2conn;
	$stmt = $db2conn->prepare("SELECT `student_id` FROM visits ORDER BY id DESC LIMIT ".$number);
	$stmt->execute();

	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	if($result != true)
		return null;
	$students = $stmt->fetchAll();
	$names = array();
	for($i = 0; $i < count($students); $i++) {
		array_push($names, isValidID(intval($students[$i]['student_id'])));
	}
	return $names;
}

//Returns id if exists, null if not
function isAdmin($uname, $passwd) {
	global $db2conn;
	$stmt = $db2conn->prepare("SELECT `id`, `passwd` FROM `admins` WHERE `uname` = :name");
	$stmt->bindparam(':name', $uname);
	$stmt->execute();

	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	if($result != true)
		return null;
	$admins = $stmt->fetchAll();
	if(count($admins) == 0)
		return null;
	if(count($admins) > 1)
		error_log("More than one admin with valid uname ".$uname, 0);
	if(!password_verify($passwd, $admins[0]['passwd'])) {
		error_log("Rejected login request from ".$_SERVER['REMOTE_ADDR'], 0);
		return null;
	}
	return $admins[0]['id'];
}

function generateSessionID($id) {
	return sha1(strval(microtime()).strval($id).strval(rand()));
}

//Returns array with "key", "timestamp", and "expireIn"
function addSessionID($id) {
	global $db2conn;
	$key = generateSessionID($id);
	$timestamp = time();
	$expireIn = 3600;

	$stmt = $db2conn->prepare("INSERT INTO `admin_sessions`(`user_id`, `hash`, `timestamp`, `expire`) VALUES (:id,:hash,:timestamp,:expire)");
	$stmt->bindparam(':id', $id);
	$stmt->bindparam(':hash', $key);
	$stmt->bindparam(':timestamp', $timestamp);
	$stmt->bindparam(':expire', $expireIn);
	$stmt->execute();

	return array('key' => $key, 'timestamp' => $timestamp, 'expireIn' => $expireIn);
}

//Returns name if valid, null if not
function verifySession($hash) {
	global $db2conn;

	$stmt = $db2conn->prepare("SELECT `user_id` FROM `admin_sessions` WHERE `hash` = :hash");
	$stmt->bindParam(':hash', $hash);
	$stmt->execute();

	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	if($result != true)
		return null;
	$sessions = $stmt->fetchAll();

	if(count($sessions) <= 0)
		return null;
	if(count($sessions) > 1)
		error_log("Multiple valid values for hash ".$hash, 0);

	$stmt = $db2conn->prepare("SELECT `uname` FROM `admins` WHERE `id` = :id");
	$stmt->bindParam(':id', $sessions[0]['user_id']);
	$stmt->execute();

	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	if($result != true)
		return null;
	$admins = $stmt->fetchAll();
	return $admins[0]['uname'];
}
