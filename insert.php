<?php

// print_r($_POST);
include("includes/database.php");
// print_r($db2);

db2_connect();
logVisit(htmlspecialchars($_POST['q']));
db2_close();
