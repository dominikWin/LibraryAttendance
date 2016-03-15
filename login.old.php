<?php
$config = include("includes/config.php");
?>

<html>
    <head>
        <title><?php echo $config->name; ?></title>
        <script type="text/javascript" src="js/jquery-2.2.1.min.js"></script>
        <script type="text/javascript" src="js/login.js"></script>
        <script type="text/javascript" src="js/numberfield.js"></script>
    </head>
    <body>
            <h1><?php echo $config->name; ?></h1>
            <form id="login" action="insert.php" method="post">
                    Login:
                    <input id="q" name="q" type="text" step="1" maxlength="6" size=4 numonly>
            </form>
            <div id="result">
            </div>
    </body>
</html>
