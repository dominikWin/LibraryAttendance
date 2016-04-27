<?php
include($_SERVER['DOCUMENT_ROOT']."/includes/verifyAdmin.php");

function drawTable() {
	$admins = getAdmins();
	// ID, Name, Change Passwd, Delete
	echo "<table class=\"table\"><thead><th>ID</th><th>Username</th><th></th><th></th></thead>";
	echo "<tbody>";
	for($i = 0; $i < count($admins); $i++) {
		$root = ($admins[$i]['id'] == 1);
		if($root) {
			echo "<tr class=\"info\">";
			echo "<td>".$admins[$i]['id']."</td>";
			echo "<td>".$admins[$i]['uname']."</td>";
			echo "<td></td><td></td>";
			echo "</tr>";
		}
		else {
			echo "<tr>";
			echo "<td>".$admins[$i]['id']."</td>";
			echo "<td>".$admins[$i]['uname']."</td>";
			echo "<td></td><td></td>";
			echo "</tr>";
		}
	}
	echo "</tbody></table>";
}
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Dashboard</title>
		<?php include($_SERVER['DOCUMENT_ROOT']."/includes/head.php"); ?>
		<link href="/css/sb-admin/sb-admin.css" rel="stylesheet">
	</head>
	<body>
		<div id="wrapper">
			<?php $select = 4; include($_SERVER['DOCUMENT_ROOT']."/includes/adminNav.php"); ?>
			<div id="page-wrapper">
				<h1>Administrators</h1>
				<hr>
				<div class="container">
					<div class="row">
						<div class="span2 offset3">
							<div class="panel panel-default">
								<div class="panel-heading">
									Administrator Managment
								</div>
								<div class="panel-body">
								<?php drawTable(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
