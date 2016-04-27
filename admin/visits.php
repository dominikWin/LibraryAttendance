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
			<?php $select = 2; include($_SERVER['DOCUMENT_ROOT']."/includes/adminNav.php"); ?>
			<div id="page-wrapper">
				<h1>Visits <small>Monitor Visits</small></h1>
				<div class="col-md-2">
					<div class="panel panel-default">
						<div class="panel-heading">
							Show Visits
						</div>
						<div class="panel-body">
							<form method="post">
								<div class="form-group">
									<label>Number:</label>
									<input class="form-control" autocomplete="off" name="num" id="num" type="number" min="0" max="1000" step="1"></input>
									<br />
									<button type="submit" class="btn btn-primary form-control">Query</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<?php
					if(isset($_POST['num']) && intval($_POST['num']) >= 1) {
						include($_SERVER['DOCUMENT_ROOT']."/includes/tableHead.php");
						$status = db1_connect();
						if(is_null($status)) {
							exit();
						}
						$status = db2_connect();
						if(is_null($status)) {
							exit();
						}
						$visits = getVisitsTable(intval($_POST['num']));
						for($i = 0; $i < count($visits); $i++) {
							echo "<tr>";
							echo "<td>".$visits[$i]['name']['fname']."</td>";
							echo "<td>".$visits[$i]['name']['lname']."</td>";
							echo "<td>".$visits[$i]['id']."</td>";
							echo "<td>".date("Y-m-d h:i:s A",$visits[$i]['time'])."</td>";
							echo "</tr>";
						}
						echo "</tbody></table>";
					}
					else {
						echo "<div style=\"height:250px;\"></div>";
					}
				?>
			</div>
		</div>
	</body>
</html>
