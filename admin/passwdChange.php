<?php
include($_SERVER['DOCUMENT_ROOT']."/includes/verifyAdmin.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/hashUtil.php");

if(getAdminID($_COOKIE['sid']) != 1) {
	die("You need to be root to access this page!");
}

if((!isset($_GET['uid'])) || intval($_GET['uid'] == 0)) {
	die("UID needs to be set");
}

$submit = false;
$passwd1good = false;
$passwd2good = false;
$passwdConfgood = false;
$passwdMatch = false;
$changed = false;

if(isset($_POST['passwd1'])) {
	$submit = true;
	if(strlen($_POST['passwd1']) > 0 && ctype_alnum($_POST['passwd1']))
		$passwd1good = true;
}

if(isset($_POST['passwd2'])) {
	$submit = true;
	if(strlen($_POST['passwd2']) > 0 && ctype_alnum($_POST['passwd2']))
		$passwd2good = true;
}

if($passwd1good && $passwd2good && $_POST['passwd1'] == $_POST['passwd2'])
	$passwdMatch = true;

if(isset($_POST['passwdRoot'])) {
	$submit = true;
	if(isAdmin("root", $_POST['passwdRoot']) == 1)
		$passwdConfgood = true;
}

if($submit && $passwdMatch && $passwdConfgood) {
	//Change Password
	updateAdminHash(intval($_GET['uid']), gen_hash($_POST['passwd1']));
	$changed = true;
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
		<title>Change Password</title>
		<?php include($_SERVER['DOCUMENT_ROOT']."/includes/head.php"); ?>
		<link href="/css/sb-admin/sb-admin.css" rel="stylesheet">
	</head>
	<body>
		<div id="wrapper">
			<?php $select = 0; include($_SERVER['DOCUMENT_ROOT']."/includes/adminNav.php"); ?>
			<div id="page-wrapper">
				<h1>Change Password for <?php echo getChangeAdminName(); ?></h1>
				<hr>
				<?php
				if($changed) {
					echo "<div class=\"alert alert-success\"><strong>Success!</strong> Password Changed</div>";
					exit();
				}
				 ?>
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							Change Password
						</div>
						<div class="panel-body">
							<form role="form" id="cngPasswd" method="post">
								<div class="form-group<?php if($submit && !$passwdMatch) echo " has-warning"; ?>">
									<label class="control-label">New Password:</label>
									<input class="form-control" autocomplete="off" name="passwd1" type="password"></input>
								</div>
								<div class="form-group<?php if($submit && !$passwdMatch) echo " has-warning"; ?>">
									<label class="control-label">Confirm Password:</label>
									<input class="form-control" autocomplete="off" name="passwd2" type="password"></input>
								</div>
								<div class="form-group<?php if($submit && !$passwdConfgood) echo " has-error"; ?>">
									<label class="control-label">Root Password (For confirmation):</label>
									<input class="form-control" autocomplete="off" name="passwdRoot" type="password"></input>
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
