<?php
$config = include("includes/config.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $config->name; ?></title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<script type="text/javascript" src="js/jquery-2.2.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
	        <script type="text/javascript" src="js/login.js"></script>
	        <script type="text/javascript" src="js/numberfield.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="login.php"><?php echo $config->name; ?></a>
				</div>
				<ul class="nav navbar-nav navbar-right">
					<li><a>Item1</a></li>
				</ul>
			</div>
		</nav>
		<div class="container">
			<!-- <div class="col-md-6"></div> -->
			<!-- Login Menu -->
			<div class="col-md-4">
				<div class="panel panel-default" style="margin-top: 100px;">
					<div class="panel-heading">
						Login
					</div>
					<div class="panel-body">
						<form role="form" id="login" action="interface/logvisit.php" method="post">
							<div class="from-group">
								<label>Student ID:</label>
								<input class="form-control" autocomplete="off" id="q" name="q" type="text" maxlength="6" numonly>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
