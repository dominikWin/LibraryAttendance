<?php

function read_file($name) {
	$full_path = $_SERVER['DOCUMENT_ROOT']."/config/".$name.".txt";
	return rtrim(file_get_contents($full_path));
}

//Any unchangeable config defined here
$CONF = array("cost" => 12);

function add_conf($name) {
	global $CONF;
	$add = read_file($name);
	$new = array($name => $add);
	$CONF = array_merge($CONF, $new);
}

function set_conf_value($key, $value) {
	global $CONF;
	$full_path = $_SERVER['DOCUMENT_ROOT']."/config/".$key.".txt";
	file_put_contents($full_path, $value);
	$CONF[$key] = $value;
}

/*
.txt extension is used to ensure deploy script sends config files.
*/

add_conf("name");

?>
