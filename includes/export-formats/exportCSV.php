<?php

header("Content-Type: text/csv");

$status = db1_connect();

if(is_null($status)) {
	exit();
}

$visits = getVisitsTable(-1);

echo "\"First Name\",\"Last Name\",ID,Time\n";
for($i = 0; $i < count($visits); $i++) {
	echo "\"".$visits[$i]['name']['fname']."\",\"".$visits[$i]['name']['lname']."\",".$visits[$i]['id'].",";
	if(isset($_GET['unix']) && $_GET['unix'] == 'on') {
		echo $visits[$i]['time']."\n";
	}
	else {
		echo "\"".date("Y-m-d h:i:s A",$visits[$i]['time'])."\"\n";
	}
}
?>
