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
			<li<?php if($select == 1) echo " class=\"active\"" ?>>
				<a href="/admin/dashboard.php"><span class="glyphicon glyphicon-home"></span>  Dashboard</a>
			</li>
			<li<?php if($select == 2) echo " class=\"active\"" ?>>
				<a href="/admin/visits.php"><span class="glyphicon glyphicon-list"></span>  Visits</a>
			</li>
			<li<?php if($select == 3) echo " class=\"active\"" ?>>
				<a href="/admin/export.php"><span class="glyphicon glyphicon-export"></span>  Export</a>
			</li>
			<li<?php if($select == 4) echo " class=\"active\"" ?>>
				<a href="/admin/adminManage.php"><span class="glyphicon glyphicon-edit"></span>  Administrators</a>
			</li>
			<li<?php if($select == 5) echo " class=\"active\"" ?>>
				<a href="/admin/settings.php"><span class="glyphicon glyphicon-cog"></span>  Settings</a>
			</li>
		</ul>
	</div>
</nav>