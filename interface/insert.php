<?php

// print_r($_POST);
include($_SERVER['DOCUMENT_ROOT']."/includes/database.php");
// print_r($db2);

if(!isset($_POST['q'])) {
	die("No query value");
}

db2_connect();
logVisit(htmlspecialchars($_POST['q']));
db2_close();
