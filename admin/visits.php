<?php
include($_SERVER['DOCUMENT_ROOT']."/includes/verifyAdmin.php");
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Visits</title>
		<?php include($_SERVER['DOCUMENT_ROOT']."/includes/head.php"); ?>
		<link href="/css/sb-admin/sb-admin.css" rel="stylesheet">
		<script type="text/javascript" src="/js/numberfield.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<?php $select = 1; include($_SERVER['DOCUMENT_ROOT']."/includes/adminNav.php"); ?>
			<div id="page-wrapper">
				<h1>Visits</h1>
				<hr>
				<div class="container">
					<div class="col-md-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								Filter Settings
							</div>
							<div class="panel-body">
								<form class="form" method="get">
									<div class="form-group">
										<input class="form-control" autocomplete="off" name="num" id="num" type="number" min="0" max="1000" step="1" placeholder="Max Quantity">
									</div>
									<div class="form-group">
										<input class="form-control" autocomplete="off" name="sid" id="sid" type="text" placeholder="Student ID" numonly>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary form-control">Query</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-body">
								<?php
									$num = 0;
									$id = 0;
									if(!isset($_GET['num'])) {
										$num = 10;
									}
									elseif(intval($_GET['num']) >= 1 && intval($_GET['num']) <= 1000) {
										$num = intval($_GET['num']);
									}
									else {
										$num = 1000;
									}

									if(isset($_GET['sid']) && intval($_GET['sid']) > 0) {
										$id = $_GET['sid'];
									}

									$status = db1_connect();
									if(is_null($status)) {
										exit();
									}
									$status = db2_connect();
									if(is_null($status)) {
										exit();
									}
									$visits = getVisitsTable($num, $id);
									echo "<div class=\"alert alert-info\"><strong>".count($visits)."</strong> visit". (count($visits) > 1 ? "s" : "") ." shown out of ".countVisits()."</div>";
									include($_SERVER['DOCUMENT_ROOT']."/includes/tableHead.php");
									for($i = 0; $i < count($visits); $i++) {
										echo "<tr>";
										echo "<td>".$visits[$i]['name']['fname']."</td>";
										echo "<td>".$visits[$i]['name']['lname']."</td>";
										echo "<td>".$visits[$i]['id']."</td>";
										echo "<td>".date("Y-m-d h:i:s A",$visits[$i]['time'])."</td>";
										echo "</tr>";
									}
									echo "</tbody></table>";
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
