<?php
define('DB_USER', 'rahul_100');
define('DB_PASSWORD', 'r@hu!');
define('DB_HOSTNAME', 'localhost');
define('DB_NAME', 'customers');
$db=mysql_connect(DB_HOSTNAME,DB_USER,DB_PASSWORD,DB_NAME);
	OR die("could not connect to database");
mysqli_set_charset($db,'utf8');
?>	