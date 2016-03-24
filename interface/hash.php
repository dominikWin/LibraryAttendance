<?php

header("Content-Type: application/json");

// Default: [1] => interface [2] => hash.php
$uri = array_filter(explode('/', $_SERVER['REQUEST_URI']));

// Make indexs incremental
$uri = array_values($uri);


if(count($uri) <= 2) {
	echo json_encode(array("status" => 40, "error" => "No password given"));
	exit();
}

if(count($uri) > 3) {
	echo json_encode(array("status" => 11, "error" => "Extra data given"));
	exit();
}

$password = $uri[2];

$options = [
    'cost' => 12,
];

$password = password_hash($password, PASSWORD_BCRYPT, $options);

echo json_encode(array("status" => 0, "passwd" => $uri[2], "length" => strlen($uri[2]), "hash" => $password));
