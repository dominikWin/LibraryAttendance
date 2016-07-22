<html>
	<head>
		<script type="text/javascript" src="/js/js.cookie-2.1.0.min.js"></script>
		<script type="text/javascript" src="/js/cookie.js"></script>
		<script>
			console.log("Logging out")
			if(sidExists())
					removeSID()
			top.location = "/index.html"
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

include($_SERVER['DOCUMENT_ROOT']."/includes/database.php");

$status = db2_connect();

if(is_null($status)) {
	exit();
}

remove_session($sid);

//Does not need to be here but it works
revoke_expired_sessions();

?>
