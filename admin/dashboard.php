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
			<!-- Navigation -->
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.html"><?php echo $config->name; ?></a>
				</div>
				<!-- Top Menu Items -->
				<ul class="nav navbar-right top-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo $name; ?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li>
								<a href="#"><span class="glyphicon glyphicon-log-out"></span>  Log Out</a>
							</li>
						</ul>
					</li>
				</ul>
				<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav side-nav">
						<li class="active">
							<a href="#"><span class="glyphicon glyphicon-home"></span>  Dashboard</a>
						</li>
						<li>
							<a href="#"><span class="glyphicon glyphicon-list"></span>  Visits</a>
						</li>
						<li>
							<a href="#"><span class="glyphicon glyphicon-export"></span>  Export</a>
						</li>
						<li>
							<a href="#"><span class="glyphicon glyphicon-edit"></span>  Administrators</a>
						</li>
						<li>
							<a href="#"><span class="glyphicon glyphicon-cog"></span>  Settings</a>
						</li>
					</ul>
				</div>
			</nav>
			<div id="page-wrapper">
				<h1>Stuff</h1>

			</div>
		</div>
	</body>
</html>
