<?php

function read_file($name) {
	$full_path = $_SERVER['DOCUMENT_ROOT']."/config/".$name.".txt";
	$file = fopen($full_path, 'r');
	$text = fread($file, filesize($full_path));
	fclose($file);
	return rtrim($text);
}

//Any unchangable config defined here
$CONF = array("cost" => 12);

function add_conf($name) {
	global $CONF;
	$add = read_file($name);
	$new = array($name => $add);
	$CONF = array_merge($CONF, $new);
}

/*
.txt extention is used to ensure deploy script sends config files.
*/

add_conf("name");

?>
