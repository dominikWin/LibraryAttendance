<?php
include("includes/config.php");

function img_res() {
	global $CONF;
	if(!isset($CONF['res'])) return array("width" => 48, "height" => 48);
	if(count(split('x', $CONF['res'])) != 2) return array("width" => 48, "height" => 48);
	if(0 == intval(split('x', $CONF['res'])[0]) * intval(split('x', $CONF['res'])[1])) return array("width" => 48, "height" => 48); //If either is 0 it will fail
	return array("width" => intval(split('x', $CONF['res'])[0]), "height" => intval(split('x', $CONF['res'])[1]));
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $CONF['name']; ?></title>
		<?php include($_SERVER['DOCUMENT_ROOT']."libraryattendance/includes/head.php"); ?>

		<script type="text/javascript">
			var img_height = <?php echo img_res()['height']; ?>;
			var img_width = <?php echo img_res()['width']; ?>;
		</script>

		<script type="text/javascript" src="/libraryattendance/js/login.js"></script>
		<script type="text/javascript" src="/libraryattendance/js/adminLogin.js"></script>
		<script type="text/javascript" src="/libraryattendance/js/numberfield.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="login.php"><?php echo $CONF['name']; ?></a>
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
						<div style="margin-bottom:5px;">
							<form id="adminLogin" action="libraryattendance/interface/adminlogin.php" method="post">
								<div class="form-group">
									<label>Username:</label>
									<input class="form-control" autocomplete="off" id="uname" type="text">
								</div>
								<div class="form-group">
									<label>Password:</label>
									<input class="form-control" autocomplete="off" id="passwd" type="password">
								</div>
								<button class="btn btn-primary form-control">Login</button>
							</form>
						</div>
						<div class="collapse" id="admin-error">
							<div class="alert alert-danger" id="db-message">
								<span class="glyphicon glyphicon-remove"></span>  Invalid login
							</div>
						</div>
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
								<input class="form-control" autocomplete="off" id="q" name="q" type="text" maxlength="6" numonly>
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
						<span class="glyphicon glyphicon-remove"></span>  Student not found!
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
