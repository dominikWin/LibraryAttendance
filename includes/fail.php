<?php
//This is added when an admin fails to authenticate
echo file_get_contents($_SERVER['DOCUMENT_ROOT']."libraryattendance/index.html");
exit();
