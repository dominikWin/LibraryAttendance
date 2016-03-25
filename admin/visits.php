<?php
include($_SERVER['DOCUMENT_ROOT']."/includes/verifyAdmin.php");
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
			<?php $select = 2; include($_SERVER['DOCUMENT_ROOT']."/includes/adminNav.php"); ?>
			<div id="page-wrapper">
				<h1>Visits</h1>

			</div>
		</div>
	</body>
</html>
