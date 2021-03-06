<?php
include_once($_SERVER['DOCUMENT_ROOT']."/libraryattendance/includes/verifyAdmin.php");
include_once($_SERVER['DOCUMENT_ROOT']."/libraryattendance/includes/hashUtil.php");

if(get_admin_id($_COOKIE['sid']) != 1) {
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
	if(is_admin("root", $_POST['passwdRoot']) == 1)
		$passwdConfgood = true;
}

if($submit && $passwdMatch && $passwdConfgood) {
	//Change Password
	update_admin_hash(intval($_GET['uid']), gen_hash($_POST['passwd1']));
	$changed = true;
}

function get_change_admin_name() {
	$name = get_admin_name(intval($_GET['uid']));
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
		<?php include_once($_SERVER['DOCUMENT_ROOT']."/libraryattendance/includes/head.php"); ?>
		<link href="/libraryattendance/css/sb-admin/sb-admin.css" rel="stylesheet">
	</head>
	<body>
		<div id="wrapper">
			<?php $select = 0; include_once($_SERVER['DOCUMENT_ROOT']."/libraryattendance/includes/adminNav.php"); ?>
			<div id="page-wrapper">
				<h1>Change Password for <?php echo get_change_admin_name(); ?></h1>
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
									<input class="form-control" autocomplete="off" name="passwd1" type="password">
								</div>
								<div class="form-group<?php if($submit && !$passwdMatch) echo " has-warning"; ?>">
									<label class="control-label">Confirm Password:</label>
									<input class="form-control" autocomplete="off" name="passwd2" type="password">
								</div>
								<div class="form-group<?php if($submit && !$passwdConfgood) echo " has-error"; ?>">
									<label class="control-label">Root Password (For confirmation):</label>
									<input class="form-control" autocomplete="off" name="passwdRoot" type="password">
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
