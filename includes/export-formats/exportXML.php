<?php

header("Content-Type: text/xml");

$status = db1_connect();

if(is_null($status)) {
	exit();
}

$visits = get_visits_table(-1);

echo "<visits>\n";
for($i = 0; $i < count($visits); $i++) {
	echo "\t<visit>\n";
	echo "\t\t<fname>".$visits[$i]['name']['fname']."</fname>\n";
	echo "\t\t<lname>".$visits[$i]['name']['lname']."</lname>\n";
	echo "\t\t<id>".$visits[$i]['id']."</id>\n";
	if(isset($_GET['unix']) && $_GET['unix'] == 'on') {
		echo "\t\t<time>".$visits[$i]['time']."</time>\n";
	}
	else {
		echo "\t\t<time>".date("Y-m-d h:i:s A",$visits[$i]['time'])."</time>\n";
	}
	echo "\t</visit>\n";
}
echo "</visits>";
?>
