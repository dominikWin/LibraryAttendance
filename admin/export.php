<?php
include($_SERVER['DOCUMENT_ROOT']."/includes/verifyAdmin.php");
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Dashboard</title>
		<?php include($_SERVER['DOCUMENT_ROOT']."/includes/head.php"); ?>
		<link href="/css/sb-admin/sb-admin.css" rel="stylesheet">
		<script type="text/javascript" src="/js/numberfield.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<?php $select = 3; include($_SERVER['DOCUMENT_ROOT']."/includes/adminNav.php"); ?>
			<div id="page-wrapper">
				<h1>Export</h1>
				<hr>
				<div class="container">
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								Export Settings
							</div>
							<div class="panel-body">
								<form class="form" method="get">
									<div class="form-group" id="format" name="format">
										<label>Format:</label>
										<select class="form-control">
											<option value="one">CSV</option>
											<option value="two">XML</option>
											<option value="three">JSON</option>
										</select>
									</div>
									<div class="form-group">
										<label>Limit Quantity:</label>
										<div class="checkbot"><label><input type="checkbox" id="limit"></label></div>
										<input class="form-control" autocomplete="off" name="num" id="num" type="number" min="0" max="1000" step="1" placeholder="Quantity"></input>
									</div>
									<div class="form-group">
										<label>Fields:</label>
										<select multiple class="form-control">
											<option>First Name</option>
											<option>Last Name</option>
											<option>ID</option>
											<option>Time (Formated)</option>
											<option>Time (UNIX)</option>
										</select>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary form-control">Export</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
