<?php

define("CONFIG_FILE_PATH", $_SERVER['DOCUMENT_ROOT']."/config/config.xml");

return simplexml_load_file(CONFIG_FILE_PATH);

?>
