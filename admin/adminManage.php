<?php
include($_SERVER['DOCUMENT_ROOT']."/includes/verifyAdmin.php");
$notRootError = null;

if(isset($_POST['action'])) {
	if($_POST['action'] == "add") {
		//add admin
	}
	else {
		if(strlen($_POST['action']) > 3) {
			$act = substr($_POST['action'], 0, 3);
			$num = intval(substr($_POST['action'], 3));
			if($num == 0) {//Invalid action
				exit();
			}
			if($act == "del") {
				if($num == 1) {//Root
					exit();
				}

				if(getAdminID($_COOKIE['sid']) != 1) {
					$notRootError = true;
				}
				else {
					removeAdmin($num);
				}
			}
		}
	}
}

function drawTable() {
	global $notRootError;

	if($notRootError) {
		echo "<div class=\"alert alert-warning\"><strong>Warning!</strong> You can't modify users unless you are root.</div>";
	}

	$admins = getAdmins();
	// ID, Name, Change Passwd, Delete
	echo "<div class=\"well\"><table class=\"table\"><thead><th>ID</th><th>Username</th><th></th></thead>";
	echo "<tbody>";
	for($i = 0; $i < count($admins); $i++) {
		$root = ($admins[$i]['id'] == 1);
		if($root) {
			echo "<tr class=\"info\">";
			echo "<td>".$admins[$i]['id']."</td>";
			echo "<td>".$admins[$i]['uname']."</td>";
			echo "<td><form method=\"post\"><div class=\"btn-group\"><button type=\"submit\" name=\"action\" value=\"cng1\" class=\"btn btn-primary\"><span class=\"glyphicon glyphicon-pencil\"></span> Change Password</button></form></td>";
			echo "</tr>";
		}
		else {
			echo "<tr>";
			echo "<td>".$admins[$i]['id']."</td>";
			echo "<td>".$admins[$i]['uname']."</td>";
			echo "<td><form method=\"post\"><div class=\"btn-group\"><button type=\"submit\" name=\"action\" value=\"cng".$admins[$i]['id']."\" class=\"btn btn-primary\"><span class=\"glyphicon glyphicon-pencil\"></span> Change Password</button>";
			echo "<button type=\"submit\" name=\"action\" value=\"del".$admins[$i]['id']."\" class=\"btn btn-danger\"><span class=\"glyphicon glyphicon-fire\"></span> Delete</button></div></form></td>";
			echo "</tr>";
		}
	}
	echo "</tbody></table></div>";
	echo "<form method=\"post\"><button class=\"btn btn-success\" type=\"submit\" name=\"action\" value=\"add\"><span class=\"glyphicon glyphicon-plus\"></span> Add Administrator</button></form>";
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
