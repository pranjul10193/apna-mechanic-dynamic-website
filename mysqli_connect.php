<?php
define('DB_USER', 'pranjul');
define('DB_PASSWORD', 'iloveindore');
define('DB_HOSTNAME', 'localhost');
define('DB_NAME', 'apnamechanicdb');
$db=mysqli_connect(DB_HOSTNAME,DB_USER,DB_PASSWORD,DB_NAME)
	OR die("could not connect to database");
mysqli_set_charset($db,'utf8');
?>	