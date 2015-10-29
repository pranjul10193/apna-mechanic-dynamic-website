<?php
session_start();
if (@$_SESSION['log']=="no") {
	header("Location: index.php");
	exit();
}
else{
$_SESSION['log']="no";
unset($_SESSION['index']);
header("Location: index.php");
}
?>