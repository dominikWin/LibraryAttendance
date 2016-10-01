<html>
	<head>
		<script type="text/javascript" src="/libraryattendance/js/js.cookie-2.1.0.min.js"></script>
		<script type="text/javascript" src="/libraryattendance/js/cookie.js"></script>
		<script>
			console.log("Logging out")
			if(sidExists())
					removeSID()
			top.location = "/libraryattendance/index.html"
		</script>
	</head>
	<body></body>
</html>

<?php

if(!isset($_COOKIE['sid'])) {
	exit();
}

$sid = $_COOKIE['sid'];

if(strlen($sid) != 40 || !ctype_alnum($sid)) {
	exit();
}

include_once($_SERVER['DOCUMENT_ROOT']."/libraryattendance/includes/database.php");

$status = db2_connect();

if(is_null($status)) {
	exit();
}

remove_session($sid);

//Does not need to be here but it works
revoke_expired_sessions();

?>
