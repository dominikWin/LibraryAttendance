<?php
include($_SERVER['DOCUMENT_ROOT']."config/dbconfig.php");

$db1conn = null;
$db2conn = null;

//Returns exceptions, if success returns null
function db1_connect() {
	global $db1;
	global $db1conn;
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

// Returns name and img if present, null if not
function is_valid_id($id) {
	global $db1conn;
	$stmt = $db1conn->prepare("SELECT `fname`, `lname`, `img` FROM `students` WHERE `id`=:id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();

	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	if($result != true)
		return null;
	$students = $stmt->fetchAll();
	if(count($students) == 0) {
		return null;
	}
	return array("name" => $students[0]['fname'].' '.$students[0]['lname'], "img" => $students[0]['img']);
}

function log_visit($id) {
	global $db2conn;
    $time = time();
    $stmt = $db2conn->prepare("INSERT INTO visits (student_id, timestamp)
                VALUES (:id, :time)");
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':time', $time);
	$stmt->execute();
}

//Returns array of users
function get_past_users($number=25) {
	global $db2conn;
	$stmt = $db2conn->prepare("SELECT `student_id` FROM visits ORDER BY id DESC LIMIT ".$number);
	$stmt->execute();

	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	if($result != true)
		return null;
	$students = $stmt->fetchAll();
	$names = array();
	for($i = 0; $i < count($students); $i++) {
		array_push($names, is_valid_id(intval($students[$i]['student_id'])));
	}
	return $names;
}

//Returns id if exists, null if not
function is_admin($uname, $passwd) {
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

function gen_session_id($id) {
	return sha1(strval(microtime()).strval($id).strval(rand()));
}

//Returns array with "key", "timestamp", and "expireIn"
function add_session_id($id) {
	global $db2conn;
	$key = gen_session_id($id);
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
function verify_session($hash) {
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
//Returns id if valid, null if not
function get_admin_id($hash) {
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

	return $sessions[0]['user_id'];
}
function get_admin_name($id) {
	global $db2conn;

	$stmt = $db2conn->prepare("SELECT `uname` FROM `admins` WHERE `id` = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();

	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	if($result != true)
		return null;
	$sessions = $stmt->fetchAll();

	if(count($sessions) <= 0)
		return null;
	if(count($sessions) > 1)
		error_log("Multiple valid admins for id ".$id, 0);

	return $sessions[0]['uname'];
}
function remove_session($sid) {
	global $db2conn;

	$stmt = $db2conn->prepare("DELETE FROM `admin_sessions` WHERE `hash` = :hash");
	$stmt->bindParam(':hash', $sid);

	$stmt->execute();
}

function revoke_expired_sessions() {
	global $db2conn;

	$stmt = $db2conn->prepare("DELETE FROM `admin_sessions` WHERE `timestamp` + `expire` < ".strval(time()));
	$stmt->execute();
}

function get_name($id) {
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
	return array('fname' => $students[0]['fname'], 'lname' => $students[0]['lname']);
}

function get_visits_table($number=10, $id=0) {
	global $db2conn;
	$args = "";
	if($id > 0) {
		$args = $args." WHERE `student_id` = ".strval($id);
	}
	$args = $args." ORDER BY id DESC";
	if($number > -1) {
		$args = $args." LIMIT ".strval($number);
	}
	$stmt = $db2conn->prepare("SELECT `student_id`, `timestamp` FROM visits".$args);
	$stmt->execute();

	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	if($result != true)
		return null;
	$students = $stmt->fetchAll();
	$names = array();
	for($i = 0; $i < count($students); $i++) {
		array_push($names, array('name' => get_name(intval($students[$i]['student_id'])), 'id' => $students[$i]['student_id'], 'time' => intval($students[$i]['timestamp'])));
	}
	return $names;
}

function get_admins() {
	global $db2conn;
	$stmt = $db2conn->prepare("SELECT `id`, `uname` FROM `admins` WHERE 1");
	$stmt->execute();

	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	if($result != true)
		return null;
	$admins = $stmt->fetchAll();
	return $admins;
}

function remove_admin($id) {
	global $db2conn;
	if($id == 1) {
		die("Trying to remove root!");
	}
	$stmt = $db2conn->prepare("DELETE FROM `admins` WHERE `id` = :id");
	$stmt->bindparam(':id', $id);
	$stmt->execute();
}

function update_admin_hash($id, $hash) {
	global $db2conn;
	$stmt = $db2conn->prepare("UPDATE `admins` SET `passwd` = :hash WHERE `id` = :id");
	$stmt->bindparam(':id', $id);
	$stmt->bindparam(':hash', $hash);
	$stmt->execute();
}

function add_admin($uname, $hash) {
	global $db2conn;
	$stmt = $db2conn->prepare("INSERT INTO `admins`(`uname`, `passwd`) VALUES (:uname,:passwd)");
	$stmt->bindparam(':uname', $uname);
	$stmt->bindparam(':passwd', $hash);
	$stmt->execute();
}

function count_visits() {
	global $db2conn;
	$stmt = $db2conn->prepare("SELECT COUNT(*) FROM `visits`");
	$stmt->execute();

	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	if($result != true)
		return null;
	$cnt = $stmt->fetchAll();
	return intval($cnt[0]['COUNT(*)']);
}
