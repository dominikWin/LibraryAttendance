<?php
include($_SERVER['DOCUMENT_ROOT']."/includes/verifyAdmin.php");

if(getAdminID($_COOKIE['sid']) != 1) {
	die("You need to be root to access this page!");
}

if((!isset($_GET['uid'])) || intval($_GET['uid'] == 0)) {
	die("UID needs to be set");
}

function getChangeAdminName() {
	$name = getAdminName(intval($_GET['uid']));
	if($name == null) {
		die("Invalid admin id");
	}
	return $name;
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
			<?php $select = 0; include($_SERVER['DOCUMENT_ROOT']."/includes/adminNav.php"); ?>
			<div id="page-wrapper">
				<h1>Change Password for <?php echo getChangeAdminName(); ?></h1>
				<hr>
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							Change Password
						</div>
						<div class="panel-body">
							<form role="form" id="cngPasswd" method="post">
								<div class="form-group">
									<label>New Password:</label>
									<input class="form-control" autocomplete="off" id="passwd1" type="password"></input>
								</div>
								<div class="form-group">
									<label>Confirm Password:</label>
									<input class="form-control" autocomplete="off" id="passwd2" type="password"></input>
								</div>
								<div class="form-group">
									<label>Root Password (For confirmation):</label>
									<input class="form-control" autocomplete="off" id="passwdRoot" type="password"></input>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-warning" text="Change Password"><span class="glyphicon glyphicon-ok"></span> Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
