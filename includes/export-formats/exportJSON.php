<?php

header("Content-Type: application/json");

$status = db1_connect();

if(is_null($status)) {
	exit();
}

$visits = get_visits_table(-1);

if(isset($_GET['unix']) && $_GET['unix'] == 'on') {}
else {
	for($i = 0; $i < count($visits); $i++) {
		$visits[$i]['time'] = date("Y-m-d h:i:s A",$visits[$i]['time']);
	}
}

echo json_encode($visits);

?>
