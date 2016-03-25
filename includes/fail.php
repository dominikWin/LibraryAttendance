<?php
//This is added when a user lacks proper authentication
echo file_get_contents($_SERVER['DOCUMENT_ROOT']."/index.html");
exit();
