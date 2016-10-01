<?php
include_once($_SERVER['DOCUMENT_ROOT']."/libraryattendance/includes/verifyAdmin.php");
include_once($_SERVER['DOCUMENT_ROOT']."/libraryattendance/includes/hashUtil.php");

if(get_admin_id($_COOKIE['sid']) != 1) {
	die("You need to be root to access this page!");
}

$added = false;

if(isset($_POST['uname']) && isset($_POST['passwd'])) {
	if(strlen($_POST['uname']) > 0 && strlen($_POST['passwd']) > 0) {
		if(ctype_alnum($_POST['uname'])) {
			$hash = gen_hash($_POST['passwd']);
			add_admin($_POST['uname'], $hash);
			$added = true;
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Add Admin</title>
		<?php include_once($_SERVER['DOCUMENT_ROOT']."/libraryattendance/includes/head.php"); ?>
		<link href="/libraryattendance/css/sb-admin/sb-admin.css" rel="stylesheet">
	</head>
	<body>
		<div id="wrapper">
			<?php $select = 0; include_once($_SERVER['DOCUMENT_ROOT']."/libraryattendance/includes/adminNav.php"); ?>
			<div id="page-wrapper">
				<h1>Add Administrator</h1>
				<hr>
				<?php
				if($added) {
					echo "<div class=\"alert alert-success\"><strong>Success!</strong> Added Admin</div>";
					exit();
				}
				?>
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							Add Administrator
						</div>
						<div class="panel-body">
							<form role="form" id="cngPasswd" method="post">
								<div class="form-group">
									<label class="control-label">Name</label>
									<input class="form-control" autocomplete="off" name="uname" type="text">
								</div>
								<div class="form-group">
									<label class="control-label">Password:</label>
									<input class="form-control" autocomplete="off" name="passwd" type="password">
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-success" text="Change Password"><span class="glyphicon glyphicon-plus"></span> Add</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
