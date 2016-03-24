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
		<script type="text/javascript" src="js/adminLogin.js"></script>
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
					<li style="cursor: pointer;"><a data-toggle="modal" data-target="#adminLoginModal">Administrator Login <span class="glyphicon glyphicon-cog"></span></a></li>
				</ul>
			</div>
		</nav>
		<div id="adminLoginModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4>Administrator Login</h4>
					</div>
					<div class="modal-body">
						<form id="adminLogin" action="interface/adminlogin.php" method="post">
							<div class="form-group">
								<label>Username:</label>
								<input class="form-control" autocomplete="off" id="uname" type="text"></input>
							</div>
							<div class="form-group">
								<label>Password:</label>
								<input class="form-control" autocomplete="off" id="passwd" type="text"></input>
							</div>
							<button class="btn btn-primary form-control">Login</button>
						</form>
					</div>
					<div class="modal-footer">
						 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="collapse" id="db-status">
				<div class="alert alert-danger" id="db-message">
					<span class="glyphicon glyphicon-remove"></span>  Error connecting to server!
				</div>
			</div>
		</div>
		<div class="container">
			<!-- Login Menu -->
			<div class="col-md-4">
				<div class="panel panel-default" style="margin-top: 100px;">
					<div class="panel-heading">
						<b>Login</b>
					</div>
					<div class="panel-body" id="loginForm">
						<form role="form" id="login" action="interface/logvisit.php" method="post">
							<div class="form-group">
								<label>Student ID:</label>
								<input class="form-control" autocomplete="off" id="q" name="q" type="text" maxlength="6" numonly></input>
							</div>
						</form>
					</div>
				</div>
				<div class="collapse" id="s-status">
					<div class="alert alert-success">
						<span class="glyphicon glyphicon-ok"></span>  Welcome!
					</div>
				</div>
				<div class="collapse" id="e-status">
					<div class="alert alert-danger">
						<span class="glyphicon glyphicon-remove"></span>  User not found!
					</div>
				</div>
			</div>
			<div class="col-md-3"></div>
			<div class="col-md-4">
				<ul class="list-group" id="student-list">
					<li class="list-group-item list-group-item-heading"><b>Students</b></li>
				</ul>
				<div id="loadMoreContainer">
					<button class="btn btn-default" onclick="loadMore();" style="width:100%;">Load More</button>
				</div>
			</div>
		</div>
		<!-- Scroll down buffer -->
		<div style="height:100px;"></div>
	</body>
</html>
