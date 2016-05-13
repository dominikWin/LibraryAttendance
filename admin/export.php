<?php
include($_SERVER['DOCUMENT_ROOT']."/includes/verifyAdmin.php");

if(isset($_GET['format'])) {
	//Gen system
	if($_GET['format'] == 'csv') {
		include($_SERVER['DOCUMENT_ROOT']."/includes/export-formats/exportCSV.php");
	}
	elseif($_GET['format'] == 'xml') {
		include($_SERVER['DOCUMENT_ROOT']."/includes/export-formats/exportXML.php");
	}
	elseif($_GET['format'] == 'json') {
		include($_SERVER['DOCUMENT_ROOT']."/includes/export-formats/exportJSON.php");
	}
	else {
		die("Unknown format");
	}
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Export</title>
		<?php include($_SERVER['DOCUMENT_ROOT']."/includes/head.php"); ?>
		<link href="/css/sb-admin/sb-admin.css" rel="stylesheet">
		<script type="text/javascript" src="/js/numberfield.js"></script>
		<script>
			$(document).ready(function(){
    				$('[data-toggle="tooltip"]').tooltip();
			});
		</script>
	</head>
	<body>
		<div id="wrapper">
			<?php $select = 2; include($_SERVER['DOCUMENT_ROOT']."/includes/adminNav.php"); ?>
			<div id="page-wrapper">
				<h1>Export</h1>
				<hr>
				<div class="container">
					<div class="row">
						<div class="span2 offset3">
							<div class="panel panel-default">
								<div class="panel-heading">
									Export Settings
								</div>
								<div class="panel-body">
									<form class="form" method="get">
										<div class="form-group">
											<label>Format:</label>
											<select class="form-control" name="format">
												<option value="csv">CSV</option>
												<option value="xml">XML</option>
												<option value="json">JSON</option>
											</select>
										</div>
										<div class="form-group">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="unix" />
													<a href="#" data-toggle="tooltip" style="text-decoration:none;" data-placement="auto" title="Will display time as the seconds since Jan 1, 1970. If unsure don't select.">UNIX Time Format</a>
												</label>
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
		</div>
	</body>
</html>
