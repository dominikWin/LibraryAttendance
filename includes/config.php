<?php

$conf_file = "/etc/libraryattendance.json";

$json = NULL;

if(file_exists($conf_file)) {
	$contents = file_get_contents($conf_file);
	$json = json_decode($contents);
}

if($json == NULL) {
	die("Invalid settings file");
}

function validate($json, $key) {
	if(isset($json->{$key}))
		return;
	die("Setting not defined [".$key."]");
}

validate($json, "name");
$CONF["name"] = $json->{"name"};

validate($json, "res");
$CONF["res"] = $json->{"res"};

validate($json,"db1host");
validate($json,"db2host");
validate($json,"db1uname");
validate($json,"db2uname");
validate($json,"db1passwd");
validate($json,"db2passwd");
validate($json,"db1name");
validate($json,"db2name");

$db1 = array('name' => $json->{"db1host"}, 'uname' => $json->{"db1uname"}, 'passwd' => $json->{"db1passwd"}, 'dbname' => $json->{"db1name"});
$db2 = array('name' => $json->{"db2host"}, 'uname' => $json->{"db2uname"}, 'passwd' => $json->{"db2passwd"}, 'dbname' => $json->{"db2name"});

?>
