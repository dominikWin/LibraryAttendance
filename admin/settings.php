<?php
include($_SERVER['DOCUMENT_ROOT']."/libraryattendance/includes/verifyAdmin.php");

$renamed = false;

if(isset($_POST['rename']) && strlen($_POST['rename']) > 0) {
	if(ctype_alnum(str_replace(' ', '', $_POST['rename']))) {
		set_conf_value('name', $_POST['rename']);
		$renamed = true;
	}
	else {
		die("Can't be non alnum value");
	}
}

$imgresset = false;
if(isset($_POST['imgw']) && isset($_POST['imgh'])) {
	if(intval($_POST['imgw']) > 0 && intval($_POST['imgh']) > 0) {
		set_conf_value('res', $_POST['imgw'] . 'x' . $_POST['imgh']);
		$imgresset = true;
	}
	else {
		die("Invalid values");
	}
}
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Settings</title>
		<?php include($_SERVER['DOCUMENT_ROOT']."/libraryattendance/includes/head.php"); ?>
		<link href="/libraryattendance/css/sb-admin/sb-admin.css" rel="stylesheet">
	</head>
	<body>
		<div id="wrapper">
			<?php $select = 4; include($_SERVER['DOCUMENT_ROOT']."/libraryattendance/includes/adminNav.php"); ?>
			<div id="page-wrapper">
				<h1>Settings</h1>
				<hr>
				<div class="alert alert-info"><strong>Notice</strong> In a testing environment this will not write to disk to due to disk write permissions.
				This should work on any system where the config directory is writable by the webserver.</div>
				<div class="col-md-5">
					<div class="panel panel-default">
						<div class="panel-heading">
							System Name
						</div>
						<div class="panel-body">
							<form method="post">
								<div class="form-group">
									<label>System Name:</label>
									<input class="form-control" name="rename" type="text" placeholder="<?php echo $CONF['name']; ?>">
								</div>
								<button class="btn btn-primary form-control" type="submit">Rename</button>
							</form>
							<?php if($renamed) echo "<div class=\"alert alert-success\"><strong>Success!</strong> Renamed to ".$CONF['name']; ?>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="panel panel-default">
						<div class="panel-heading">
							Image Scale Resolution
						</div>
						<div class="panel-body">
							<form method="post">
								<div class="form-group">
									<label>Width:</label>
									<input class="form-control" name="imgw" type="number" min="1" placeholder="<?php echo split('x', $CONF['res'])[0]; ?>">
								</div>
								<div class="form-group">
									<label>Height:</label>
									<input class="form-control" name="imgh" type="number" min="1" placeholder="<?php echo split('x', $CONF['res'])[1]; ?>">
								</div>
								<button class="btn btn-primary form-control" type="submit">Update</button>
							</form>
							<?php if($imgresset) echo "<div class=\"alert alert-success\"><strong>Success!</strong> Set to ".$CONF['res']; ?>
						</div>
					</div>
				</div>
	
			</div>
		</div>
	</body>
</html>
